<?php

use Illuminate\Database\Seeder;

class GamesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        foreach (range(1, 10) as $index) {
            \App\Models\Game::create([
                'name'          => $faker->name,
                'winner_id'     => \App\Models\User::inRandomOrder()->first()->id,
                'subject_id'    => \App\Models\Subject::inRandomOrder()->first()->id
            ]);
        }
    }
}
