<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CropItem extends Model
{
    use HasFactory;
    protected $guarded;

    public function cat()
    {
        return $this->belongsTo(CropCategory::class, 'crop_category_id', 'id');
    }
}
