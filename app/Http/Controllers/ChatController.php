<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function chats()
    {
        $id = auth()->id();
        $chats = Chat::where("user1_id", $id)->orWhere("user2_id", $id)->latest("last_message_at")->get();
        $context = ["chats"=>$chats, "id"=>$id];
        return view("chat.group_of_chats", $context);
    }

    public function chat(User $recepient)
    {
        $id = auth()->id();
        if ($recepient->id > $id){
            $chat = Chat::where("user1_id", $id)->where("user2_id", $recepient->id)->first();
        }else{
            $chat = Chat::where("user1_id", $recepient->id)->where("user2_id", $id)->first();
        }

        if(!$chat){
            if ($recepient->id > $id){
                $chat = [
                    "user1_id" => $id,
                    "user2_id" => $recepient->id
                ];
                $chat = Chat::create($chat);
            }else{
                $chat = [
                    "user1_id" => $recepient->id,
                    "user2_id" => $id
                ];
                $chat = Chat::create($chat);
            }
        }

        $messages = Message::where("chat_id",$chat->id)->oldest()->get();

        $context = [
            "chat"=>$chat,
            "messages"=>$messages,
        ];
        return view("chat.chat", $context);
    }

    public function chat_submit(Request $request, Chat $chat, User $recepient)
    {
        $text = $request["text"];
        $message = [
            "chat_id" => $chat->id,
            "sender_id" => auth()->id(),
            "recepient_id" => $recepient->id,
            "text" => $text
        ];
        Message::create($message);
        $chat->last_message_at = now();
        $chat->save();

        return redirect()->back();
    }
}
