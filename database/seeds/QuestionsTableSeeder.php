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
        foreach (\App\Models\Topic::all() as $topic) {
            factory(\App\Models\Question::class, rand(10, 15))->create([
                'subject_id'    => $topic->subject_id,
                'topic_id'      => $topic->id,
            ]);
        }
    }
}
