<?php

use Illuminate\Database\Seeder;

class AnswersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (\App\Models\Question::all() as $question) {
            factory(\App\Models\Answer::class, rand(3, 7))->create(['question_id' => $question->id]);
        }
    }
}
