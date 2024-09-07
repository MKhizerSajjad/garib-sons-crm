<?php

namespace App\Models;

use Carbon\Unit;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    use HasFactory;
    protected $guarded;

    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    // public function alottedKeywords()
    // {
    //     return $this->hasMany(UniversityKeyword::class);
    // }

    public function keywords()
    {
        return $this->belongsToMany(Keyword::class, 'university_keywords');
    }

    public function universityKeywords()
    {
        return $this->belongsToMany(UniversityKeyword::class, 'university_keywords', 'university_id', 'keyword_id');
    }

    public function universityCourses()
    {
        return $this->hasMany(UniversityCourse::class);
    }
}
