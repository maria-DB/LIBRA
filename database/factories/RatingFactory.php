<?php

namespace Database\Factories;

use App\Models\Rating;
use Illuminate\Database\Eloquent\Factories\Factory;

class RatingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Rating::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'rating' => $this->faker->realText($maxNbChars = 200, $indexSize = 2),
            'userId' => $this->faker->numberBetween($min = 1, $max = 10),
            'bookId' => $this->faker->numberBetween($min = 1, $max = 10),
        ];
    }
}
