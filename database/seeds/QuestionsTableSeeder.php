<?php

use Illuminate\Database\Seeder;

class QuestionsTableSeeder extends Seeder
{
    public function run()
    {
        foreach (\App\Models\Question::MAT_ANALIZ_QUESTIONS as $question) {
            factory(\App\Models\Question::class)->create([
                'topic_id'      => \App\Models\Topic::inRandomOrder()->first()->id,
                'subject_id'    => 1, //mat analiz
                'text'          => $question
            ]);
        }
    }
}
