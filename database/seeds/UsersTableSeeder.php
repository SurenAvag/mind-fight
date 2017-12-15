<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker\Factory::create();

        foreach (range(1, 10) as $index) {
            \App\Models\User::create([
                'first_name'        => $faker->firstName,
                'last_name'         => $faker->lastName,
                'type'              => rand(1, 2),
                'email'             => $faker->email,
                'password'          => bcrypt('asdasd'),
                'point'             => rand(100, 1000),
                'remember_token'    => str_random(10),
            ]);
        }
    }
}
