<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

/**
 * Controller for work with GPT models of OpenAI
 */
class GptController extends Controller
{
    /**
     * Method for sending a request to the OpenAI API
     *
     * @param string $prompt User prompt
     * @param string $system_prompt Model instruction
     * @param string $model Model version
     * @param int $temperature Creative value 0-2
     * @return array JSON Format
     */
    private function gpt_request(string $prompt, string $system_prompt, string $model, int $temperature)
    {
        return Http::withHeaders([
            "Content-Type" => "application/json",
            "Authorization" => "Bearer " . env('CHAT_GPT_API')
        ])->post("https://api.openai.com/v1/chat/completions", [
            "model" => $model,
            "messages" => [
                ["role" => "system", "content" => $system_prompt],
                ["role" => "user", "content" => $prompt],
            ],
            "temperature" => $temperature,
            "max_tokens" => 500,
        ])->json();
    }

    /**
     * Get actual ads with format for GPT
     *
     * @return string
     */
    private function actual_ads()
    {
        $ads = Ad::select("id", "title")->get();
        $ads_format = "";
        foreach ($ads as $ad){
            $ads_format .= $ad->id."-".$ad->title."|";
        }
        return $ads_format;
    }

    /**
     * Search the database of actual ads using natural language processing
     *
     * @param Request $request
     * @return View
     */
    public function search(Request $request)
    {
        $ads_format = $this->actual_ads();

        //Make prompt
        $user_prompt = $request->input("search");
        $prompt = "Сообщение пользователя: $user_prompt Актуальный список товаров: $ads_format";
        $system_prompt = "Ты помощник на сайте товаров.
        Твоя задача помочь с поиском товаров возвращая только их ID.
        Ты получаешь запрос пользователя и актуальный список товаров в виде id-name разделенные. Товары разделены “|”.
        Твоя задача найти соответствующие сообщению пользователя товары и вывести только номер их id. Если подходящих товаров больше одного, их id разделяются “-”.
        Проверь каждый товар очень внимательно и если товар спорный, то скорее добавь его в список, чем не добавляй.
        Так же ищи товары на казахском языке.
        Если сообщение пользователя на казахском языке, переведи его на русский язык и ищи товары так же и на русском
        ";

        $response = $this->gpt_request($prompt, $system_prompt, "gpt-4-0125-preview", 0.5);

        //Get ads from answer
        $ids = explode("-", $response['choices'][0]['message']['content']);
        $ads_from_gpt = Ad::whereIn("id", $ids)->get();

        //Pass it to view
        $context = [
            "ads" => $ads_from_gpt
        ];
        return view("searched", $context);
    }

    /**
     * Text embellishment with GPT
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function text_edit(Request $request)
    {
        $prompt = $request->text;

        $system_prompt = "Твоя задача - редактирование и украшение текстов.
Тебе на вход придет сообщение с описанием какого-либо объявления. Тебе нужно будет красиво его отредактировать и дописать текст так, чтобы все это выглядело лаконично, красиво и структурированно. Не нужно писать про цену, контакты и город. Так же при присутствии ошибок их нужно исправить. Структурируй текст через '-' если это будет уместно
Если запрос пришел на казахском языке, ты должен составить описание на казахском языке";
        $response = $this->gpt_request($prompt, $system_prompt, "gpt-3.5-turbo-0125", 1);
        $text = $response['choices'][0]['message']['content'];

        return response()->json(['data' => $text]);
    }

    /**
     * Correcting grammar in the title using GPT
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function grammar_edit(Request $request)
    {
        $prompt = $request->text;

        $system_prompt = "Твоя задача исправление ошибок в заголовке объявления. Ты не должен добавлять ничего нового. Твоя цель лишь исправить ошибки, а так же если первое слово начинается с маленькой буквы исправить это. Имей ввиду что товар скорее всего для людей с ограниченными возможностями. Если слово не соответствует русскому или английскому языку, значит оно на казахском и исправь ошибку в соответствии с грамматикой казахского языка";
        $response = $this->gpt_request($prompt, $system_prompt, "gpt-3.5-turbo-0125", 1);
        $text = $response['choices'][0]['message']['content'];

        return response()->json(['data' => $text]);
    }

    /**
     * Recommend ads base on favorites with GPT
     *
     * @param Request $request
     * @return View
     */
    public function recommendation(Request $request)
    {
        $ads_format = $this->actual_ads();

        //Get favorites of auth user
        $favorites = auth()->user()->favorite_ads()->get();
        $favorites_format = "";
        foreach ($favorites as $favorite){
            $favorites_format .= $favorite->id."-".$favorite->title."|";
        }

        //Make prompt
        $prompt = "Список пользователя: $favorites_format Список товаров: $ads_format";
        $system_prompt = "Задача: рекомендовать объявления на основе списка товаров и списка пользователей. Необходимо выбрать товары из списка товаров, которые:
а. Не присутствуют в списке пользователя.
б. Похожи по смыслу на товары из списка пользователя.
в. Похожи по названию на товары из списка пользователя (на русском и казахском).
г. Один товар создан для другого.
д. Если один товар создан для другого, но это понятно только из контекста.
Рекомендации выводятся в формате id, разделенные '-'. Ты не можешь использовать текст, твой вывод этого числовые id разделенные символом '-'";

        $response = $this->gpt_request($prompt, $system_prompt, "gpt-4-0125-preview", 0.5);
        //Get ads from answer
        $ids = explode("-", $response['choices'][0]['message']['content']);
        $ads_from_gpt = Ad::whereIn("id", $ids)->get();

        //Pass it to view
        $context = [
            "ads" => $ads_from_gpt
        ];
        return view("searched", $context);
    }
}

