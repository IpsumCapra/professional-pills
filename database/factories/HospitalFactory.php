<?php

namespace Database\Factories;

use App\Models\Hospital;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class HospitalFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Hospital::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->company . ' ' . $this->faker->randomElement(['Ziekenhuis', 'Gasthuis', 'Hostpital']),
            'province' => $this->faker->randomElement(User::PROVINCES)
        ];
    }
}
