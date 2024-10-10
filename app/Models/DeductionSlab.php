<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeductionSlab extends Model
{
    use HasFactory;
    protected $guarded;

    public function crop()
    {
        return $this->belongsTo(Crop::class, 'crop_id', 'id');
    }

    public function cat()
    {
        return $this->belongsTo(CropCategory::class, 'crop_category_id', 'id');
    }

    public function cropType()
    {
        return $this->belongsTo(CropType::class, 'crop_type_id', 'id');
    }

    public function year()
    {
        return $this->belongsTo(CropYear::class, 'crop_year_id', 'id');
    }
}
