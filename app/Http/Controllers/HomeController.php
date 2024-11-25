<?php

namespace App\Http\Controllers;

use App\Models\Calendar;
use App\Models\Classe;
use App\Models\CourseLesson;
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
    public function view() {
        $classes = CourseLesson::where("user_id", Auth::user()->id)->get();
        $allCourses = [];
    
        foreach ($classes as $key) {
            $courses = Calendar::where("id", $key->calendar_id)->get();
    
            foreach ($courses as $course) {
                $course->is_complete = $key->is_complete; 
            }
    
            $allCourses[] = $courses;
        }
    
        return view('profile_show', compact("allCourses"));
    }
    
    
    public function class (Classe $class){
        $courses = Calendar::where("user_id", Auth::user()->id)->where("class_id",$class->id)->get();
        $classes = Classe::where("user_id", Auth::user()->id)->where("id",$class->id)->get();
        return view('classe.classe',compact("courses","classes"));
    }
}
