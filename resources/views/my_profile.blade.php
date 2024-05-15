@extends('layouts.base')

{{--@section('title')--}}

@section('main')
    @if(!auth()->user()->email_verified_at)
        <div class="text-white m-2">
            <a href="{{route('verify')}}" class="bg-green-800 hover:bg-green-700 p-1 rounded">
                Подтвердите аккаунт
            </a>
        </div>
    @endif

    <main class="md:w-10/12 mx-auto grid md:grid-cols-2 gap-2">
        <div class="bg-white rounded-xl mt-5 md:p-5 h-max">
            <div class="py-3 flex items-center justify-between">
                <p class="text-xl p-1 font-light outline outline-1 outline-green-600 rounded w-max">Мои
                    Объявления</p>
                <a href="{{route('ad.archive')}}" class="font-light text-gray-400 hover:text-gray-500">Архив</a>
            </div>
            <div class="flex flex-col py-5 space-y-2">
                @if(count(auth()->user()->ad()->get()) != 0)
                @foreach($user->ad()->get() as $ad)
                    <div class="rounded bg-white shadow-lg shadow-gray-400 hover:shadow-gray-500">
                        <div class="flex justify-between">
                            <a href="{{route('ad.detail', $ad->id)}}" class="flex">
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
                                <form action="{{route('ad.delete', $ad->id)}}" method="POST">
                                    @csrf
                                    <button>
                                        <img src="img/trash.svg" class="w-6 hover:scale-110">
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
                @else
                    <div class="text-center">
                        <p class="italic text-gray-400">
                            У вас нет обяъвлений
                        </p>
                    </div>
                @endif
            </div>
        </div>
        <div class="bg-white rounded-xl mt-5 p-5 h-max">
            <div class="py-3 flex items-center space-x-2">
                <p class="text-xl p-1 font-light outline outline-1 outline-yellow-600 rounded w-max">Избранное</p>
                <a href="{{route("recomendation")}}" class="flex bg-green-700 opacity-70 hover:bg-green-800 hover:cursor-pointer items-end p-1 rounded space-x-0.5">
                    <p class="font-bold text-white">Рекомендации</p>
                    <p class="font-light text-white text-xs">от нейросети</p>
                </a>
            </div>
            <div class="flex flex-col py-5 space-y-2">
                @if(count(auth()->user()->favorite_ads) != 0)
                    @foreach(auth()->user()->favorite_ads as $ad)
                        <div class="rounded bg-white shadow-lg shadow-gray-400 hover:shadow-gray-500">
                            <div class="flex justify-between">
                                <a href="{{route('ad.detail', $ad->id)}}" class="flex">
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
                                    <form action="{{route('favorite.delete', $ad->id)}}" method="POST">
                                        @csrf
                                        <button>
                                            <img src="{{asset('img/like.svg')}}" class="w-6 hover:scale-110">
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="text-center">
                        <p class="italic text-gray-400">
                            У вас нет избранного
                        </p>
                    </div>
                @endif
            </div>
        </div>
    </main>
@endsection
