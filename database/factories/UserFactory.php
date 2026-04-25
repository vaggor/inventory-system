<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    /* public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    } */

    
    public function definition(): array
    {
        return [
            'name'     => 'John Doe',
            'email'    => 'jdoe@mail.com',
            'password' => bcrypt('12345678'),
            'role'     => 'user',
        ];
    }

    // Admin state
    public function admin(): static
    {
        return $this->state([
            'name'  => 'Admin User',
            'email' => 'admin@mail.com',
            'password' => bcrypt('12345678'),
            'role'  => 'admin',
        ]);
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
