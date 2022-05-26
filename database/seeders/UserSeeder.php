<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i=1; $i < 5; $i++) { 
            User::create([
                'name' => $faker->name(),
                'email' => $faker->unique()->email(),
                'password' => bcrypt('12345678'),
            ]);
        }
    }
}
