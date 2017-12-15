<?php

use Illuminate\Database\Seeder;

class KeyWordsTableSeeder extends Seeder
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
            \App\Models\KeyWords::create([
                'name'          => str_random(6),
                'subject_id'    => \App\Models\Subject::inRandomOrder()->first()->id,
                'topic_id'      => \App\Models\Topic::inRandomOrder()->first()->id,
            ]);
        }
    }
}
