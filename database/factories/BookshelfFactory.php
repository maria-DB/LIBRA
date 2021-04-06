<?php

namespace Database\Factories;

use App\Models\Bookshelf;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookshelfFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Bookshelf::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'type' => "to be read",
            'userId' => $this->faker->numberBetween($min = 1, $max = 10),
            'bookId' => $this->faker->numberBetween($min = 1, $max = 10),
            'favorite' => "false",
        ];
    }
}
