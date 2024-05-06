<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GptController extends Controller
{
    private function gpt_request($prompt, $system_prompt, $model)
    {
        //Make request to GPT API
        $response = Http::withHeaders([
            "Content-Type" => "application/json",
            "Authorization" => "Bearer " . env('CHAT_GPT_API')
        ])->post("https://api.openai.com/v1/chat/completions", [
            "model" => $model,
            "messages" => [
                ["role" => "system", "content" => $system_prompt],
                ["role" => "user", "content" => $prompt],
            ],
            "temperature" => 1,
            "max_tokens" => 500,
        ])->json();
        return $response;
    }
    public function search(Request $request)
    {
        //Get ads to format string for prompt
        $ads = Ad::select("id", "title")->get();
        $ads_format = "";
        foreach ($ads as $ad){
            $ads_format .= $ad->id."-".$ad->title."|";
        }

        //Make prompt
        $user_prompt = $request->input("search");
        $prompt = "Сообщение пользователя: $user_prompt Актуальный список товаров: $ads_format";
        $system_prompt = "Ты помощник на сайте товаров.
        Твоя задача помочь с поиском товаров возвращая только их ID.
        Ты получаешь запрос пользователя и актуальный список товаров в виде id-name разделенные. Товары разделены “|”.
        Твоя задача найти соответствующие сообщению пользователя товары и вывести только номер их id. Если подходящих товаров больше одного, их id разделяются “-”.
        Проверь каждый товар очень внимательно и если товар спорный, то скорее добавь его в список, чем не добавляй.";

        $response = $this->gpt_request($prompt, $system_prompt, "gpt-4-0125-preview");

        //Get ads from answer
        $ids = explode("-", $response['choices'][0]['message']['content']);
        $ads_from_gpt = Ad::whereIn("id", $ids)->get();

        //Pass it to view
        $context = [
            "ads" => $ads_from_gpt
        ];
        return view("searched", $context);
    }

    public function text_edit(Request $request)
    {
        $prompt = $request->text;

        $system_prompt = "Твоя задача - редактирование и украшение текстов.
Тебе на вход придет сообщение с описанием какого-либо объявления. Тебе нужно будет красиво его отредактировать и дописать текст так, чтобы все это выглядело лаконично, красиво и структурированно. Не нужно писать про цену, контакты и город. Так же при присутствии ошибок их нужно исправить. Структурируй текст через '-' если это будет уместно ";
        $response = $this->gpt_request($prompt, $system_prompt, "gpt-3.5-turbo-0125");
        $text = $response['choices'][0]['message']['content'];

        return response()->json(['data' => $text]);
    }

    public function grammar_edit(Request $request)
    {
        $prompt = $request->text;

        $system_prompt = "Твоя задача исправление ошибок в заголовке объявления.  Ты не должен добавлять ничего нового. Твоя цель лишь исправить ошибки, а так же если первое слово начинается с маленькой буквы исправить это";
        $response = $this->gpt_request($prompt, $system_prompt, "gpt-3.5-turbo-0125");
        $text = $response['choices'][0]['message']['content'];

        return response()->json(['data' => $text]);
    }
}
