<?php

namespace Database\Factories;

use App\Models\Delivery;
use App\Models\Hospital;
use Illuminate\Database\Eloquent\Factories\Factory;

class DeliveryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Delivery::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $hospitals = Hospital::all()->pluck('id')->toArray();
        return [
            'destination' => $this->faker->randomElement($hospitals),
            'contents' => $this->faker->randomElement(['Syringes', 'Facemasks', 'Gloves', 'PCR Tests', 'Cotton swabs']),
            'quantity' => $this->faker->numberBetween(1, 500)
        ];
    }
}
