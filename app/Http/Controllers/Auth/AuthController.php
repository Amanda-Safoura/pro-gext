<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\StoreUserRequest;
use App\Mail\VerifyEmail;
use App\Models\User;
use DateTime;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function register(StoreUserRequest $request)
    {
        $validated_inputs = $request->validated();
        $validated_inputs['password'] = Hash::make($validated_inputs['password']);

        $newest = User::create($validated_inputs);
        if ($newest) {
            $receiver_email = $newest->email;
            Mail::to($receiver_email)->send(new VerifyEmail($receiver_email));

            return redirect()->intended(route('login_page'))->with('message', 'Un mail de confirmation de compte vous a été envoyé. Veuillez vérifiez votre boîte mail.');
        }
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');

        // Attempt to find the user by email
        $user = User::where('email', $credentials['email'])->first();

        // Check if user exists
        if (!$user) {
            return redirect()->back()->withErrors(['general' => 'Cette adresse mail n\'existe pas en base.']);
        }

        // Check if user is verified
        if (!$user->email_verified_at) {
            return redirect()->back()->withErrors(['general' => 'Veuillez valider votre compte.']);
        }

        // Attempt to authenticate and remember if requested
        $remember = $request->has('remember');
        if (Auth::attempt($credentials, $remember)) {
            return redirect()->intended(route('overview'));
        }

        // Fallback for incorrect credentials
        return redirect()->back()->withErrors(['general' => 'Identifiants incorrects']);
    }


    public function logout()
    {
        Auth::logout();
        return redirect()->route('login_page');
    }

    public function verify_email($token)
    {
        $email = self::getTokenEmail($token);
        $user = User::whereEmail($email)->firstOrFail();
        if (!$user->email_verified_at) {
            $user->email_verified_at = new DateTime();
            $user->save();
        }

        return !$user->password ?
            redirect()->route('change_password-page', ['origin_hashed' => $email])
            : redirect()->route('login');
    }

    public function change_password_page(string $origin_hashed): View
    {
        return view('site.pages.auth.change_password', ['origin_hashed' => $origin_hashed]);
    }

    public function change_password(ChangePasswordRequest $request): RedirectResponse
    {
        $email = self::getTokenEmail($request->input('origin'));
        $user = User::whereEmail($email)->firstOrFail();
        $user->password = $request->input('password');
        $user->updated_at = new DateTime();
        $user->save();
        return redirect()->route('auth.password_changed');
    }


    static public function getTokenEmail(string $token): string
    {
        $decoded = decrypt($token);
        $email = explode('@@amanda-saf@@', $decoded)[0];
        return $email;
    }
}
