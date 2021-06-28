<?php

namespace Database\Factories;

use App\Models\MovieCast;
use Illuminate\Database\Eloquent\Factories\Factory;

class MovieCastFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MovieCast::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'movie_id' => function() {
                return MovieFactory::new()->create()->id;
            },
            'person_id' => function() {
                return PersonFactory::new()->create()->id;
            },
            'character_name' => $this->faker->name(),
        ];
    }
}

// php artisan tinker
// \Database\Factories\MovieCastFactory::new()->create();
// \Database\Factories\MovieCastFactory::times(10)->create();