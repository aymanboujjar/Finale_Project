<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseLesson extends Model
{
    //
    protected $fillable = [
       "user_id",
       "is_complete",
       "calendar_id"

    ];

    
}
