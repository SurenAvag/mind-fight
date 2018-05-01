<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Models\User::class, function (Faker $faker) {
    static $password;

    return [
        'first_name'        => $faker->firstName,
        'last_name'         => $faker->lastName,
        'type'              => rand(1, 2),
        'email'             => $faker->email,
        'password'          => bcrypt('asdasd'),
        'point'             => rand(100, 1000),
        'remember_token'    => str_random(10),
        'api_token'    => str_random(50),
    ];
});

$factory->define(App\Models\Book::class, function (Faker $faker) {

    return [
        'name'          => $faker->name,
        'subject_id'    => \App\Models\Subject::inRandomOrder()->first()->id,
        'link'          => $faker->url
    ];
});

$factory->define(App\Models\Topic::class, function (Faker $faker) {

    return [
        'name'          => $faker->word,
        'subject_id'    => \App\Models\Subject::inRandomOrder()->first()->id
    ];
});

$factory->define(App\Models\Subject::class, function (Faker $faker) {

    return [
        'name' => $faker->slug
    ];
});

$factory->define(App\Models\Question::class, function (Faker $faker) {

    return [
        'text'              => $faker->text(50),
        'subject_id'        => \App\Models\Subject::inRandomOrder()->first()->id,
        'topic_id'          => \App\Models\Topic::inRandomOrder()->first()->id,
        'level'             => array_random(\App\Models\Question::LEVELS),
    ];
});

$factory->define(App\Models\KeyWord::class, function (Faker $faker) {

    return [
        'name'          => $faker->word,
        'subject_id'    => \App\Models\Subject::inRandomOrder()->first()->id,
        'topic_id'      => \App\Models\Topic::inRandomOrder()->first()->id,
    ];
});

$factory->define(App\Models\Game::class, function (Faker $faker) {

    return [
        'name'          => $faker->name,
        'winner_id'     => \App\Models\User::inRandomOrder()->first()->id,
        'subject_id'    => \App\Models\Subject::inRandomOrder()->first()->id
    ];
});

$factory->define(App\Models\Answer::class, function (Faker $faker) {

    return [
        'text'              => $faker->word,
        'question_id'       => \App\Models\Question::inRandomOrder()->first()->id,
        'is_true_answer'    => (rand(1,3) == 3) ? true : false
    ];
});