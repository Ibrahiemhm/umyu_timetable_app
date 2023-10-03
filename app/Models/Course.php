<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'courses';

    protected $fillable = [
        'department_id',
        'course_category_id',
        'semester_id',
        'title',
        'course_code',
        'number_of_students'
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function courseCategory()
    {
        return $this->belongsTo(CourseCategory::class);
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }
}
