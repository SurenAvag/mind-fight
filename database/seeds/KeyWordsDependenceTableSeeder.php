<?php

use Illuminate\Database\Seeder;

class KeyWordsDependenceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (\App\Models\KeyWord::all() as $keyWord) {
            foreach (range(1, 3) as $i) {
                $word = \App\Models\KeyWord::whereNotIn(
                    'key_words.id', $keyWord->parents->pluck('parent_id')
                )->inRandomOrder()->first();

                if($word && $word->id != $keyWord->id) {
                    $keyWord->children()->syncWithoutDetaching(
                        $word->id
                    );
                }
            }
        }
    }
}
