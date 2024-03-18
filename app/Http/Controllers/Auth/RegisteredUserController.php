<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\UserEmailVerification;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

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
            // 'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $token = md5(microtime(TRUE)*100000);

        $user = User::create([
            // 'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'token' => $token,
        ]);

        // event(new Registered($user));
        // Auth::login($user);
        // return redirect(RouteServiceProvider::HOME);

        // Envoi d'un email de vérification
        $verificationLink = route('register_validation', ['token' => $token]);
        Mail::to($request->email)->send(new UserEmailVerification($verificationLink));
        return redirect()->route('register_final')->with('email', $request->email);
    }

    public function final() {
        return view('auth.final');
    }

    public function validation($token) {
        $user = User::where('token', $token)->first();
        if($user) {
            $active = $user->active;
            if($active == 0) {
                $user->active = 1;
                $user->save();
            }
        }
        return view('auth.validation')
            ->with('active', $active ?? null)
            ->with('user', $user);
    }
}
