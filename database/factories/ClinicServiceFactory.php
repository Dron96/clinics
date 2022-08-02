<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ClinicService>
 */
class ClinicServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     * @throws \Exception
     */
    public function definition()
    {
        return [
            'city_id' => random_int(1, 100),
            'clinic_id' => random_int(1, 100),
            'doctor_id' => random_int(1, 100),
            'service_id' => random_int(1, 100),
        ];
    }
}
