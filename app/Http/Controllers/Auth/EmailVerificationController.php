<?php


namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;

class EmailVerificationController extends Controller
{
    public function showForm()
    {
        if (!session('email_verification_user_id')) {
            return redirect()->route('register')->withErrors('No user to verify.');
        }
        return view('admin.emails.verify-email');
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|digits:6',
        ]);

        $userId = session('email_verification_user_id');

        $user = User::find($userId);

        if (!$user) {
            return redirect(url('/Administrator/sign-up'))->withErrors('User not found.');
        }

        if ($user->email_verified) {
            // return redirect()->route('login')->with('success', 'Email already verified. Please login.');
            return redirect(url('/Administrator'))->with('success', 'Email already verified. Please login.');

        }

        if ($user->email_otp !== $request->otp) {
            return back()->withErrors(['otp' => 'Invalid OTP.']);
        }

        if (Carbon::now()->gt($user->email_otp_expires_at)) {
            return back()->withErrors(['otp' => 'OTP expired. Please register again.']);
        }

        $user->email_verified = true;
        $user->email_otp = null;
        $user->email_otp_expires_at = null;
        $user->save();

        $request->session()->forget('email_verification_user_id');

        return redirect(url('/Administrator'))->with('success', 'Email verified successfully. You can now login.');
    }
}