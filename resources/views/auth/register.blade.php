<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="w-full justify-center flex-wrap flex">
            <div class="text-left w-11/12">
                <p class="my-4">Логин</p>
                <x-text-input type="text" id="name" name="name" :value="old('email')" placeholder="Введите ваше имя" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>
            <div class="text-left w-11/12">
                <p class="my-4">Email</p>
                <x-text-input type="text" id="email" name="email" :value="old('email')"
                    placeholder="Введите ваше Email" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
            <div class="text-left w-11/12">
                <p class="my-4">Пароль</p>
                <x-text-input type="password" id="password" name="password" required autocomplete="new-password"
                    placeholder="Введите ваш пароль" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
            <div class="text-left w-11/12">
                <p class="my-4">Подтверждение пароля</p>
                <x-text-input type="password" id="password_confirmation" name="password_confirmation" required
                    autocomplete="new-password" placeholder="Введите ваш пароль" class="mb-4" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>
            <x-secondary-button>
                {{ __('Зарегистрироваться') }}
            </x-secondary-button>

        </div>
    </form>
</x-guest-layout>