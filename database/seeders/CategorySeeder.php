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
            'name' => 'Средства передвижения',
            'photo_path' => 'img/category/wheelchair.svg'
        ]);

        Category::create([
            'name' => 'Реабилитация',
            'photo_path' => 'img/category/rec.svg'
        ]);

        Category::create([
            'name' => 'Для слабовидящих',
            'photo_path' => 'img/category/glasses.svg'
        ]);

        Category::create([
            'name' => 'Для слабослышащих',
            'photo_path' => 'img/category/hear.svg'
        ]);

        Category::create([
            'name' => 'Домашние приспособления',
            'photo_path' => 'img/category/house.svg'
        ]);
        Category::create([
            'name' => 'Для детей',
            'photo_path' => 'img/category/toy.svg'
        ]);
        Category::create([
            'name' => 'Медицинское оборудование',
            'photo_path' => 'img/category/med.svg'
        ]);
        Category::create([
            'name' => 'Трудоустройство',
            'photo_path' => 'img/category/work.svg'
        ]);
        Category::create([
            'name' => 'Услуги',
            'photo_path' => 'img/category/service.svg'
        ]);
        Category::create([
            'name' => 'Прочее',
            'photo_path' => 'img/category/other.svg'
        ]);
    }

}
