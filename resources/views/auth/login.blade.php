@extends('layouts.form')
@section('title', 'Логин')

@section('main')
    <main class="bg-gray-50 md:w-2/5 mx-auto mt-5 rounded-lg p-5 shadow-lg shadow-stone-600">
        <div class="text-center">
            <p class="text-3xl font-light">ЛОГИН</p>
        </div>
        <form action="{{route('login_submit')}}" method="POST" class="w-9/12 mx-auto mt-4 space-y-2">
            @csrf
            <div class="flex flex-col space-y-2 text-ce">
                <label for="" class="text-xl font-light">Email</label>
                <input type="email" name="email" class="rounded outline outline-1 outline-gray-200 p-2" placeholder="Email">
            </div>
            @error("email")
            <p class="text-red-500">Нужно ввести Email!</p>
            @enderror

            <div class="flex flex-col space-y-2 text-ce">
                <label for="" class="text-xl font-light">Пароль</label>
                <input type="password" name="password" class="rounded outline outline-1 outline-gray-200 p-2"
                       placeholder="Пароль">
            </div>
            @error("password")
            <p class="text-red-500">Нужно ввести пароль!</p>
            @enderror


            <button type="submit"
                    class="w-full bg-green-700 p-2 rounded-lg text-white font-bold hover:cursor-pointer hover:bg-green-500">
                Войти
            </button>
            @error('lose')
            <p class="text-red-500">{{$message}}</p>
            @enderror
            <div class="flex flex-col">
                <a href="{{route('register')}}" class="text-green-700 hover:text-green-500">Нет аккаунта</a>
{{--                TODO: забыли пароль--}}
{{--                <a href="" class="text-green-700 hover:text-green-500">Забыли пароль</a>--}}
            </div>
        </form>
    </main>
@endsection
