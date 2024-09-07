<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keyword extends Model
{
    use HasFactory;
    protected $guarded;

    public function universities()
    {
        return $this->belongsToMany(University::class, 'university_keyword');
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }
}
