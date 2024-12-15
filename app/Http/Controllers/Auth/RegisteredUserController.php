<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ], [
            // Сообщения для валидации в имени
            'name.required' => 'Имя обязательно для заполнения.',
            'name.string' => 'Имя должно быть строкой.',
            'name.max' => 'Максимальная длина имени — 50 символов.',
            
            // Сообщения валидации для емайла
            'email.required' => 'Адрес электронной почты обязателен для заполнения.',
            'email.string' => 'Адрес электронной почты должен быть строкой.',
            'email.lowercase' => 'Адрес электронной почты должен быть в нижнем регистре.',
            'email.email' => 'Введите корректный адрес электронной почты.',
            'email.max' => 'Максимальная длина адреса электронной почты — 255 символов.',
            'email.unique' => 'Этот адрес электронной почты уже используется.',

            'password.min' => 'Минимальная длина - 8 символов',
            'password.required' => 'Пароль обязателен для заполнения.',
            'password.confirmed' => 'Пароли не совпадают.',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('account', absolute: false));
    }
}
