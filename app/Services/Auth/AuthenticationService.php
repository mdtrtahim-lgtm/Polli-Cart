<?php

namespace App\Services\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthenticationService
{
    protected OtpService $otpService;

    public function __construct(OtpService $otpService)
    {
        $this->otpService = $otpService;
    }

    /**
     * Register a new user
     */
    public function register(array $data): User
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'] ?? null,
            'mobile' => $data['mobile'] ?? null,
            'password' => Hash::make($data['password']),
        ]);

        // Assign Customer role
        $user->roles()->attach(\App\Models\Role::where('name', 'Customer')->first());

        return $user;
    }

    /**
     * Login with email/mobile and password
     */
    public function loginWithPassword(string $emailOrMobile, string $password): ?User
    {
        $user = User::where('email', $emailOrMobile)
            ->orWhere('mobile', $emailOrMobile)
            ->first();

        if (!$user || !Hash::check($password, $user->password)) {
            return null;
        }

        if (!$user->status) {
            return null;
        }

        return $user;
    }

    /**
     * Request OTP for login
     */
    public function requestOtp(string $mobile): ?User
    {
        $user = User::where('mobile', $mobile)->first();

        if (!$user || !$user->status) {
            return null;
        }

        // Rate limiting - max 3 OTP requests per 5 minutes
        $recentOtps = \DB::table('activity_logs')
            ->where('user_id', $user->id)
            ->where('action', 'otp_requested')
            ->where('created_at', '>', now()->subMinutes(5))
            ->count();

        if ($recentOtps >= config('app.otp_rate_limit', 3)) {
            return null;
        }

        $this->otpService->generate($user);

        return $user;
    }

    /**
     * Login with OTP
     */
    public function loginWithOtp(string $mobile, string $otp): ?User
    {
        $user = User::where('mobile', $mobile)->first();

        if (!$user || !$this->otpService->verify($user, $otp)) {
            return null;
        }

        return $user;
    }

    /**
     * Update last login
     */
    public function recordLogin(User $user): void
    {
        $user->update([
            'last_login_at' => now(),
            'last_login_ip' => request()->ip(),
        ]);
    }
}
