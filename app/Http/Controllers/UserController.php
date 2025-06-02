<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;


class UserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->isMethod('post')) {
            $validatedData = $request->validate([
                'email'             => 'required|email',
                'password'          => 'required|string',
            ], [
                'email.required'        => 'We need your email address to proceed.',
                'email.email'           => 'Make sure to enter a valid email address.',
                'password.required'     => 'A password is necessary for your account.',
            ]);


            /**using auth function */
            if (Auth::guard('admin')->attempt(['email' => $validatedData['email'], 'password' => $validatedData['password'],'email_verified' => 1])) {

                $sessionData = Auth::guard('admin')->user();


                $request->session()->put('user_id', $sessionData->id);
                $request->session()->put('name', $sessionData->name);
                $request->session()->put('email', $sessionData->email);
                $request->session()->put('mobile', $sessionData->mobile);
                $request->session()->put('user_type', $sessionData->role);
                $request->session()->put('is_admin_login', 1);

                return redirect('Administrator/dashboard')->with([
                    'message' => 'Logged in successfully.',
                    'type'    => 'success',
                ]);
            } else {
                return redirect()->back()->with([
                    'message' => 'You have entered an invalid email or password.',
                    'type'    => 'error',
                ]);
            }
            /**using auth function */
        }
        return view('admin.login');
    }
    public function dashboard()
    {
        $sessionData        = session()->all();
        $uId                = $sessionData['user_id'];
        $data               = [];
        $title              = 'Dashboard';
        $page_name          = 'admin.dashboard';
        echo $this->admin_after_login_layout($title, $page_name, $data);
    }
    public function logout()
    {
        session()->forget(['user_id', 'name', 'email', 'mobile', 'user_type', 'is_admin_login']);
        Auth::guard('admin')->logout();
        return redirect()->back()->with([
            'message' => 'Your request is not approved by our Administrator. Please wait or contact the Administrator.',
            'type'    => 'warning',
        ]);
    }
    public function forgotPassword(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate(['email' => 'required|email']);

            $status = Password::sendResetLink(
                $request->only('email')
            );

            return $status === Password::RESET_LINK_SENT
                ? back()->with(['status' => __($status)])
                : back()->withErrors(['email' => __($status)]);
        }
        return view('admin.forgot-password');
    }
    public function showResetForm($token)
    {
        return view('admin.reset-password', ['token' => $token]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->save();

                $user->setRememberToken(Str::random(60));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect(url('Administrator/'))->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }
    public function signUp(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255',
                'password' => 'required|string|min:8',
            ]);
    
            $otp = rand(100000, 999999);  // 6-digit OTP
            // echo $otp;die;
            $user = User::create([
                'name'  => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'email_otp' => $otp,
                'email_otp_expires_at' => Carbon::now()->addMinutes(10),
            ]);
    
            // Send OTP email
            Mail::to($user->email)->send(new \App\Mail\EmailOtp($user));
    
            // Store user id in session to identify during verification
            session(['email_verification_user_id' => $user->id]);
    
            return redirect()->route('verify.email.form')->with('success', 'OTP sent to your email. Please verify.');
        }
        return view('admin.sign-up');
    }
}
