<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'mobile' => '01' . fake()->numerify('#########'),
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'avatar' => null,
            'status' => true,
            'otp_code' => null,
            'otp_expires_at' => null,
            'otp_attempts' => 0,
            'last_login_at' => now(),
            'last_login_ip' => fake()->ipv4(),
            'remember_token' => Str::random(10),
        ];
    }
}
