<?php

namespace Database\Factories;

use App\Models\Review;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Review::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'author' => $this->faker->name,
            'publish_date' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'summary' => $this->faker->realText($maxNbChars = 200, $indexSize = 2),
            'bookId' => $this->faker->numberBetween($min = 1, $max = 10)
        ];
    }
}
