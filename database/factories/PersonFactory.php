<?php

namespace Database\Factories;

use App\Models\Person;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class PersonFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Person::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $gender = ['male', 'female'][0];

        return [
            'last_name' => $this->faker->lastName($gender),
            'middle_name' => $this->faker->firstName($gender),
            'first_name' => $this->faker->firstName($gender),
            'gender' => $gender,
            'birth_date' => $this->faker->dateTimeBetween(Carbon::now()->subCentury()->toDateTimeString(), Carbon::now()->subDecade()->toDateTimeString()),
        ];
    }
}

// php artisan tinker
// \Database\Factories\PersonFactory::new()->create();
// \Database\Factories\PersonFactory::times(10)->create();