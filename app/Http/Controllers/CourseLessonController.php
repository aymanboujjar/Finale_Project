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
        request()->validate([
            "user_id" => "required",
            "calendar_id" => "required",
        ]);
    
        $cal = Calendar::where("id", $request->calendar_id)->first();
        if ($cal->places > 0) {
            if ($cal->type == "payement") {
                Stripe::setApiKey(config('stripe.sk'));
                
                // Create the Stripe session for payment
                $session = Session::create([
                    'line_items' => [
                        [
                            'price_data' => [
                                'currency' => 'usd',
                                'product_data' => [
                                    "name" => $cal->name,
                                    "description" => $cal->description,
                                ],
                                'unit_amount' => 6900, // amount in cents (e.g., 69.00 USD)
                            ],
                            'quantity' => 1,
                        ],
                    ],
                    'mode' => 'payment',
                    'success_url' => route('home'),
                    'cancel_url' => route('home'),
                ]);
        
                // Create the CourseLesson entry after the payment session is created
                CourseLesson::create([
                    "user_id" => $request->user_id,
                    "calendar_id" => $cal->id,
                ]);
        
                // Decrease the places available for the course by 1
                $cal->places = $cal->places - 1;
                $cal->save();
        
                // Redirect to the Stripe payment page
                return redirect()->away($session->url)->with('success', 'Course booked successfully!');
            }
        
            CourseLesson::create([
                "user_id" => $request->user_id,
                "calendar_id" => $request->calendar_id,
            ]);
        
            $cal->places = $cal->places - 1;
            $cal->save();
            return back()->with('success', 'Course booked successfully!');
        }else {
            return back()->with('error', 'No places available for this course.');
        }
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
