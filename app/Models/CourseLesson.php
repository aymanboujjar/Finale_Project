<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseLesson extends Model
{
    //
    protected $fillable = [
       "user_id",
       "calendar_id"

    ];
}
