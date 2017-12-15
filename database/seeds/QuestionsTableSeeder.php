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
        $faker = Faker\Factory::create();

        foreach (range(1, 10) as $index) {
            \App\Models\Question::create([
                'text'              => $faker->text(50),
                'subject_id'        => \App\Models\Subject::inRandomOrder()->first()->id,
                'topic_id'          => \App\Models\Topic::inRandomOrder()->first()->id,
                'level'             => array_random(\App\Models\Question::LEVELS),
            ]);
        }
    }
}
