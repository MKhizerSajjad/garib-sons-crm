<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArrivalInspection extends Model
{
    use HasFactory;
    protected $guarded;

    public function po()
    {
        return $this->belongsTo(PurchaseOrder::class, 'purchase_order_id', 'id');
    }

    public function params()
    {
        return $this->belongsTo(ArrivalInspectionParam::class, 'arrival_inspection_id', 'id');
    }
}
