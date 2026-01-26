<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): Response
    {
        $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => [
            'required',
            'string',
            'lowercase',
            'email',
            'max:255',
            'unique:'.User::class,
            // THIS LINE ENFORCES THE DOMAIN
            'regex:/^[a-zA-Z0-9._%+-]+@student\.uitm\.edu\.my$/i'
        ],
        'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ], [
            // THIS IS YOUR CUSTOM MESSAGE
            'email.regex' => 'Please use your @student.uitm.edu.my email address.',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->string('password')),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return response()->noContent();
    }
    /**
    * Display the registration view.
    */
    public function create(): \Illuminate\View\View
    {
        return view('auth.register');
    }
}
