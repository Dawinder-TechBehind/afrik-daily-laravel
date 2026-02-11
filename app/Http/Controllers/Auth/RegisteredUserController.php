<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\OtpMail;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        return view('public.auth.signup');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // ncreate maximum exicution time
        set_time_limit(300);

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'password_confirmation' => ['required', 'same:password'],
            'role' => ['required', 'string', 'exists:roles,name'],
        ]);

        DB::beginTransaction();
        try {

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            $user->assignRole($request->role);

            // genrate otp
            $user->otp_code = $user->generate();
            $user->otp_expires_at = $user->expiry();
            $user->save();


            // fire mail
            Mail::to($user->email)->send(new OtpMail($user->otp_code, $user->name));

            session(['otp_email' => $user->email]);
            DB::commit();
            return redirect()->route('otp-show')->with('success', 'A 6 digit code has been sent to your email! Please enter the code to verify your account.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }
}
