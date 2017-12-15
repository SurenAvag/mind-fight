<?php

use Illuminate\Database\Seeder;

class BooksTableSeeder extends Seeder
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
            \App\Models\Book::create([
                'name'          => $faker->name,
                'subject_id'    => \App\Models\Subject::inRandomOrder()->first()->id,
                'link'          => $faker->url
            ]);
        }
    }
}
