@extends('layouts.base')

@section('title', $ad->title)

@php
    $mode = Request::session()->get('mode');
@endphp

@section('main')
    <main>
        <div class="mx-auto w-11/12 py-3">
            @if($previous = url()->previous())
                <a href="{{$previous}}" class="flex items-center font-light p-1 rounded outline-gray-500 hover:bg-gradient-to-r hover:from-gray-300 hover:to-gray-200">
                    <img src="{{asset('img/back.svg')}}" class="w-5" alt="">
                    <p>Назад</p>
                </a>
            @else
                <a href="{{route('home')}}" class="flex items-center font-light p-1 rounded outline-gray-500 hover:bg-gradient-to-r hover:from-gray-300 hover:to-gray-200">
                    <img src="{{asset('img/back.svg')}}" class="w-5" alt="">
                    <p>Назад</p>
                </a>
            @endif

        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 mx-auto gap-2 w-11/12">
            <div class="bg-white rounded-lg p-5 col-span-2 flex items-center justify-center">
                <div class=""><img src="{{asset($ad->photo_path)}}" class="w-6/12 min-w-96  mx-auto rounded-sm"></div>
            </div>
            <div class="grid md:grid-rows-2 gap-2">
                <div class="bg-white rounded-lg p-5 flex flex-col justify-around space-y-4">
                    <div>
                        <p class="text-xl font-bold">{{$ad->title}} </p>
                        <p class="text-xs @if($mode == 'vi') font-bold text-black @else font-thin @endif ">{{$ad->city->name}}</p>
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
                        @if(auth()->id() != $ad->user->id)
                        <a href="{{route("chat.chat", $ad->user->id)}}"
                           class="p-2 bg-green-600 hover:bg-green-800 rounded text-center font-bold text-white">Написать</a>
                        @endif
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
                                <p class="text-xl font-light">{{$ad->user->name}}</p>
                                <p class="text-sm font-extralight">на сайте с {{$ad->user->created_at->translatedFormat('F Y')}}</p>
                            </div>
                        </div>
                    </div>
                    @if(auth()->id() != $ad->user->id)
                    <div class="flex flex-col">
                        <a href="{{route("user.profile", $ad->user->id)}}"
                           class="p-1 bg-green-600 hover:bg-green-800 rounded text-center font-bold text-white">Все
                            объявления</a>
                    </div>
                    @else
                        <div class="flex flex-col">
                            <a href="{{route("profile")}}"
                               class="p-1 bg-green-600 hover:bg-green-800 rounded text-center font-bold text-white">Мой профиль</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 h-max w-11/12 mx-auto py-2">
            <div class="bg-white rounded-lg p-5 col-span-2">
                <div>
                    <p class="font-mono text-lg font-bold">ОПИСАНИЕ</p>
                </div>
                <div class="p-5">
                    {{-- TODO: Вывод категории --}}
                    <p class="px-3 py-1 rounded w-max outline outline-green-600">{{$ad->category->name}}</p>
                </div>
                <div>
                    <p class="px-5 whitespace-pre-line">
                        {{ $ad->description }}
                    </p>
                </div>
                <div class="py-3 space-y-4">
                    <hr class="@if($mode == 'vi') border-black @endif">
                    <div class="flex justify-between">
                        <p class="font-light text-xs @if($mode == 'vi') text-black @else text-gray-500 @endif">{{$ad->created_at->translatedFormat('j F')}}</p>

                        <p class="font-light text-xs @if($mode == 'vi') text-black @else text-gray-500 @endif">
                            Просмотров: {{$ad->view}}

                        </p>
                        @if(auth()->check())
                            @if(auth()->user()->favorite_ads->contains($ad))
                                <form action="{{route('favorite.delete', $ad->id)}}" method="POST">
                                    @csrf
                                    <button>
                                        <img src="{{asset('img/like.svg')}}" class="w-6 hover:scale-110">
                                    </button>
                                </form>
                            @else
                                <form action="{{route('favorite.add', $ad->id)}}" method="POST">
                                    @csrf
                                    <button>
                                        <img src="{{asset('img/unlike.svg')}}" class="w-6 hover:scale-110">
                                    </button>
                                </form>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
