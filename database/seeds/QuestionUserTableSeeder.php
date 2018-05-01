<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class QuestionUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (User::all() as $user) {
            foreach (range(7, 10) as $i) {
                $user->answeredQuestions()->syncWithoutDetaching(\App\Models\Question::inRandomOrder()->first());
            }
        }
    }
}
