<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\Auth\AuthenticationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OtpController extends Controller
{
    protected AuthenticationService $authService;

    public function __construct(AuthenticationService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * Show OTP request form
     */
    public function showRequestOtp()
    {
        return view('auth.otp-request');
    }

    /**
     * Request OTP
     */
    public function requestOtp(Request $request)
    {
        $validated = $request->validate([
            'mobile' => 'required|string|regex:/^01[0-9]{9}$/',
        ]);

        $user = $this->authService->requestOtp($validated['mobile']);

        if (!$user) {
            return back()->withErrors(['mobile' => 'No account found or rate limit exceeded']);
        }

        session(['otp_mobile' => $validated['mobile']]);
        return redirect()->route('auth.otp-verify');
    }

    /**
     * Show OTP verification form
     */
    public function showVerifyOtp()
    {
        if (!session('otp_mobile')) {
            return redirect()->route('auth.otp-request');
        }
        return view('auth.otp-verify');
    }

    /**
     * Verify OTP and login
     */
    public function verifyOtp(Request $request)
    {
        $validated = $request->validate([
            'otp' => 'required|string|size:6|regex:/^[0-9]{6}$/',
        ]);

        $mobile = session('otp_mobile');
        if (!$mobile) {
            return redirect()->route('auth.otp-request');
        }

        $user = $this->authService->loginWithOtp($mobile, $validated['otp']);

        if (!$user) {
            return back()->withErrors(['otp' => 'Invalid OTP']);
        }

        Auth::login($user);
        $this->authService->recordLogin($user);
        session()->forget('otp_mobile');

        return redirect()->intended('customer.home');
    }
}
