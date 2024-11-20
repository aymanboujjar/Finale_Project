<?php

namespace App\Http\Controllers;

use App\Models\Calendar;
use App\Models\Lesson;
use Illuminate\Http\Request;

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
            "image"=>$file
        ]);

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Lesson $lesson)
    {
        //
        $courses = Calendar::where("id",$lesson->calendar_id)->first();
        // dd($courses);
        return view("lesson.lesson",compact("courses"));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lesson $lesson)
    {
        //
    }
}
