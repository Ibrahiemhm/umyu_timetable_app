<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExamTimetable extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'exam_timetables';

    protected $fillable = [
        'course_id',
        'venue_id',
        'start_time',
        'end_time',
        'date'
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function venue()
    {
        return $this->belongsTo(Venue::class);
    }
}
