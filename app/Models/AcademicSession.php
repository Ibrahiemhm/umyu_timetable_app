<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class AcademicSession extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'academic_sessions';

    protected $fillable = [
        'title',
        'start_date',
        'end_date'
    ];
}
