<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {   $bio = $this->faker->name;
        return [
            'name' => $this->faker->name,
            'lastname' => $this->faker->lastname,
            'username' => $this->faker->userName,
            'bio' => Str::of($bio)->slug('-'),
            'age' => $this->faker->randomNumber(2),
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => '$2a$04$eBu.uldEdjN6D.QokeAZJu95cApUHUG41wQvbsGcOgw/15vHmERuK', // password
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
