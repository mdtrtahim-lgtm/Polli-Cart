<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Auth\AuthenticationService;
use App\Services\Auth\TwoFactorService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    protected AuthenticationService $authService;
    protected TwoFactorService $twoFactorService;

    public function __construct(
        AuthenticationService $authService,
        TwoFactorService $twoFactorService
    ) {
        $this->authService = $authService;
        $this->twoFactorService = $twoFactorService;
    }

    /**
     * Show admin login form
     */
    public function showLogin()
    {
        if (Auth::check() && Auth::user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.auth.login');
    }

    /**
     * Handle admin login
     */
    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $user = $this->authService->loginWithPassword($validated['email'], $validated['password']);

        if (!$user || !$user->isAdmin()) {
            return back()->withErrors(['email' => 'Invalid credentials or insufficient permissions']);
        }

        // Check if 2FA is required
        if (config('app.admin_force_2fa', true) || $user->hasRole('Super Admin')) {
            session(['admin_2fa_user_id' => $user->id]);
            $this->twoFactorService->sendOtp($user);
            return redirect()->route('admin.2fa-verify');
        }

        Auth::login($user);
        $this->authService->recordLogin($user);

        return redirect()->route('admin.dashboard');
    }

    /**
     * Show 2FA verification form
     */
    public function show2faForm()
    {
        if (!session('admin_2fa_user_id')) {
            return redirect()->route('admin.login');
        }
        return view('admin.auth.2fa-verify');
    }

    /**
     * Verify 2FA
     */
    public function verify2fa(Request $request)
    {
        $validated = $request->validate([
            'otp' => 'required|string|size:6|regex:/^[0-9]{6}$/',
        ]);

        $userId = session('admin_2fa_user_id');
        if (!$userId) {
            return redirect()->route('admin.login');
        }

        $user = \App\Models\User::find($userId);
        
        if (!$this->twoFactorService->verifyOtp($user, $validated['otp'])) {
            return back()->withErrors(['otp' => 'Invalid OTP']);
        }

        Auth::login($user);
        $this->authService->recordLogin($user);
        session()->forget('admin_2fa_user_id');

        return redirect()->route('admin.dashboard');
    }
}
