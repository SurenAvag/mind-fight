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
        factory(\App\Models\Topic::class, 6)->create([
            'subject_id'    => \App\Models\Subject::inRandomOrder()->first()->id,
        ]);
    }
}
