<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 50) as $index) {
            DB::table('patients')->insert([
                'firstName' => $faker->firstName,
                'lastName' => $faker->lastName,
                'email' => $faker->unique()->safeEmail,
                'phone' => $faker->phoneNumber,
                'address' => json_encode([
                    'street' => $faker->streetAddress,
                    'city' => $faker->city,
                    'province' => $faker->state,
                    'postal_code' => $faker->postcode,
                    'country' => $faker->country,
                ]),
                'dateOfBirth' => $faker->date('Y-m-d'),
                'bloodType' => $faker->randomElement(['A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-']),
                'weightKg' => $faker->randomFloat(2, 50, 100),
                'heightCm' => $faker->randomFloat(2, 150, 200),
                'emergencyContactName' => $faker->name,
                'emergencyContactPhone' => $faker->phoneNumber,
                'specialNotes' => $faker->sentence,
                'gender' => $faker->randomElement(['Male','Female']),
            ]);
        }
    }
}
