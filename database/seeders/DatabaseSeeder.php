<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
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
    }
}
