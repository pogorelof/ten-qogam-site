<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $context = [
            'categories' => Category::get(),
            //TODO:articles to context
        ];
        return view('index', $context);
    }
}
