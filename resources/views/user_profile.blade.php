@extends("layouts.base")
@section("title", "Профиль")

@section("main")
    <main class="md:w-10/12 mx-auto grid md:grid-cols-4 md:gap-2">
        <div class="bg-white rounded-xl mt-5 p-5 space-y-3 h-max">
            <div class="">
                <div class="rounded-full w-28 h-28 overflow-hidden mx-auto">
                    <img src="{{asset($user->photo_path)}}">
                </div>
            </div>
            <div class="text-center">
                <p class="text-2xl font-light">{{$user->name}}</p>
            </div>
            <div class="flex flex-col">
                <a href="{{route("chat.chat", $user->id)}}"
                   class="p-2 bg-green-600 hover:bg-green-800 rounded text-center text-sm font-bold text-white">Написать</a>
            </div>
        </div>
        <div class="bg-white rounded-xl mt-5 p-5 md:col-span-3">
            <div class="py-3">
                <p class="text-xl p-1 font-light outline outline-1 outline-green-600 rounded w-max">Объявления пользователя</p>
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
                                @endif</div>
                            @if(auth()->check())
                                @if(auth()->user()->favorite_ads->contains($ad))
                                    <form action="{{route('favorite.delete', $ad->id)}}" method="POST">
                                        @csrf
                                        <button>
                                            <img src="{{asset('img/like.svg')}}" class="w-6 hover:scale-110">
                                        </button>
                                    </form>
                                @else
                                    <form action="{{route('favorite.add', $ad->id)}}" method="POST">
                                        @csrf
                                        <button>
                                            <img src="{{asset('img/unlike.svg')}}" class="w-6 hover:scale-110">
                                        </button>
                                    </form>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </main>
@endsection
