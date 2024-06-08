<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'administrator',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('password'),
                'role' => User::ROLES['admin'],
            ],
            [
                'name' => 'user',
                'email' => 'user@gmail.com',
                'password' => Hash::make('password'),
                'role' => User::ROLES['user'],
            ],
        ];

        foreach($users as $user){
            User::query()->create($user);
        }
    }
}
