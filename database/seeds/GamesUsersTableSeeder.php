<?php

use Illuminate\Database\Seeder;

class GamesUsersTableSeeder extends Seeder
{
    public function run()
    {
        foreach (\App\Models\Game::all() as $game) {
            $firstPlayer = \App\Models\User::inRandomOrder()->first();
            $game->users()->syncWithoutDetaching([
                $firstPlayer->id => [
                    'true_answers_count'    => rand(3, 4),
                    'rating_changes'        => ($point = rand(1, 4)),
                    'finished_date'         => \Carbon\Carbon::now()->subMinutes(rand(10, 20))
                ]
            ]);

            $secondPlayer = \App\Models\User::where('id', '!=', $firstPlayer->id)->inRandomOrder()->first();
            $game->users()->syncWithoutDetaching([
                $secondPlayer->id => [
                    'true_answers_count'    => rand(1, 2),
                    'rating_changes'        => -$point,
                    'finished_date'         => \Carbon\Carbon::now()->subMinutes(rand(10, 20))
                ]
            ]);
        }
    }
}
