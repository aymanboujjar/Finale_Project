<?php

namespace App\Http\Controllers;

use App\Models\Calendar;
use App\Models\Classe;
use App\Models\Masterclasse;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\Checkout\Session;
use Stripe\Stripe;

class MasterclasseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $classes = Classe::where("user_id", Auth::user()->id)->get();
        
        $courses = collect();
        
        foreach ($classes as $key) {
            $courses = $courses->merge(Calendar::where("class_id", $key->id)->get());
        }
    
        return view("Masterclasse", compact("classes", "courses"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $events = Masterclasse::all();

        $events = $events->map(function ($e) {
            $user = User::where("id" , $e->user_id)->first();
            return [
                "id" => $e->id,
                "start" => $e->start,
                "end" => $e->end,
                "owner"=> $e->user_id,
                "color" => "#007bff",
                "passed" => false,
                "title" => "Course : $e->name",
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
        ]);
        $file = $request->file("image")->store("images", "public");
        Stripe::setApiKey(config('stripe.sk'));
        
        $session = Session::create([
            'line_items'  => [
                [
                    'price_data' => [
                        'currency'     => 'usd',
                        'product_data' => [
                            "name" => "LionsGeek Product",
                            "description"=> "nyehehehehe"
                        ],
                        'unit_amount'  => 6900,
                    ],
                    'quantity'   => 2,
                ],

            ],
            'mode'        => 'payment', // the mode  of payment
            'success_url' => route('masterclasse.index'), // route when success 
            'cancel_url'  => route('masterclasse.index'), // route when  failed or canceled
        ]);

        Masterclasse::create([
            "start" => $request->start . ":00",
            "end" => $request->end . ":00",
            "user_id" => Auth::user()->id,
            "name"=>$request->name,
            "description"=>$request->description,
            "places"=>$request->places,
            "image"=>$file,
        ]);
        return redirect()->away($session->url)->with('success', 'masterClasse created successfully!');

    }

    /**
     * Display the specified resource.
     */
    public function show(Masterclasse $masterclasse)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Masterclasse $masterclasse)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Masterclasse $masterclasse)
    {
        //
        {
            //
            // dd($request->all());
            $request->validate([
                "start" => "required",
                "end" => "required"
            ]);
    
            $masterclasse->update([
                "start" => $request->start ,
                "end" => $request->end
            ]);
    
            return back()->with('success', 'course time updated successfully!');
            // dd("jkh");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Masterclasse $masterclasse)
    {
        //
        
        $masterclasse->delete();
        return back()->with('success', 'course deleted successfully!');
    }
}
