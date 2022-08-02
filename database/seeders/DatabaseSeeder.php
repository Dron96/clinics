<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\City;
use App\Models\Clinic;
use App\Models\ClinicService;
use App\Models\Doctor;
use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;

class DatabaseSeeder extends Seeder
{
    const CITY_COUNT = 100;
    const CLINIC_COUNT = 500;
    const DOCTOR_COUNT = 50000;
    const SERVICE_COUNT = 5000;
    const CLINIC_SERVICE_COUNT = 1000000;
    const CHUNK_SIZE = 100;
    const CLINIC_SERVICE_CHUNK_SIZE = 500;

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
//        City::factory(self::CITY_COUNT)->create();
//
//        for ($i = 0; $i < self::CLINIC_COUNT; $i += self::CHUNK_SIZE) {
//            Clinic::factory(self::CHUNK_SIZE)->create();
//        }
//
//        for ($i = 0; $i < self::DOCTOR_COUNT; $i += self::CHUNK_SIZE) {
//            Doctor::factory(self::CHUNK_SIZE)->create();
//        }
//
//        for ($i = 0; $i < self::SERVICE_COUNT; $i += self::CHUNK_SIZE) {
//            Service::factory(self::CHUNK_SIZE)->create();
//        }

        $citiesFromDb = City::all()->pluck('id')->toArray();
        $cities = $citiesFromDb;
        while (count($cities) < self::CLINIC_SERVICE_CHUNK_SIZE) {
            $cities = array_merge($cities, $citiesFromDb);
        }

        for ($i = 0; $i < self::CLINIC_SERVICE_COUNT; $i += self::CLINIC_SERVICE_CHUNK_SIZE) {
            $cities = Arr::shuffle($cities);

            $clinics = Clinic::all()->random(self::CLINIC_SERVICE_CHUNK_SIZE)->pluck('id')->toArray();
            $doctors = Doctor::all()->random(self::CLINIC_SERVICE_CHUNK_SIZE)->pluck('id')->toArray();
            $services = Service::all()->random(self::CLINIC_SERVICE_CHUNK_SIZE)->pluck('id')->toArray();

            for ($j = 0; $j < self::CLINIC_SERVICE_CHUNK_SIZE; $j++) {
                ClinicService::factory()
                    ->state(new Sequence(
                        fn($sequence) => [
                            'city_id' => $cities[$j],
                            'clinic_id' => $clinics[$j],
                            'doctor_id' => $doctors[$j],
                            'service_id' => $services[$j],
                        ],
                    ))
                    ->create();
            }
            dump($i + $j);
        }
    }
}
