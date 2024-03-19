<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\NewUserNotification;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    //TODO: забыл пароль, смена пароля
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
        //TODO:strict validate to prod
        $validated = $request->validate([
            "name" => "required|unique:users,name",
            "email" => "required|email|string|unique:users,email",
            "password" => "required|confirmed",
            "agree" => "required",
            "photo" => "", //TODO:photo required
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'photo_path' => "uploads/user/{$validated['photo']}"
        ]);

        $code = $this->generate_verify_code();
        $user->verification_code()->create(['code'=>$code]);
        $this->send_verify_code($user);

        if($user){
            auth()->login($user);
        }

        return redirect()->route('home');
    }

    public function check_verify(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|max:6|min:6',
        ]);

        $user = auth()->user();
        $verification_code = $user->verification_code->code;
        $input_code = $validated['code'];

        if($verification_code === $input_code){
            $user->email_verified_at = now();
            $user->verification_code->delete();
            return redirect()->route('home');
        }else{
            return redirect()->route('verify')->withErrors(['lose' => 'Неверный код!']);
        }
    }

    //help functions
    protected function generate_verify_code()
    {
        return rand(100000, 999999);
    }
    protected function send_verify_code(User $user)
    {
        $user->notify(new NewUserNotification($user));
    }
}
