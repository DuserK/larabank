<?php

namespace Database\Seeders;
use App\Models\Client;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use Faker\Factory as Faker;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $faker = Faker::create('lt_LT');

        DB::table('users')->insert([
            'name' => 'Darius   ',
            'email' => 'darius@lrp.lt',
            'password' => Hash::make('123'),
        ]);
        DB::table('users')->insert([
            'name' => 'Gitanas',
            'email' => 'gitanas@lrp.lt',
            'password' => Hash::make('123'),
        ]);

        foreach (range(1, 20) as $_) {
            DB::table('clients')->insert([
                'name' => $faker->firstName,
                'surname' => $faker->lastName,
                'person_id' => Client::personID()
            ]);
        }
    }
}
