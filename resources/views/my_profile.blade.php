@extends('layouts.base')

{{--@section('title')--}}

@section('main')
    <main class="md:w-10/12 mx-auto grid md:grid-cols-2 gap-2">
            <div class="bg-white rounded-xl mt-5 md:p-5">
                <div class="py-3">
                    <p class="text-xl p-1 font-light outline outline-1 outline-green-600 rounded w-max">Мои
                        Объявления</p>
                </div>
                <div class="flex flex-col py-5 space-y-2">
                    @foreach($user->ad()->get() as $ad)
                    <div class="rounded bg-white shadow-lg shadow-gray-400 hover:shadow-gray-500">
                        <div class="flex justify-between">
                            <a href="" class="flex">
                                <div class="w-24 h-32 md:w-48 md:h-36 overflow-hidden m-2">
                                    <img src="{{asset($ad->photo_path)}}" class="object-cover w-full h-full ">
                                </div>
                                <div class="flex flex-col justify-between md:p-3">
                                    <div class="md:text-2xl font-light">{{$ad->title}}</div>
                                    <div class="text-xs md:text-sm font-light">{{$ad->created_at->translatedFormat('j F')}} - {{$ad->city->name}}</div>
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
                                <button>
{{--                                    TODO: delete button--}}
                                    <img src="img/trash.svg" class="w-6">
                                </button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        <div class="bg-white rounded-xl mt-5 p-5">
            <div class="py-3">
                <p class="text-xl p-1 font-light outline outline-1 outline-yellow-600 rounded w-max">Избранное</p>
            </div>
            <div class="flex flex-col py-5 space-y-2">

                <div class="rounded bg-white shadow-lg shadow-gray-400 hover:shadow-gray-500">
                    <div class="flex justify-between">
                        <a href="" class="flex">
                            <div class="w-24 h-32 md:w-48 md:h-36 overflow-hidden m-2">
                                <img src="img/1.png" class="object-cover w-full h-full ">
                            </div>
                            <div class="flex flex-col justify-between md:p-3">
                                <div class="md:text-2xl font-light">Коляска</div>
                                <div class="text-xs md:text-sm font-light">30 января - Алматы</div>
                            </div>
                        </a>
                        <div class="flex flex-col items-end justify-between p-3">
                            <div class="text-sm md:text-lg font-mono">35000тг</div>
                            <button>
                                <img src="img/like.svg" class="w-6">
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>
@endsection
