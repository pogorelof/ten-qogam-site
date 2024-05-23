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
        $system_prompt = "Ты выполняешь роль поисковика.
        Ты получаешь запрос пользователя и актуальный список товаров в виде id-name. Разные товары разделены “|”.
        Твоя задача найти ID всех товаров подходящих запросу пользователя. Вывести только номера id разделенные '-'. Если ты выведешь все подходящие товары, получишь чаевые 200 долларов";

        $response = $this->gpt_request($prompt, $system_prompt, "gpt-4o", 0.3);

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

        $system_prompt = "Твоя роль - редактор на сайте объявлений.
        Твоя задача - редактирование и украшение текстов.
Тебе на вход придет сообщение с описанием какого-либо объявления. Тебе нужно будет красиво его отредактировать и дописать текст так, чтобы все это выглядело лаконично, красиво и структурированно. Не нужно писать про цену, контакты и город. Так же при присутствии ошибок их нужно исправить. Структурируй текст через '-' если это будет уместно
В тексте не используются никакие специальные редакторы типа markdown.
Если запрос пришел на казахском языке, ты должен составить описание на казахском языке";
        $response = $this->gpt_request($prompt, $system_prompt, "gpt-4o", 1);
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
            $favorites_format .= $favorite->id."-".$favorite->title.",";
        }

        //Make prompt
        $prompt = "Список пользователя: $favorites_format Список товаров: $ads_format";
        $system_prompt = "
        Роль: Советник по товарам
        Задача: Рекомендовать товары на основе списка избранного пользователя и списка доступных товаров.

        Инструкции:

        1)Анализ: Проанализируй список избранного пользователя, чтобы понять его предпочтения.
        2)Рекомендации: Рекомендуй подходящие или сопутствующие товары из списка доступных товаров.
        3)Рациональность: Если не удается рационально объединить товары из списка, не рекомендовать их.
        4)Формат вывода: Рекомендации выводятся в формате id, разделенные дефисом ('-').
        Пример:
        Список пользователя: 1-ball,2-car
        Список товаров: 1-ball,2-car,3-garage,4-service,5-toy
        Рекомендации: 3-4
        Награда:
        Если рекомендации будут качественными и соответствующими предпочтениям пользователя, ты получишь чаевые в размере 200 долларов.
        ";

        $response = $this->gpt_request($prompt, $system_prompt, "gpt-4o", 0.5);
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

