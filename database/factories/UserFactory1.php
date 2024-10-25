<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Utilities\PasswordHasher;
use App\Utilities\TokenGenerator;

class UserFactory extends Factory
{
    protected static ?string $password;

    public function __construct(PasswordHasher $passwordHasher, TokenGenerator $tokenGenerator)
    {
        $this->passwordHasher = $passwordHasher;
        $this->tokenGenerator = $tokenGenerator;
    }

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= $this->passwordHasher->hash('password'),
            'remember_token' => $this->tokenGenerator->generate(10),
        ];
    }

    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
