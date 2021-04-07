<?php

namespace Database\Factories;

use App\Models\Profile;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProfileFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Profile::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition() {
        $gender = ['Male', 'Female'];
        $bio = $this->faker->name;
        return [
            'bio' => Str::of($bio)->slug('-'),
            'gender' => Arr::random($gender),
        ];
    }
}
