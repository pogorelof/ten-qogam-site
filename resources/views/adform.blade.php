@extends('layouts.base')

@section('title', 'Выложить объявление')

@section('main')
    <main>
        <div class="mx-auto w-11/12 py-3">
            @if($previous = url()->previous())
                <a href="{{$previous}}"
                   class="flex items-center font-light p-1 rounded outline-gray-500 hover:bg-gradient-to-r hover:from-gray-300 hover:to-gray-200">
                    <img src="img/back.svg" class="w-5" alt="">
                    <p>Назад</p>
                </a>
            @else
                <a href="{{route('home')}}"
                   class="flex items-center font-light p-1 rounded outline-gray-500 hover:bg-gradient-to-r hover:from-gray-300 hover:to-gray-200">
                    <img src="img/back.svg" class="w-5" alt="">
                    <p>Назад</p>
                </a>
            @endif
        </div>

        <div class="mx-auto w-11/12 bg-white rounded-lg p-5 space-y-5">
            <div class="">
                <p class="text-2xl font-light">ВЫЛОЖИТЬ ОБЪЯВЛЕНИЕ</p>
            </div>
            <form action="{{route('ad.submit')}}" method="POST" class="space-y-3" enctype="multipart/form-data">
                @csrf
                <div class="flex flex-col space-y-2">
                    <label for="" class="text-xl font-light">Вставить фотографию</label>
                    <input name="photo" type="file" class="
                    file:border-0 file:bg-green-700 file:rounded-lg file:p-2
                    file:hover:bg-green-600 file:hover:cursor-pointer
                    file:text-white
                    ">
                </div>

                <div class="flex flex-col space-y-2">
                    <label for="" class="text-xl font-light">Название</label>
                    <input name="name" type="text" class="border p-2 rounded-md" placeholder="Название">
                </div>

                <div class="grid md:grid-cols-2 gap-3">
                    <div class="flex flex-col space-y-2">
                        <label for="" class="text-xl font-light flex items-center">Цена <p class="text-sm">(Оставьте пустым если цена договорная)</p> </label>
                        <input name="price" type="text" class="border p-2 rounded-md" placeholder="Цена, тенге">
                    </div>

                    <div class="flex flex-col space-y-2">
                        <label for="" class="text-xl font-light">Категория</label>
                        <select class="border p-2 rounded-md w-full" name="category" style="width: 50%;height: 38px;">
                            <optgroup label="Категории">
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </optgroup>
                        </select>
                    </div>
                </div>

                <div class="flex flex-col space-y-2">
                    <label for="" class="text-xl font-light">Описание</label>
                    <textarea name="description" type="text" class="border p-2 rounded-md resize-none h-36"></textarea>
                </div>

                <div class="grid md:grid-cols-2 gap-3">
                    <div class="flex flex-col space-y-2">
                        <label for="" class="text-xl font-light">Номер телефона</label>
                        <input name="phone" type="text" class="border p-2 rounded-md" value="+7">
                    </div>

                    <div class="flex flex-col space-y-2">
                        <label for="" class="text-xl font-light">Город, область</label>
                        <select class="border p-2 rounded-md w-full" name="city" style="width: 50%;height: 38px;">
                            <optgroup label="Город, область">
                                @foreach($cities as $city)
                                    <option value="{{$city->id}}">{{$city->name}}</option>
                                @endforeach
                            </optgroup>
                        </select>
                    </div>
                </div>

                <button type="submit"
                        class="w-full bg-green-700 p-2 rounded-lg text-white font-bold hover:cursor-pointer hover:bg-green-600">
                    Создать
                </button>

            </form>
        </div>
    </main>
@endsection
