<header
    class="bg-gradient-to-b from-green-700 to-green-900 flex flex-col md:flex-row space-y-7 md:space-y-0 items-center justify-between py-5 px-3
    @if($mode == 'vi') from-green-800 to-green-800 @endif
    ">
    <a href='{{route('home')}}' class="flex items-center space-x-3">
        <div class="bg-gradient-to-tl from-green-400 rounded-xl w-16 shadow-lg shadow-black">
            <img class="" src="{{asset('img/TQ.png')}}">
        </div>
        <div>
            <p class="text-gray-300 text-2xl @if($mode == 'vi') text-white @endif">Ten Qogam</p>
        </div>
    </a>
    <div>
        <a href="{{route('about')}}" class="hidden text-xl text-gray-300 @if($mode == 'vi') text-white @endif">О нас</a>
    </div>
    <div>
        @auth
            <div class="scale-75 md:scale-100 whitespace-nowrap grid grid-cols-2 md:block">
                <a href="{{route('profile')}}" class="bg-white hover:bg-gray-300 p-4 text-md rounded-l">Профиль</a>
                <a href="{{route('chat.chats')}}" class="bg-white hover:bg-gray-300 p-4 text-md">Сообщения</a>
                <a href="{{route('ad.add')}}" class="bg-white hover:bg-gray-300 p-4 text-md">Выложить объявление</a>
                <a href="{{'/logout'}}"
                   class="bg-white hover:bg-gray-300 p-4 text-md rounded-r hover:bg-red-600">Выйти</a>
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
