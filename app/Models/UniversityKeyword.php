<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UniversityKeyword extends Model
{
    use HasFactory;
    protected $guarded;

    public function keyword()
    {
        return $this->belongsTo(Keyword::class);
    }
}
