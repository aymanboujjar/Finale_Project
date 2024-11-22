<?php

namespace App\Http\Controllers;

use App\Models\Calendar;
use App\Models\Classe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    //
    public function index (){
        $courses = Calendar::all();
        $classes = Classe::all();
        return view("home.home",compact("courses","classes"));
    }
    public function view (){
        $classes = Classe::where("user_id", Auth::user()->id)->get();
        $courses = Calendar::where("user_id", Auth::user()->id)->get();
        return view('profile_show',compact("courses","classes"));
    }
    public function class (Classe $class){
        $courses = Calendar::where("user_id", Auth::user()->id)->where("class_id",$class->id)->get();
        $classes = Classe::where("user_id", Auth::user()->id)->where("id",$class->id)->get();
        return view('classe.classe',compact("courses","classes"));
    }
}
