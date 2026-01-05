<?php

namespace App\Services\Auth;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function register(array $data)
    {
        try {

            $otp = '123456'; // rand(100000, 999999);

            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => null, // $data['phone'],
                'password' => Hash::make($data['password']),
                'otp' => $otp,
                'otp_expires_at' => Carbon::now()->addMinutes(10),
            ]);

            $user->assignRole('user');
            //Mail::to($user->email)->send(new \App\Mail\OtpMail($otp));
            return $user;
        } catch (\Exception $e) {
            Log::error('Registration error: ' . $e->getMessage());
            throw new \Exception('Registration failed: ' . $e->getMessage());
        }
    }
}
