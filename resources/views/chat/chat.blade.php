@extends("layouts.base")
@section("title", "Чат")

@section("main")
    @php
        $id = auth()->id();
        if($chat->user1->id == auth()->id()){
            $chat_with = $chat->user2;
        }else{
            $chat_with = $chat->user1;
        }
    @endphp
    <main class="md:w-10/12 mx-auto">
        <div class="rounded bg-white md:mt-5">

            <div class="flex justify-between p-2">
                <div class="flex items-center space-x-2">
                    <div class="rounded-full w-10 h-10 overflow-hidden ">
                        <img src="{{asset($chat_with->photo_path)}}">
                    </div>
                    <div>
                        <p class="font-semibold text-gray-700">{{$chat_with->name}}</p>
                    </div>
                </div>

{{--                TODO: кнопка удаления--}}
{{--                <button class="flex items-center hover:scale-105">--}}
{{--                    <img src="img/trash.svg" class="w-6 ">--}}
{{--                </button>--}}
            </div>

            <hr class="mt-1 w-full">
            <div class="overflow-scroll flex flex-col p-5 h-96 space-y-2">
                @foreach($messages as $message)

                    @if($message->sender_id == $id)
                        <div class="flex justify-end">
                            <div class="p-3 bg-green-200 rounded-xl max-w-80">
                                <p>{{$message->text}}</p>
                            </div>
                        </div>
                    @else
                        <div class="flex justify-start">
                            <div class="p-3 bg-gray-300 rounded-xl max-w-80">
                                <p>{{$message->text}}</p>
                            </div>
                        </div>
                    @endif
                @endforeach

                <div id="chatAnchor"></div>
            </div>

            <hr class="mt-1 w-full">

            <form action="{{route("chat.submit", ["chat"=>$chat->id, "recepient"=>$chat_with->id])}}" method="POST" class="flex justify-between">
                @csrf
                <textarea name="text" class=" w-full resize-none p-1 text-sm" placeholder="Напишите сообщение"></textarea>
                <button type="submit" class="text-xs font-light bg-green-200 hover:bg-green-300 rounded p-1">ОТПРАВИТЬ</button>
            </form>
        </div>
    </main>
@endsection
