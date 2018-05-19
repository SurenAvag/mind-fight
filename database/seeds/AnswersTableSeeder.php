<?php

use Illuminate\Database\Seeder;

class AnswersTableSeeder extends Seeder
{
    public function run()
    {
        foreach (\App\Models\Question::all() as $question) {
            $answers = factory(\App\Models\Answer::class, rand(3, 7))->create([
                'is_true_answer'    => false,
                'question_id'       => $question->id
            ]);
            $answers->random()->update(['is_true_answer' => true]);
        }
    }
}
