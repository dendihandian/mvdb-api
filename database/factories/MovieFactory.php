<?php

namespace Database\Factories;

use App\Models\Movie;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class MovieFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Movie::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => Str::title($this->faker->words(random_int(1, 6), true)),
        ];
    }
}

// php artisan tinker
// \Database\Factories\MovieFactory::new()->create();
// \Database\Factories\MovieFactory::times(10)->create();