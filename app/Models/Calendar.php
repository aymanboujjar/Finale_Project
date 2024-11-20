<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{
    //
    protected $fillable = [
        "start",
        "end",
        "user_id",
        "name",
        "description",
        "places",
        "class_id"
    ];

    public function lessons (){
        return $this->hasMany(Lesson::class);
    }
    public function users (){
        return $this->belongsToMany(User::class , "course_lessons");
    }
}
