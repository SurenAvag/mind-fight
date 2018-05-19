<?php

use Illuminate\Database\Seeder;

class GameQuestionsTableSeeder extends Seeder
{
    public function run()
    {
        foreach (\App\Models\Game::all() as $game) {
            $game->questions()->syncWithoutDetaching(
                \App\Models\Question::inRandomOrder()
                    ->where('subject_id', \App\Models\Subject::inRandomOrder()->first()->id)
                    ->limit(4)
                    ->get()
            );
        }
    }
}
