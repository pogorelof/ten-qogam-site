@extends('layouts.base')

@section('title', 'Архив')

@section('main')
    <main>
        <div class="mx-auto w-11/12 py-3">
            <a href="{{route('profile')}}" class="flex items-center font-light p-1 rounded outline-gray-500 hover:bg-gradient-to-r hover:from-gray-300 hover:to-gray-200">
                <img src="{{asset('img/back.svg')}}" class="w-5" alt="">
                <p>Назад</p>
            </a>
        </div>
        <div class="bg-white rounded-xl mt-5 md:p-5 h-max w-6/12 mx-auto">
            <div class="py-3">
                <p class="text-xl p-1 font-light outline outline-1 outline-gray-600 rounded w-max">Архив</p>
            </div>
            <div class="flex flex-col py-5 space-y-2">
                @if(count($ads) != 0)
                    @foreach($ads as $ad)
                        <div class="rounded bg-white shadow-lg shadow-gray-400 hover:shadow-gray-500">
                            <div class="flex justify-between">
                                <a class="flex">
                                    <div class="w-24 h-32 md:w-48 md:h-36 overflow-hidden m-2">
                                        <img src="{{asset($ad->photo_path)}}" class="object-cover w-full h-full ">
                                    </div>
                                    <div class="flex flex-col justify-between md:p-3">
                                        <div class="md:text-2xl font-light">{{$ad->title}}</div>
                                        <div
                                            class="text-xs md:text-sm font-light">{{$ad->created_at->translatedFormat('j F')}}
                                            - {{$ad->city->name}}</div>
                                    </div>
                                </a>
                                <div class="flex flex-col items-end justify-between p-3">
                                    <div class="text-sm md:text-lg font-mono">
                                        @if($ad->price)
                                            {{$ad->price}} тг
                                        @else
                                            Договорная
                                        @endif
                                    </div>
                                    <form action="unarchive/2" method="POST">
                                        @csrf
                                        <button>
                                            <img src="img/restore.svg" class="w-8 hover:scale-110">
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="text-center">
                        <p class="italic text-gray-400">
                            Архив пуст
                        </p>
                    </div>
                @endif
            </div>
        </div>
    </main>
@endsection
