<?php

use Illuminate\Database\Seeder;

class TopicsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (range(1, 10) as $index) {
            \App\Models\Topic::create([
                'name'          => str_random(10),
                'subject_id'    => \App\Models\Subject::inRandomOrder()->first()->id
            ]);
        }
    }
}
