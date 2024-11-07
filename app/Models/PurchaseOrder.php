<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    use HasFactory;
    protected $guarded;

    public function crop()
    {
        return $this->belongsTo(Crop::class);
    }
    public function cropCategory()
    {
        return $this->belongsTo(CropCategory::class);
    }

    public function cropItem()
    {
        return $this->belongsTo(CropItem::class);
    }

    public function cropType()
    {
        return $this->belongsTo(CropType::class);
    }

    public function cropYear()
    {
        return $this->belongsTo(CropYear::class);
    }

    public function subItem()
    {
        return $this->belongsTo(CropItem::class, 'sub_item_id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function supplierAgent()
    {
        return $this->belongsTo(SupplierAgent::class);
    }

    public function inspections()
    {
        return $this->hasMany(ArrivalInspection::class, 'purchase_order_id', 'id');
    }

    public function firstInspection()
    {
        return $this->hasMany(ArrivalInspection::class, 'arrival_inspection_id', 'id')->whereIn('count', [1, 2, 3])->where('status', 1);
    }

    public function secondInspection()
    {
        return $this->hasMany(ArrivalInspection::class, 'arrival_inspection_id', 'id')->whereIn('count', [2, 3]);
        // return $this->belongsTo(ArrivalInspection::class, 'id', 'arrival_inspection_id')->where('count', 2);
    }

    public function finalInspection()
    {
        return $this->hasMany(ArrivalInspection::class, 'arrival_inspection_id', 'id')->whereIn('count', [3]);
        // return $this->belongsTo(ArrivalInspection::class, 'id', 'arrival_inspection_id')->where('count', 3);
    }
}
