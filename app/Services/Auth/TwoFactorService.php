<?php

namespace App\Services\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class TwoFactorService
{
    protected OtpService $otpService;

    public function __construct(OtpService $otpService)
    {
        $this->otpService = $otpService;
    }

    /**
     * Enable 2FA for user
     */
    public function enable(User $user): array
    {
        $backupCodes = [];
        for ($i = 0; $i < 6; $i++) {
            $backupCodes[] = Str::random(10);
        }

        $user->update([
            'two_factor_secret' => json_encode($backupCodes),
        ]);

        return $backupCodes;
    }

    /**
     * Disable 2FA for user
     */
    public function disable(User $user): void
    {
        $user->update([
            'two_factor_secret' => null,
        ]);
    }

    /**
     * Generate and send 2FA OTP
     */
    public function sendOtp(User $user): void
    {
        $this->otpService->generate($user);
        
        // TODO: Send OTP to user's email
    }

    /**
     * Verify 2FA OTP
     */
    public function verifyOtp(User $user, string $otp): bool
    {
        return $this->otpService->verify($user, $otp);
    }

    /**
     * Use backup code
     */
    public function useBackupCode(User $user, string $code): bool
    {
        $codes = json_decode($user->two_factor_secret) ?? [];
        $key = array_search($code, $codes);

        if ($key === false) {
            return false;
        }

        unset($codes[$key]);
        $user->update([
            'two_factor_secret' => json_encode(array_values($codes)),
        ]);

        return true;
    }
}
