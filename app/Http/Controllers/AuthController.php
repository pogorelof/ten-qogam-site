<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\NewUserNotification;
use Illuminate\Http\Request;

/**
 * User authentication and registration controller
 */
class AuthController extends Controller
{
    /**
     * Show login form
     *
     * @return View
     */
    public function login()
    {
        return view("auth.login");
    }

    /**
     * Handle the login form data
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login_submit(Request $request)
    {
        $validated = $request->validate([
            "email" => "required|email|string",
            "password" => "required",
        ]);

        if (
            auth()->attempt([
                "email" => $validated["email"],
                "password" => $validated["password"],
            ])
        ) {
            return redirect()->route("home");
        }
        return redirect()
            ->route("login")
            ->withErrors(["lose" => "Ошибка в данных!"]);
    }

    /**
     * User logout
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        auth()->logout();
        return redirect()->route("home");
    }

    /**
     * Show register form
     *
     * @return View
     */
    public function register()
    {
        return view("auth.register");
    }

    /**
     * Handle the register form data
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register_submit(Request $request)
    {
        //TODO:strict validate to prod
        $validated = $request->validate([
            "name" => "required|unique:users,name",
            "email" => "required|email|string|unique:users,email",
            "password" => "required|confirmed",
            "agree" => "required",
            "photo" => "required",
        ]);

        $user = [
            "name" => $validated["name"],
            "email" => $validated["email"],
            "password" => bcrypt($validated["password"]),
            "photo_path" => "uploads/user/{$validated["photo"]}",
        ];

        if($request['photo']){
            $file = $request->file('photo');
            $file_name = (string) time() . '_'. $file->getClientOriginalName();
            $file->move(public_path('uploads/user'), $file_name);
            $user['photo_path'] = 'uploads/user/' . $file_name;
        }
        $user = User::create($user);

        $code = $this->generate_verify_code();
        $user->verification_code()->create(["code" => $code]);
        $this->send_verify_code($user);

        if ($user) {
            auth()->login($user);
        }

        return redirect()->route("home");
    }

    /**
     * Сhecks if the verification code is correct
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function check_verify(Request $request)
    {
        $validated = $request->validate([
            "code" => "required|max:6|min:6",
        ]);

        $user = auth()->user();
        $verification_code = $user->verification_code->code;
        $input_code = $validated["code"];

        if ($verification_code === $input_code) {
            $user->email_verified_at = now();
            $user->verification_code->delete();
            $user->save();
            return redirect()->route("home");
        } else {
            return redirect()
                ->route("verify")
                ->withErrors(["lose" => "Неверный код!"]);
        }
    }

    //Help functions
    /**
     * Generates a six-digit verification code
     *
     * @return int
     */
    protected function generate_verify_code()
    {
        return rand(100000, 999999);
    }

    /**
     * Send email with verification code
     *
     * @param User $user
     * @return void
     */
    protected function send_verify_code(User $user)
    {
        $user->notify(new NewUserNotification($user));
    }
}
