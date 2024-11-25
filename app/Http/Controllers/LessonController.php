<?php

namespace App\Http\Controllers;

use App\Models\Calendar;
use App\Models\Lesson;
use App\Models\Projectfinale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
       
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            "name" => "required",
            "description" => "required",
            "places" => "required|integer",
            "calendar_id" => "required|integer",
        ]);
        $file = $request->file("image")->store("images", "public");
// dd($file);
        Lesson::create([
            "name"=>$request->name,
            "description"=>$request->description,
            "places"=>$request->places,
            "calendar_id"=>$request->calendar_id,
            "completed"=> false,
            "image"=>$file,
            // "user_id"=>Auth::user()->id,
        ]);

        return back()->with('success', 'lesson created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Lesson $lesson)
    {
        //
        $finalproject = Projectfinale::all();
        $calendar = Calendar::where("id",$lesson->id)->first();
        // dd($courses);
        return view("lesson.lesson",compact("calendar","finalproject"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lesson $lesson)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Lesson $lesson)
    {
        // $lesson->update([
        //     'completed' => 'true',
        // ]);
    
        return response()->json([
            'status' => 'success',
            'message' => 'Lesson 
             completed!',
        ]);
    }
    
    
    
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lesson $lesson)
    {
        //
    }
}
