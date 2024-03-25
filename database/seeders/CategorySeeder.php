<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'name' => 'Коляски',
            'photo_path' => 'img/category/wheelchair.svg'
        ]);

        Category::create([
            'name' => 'Услуги',
            'photo_path' => 'img/category/service.svg'
        ]);

        Category::create([
            'name' => 'Дом',
            'photo_path' => 'img/category/house.svg'
        ]);

        Category::create([
            'name' => 'Одежда',
            'photo_path' => 'img/category/clothes.svg'
        ]);

        Category::create([
            'name' => 'Аренда',
            'photo_path' => 'img/category/rent.svg'
        ]);
    }
}
