<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function login_submit(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|string',
            'password' => 'required'
        ]);

        if(auth()->attempt(['email'=>$validated['email'], 'password'=>$validated['password']])){
            return redirect()->route('home');
        }
        return redirect()->route('login_form')->withErrors(['lose'=>'Ошибка в данных!']);
    }

    public function logout()
    {

        auth()->logout();
        return redirect()->route('home');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function register_submit(Request $request)
    {
        $validated = $request->validate([
            "name" => "required|unique:users,name",
            "email" => "required|email|string|unique:users,email",
            "password" => "required|confirmed",
            "agree" => "required",
            "photo" => "required",
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'photo_path' => "uploads/user/{$validated['photo']}"
        ]);

        if($user){
            auth()->login($user);
        }

        return redirect()->route('home');
    }
}
