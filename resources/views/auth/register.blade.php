@extends('layouts.form')
@section('title', 'Регистрация')

@section('main')
<main class="bg-gray-50 md:w-2/5 mx-auto mt-5 rounded-lg p-5 shadow-lg shadow-stone-600">
    <div class="text-center">
        <p class="text-3xl font-light">РЕГИСТРАЦИЯ</p>
    </div>
    <form action="{{route('register_submit')}}" method="POST" class="w-9/12 mx-auto mt-4 space-y-2">
        @csrf
        <div class="flex flex-col space-y-2 text-ce">
            <label for="" class="text-xl font-light">Имя</label>
            <input type="text" name="name" class="rounded outline outline-1 outline-gray-200 p-2 @error('name') outline-red-200 @enderror" placeholder="Имя">
            @error('name')
                <p class="text-red-500">{{$message}}</p>
            @enderror
        </div>
        <div class="flex flex-col space-y-2 text-ce">
            <label for="" class="text-xl font-light">Email</label>
            <input type="email" name="email" class="rounded outline outline-1 outline-gray-200 p-2 @error('email') outline-red-200 @enderror" placeholder="Email">
            @error('email')
                <p class="text-red-500">{{$message}}</p>
            @enderror
        </div>
        <div class="flex flex-col space-y-2 text-ce">
            <label for="" class="text-xl font-light">Вставить фотографию</label>
            <input type="file" name='photo' class="block w-full text-sm text-slate-500
      file:mr-4 file:py-2 file:px-4
      file:rounded file:border-0
      file:text-sm file:font-semibold
      file:bg-green-100 file:text-green-700
      hover:file:bg-green-200 hover:cursor-pointer
      @error('photo') outline-red-200 @enderror
    " />
            @error('photo')
                <p class="text-red-500">{{$message}}</p>
            @enderror
        </div>
        <div class="flex flex-col space-y-2 text-ce">
            <label for="" class="text-xl font-light">Пароль</label>
            <input type="password" name="password" class="rounded outline outline-1 outline-gray-200 p-2 @error('password') outline-red-200 @enderror"
                   placeholder="Пароль">
            @error('password')
                <p class="text-red-500">{{$message}}</p>
            @enderror
        </div>
        <div class="flex flex-col space-y-2 text-ce">
            <label for="" class="text-xl font-light">Повторите пароль</label>
            <input type="password" name="password_confirmation" class="rounded outline outline-1 outline-gray-200 p-2"
                   placeholder="Повторите пароль">
        </div>
        <div class="md:flex md:items-start md:space-x-2">
            <input type="checkbox" name="agree" class="accent-green-700 hover:scale-125 hover:cursor-pointer">
            <p class="text-xs italic">Я соглашаюсь с <a href=""
                                                        class="text-green-500 hover:text-green-600">Условиями использования</a>, а также с передачей и
                обработкой моих данных в Ten Qogam. Я
                подтверждаю своe совершеннолетие и свою ответственность за выставление объявления.</p>
        </div>
        @error('agree')
        <p class="text-red-500">{{$message}}</p>
        @enderror

        <button type="submit"
                class="w-full bg-green-700 p-2 rounded-lg text-white font-bold hover:cursor-pointer hover:bg-green-500">Зарегистрироваться</button>

        <div class="">
            <a href="{{route('login')}}" class="text-green-700 hover:text-green-500">Уже есть аккаунт</a>
        </div>
    </form>
</main>
@endsection
