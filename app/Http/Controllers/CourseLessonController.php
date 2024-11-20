<?php

namespace App\Http\Controllers;

use App\Models\CourseLesson;
use Illuminate\Http\Request;

class CourseLessonController extends Controller
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
        request()->validate([
            "user_id"=>"required",
            "calendar_id"=>"required",
        ]);
        // dd();
        CourseLesson::create([
            "user_id"=>$request->user_id,
            "calendar_id"=>$request->calendar_id
        ]);
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(CourseLesson $courseLesson)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CourseLesson $courseLesson)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CourseLesson $courseLesson)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CourseLesson $courseLesson)
    {
        //
    }
}
