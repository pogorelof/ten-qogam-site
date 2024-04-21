@extends('layouts.base')
@section('title', 'Главная страница')

@php
    $mode = Request::session()->get('mode');
@endphp

@section('main')
<main class="bg-gray-50 pb-6">
    <div class="bg-gray-200 text-center py-4 space-y-6 shadow-lg shadow-gray-400
    @if($mode == 'vi') shadow-gray-50 bg-gray-200 @endif
    ">
        <form action="" class="flex flex-col md:block items-center space-y-3 md:space-y-0">
            <input type="search" class="rounded p-2 w-full md:w-1/4 " placeholder="Что ищете?">
            <select class="p-3 rounded h-10 md:w-2/12">
                <option value="all">Вся страна</option>
                @foreach($cities as $city)
                <option value="{{$city->id}}">{{$city->name}}</option>
                @endforeach
            </select>
            <button class="p-2 w-24 bg-gray-200 hover:bg-gray-400 rounded text-gray-600 border border-gray-400
            @if($mode == 'vi')
                text-black border-black
            @endif
            "
                    type="submit">Поиск
            </button>
        </form>

        <div>
            <p class="text-2xl">Категории</p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-5 w-5/12 mx-auto gap-1">
            @foreach($categories as $category)
            <a href='{{route('category.index', $category->id)}}' class="bg-white hover:bg-gray-400 flex flex-col items-center p-2 rounded-md
            @if($mode == 'vi') outline outline-1 outline-black @endif">
                <img class="w-6 " src="{{asset($category->photo_path)}}">
                <p>{{$category->name}}</p>
            </a>
            @endforeach
        </div>
    </div>

    <div class="w-11/12 mx-auto">
        <div class="text-center py-9">
            <p class="text-3xl">
                Последние объявления
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @foreach($ads as $ad)
            <div
                class="flex flex-col justify-between bg-gradient-to-b from-gray-100 to-gray-200 hover:to-gray-300 p-3 space-y-5 rounded-lg
                @if($mode == 'vi') outline outline-1 outline-gray-700 @endif">
                <a href="{{route('ad.detail', $ad->id)}}" class="text-center ">
                    <p class="text-2xl font-bold ">
                        {{$ad->title}}
                    </p>
                </a>
                <a href="{{route('ad.detail', $ad->id)}}" class="mx-auto">
                    <img class="rounded-lg h-80 w-72" src="{{asset($ad->photo_path)}}">
                </a>
                <div class="text-center">
                    <p class="text-xl">
                        @if($ad->price)
                            {{$ad->price}} тг
                        @else
                            Договорная
                        @endif
                    </p>
                </div>
                <div class="flex justify-start items-center">
                    <p class="text-sm">
                        {{$ad->city->name}}, {{ $ad->created_at->translatedFormat('j F') }}
                    </p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</main>
@endsection
