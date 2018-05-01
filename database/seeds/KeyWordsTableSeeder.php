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
        factory(\App\Models\KeyWord::class, rand(90, 100))->create();
    }
}
