<?php

use Illuminate\Database\Seeder;

class GameQuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (range(1, 10) as $index) {
            $game = \App\Models\Game::inRandomOrder()->first();
            $i = 0;
            while ($i < 4) {
                $game->questions()->syncWithoutDetaching(\App\Models\Question::inRandomOrder()->first());
                $i ++;
            }
        }
    }
}
