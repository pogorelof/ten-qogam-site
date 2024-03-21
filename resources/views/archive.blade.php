@extends('layouts.base')

@section('title', 'Архив')

@section('main')
    <main>
        <div class="bg-white rounded-xl mt-5 md:p-5 h-max">
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
                            Архив пуст
                        </p>
                    </div>
                @endif
            </div>
        </div>
    </main>
@endsection
