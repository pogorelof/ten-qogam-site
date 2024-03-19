<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>@yield('title')</title>
</head>

<body class="bg-gray-200">
<header
    class="bg-gradient-to-b from-green-700 to-green-900 flex flex-col md:flex-row space-y-7 md:space-y-0 items-center justify-between py-5 px-3">
    <a href='{{route('home')}}' class="flex items-center space-x-3">
        <div class="bg-gradient-to-tl from-green-400 rounded-xl w-16 shadow-lg shadow-black">
            <img class="" src="{{asset('img/TQ.png')}}">
        </div>
        <div>
            <p class="text-gray-300 text-2xl">Ten Qogam</p>
        </div>
    </a>
    <div>
        <a href="" class="text-xl text-gray-300">О нас</a>
    </div>
    <div>
        @auth
            <div class="scale-75 md:scale-100 whitespace-nowrap">
                <a href="{{route('profile')}}" class="bg-white hover:bg-gray-300 p-4 text-md rounded-l">Профиль</a>
                <a href="" class="bg-white hover:bg-gray-300 p-4 text-md">Сообщения</a>
                <a href="" class="bg-white hover:bg-gray-300 p-4 text-md">Выложить объявление</a>
                <a href="{{'/logout'}}" class="bg-white hover:bg-gray-300 p-4 text-md rounded-r hover:bg-red-600">Выйти</a>
            </div>
        @endauth

        @guest
            <div class="scale-75 md:scale-100 whitespace-nowrap">
                <a href="{{route('login')}}" class="bg-white hover:bg-gray-300 p-4 text-md rounded-l">Логин</a>
                <a href="{{route('register')}}" class="bg-white hover:bg-gray-300 p-4 text-md rounded-r">Регистрация</a>
            </div>
        @endguest
    </div>
</header>

@yield('main')

<footer class="py-3">
    <hr>
    <div class="flex flex-col items-start space-y-5 py-8 mx-auto w-11/12 text-sm font-light">
        <div class="flex space-x-1 items-center text-gray-500 w-10/12">
            <img src="{{asset('img/copy.svg')}}" class="w-6">
            <p class="">Ten Qogam 2022-2024</p>
        </div>
        <div class="text-gray-500 items-center flex space-x-2 w-10/12">
            <img src="{{asset('img/address.svg')}}" class="w-6">
            <p>Алматы, Талдыарал 13/1 </p>
        </div>
        <div class="text-gray-500 items-center flex space-x-2 w-10/12">
            <img src="{{asset('img/wa.svg')}}" class="w-6">
            <p>+77713338080</p>
        </div>
    </div>
</footer>
</body>

</html>
