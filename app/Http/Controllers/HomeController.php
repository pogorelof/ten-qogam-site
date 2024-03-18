<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $context = [
            'categories' => Category::get(),
            'ads' => Ad::latest()->limit(6)->get(),
        ];
        return view('index', $context);
    }
}
