<?php

use Illuminate\Database\Seeder;

class GamesUsersTableSeeder extends Seeder
{
    public function run()
    {
        foreach (\App\Models\Game::all() as $game) {
            if ($game->for_two_player) {
                $game->users()->syncWithoutDetaching([
                    $game->winner->id => [
                        'true_answers_count'    => rand(5, 10),
                        'rating_changes'        => ($point = rand(1, 4)),
                        'finished_date'         => \Carbon\Carbon::now()->subMinutes(rand(10, 20))
                    ]
                ]);

                $game->users()->syncWithoutDetaching([
                    $game->loser->id => [
                        'true_answers_count'    => rand(1, 4),
                        'rating_changes'        => -$point,
                        'finished_date'         => \Carbon\Carbon::now()->subMinutes(rand(10, 20))
                    ]
                ]);
            } else {
                if ($game->winner) {
                    $game->users()->syncWithoutDetaching([
                        $game->winner->id => [
                            'true_answers_count'    => rand(3, 4),
                            'rating_changes'        => rand(1, 4),
                            'finished_date'         => \Carbon\Carbon::now()->subMinutes(rand(10, 20))
                        ]
                    ]);
                }

                if ($game->loser) {
                    $game->users()->syncWithoutDetaching([
                        $game->loser->id => [
                            'true_answers_count'    => rand(1, 2),
                            'rating_changes'        => -rand(1, 4),
                            'finished_date'         => \Carbon\Carbon::now()->subMinutes(rand(10, 20))
                        ]
                    ]);
                }
            }

        }
    }
}
