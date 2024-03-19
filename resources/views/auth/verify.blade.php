@extends('layouts.for')

@section('title', 'Подтверждение почты')

@section('main')
    <main class="bg-gray-50 md:w-2/5 mx-auto mt-5 rounded-lg p-5 shadow-lg shadow-stone-600">
        <div class="text-center">
            <p class="text-3xl font-light">ПОДТВЕРЖДЕНИЕ</p>
        </div>
        <form action="" method="POST" class="w-9/12 mx-auto mt-4 space-y-2">
            @csrf
            <div class="flex flex-col space-y-2 text-ce">
                <label for="" class="text-xl font-light">Код подтверждения</label>
                <input type="text" name="code" class="rounded outline outline-1 outline-gray-200 p-2" placeholder="Email">
            </div>

            <button type="submit"
                    class="w-full bg-green-700 p-2 rounded-lg text-white font-bold hover:cursor-pointer hover:bg-green-500">
                Отправить
            </button>
            @error('lose')
            <p class="text-red-500">{{$message}}</p>
            @enderror
        </form>
    </main>
@endsection

