<?php

namespace Database\Factories;

use App\Models\Art;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArtFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Art::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
           'art_type' => $this->faker->name,
           'art_caption' => $this->faker->caption,
            'art_path' => $this->faker->path,
            'remember_token' => Str::random(10),
        ];
    }
}
