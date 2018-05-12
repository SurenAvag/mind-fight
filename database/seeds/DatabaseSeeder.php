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
        $this->call(UsersTableSeeder::class);
        $this->call(SubjectsTableSeeder::class);
        $this->call(TopicsTableSeeder::class);
        $this->call(KeyWordsTableSeeder::class);
        $this->call(BooksTableSeeder::class);
        $this->call(GamesTableSeeder::class);
        $this->call(QuestionsTableSeeder::class);
        $this->call(AnswersTableSeeder::class);
        $this->call(GameQuestionsTableSeeder::class);
        $this->call(GamesUsersTableSeeder::class);
    }
}
