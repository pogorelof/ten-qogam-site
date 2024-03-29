<?php

namespace Database\Seeders;

use App\Models\Ad;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Ad::create([
            'user_id' => 1,
            'category_id' => 1,
            'title' => 'Коляска',
            'city_id' => 1,
            'description' => 'Качественная, импортная, с колесами',
            'phone_number' => '77085875150',
            'photo_path' => 'uploads/article/1.png',
            'price' => '50000',
//            'status' => 'POSTED'
        ]);

        Ad::create([
            'user_id' => 2,
            'category_id' => 2,
            'title' => 'Инватакси',
            'city_id' => 5,
            'description' => 'Такси, дешеве, быстро, удобно',
            'phone_number' => '77085875150',
            'photo_path' => 'uploads/article/2.jpg',
            'price' => null,
//            'status' => 'POSTED'
        ]);

        Ad::create([
            'user_id' => 3,
            'category_id' => 2,
            'title' => 'Костыли',
            'city_id' => 3,
            'description' => 'Прямой, пара, металлический',
            'phone_number' => '77085875150',
            'photo_path' => 'uploads/article/3.png',
            'price' => '5000',
//            'status' => 'POSTED'
        ]);

        Ad::create([
            'user_id' => 3,
            'category_id' => 2,
            'title' => 'Костыли',
            'city_id' => 3,
            'description' => 'Костыли Костыли Костыли Костыли Костыли Костыли Костыли Костыли Костыли Костыли Костыли Костыли Костыли Костыли Костыли Костыли Костыли Костыли Костыли Костыли Костыли Костыли Костыли Костыли Костыли Костыли Костыли Костыли Костыли Костыли Костыли Костыли Костыли Костыли Костыли Костыли Костыли Костыли Костыли Костыли Костыли Костыли Костыли Костыли Костыли Костыли Костыли Костыли Костыли Костыли Костыли Костыли Костыли Костыли Костыли Костыли Костыли Костыли Костыли Костыли ',
            'phone_number' => '77085875150',
            'photo_path' => 'uploads/article/3.png',
            'price' => '5000',
//            'status' => 'POSTED'
        ]);
    }
}
