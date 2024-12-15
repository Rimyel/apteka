<x-guest-layout>
    <script src="https://yastatic.net/s3/passport-sdk/autofill/v1/sdk-suggest-with-polyfills-latest.js"></script>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="w-11/12 text-left">
        @csrf
        <div>
            <p class="my-4">Логин</p>
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Пароль -->
        <div class=" mb-4">
            <p class="my-4">Пароль</p>
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Нету аккаунта -->
        <div class=" flex flex-wrap items-center  justify-between no-underline mt-4">
            <ul>
                <li>
                    <a class="hover:underline text-sm text-gray-600  rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 "
                        href="{{ route('register') }}">
                        {{ __('Нету аккаунта? Зарегистрируйтесь!') }}
                    </a>
                </li>
                <li>
                <a href="{{ route('yandex.login') }}" class="btn btn-yandex">Войти через Яндекс</a>
                </li>
            </ul>
            <x-secondary-button>
                {{ __('Вход') }}
            </x-secondary-button>
        </div>
    </form>
</x-guest-layout>