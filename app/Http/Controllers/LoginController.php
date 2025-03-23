<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class LoginController extends Controller
{
    /**
     * Показать форму входа
     */
    public function login()
    {
        return view('login', ['user' => Auth::user()]);
    }

    /**
     * Аутентификация пользователя
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            
            $request->session()->regenerate();
            
            return redirect()->intended('/login');
        }
        return back()->withErrors([
            'error' => 'Предоставленные учетные данные не соответствуют нашим записям.',
        ])->onlyInput('email','password');
    }

    /**
     * Выход из системы
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('login');
    }
}
