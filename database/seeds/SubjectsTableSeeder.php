<?php

use Illuminate\Database\Seeder;

class SubjectsTableSeeder extends Seeder
{
    public function run()
    {
        foreach (\App\Models\Subject::SUBJECT_NAMES as $subjectName) {
            factory(\App\Models\Subject::class)->create([
                'name' => $subjectName
            ]);
        }
    }
}
