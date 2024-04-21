<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\Category;
use App\Models\City;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $context = [
            'categories' => Category::get(),
            'ads' => Ad::latest()->limit(6)->get(),
            'cities' => City::get(),
        ];
        return view('index', $context);
    }

    public function profile()
    {
        $context = [
          'user' => auth()->user(),
        ];
        return view('my_profile', $context);
    }

    public function user_profile(User $user)
    {
        $context = [
          'user' => $user
        ];
        return view("user_profile", $context);
    }
}
