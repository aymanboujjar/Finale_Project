<?php

namespace App\Http\Controllers;

use App\Models\Calendar;
use App\Models\CourseLesson;
use Illuminate\Http\Request;
use Stripe\Checkout\Session;
use Stripe\Stripe;

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
        $cal = Calendar::where("id",$request->calendar_id)->first();
        // dd($cal->type);
        if ($cal->type == "payement") {
            Stripe::setApiKey(config('stripe.sk'));
        
            $session = Session::create([
                'line_items'  => [
                    [
                        'price_data' => [
                            'currency'     => 'usd',
                            'product_data' => [
                                "name" => $cal->name ,
                                "description"=> $cal->description,
                            ],
                            'unit_amount'  => 6900,
                        ],
                        'quantity'   => 1,
                    ],
    
                ],
                'mode'        => 'payment', // the mode  of payment
                'success_url' => route('home'), // route when success 
                'cancel_url'  => route('home'), // route when  failed or canceled
            ]);
            CourseLesson::create([
                "user_id"=>$request->user_id,
                "calendar_id"=>$cal->id
            ]);
            return redirect()->away($session->url)->with('success', 'course tooked successfully!');
        }
        CourseLesson::create([
            "user_id"=>$request->user_id,
            "calendar_id"=>$request->calendar_id
        ]);
        return back()->with('success', 'course tooked successfully!');
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
