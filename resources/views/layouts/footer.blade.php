<!-- Футер -->
<footer class="h-80 bg-sky-800 p-12">
  <div class="max-w-screen-xl mx-auto flex flex-col h-full md:flex-row justify-between space-y-6 md:space-y-0">
    <div class="flex items-start">
      <div class="flex items-center space-x-3">
        <img src="{{ asset('img/sait/hospital.svg') }}" alt="Apteka24 Logo" class="w-10 sm:hidden lg:block">
        <span class="text-xl font-bold text-white">Apteka24</span>
      </div>
    </div>
    <div class="text-white space-y-4 text-center md:text-left">
      <p class="text-lg font-semibold">Навигация</p>
      <div>
        <a href="{{ route('index') }}">
          <p>Главная</p>
        </a>
      </div>
      <div>
        <a href="{{ route('search') }}">
          <p>Купить по категориям</p>
        </a>
      </div>
      <div><a href="{{ route('search') }}">
          <p>Купить по брендам</p>
        </a>
      </div>

    </div>
    <div class="text-white space-y-4 text-center md:text-left">
      <p class="text-lg font-semibold">Контакты</p>
      <p>Иркутск</p>
      <p>Ленина 5А</p>
      <p>Email: email@gmail.com</p>
    </div>
  </div>
</footer>