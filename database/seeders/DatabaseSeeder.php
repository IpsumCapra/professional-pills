<?php

namespace Database\Seeders;

use App\Models\Hospital;
use App\Models\Research;
use Faker\Factory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Hospital::factory(20)->create();
        \App\Models\User::factory(100)->create();

        \App\Models\Research::factory(30)->create();

        \App\Models\User::all()->each(function ($user) {
            // Get the hospitals in a province.
            $hospitals = Hospital::search($user->province);

            $faker = Factory::create();

            Research::create([
                'patient_id' => $user->id,
                'placebo' => $faker->boolean(),
                'successful' => $faker->randomElement([true, false, null])
            ]);

            // Attach user to closest hospital, or the first available one.
            if ($hospitals->count() > 0) {
                $hospitals->first()->users()->attach($user->id);
            } else {
                $hospitals = Hospital::all();
                if ($hospitals->count() > 0) {
                    $hospitals->first()->users()->attach($user->id);
                }
            }
        });
    }
}
