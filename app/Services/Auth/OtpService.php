<?php

namespace App\Services\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class OtpService
{
    /**
     * Generate and send OTP
     */
    public function generate(User $user): bool
    {
        $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        
        $user->update([
            'otp_code' => Hash::make($otp),
            'otp_expires_at' => Carbon::now()->addMinutes(config('app.otp_expiry', 10) / 60),
            'otp_attempts' => 0,
        ]);

        // TODO: Send OTP via SMS or Email
        
        return true;
    }

    /**
     * Verify OTP
     */
    public function verify(User $user, string $otp): bool
    {
        // Check if OTP is expired
        if ($user->otp_expires_at && $user->otp_expires_at->isPast()) {
            return false;
        }

        // Check attempt limit
        if ($user->otp_attempts >= 5) {
            return false;
        }

        // Verify OTP
        if (!Hash::check($otp, $user->otp_code)) {
            $user->increment('otp_attempts');
            return false;
        }

        // Clear OTP
        $user->update([
            'otp_code' => null,
            'otp_expires_at' => null,
            'otp_attempts' => 0,
        ]);

        return true;
    }
}
