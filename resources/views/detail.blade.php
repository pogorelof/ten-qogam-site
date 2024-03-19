@extends('layouts.base')

@section('title', $ad->title)

@section('main')
    <main>
        <div class="mx-auto w-11/12 py-3">
            <a href="{{url()->previous()}}" class="flex items-center font-light p-1 rounded outline-gray-500 hover:bg-gradient-to-r hover:from-gray-300 hover:to-gray-200">
                <img src="{{asset('img/back.svg')}}" class="w-5" alt="">
                <p>Назад</p>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 mx-auto gap-2 w-11/12">
            <div class="bg-white rounded-lg p-5 col-span-2">
                <div class=""><img src="{{asset($ad->photo_path)}}" class="w-5/12 mx-auto rounded-sm"></div>
            </div>
            <div class="grid md:grid-rows-2 gap-2">
                <div class="bg-white rounded-lg p-5 flex flex-col justify-around space-y-4">
                    <div>
                        <p class="text-xl font-bold">{{$ad->title}} </p>
                        <p class="text-xs font-thin">{{$ad->city->name}}</p>
                    </div>
                    <div>
                        <p class="text-xl font-light ">
                            @if($ad->price)
                                {{$ad->price}} тенге
                            @else
                                Договорная
                            @endif
                        </p>
                    </div>
                    <div class="flex flex-col">
                        <div
                            class="p-2 outline hover:outline-4 outline-green-600 rounded  text-black flex justify-between items-center">
                            <p class="font-light">Номер телефона:</p>
                            <p>{{$ad->phone_number}}</p>
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <a href=""
                           class="p-2 bg-green-600 hover:bg-green-800 rounded text-center font-bold text-white">Написать</a>
                    </div>
                </div>
                <div class="bg-white rounded-lg p-5 flex flex-col justify-between space-y-4">
                    <div>
                        <p class="font-mono text-sm font-bold">ПРОДАВЕЦ</p>
                    </div>

                    <div class="">
                        <div class="flex items-center space-x-3">
                            <div class="rounded-full bg-gray-400 w-12 h-12 overflow-hidden">
                                <img class="w-12 h-12" src="{{asset($ad->user->photo_path)}}">
                            </div>
                            <div>
                                <p class="text-xl font-light">Владимир</p>
                                <p class="text-sm font-extralight">на сайте с {{$ad->user->created_at->translatedFormat('F Y')}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <a href=""
                           class="p-1 bg-green-600 hover:bg-green-800 rounded text-center font-bold text-white">Все
                            объявления</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 h-max w-11/12 mx-auto py-2">
            <div class="bg-white rounded-lg p-5 col-span-2">
                <div>
                    <p class="font-mono text-lg font-bold">ОПИСАНИЕ</p>
                </div>
                <div class="p-5">
                    <p class="px-3 py-1 rounded w-max outline outline-green-600">Коляски</p>
                </div>
                <div>
                    <p class="px-5">
                        {{$ad->description}}
                    </p>
                </div>
                <div class="py-3 space-y-4">
                    <hr>
                    <div class="flex justify-between">
                        <p class="font-light text-gray-500 text-xs">{{$ad->created_at->translatedFormat('j F')}}</p>

{{--                        TODO: просмотры--}}
                        <p class="font-light text-gray-500 text-xs">Просмотров: 50</p>
                        <a href="" class="font-light text-red-500 hover:text-red-600 text-sm">Жалоба</a>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
