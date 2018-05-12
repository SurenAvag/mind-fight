<?php

use Illuminate\Database\Seeder;

class GamesTableSeeder extends Seeder
{
    public function run()
    {
        \App\Models\Game::unsetEventDispatcher();
        $faker = Faker\Factory::create();

        foreach (range(1, 10) as $index) {
            \App\Models\Game::create([
                'name'          => $faker->word,
                'winner_id'     => \App\Models\User::inRandomOrder()->first()->id,
                'subject_id'    => \App\Models\Subject::inRandomOrder()->first()->id
            ]);
        }

        foreach (range(1, 10) as $index) {
            \App\Models\Game::create([
                'name'              => $faker->word,
                'for_two_player'    => true,
                'winner_id'         => $winnerId = \App\Models\User::inRandomOrder()->first()->id,
                'loser_id'          => \App\Models\User::inRandomOrder()->where('id', '!=', $winnerId)->first()->id,
                'subject_id'        => \App\Models\Subject::inRandomOrder()->first()->id
            ]);
        }
    }
}
