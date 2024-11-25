<?php

namespace App\Http\Controllers;

use App\Models\Calendar;
use App\Models\CourseLesson;
use App\Models\Projectfinale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FinalProjectController extends Controller
{
    //
    public function store(Request $request, Projectfinale $projectfinale)
    {
        $Projectfinal1 = Projectfinale::where("id","1")->first();
        $Projectfinal2 = Projectfinale::where("id","2")->first();
        $Projectfinal3 = Projectfinale::where("id","3")->first();
        $reponse1= $request->reponse1;
        $reponse2= $request->reponse2;
        $reponse3= $request->reponse3;
        // dd($request->all());
        $course=CourseLesson::where("calendar_id",$request->calendar_id)->where("user_id",Auth::user()->id)->first();
        if ($reponse1==$Projectfinal1->reponse && $reponse2==$Projectfinal2->reponse && $reponse3==$Projectfinal3->reponse ) {
            // dd($Projectfinal3->reponse);
            $course->is_complete = true;
            $course->save();
            return back()->with('success', 'Exam  passed successfully!');
        }
        
        return back()->with('error', 'Exam  Failed good luck in the next time !');

       
    }
    
}
