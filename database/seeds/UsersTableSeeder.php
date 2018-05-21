<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        factory(\App\Models\User::class)->create([
            'first_name'    => 'Suren',
            'last_name'     => 'Avagyan',
            'email'         => 's404747@gmail.com',
            'type'          => \App\Models\User::TYPES['student'],
            'password'      => bcrypt('asdasd'),
            'api_token'     => 'yRKb5YNnW9aq0RS7wL2bLQmkFgiBJCEiXxMdRBM2ynu1Oh6Dng',
        ]);

        factory(\App\Models\User::class)->create([
            'first_name'    => 'Tigran',
            'last_name'     => 'Gevorgyan',
            'email'         => 'tigrangevorgyan95@gmail.com',
            'type'          => \App\Models\User::TYPES['student'],
            'password'      => bcrypt('asdasd'),
            'api_token'     => 'E8mihlcovQ4k69uSXlLyL27dooRLX7lASVmcmkiBt0gTKLuPV0'
        ]);

        factory(\App\Models\User::class)->create([
            'first_name'    => 'Narine',
            'last_name'     => 'Ispiryan',
            'email'         => 'nispiryan@ysu.am',
            'type'          => \App\Models\User::TYPES['lecturer'],
            'password'      => bcrypt('asdasd'),
            'api_token'     => 'asdmihlcovQ4k69uSXlLyL27dooRLX7lASVmcmkiBt0gTKLuPV0'
        ]);

        factory(\App\Models\User::class, rand(10, 20))->create();
    }
}
