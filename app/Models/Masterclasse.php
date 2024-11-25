<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Masterclasse extends Model
{
    //
    protected $fillable = [
        "start",
        "end",
        "user_id",
        "name",
        "description",
        "places",
        "image",
        
    ];
}
