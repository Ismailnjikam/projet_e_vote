<?php

namespace Database\Factories;

use App\Models\Filiere;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
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
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email'=>fake()->unique()->safeEmail(),
            'login' => fake()->unique()->userName(),
            'role' => fake()->randomElement(['votant','admin']),
            'filiere_id' => Filiere::inRandomOrder()->first()?->id,
            'login_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }

    // indique que l'utilisateur peut etre administrateur
    public function admin():static  {
        return $this->state(fn(array $attributes) => [
            'role' => 'admin'
        ]);
    }

    public function votant():static {
        return $this->state(fn(array $attributes) => [
            'role' => 'votant'
        ]);
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'login_verified_at' => null,
        ]);
    }
}
