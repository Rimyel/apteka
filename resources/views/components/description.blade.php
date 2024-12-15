<div class="flex items-start relative">
  <div class="w-full space-y-4 p-4">
    @foreach ($sections as $section)
    @if (!empty($section['content']) && !empty($section['title']))
    <!-- Проверяем наличие всех параметров -->
    <div class="text-section">
      <div class="text-md font-semibold text-sky-700" id="{{ $section['id'] }}">
      {{ $section['title'] }}
      </div>
      <div class="text-content">
      {{ $section['content'] }}
      </div>
      <button class="toggle-button mt-2 text-blue-500 hover:underline">Развернуть текст</button>
    </div>
  @endif
  @endforeach
  </div>

  <div class="w-2/5 bg-sky-100 text-sky-600 space-y-4 p-4 sticky top-0">
    @foreach ($sections as $section)
    @if (!empty($section['content']) && !empty($section['title']))
    <!-- Проверяем наличие всех параметров -->
    <a class="hover:font-semibold active:font-semibold" href="#{{ $section['id'] }}">{{ $section['title'] }}</a>
    <hr>
  @endif
  @endforeach
  </div>
</div>