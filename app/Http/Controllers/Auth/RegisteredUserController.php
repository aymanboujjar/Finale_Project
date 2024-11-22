<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\PasswordMailer;
use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Stripe\Checkout\Session;
use Stripe\Stripe;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            // 'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $password = Str::random(10);
        $file = $request->file("image")->store("images", "public");
        // dd($request->file());
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($password),
            'is_approved' => false,
            "image"=>$file
        ]);
        
        event(new Registered($user));

        // Auth::login($user);

        return redirect(route('home', absolute: false))->with('success', 'user created successfully!');
    }


public function approveUser(User $user)
{
    $password = Str::random(10);

    $user->update([
        'is_approved' => true,
        'password' => Hash::make($password), 
    ]);

    Mail::to($user->email)->send(new PasswordMailer($password));

    return redirect()->back()->with('success', 'User approved and email sent.');
}
public function switch (User  $user)
{
    $adminRole = Role::where('name', 'coach')->first();
        $user->roles()->attach($adminRole);
     
        return back()->with('success', 'user have set as a coach successfully!');
}
}
