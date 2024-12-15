<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
use Illuminate\View\View;
use App\Models\User;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(route('account', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/account');
    }
    public function redirecttoyandex()
    {
        return Socialite::driver('yandex')->redirect();
    }

    public function handleYandexCallback()
    {
        $yandexUser = Socialite::driver('yandex')->user(); 
        $registeredUser = User::where('email', $yandexUser->getEmail())->first();


        if (!$registeredUser) {
            $registeredUser = User::firstOrCreate(
                ['email' => $yandexUser->getEmail()],
                [
                    'name' => $yandexUser->getName(),
                    'password' => bcrypt(Str::random(24)), 
                ]
            );
        }

        Auth::login($registeredUser, true); 
        return redirect()->intended('/account'); 
    }
}
