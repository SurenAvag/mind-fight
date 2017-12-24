<?php

use Illuminate\Database\Seeder;

class QuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\Question::class, 25)->create([
            'subject_id'        => \App\Models\Subject::inRandomOrder()->first()->id,
            'topic_id'          => \App\Models\Topic::inRandomOrder()->first()->id,
            'level'             => array_random(\App\Models\Question::LEVELS),
        ]);
    }
}
