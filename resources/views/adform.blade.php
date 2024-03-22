@extends('layouts.base')

@section('title', 'Выложить объявление')

@section('main')
<main>
    <div class="mx-auto w-11/12 py-3">
        <a href="" class="flex items-center font-light p-1 rounded outline-gray-500 hover:bg-gradient-to-r hover:from-gray-300 hover:to-gray-200">
            <img src="img/back.svg" class="w-5" alt="">
            <p>Назад</p>
        </a>
    </div>

    <div class="mx-auto w-11/12 bg-white rounded-lg p-5 space-y-5">
        <div class="">
            <p class="text-2xl font-light">ВЫЛОЖИТЬ ОБЪЯВЛЕНИЕ</p>
        </div>
        <form action="" class="space-y-3">
            <div class="flex flex-col space-y-2">
                <label for="" class="text-xl font-light">Вставить фотографию</label>
                <input type="file" class="
                    file:border-0 file:bg-green-300 rounded-lg file:p-2
                    file:hover:bg-green-500 file:hover:cursor-pointer
                    file:text-black
                    ">
            </div>

            <div class="flex flex-col space-y-2">
                <label for="" class="text-xl font-light">Название</label>
                <input type="text" class="border p-2 rounded-md" placeholder="Название">
            </div>

            <div class="grid md:grid-cols-2 gap-3">
                <div class="flex flex-col space-y-2">
                    <label for="" class="text-xl font-light">Цена</label>
                    <input type="text" class="border p-2 rounded-md" placeholder="Цена, тенге">
                </div>

                <div class="flex flex-col space-y-2">
                    <label for="" class="text-xl font-light">Категория</label>
                    <select class="border p-2 rounded-md w-full" style="width: 50%;height: 38px;">
                        <optgroup label="Категории">
                            <option value="12">Коляски</option>
                            <option value="13">Услуги</option>
                            <option value="14">Оборудование</option>
                        </optgroup>
                    </select>
                </div>
            </div>

            <div class="flex flex-col space-y-2">
                <label for="" class="text-xl font-light">Описание</label>
                <textarea type="text" class="border p-2 rounded-md resize-none h-36" ></textarea>
            </div>

            <div class="grid md:grid-cols-2 gap-3">
                <div class="flex flex-col space-y-2">
                    <label for="" class="text-xl font-light">Номер телефона</label>
                    <input type="text" class="border p-2 rounded-md" placeholder="+7">
                </div>

                <div class="flex flex-col space-y-2">
                    <label for="" class="text-xl font-light">Город, область</label>
                    <select class="border p-2 rounded-md w-full" style="width: 50%;height: 38px;">
                        <optgroup label="Категории">
                            <option value="12">Алматы</option>
                            <option value="13">Астана</option>
                            <option value="14">Шымкент</option>
                        </optgroup>
                    </select>
                </div>
            </div>

            <button type="submit"
                    class="w-full bg-green-600 p-2 rounded-lg text-white font-bold hover:cursor-pointer hover:bg-green-500">Создать</button>

        </form>
    </div>
</main>
@endsection
