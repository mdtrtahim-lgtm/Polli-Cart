<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\Auth\AuthenticationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    protected AuthenticationService $authService;

    public function __construct(AuthenticationService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * Show login form
     */
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('customer.home');
        }
        return view('auth.login');
    }

    /**
     * Handle password login
     */
    public function loginWithPassword(Request $request)
    {
        $validated = $request->validate([
            'email_or_mobile' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = $this->authService->loginWithPassword(
            $validated['email_or_mobile'],
            $validated['password']
        );

        if (!$user) {
            return back()->withErrors(['email_or_mobile' => 'Invalid credentials'])->withInput();
        }

        Auth::login($user);
        $this->authService->recordLogin($user);

        return redirect()->intended('customer.home');
    }
}
