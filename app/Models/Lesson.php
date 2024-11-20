<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    //
    protected $fillable = [
        "name",
        "description",
        "places",
        "image",
        "calendar_id"

    ];
    public function Course (){
        return $this->belongsTo(Calendar::class);
    }
}
