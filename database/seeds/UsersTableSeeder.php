<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        factory(\App\Models\User::class)->create([
            'first_name' => 'Suren',
            'last_name' => 'Avagyan',
            'email' => 's404747@gmail.com',
            'password' => bcrypt('asdasd'),
        ]);

        factory(\App\Models\User::class)->create([
            'first_name' => 'Tigran',
            'last_name' => 'Gevorgyan',
            'email' => 'tigran@gmail.com',
            'password' => bcrypt('asdasd'),
        ]);

        factory(\App\Models\User::class, rand(10, 20))->create([

        ]);
    }
}
