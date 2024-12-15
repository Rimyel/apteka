<div class="flex items-start ">
  <div class="w-full space-y-4 p-4">
      @foreach ($sections as $section)
      <div class="text-section">
      <div class="text-md font-semibold text-sky-700" id="{{ $section['id'] }}">
        {{ $section['title'] }}
      </div>
      <div class="text-content">
        <textarea class="w-full border-0" placeholder="Введите текст" name="{{ $section['id'] }}"
        id="{{ $section['id'] }}"></textarea>
      </div>

      </div>
    @endforeach
  </div>

  <div class="w-2/5 bg-sky-100 text-sky-600 space-y-4 p-4 sticky top-0">
    @foreach ($sections as $section)
    <a class="hover:font-semibold active:font-semibold" href="#{{ $section['id'] }}">{{ $section['title'] }}</a>
    <hr>
  @endforeach
  </div>
</div>