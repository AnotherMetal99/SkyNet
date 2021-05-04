<?php

namespace Database\Factories;

use App\Models\Chat;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
class ChatFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Chat::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {    
        $state = $this->faker->state;
        return [
            'name' => $state,
            'slug' => Str::of($state)->slug('-'),
            'active' => rand(0,10)
        ];
    }
}
