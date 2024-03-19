@extends('layouts.base')

@section('title', $category->name)

@section('main')

    <main class="md:w-9/12 mx-auto">
        <div class="py-1">
            <p class="text-3xl p-1 mt-3 font-light outline outline-1 outline-green-600 rounded w-max">{{$category->name}}</p>
        </div>
        <div class="py-3">
            <p class="text-xl p-1 font-light outline outline-1 outline-green-600 rounded w-max">Было найдено {{$ads->count()}}
                объявления(-ий)</p>
        </div>

        <div class="flex flex-col py-5 space-y-2">

            @foreach($ads as $ad)
            <div class="rounded bg-white shadow-lg shadow-gray-400 hover:shadow-gray-500">
                <div class="flex justify-between">
                    <a href="{{route('ad.detail', $ad->id)}}" class="flex">
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
                                {{$ad->price}} тенге
                            @else
                                Договорная
                            @endif
                        </div>
                        <button>
                            <img src="{{asset('img/unlike.svg')}}" class="w-6 hover:scale-110">
                        </button>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </main>

@endsection
