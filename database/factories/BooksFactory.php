<?php

namespace Database\Factories;

use App\Models\Books;
use Illuminate\Database\Eloquent\Factories\Factory;

class BooksFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Books::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->word,
            'desc' => $this->faker->word,
            'isbn' => $this->faker->isbn13,
            'author' => $this->faker->name,
            'genre' => $this->faker->word,
            // 'review' => $this->faker->word,
            // 'rating' => $this->faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = 10),
            'publisher' => $this->faker->word,
            'publish_date' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'cover' => $this->faker->word,
            'ebook' => $this->faker->url,
        ];
    }
}
