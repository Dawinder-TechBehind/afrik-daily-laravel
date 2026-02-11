<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\OtpMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

use function Symfony\Component\Clock\now;

class OtpController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('public.auth.verify-otp');
    }

    public function verify(Request $request)
    {


        $email = session('otp_email');

        if (!$email) {
            return redirect()->route('signup')
                ->with('error', 'Session expired. Please register again.');
        }

        DB::beginTransaction();

        $user = User::where('email', $email)->first();

        try {
            $request->validate([
                'otp' => 'required|array|min:6',
            ]);

            $otp = implode('', $request->otp);

            if (! $user || $user->otp_code !== $otp) {
                throw new \Exception('Invalid OTP');
            }

            if ($user->isExpired($user->otp_expires_at)) {
                throw new \Exception('OTP has expired');
            }

            $user->update([
                'email_verified_at' => now(),
                'otp_code' => null,
                'otp_expires_at' => null,
            ]);

            DB::commit();
            session(['otp_email' => $user->email]);

            return redirect()
                ->route('login')
                ->with('success', 'Account verified successfully. Please login.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }


    public function resend()
    {
        DB::beginTransaction();

        try {

            $email = session('otp_email');

            if (!$email) {
                return redirect()->route('signup')
                    ->with('error', 'Session expired. Please register again.');
            }

            $user = User::where('email', $email)->first();

            if (!$user) {
                return redirect()->route('signup')
                    ->with('error', 'User not found.');
            }

            // Generate new OTP
            $otp = $user->generate();

            $user->update([
                'otp_code' => $otp,
                'otp_expires_at' => $user->expiry(),
            ]);

            // Send email silently
            Mail::to($user->email)->send(new OtpMail($otp, $user->name));

            DB::commit();
            return back()->with('success', 'A New OTP has been sent to your email. Please check.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }
}
