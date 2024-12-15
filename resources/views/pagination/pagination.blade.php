<div class="flex justify-center mt-4 p-2">
  {{-- Первая страница --}}
  @if ($paginator->onFirstPage())
    <span class="p-2 w-8 h-8 text-gray-500 bg-gray-200 rounded-md cursor-not-allowed">
      <div class="flex items-center justify-center h-full"><<</div>
    </span>
  @else
    <a href="{{ $paginator->url(1) }}" class="p-2 w-8 h-8 text-sky-600 bg-white border border-sky-600 rounded-md hover:bg-sky-600 hover:text-white">
      <div class="flex items-center justify-center h-full"><<</div>
    </a>
  @endif

  {{-- Предыдущая страница --}}
  @if ($paginator->onFirstPage())
    <span class="p-2 w-8 h-8 text-gray-500 bg-gray-200 rounded-md cursor-not-allowed">
      <div class="flex items-center justify-center h-full"><</div>
    </span>
  @else
    <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="p-2 w-8 h-8 text-sky-600 bg-white border border-sky-600 rounded-md hover:bg-sky-600 hover:text-white">
      <div class="flex items-center justify-center h-full"><</div>
    </a>
  @endif

  {{-- Номера страниц --}}
  @php
      $start = max(1, $paginator->currentPage() - 3);
      $end = min($paginator->lastPage(), $paginator->currentPage() + 3);
  @endphp

  @for ($page = $start; $page <= $end; $page++)
    @if ($page == $paginator->currentPage())
      <span class="mx-2 p-2 w-8 h-8 text-white bg-sky-600 rounded-md">
        <div class="flex items-center justify-center h-full">{{ $page }}</div>
      </span>
    @else
      <a href="{{ $paginator->url($page) }}" class="mx-2 p-2 w-8 h-8 text-sky-600 bg-white border border-sky-600 rounded-md hover:bg-sky-600 hover:text-white">
        <div class="flex items-center justify-center h-full">{{ $page }}</div>
      </a>
    @endif
  @endfor

  {{-- Следующая страница --}}
  @if ($paginator->hasMorePages())
    <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="p-2 w-8 h-8 text-sky-600 bg-white border border-sky-600 rounded-md hover:bg-sky-600 hover:text-white">
      <div class="flex items-center justify-center h-full">></div>
    </a>
  @else
    <span class="p-2 w-8 h-8 text-gray-500 bg-gray-200 rounded-md cursor-not-allowed">
      <div class="flex items-center justify-center h-full">></div>
    </span>
  @endif

  {{-- Последняя страница --}}
  @if ($paginator->hasMorePages())
    <a href="{{ $paginator->url($paginator->lastPage()) }}" class="p-2 w-8 h-8 text-sky-600 bg-white border border-sky-600 rounded-md hover:bg-sky-600 hover:text-white">
      <div class="flex items-center justify-center h-full">>></div>
    </a>
  @else
    <span class="p-2 w-8 h-8 text-gray-500 bg-gray-200 rounded-md cursor-not-allowed">
      <div class="flex items-center justify-center h-full">>></div>
    </span>
  @endif
</div>
