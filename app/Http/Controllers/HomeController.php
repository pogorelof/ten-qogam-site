<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\Category;
use App\Models\City;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

/**
 * Controller for handling homepage requests and user profiles
 */
class HomeController extends Controller
{
    /**
     * Show main page
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\View\View
     */
    public function index()
    {
        $context = [
            'categories' => Category::get(),
            'ads' => Ad::latest()->limit(6)->get(),
            'cities' => City::get(),
        ];
        return view('index', $context);
    }

    /**
     * Show the profile of the current user
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\View\View
     */
    public function profile()
    {
        $context = [
          'user' => auth()->user(),
        ];
        return view('my_profile', $context);
    }

    /**
     * Show the profile of the specified user
     *
     * @param User $user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\View\View
     */
    public function user_profile(User $user)
    {
        $context = [
          'user' => $user
        ];
        return view("user_profile", $context);
    }
}
