@extends('layouts.base')

@section('title', $category->name)

@section('main')

    <main class="md:w-9/12 mx-auto">
        <div class="py-1">
            <p class="text-3xl p-1 mt-3 font-light outline outline-1 outline-green-600 rounded w-max">Коляски</p>
        </div>
        <div class="py-3">
            <p class="text-xl p-1 font-light outline outline-1 outline-green-600 rounded w-max">Было найдено 3
                объявления(-ий)</p>
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
                            <img src="img/unlike.svg" class="w-6">
                        </button>
                    </div>
                </div>
            </div>

            <div class="rounded bg-white shadow-lg shadow-gray-400 hover:shadow-gray-500">
                <div class="flex justify-between">
                    <a href="" class="flex">
                        <div class="w-24 h-32 md:w-48 md:h-36 overflow-hidden m-2">
                            <img src="img/2.jpg" class="object-cover w-full h-full ">
                        </div>
                        <div class="flex flex-col justify-between md:p-3">
                            <div class="md:text-2xl font-light">Инватакси</div>
                            <div class="text-xs md:text-sm font-light">20 февраля - Шымкент</div>
                        </div>
                    </a>
                    <div class="flex flex-col items-end justify-between p-3">
                        <div class="text-sm md:text-lg font-mono">Договорная</div>
                        <button>
                            <img src="img/like.svg" class="w-6">
                        </button>
                    </div>
                </div>
            </div>

            <div class="rounded bg-white shadow-lg shadow-gray-400 hover:shadow-gray-500">
                <div class="flex justify-between">
                    <a href="" class="flex">
                        <div class="w-24 h-32 md:w-48 md:h-36 overflow-hidden m-2">
                            <img src="img/3.png" class="object-cover w-full h-full ">
                        </div>
                        <div class="flex flex-col justify-between md:p-3">
                            <div class="md:text-2xl font-light">Костыли</div>
                            <div class="text-xs md:text-sm font-light">1 март - Астана</div>
                        </div>
                    </a>
                    <div class="flex flex-col items-end justify-between p-3">
                        <div class="text-sm md:text-lg font-mono">35000тг</div>
                        <button>
                            <img src="img/unlike.svg" class="w-6">
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection
