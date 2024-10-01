<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
               'nom'=>'resto admin',
               'email'=>'admin@gmail.com',
               'type'=>1,
               'password'=> bcrypt('123456'),
            ],
            [
               'nom'=>'Manager',
               'email'=>'manager@gmail.com',
               'type'=> 2,
               'password'=> bcrypt('123456'),
            ],
            [
                'nom'=>'cuisinier',
                'email'=>'cuisinier@gmail.com',
                'type'=> 3,
                'password'=> bcrypt('123456'),
             ],
            [
               'nom'=>'Admin',
               'email'=>'user@gmail.com',
               'type'=>0,
               'password'=> bcrypt('123456'),
            ],

        ];

        foreach ($users as $key => $user) {
            User::create($user);
        }
    }
}
