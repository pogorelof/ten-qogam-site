<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'user1',
            'email' => '1@user',
            'password' => 'user',
            'photo_path' => 'uploads/user/1.jpg',
        ]);
        User::create([
            'name' => 'user2',
            'email' => '2@user',
            'password' => 'user',
            'photo_path' => 'uploads/user/2.png',
        ]);
        User::create([
            'name' => 'user3',
            'email' => '3@user',
            'password' => 'user',
            'photo_path' => 'uploads/user/3.png',
        ]);
    }
}
