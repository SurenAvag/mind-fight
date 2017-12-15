<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\User::class, 10)->create();
        factory(App\Models\Subject::class, 10)->create();
        factory(App\Models\Topic::class, 10)->create();
        factory(App\Models\KeyWords::class, 10)->create();
        factory(App\Models\Book::class, 10)->create();
        factory(App\Models\Game::class, 10)->create();
        factory(App\Models\Question::class, 10)->create();
        factory(App\Models\Answer::class, 10)->create();
    }
}
