<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    use HasFactory;
    protected $guarded;

    public function cat()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function subCat()
    {
        return $this->belongsTo(Category::class, 'sub_category_id', 'id');
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function subItem()
    {
        return $this->belongsTo(Item::class, 'sub_item_id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
