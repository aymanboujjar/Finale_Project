<?php

namespace App\Http\Controllers;

use App\Models\Calendar;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function PHPSTORM_META\map;

class CalendarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $user = User::where("id",Auth::user()->id)->first();
        return view('Course.course',compact("user"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

        $events = Calendar::all();

        $events = $events->map(function ($e) {
            $user = User::where("id" , $e->user_id)->first();
            return [
                "id" => $e->id,
                "start" => $e->start,
                "end" => $e->end,
                "owner"=> $e->user_id,
                "color" => "#fcc102",
                "passed" => false,
                "title" => $user->name,
                "name"=>$e->name,
                "description"=>$e->description,
                "places"=>$e->places,
                "start_time" => $e->start,
                "end_time" => $e->end,
            ];
        });

        return response()->json([
            "events" => $events
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        $request->validate([
            "start" => "required",
            "end" => "required",
            "name" => "required",
            "description" => "required",
            "places" => "required|integer",
            "class_id" => "required|integer",
        ]);

        Calendar::create([
            "start" => $request->start . ":00",
            "end" => $request->end . ":00",
            "user_id" => Auth::user()->id,
            "name"=>$request->name,
            "description"=>$request->description,
            "places"=>$request->places,
            "class_id"=>$request->class_id
        ]);

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Calendar $calendar)
    {
        //


    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Calendar $calendar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Calendar $calendar)
    {
        //
        $request->validate([
            "start" => "required",
            "end" => "required"
        ]);

        $calendar->update([
            "start" => $request->start ,
            "end" => $request->end
        ]);

        return back();
        // dd("jkh");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Calendar $calendar)
    {
        //

        $calendar->delete();
        return back();
    }
}
