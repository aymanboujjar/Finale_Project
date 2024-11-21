<?php

namespace App\Http\Controllers;

use App\Models\Calendar;
use App\Models\Classe;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index (){
        $courses = Calendar::all();
        $classes = Classe::all();
        return view("home.home",compact("courses","classes"));
    }
}
