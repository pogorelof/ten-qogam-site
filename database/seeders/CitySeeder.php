<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        City::create([
            'name' => 'Алматы'
        ]);
        City::create([
            'name' => 'Астана'
        ]);

        City::create([
            'name' => 'Шымкент'
        ]);

        City::create([
            'name' => 'Абайская область'
        ]);

        City::create([
            'name' => 'Акмолинская область'
        ]);

        City::create([
            'name' => 'Актюбинская область'
        ]);

        City::create([
            'name' => 'Алматинская область'
        ]);

        City::create([
            'name' => 'Атырауская область'
        ]);

        City::create([
            'name' => 'Восточно-Казахстанская область'
        ]);

        City::create([
            'name' => 'Жамбылская область'
        ]);

        City::create([
            'name' => 'Жетысуская область'
        ]);

        City::create([
            'name' => 'Западно-Казахстанская область'
        ]);

        City::create([
            'name' => 'Карагандинская область'
        ]);

        City::create([
            'name' => 'Костанайская область'
        ]);

        City::create([
            'name' => 'Кызылординская область'
        ]);

        City::create([
            'name' => 'Мангистауская область'
        ]);

        City::create([
            'name' => 'Павлодарская область'
        ]);

        City::create([
            'name' => 'Северо-Казахстанская область'
        ]);

        City::create([
            'name' => 'Туркестанская область'
        ]);

        City::create([
            'name' => 'Улытауская область'
        ]);
    }
}
