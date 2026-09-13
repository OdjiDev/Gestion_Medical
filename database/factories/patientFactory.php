<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\patient>
 */
class patientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        
        return [
            //
        'nom' => $this->faker->lastName(),
        'email' => $this->faker->unique()->safeEmail(),
        'password' => bcrypt('password'),
        'telephone' => $this->faker->phoneNumber(),
        'adress' => $this->faker->address(),
        'sexe' => $this->faker->randomElement(['M', 'F']),
        'n_dossier' => $this->faker->numberBetween(1000,9999),
        ];
    }
}
