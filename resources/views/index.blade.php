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
        <form action="{{route("ad.search")}}" method="GET" class="flex flex-col items-center space-y-3">
            <p id="header" class="transition-opacity duration-500">
                Скажите нейросети что вы ищете
            </p>

            <input id="search" name="search" type="search" class="rounded text-center p-2 w-24 transition-all duration-300 focus:outline-none border border-green-600 border-2" placeholder="" autocomplete="off">
            <button id="button_search" class="hidden p-2 w-20 bg-green-500 hover:bg-green-300 rounded text-white font-sans text-sm
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

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 w-9/12 md:w-7/12 mx-auto gap-1">
            @foreach($categories as $category)
            <a href='{{route('category.index', $category->id)}}' class="bg-white hover:bg-gray-400 flex flex-row items-center justify-between p-1 rounded-md
            @if($mode == 'vi') outline outline-1 outline-black @endif">
                <img class="w-8 " src="{{asset($category->photo_path)}}">
                <p class="font-light text-sm">{{$category->name}}</p>
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
                <a href="{{route('ad.detail', $ad->id)}}" class="mx-auto h-80 w-80">
                    <img class="rounded-lg object-cover w-full h-full" src="{{asset($ad->photo_path)}}">
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
    <script>
        const element = document.getElementById("search");
        const button = document.getElementById("button_search");
        const header = document.getElementById("header")
        const w = "w-1/4"
        const h = "h-24"
        element.addEventListener("click", function() {
            if (!this.classList.contains(w)) {
                this.classList.add(w);
                this.classList.add(h);
                button.classList.remove("hidden");
                header.classList.add("opacity-0");
            }
        })

        document.addEventListener("click", function(event) {
            var clickedElement = event.target;

            if (clickedElement.id !== "search") {
                element.classList.remove(w);
                element.classList.remove(h);
                button.classList.add("hidden");
                header.classList.remove("opacity-0");
            }
        });
    </script>
@endsection
