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
        foreach (\App\Models\Subject::all() as $subject) {
            factory(\App\Models\Topic::class, 5)->create([
                'subject_id' => $subject->id,
            ]);
        }
    }
}
