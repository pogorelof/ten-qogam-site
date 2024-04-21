@extends("layouts.base")
@section("title", "Чаты")

@section("main")
    <main class="w-10/12 mx-auto">
        <p class="text-2xl font-light mt-5">ВАШИ СООБЩЕНИЯ</p>
        <div class=" py-5 space-y-3">

            @foreach($chats as $chat)
                @php
                    if($chat->user1->id == auth()->id()){
                        $chat_with = $chat->user2;
                    }else{
                        $chat_with = $chat->user1;
                    }
                @endphp
                <div class="bg-white rounded-lg p-2 flex justify-between hover:bg-gradient-to-tr hover:from-slate-200 hover:to-slate-100">
                    <a href="{{route("chat.chat", $chat_with->id)}}" class="flex">
                        <div class="rounded-full w-20 h-20 overflow-hidden ">
                            <img src="{{asset($chat_with->photo_path)}}">
                        </div>
                        <div class="ml-5 flex flex-col justify-between">
                            <div>
                                <p class="text-xl font-light">
                                    {{$chat_with->name}}
                                </p>
                            </div>
                            <div>
                                <p class="font-light text-sm">
                                    {{date('d.m.Y H:m', strtotime($chat->last_message_at))}}
                                </p>
                            </div>
                        </div>
                    </a>
                    <button class="flex items-center hover:scale-105">
                        <img src="img/trash.svg" class="w-8">
                    </button>
                </div>
            @endforeach

        </div>
    </main>
@endsection
