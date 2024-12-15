<div class="flex justify-center">
  <div class="border flex">
    {{-- Первая страница --}}
    @if ($paginator->onFirstPage())
      <span class="p-2 w-12 h-12 text-gray-500 bg-gray-200 cursor-not-allowed flex items-center justify-center">
        <<
      </span>
    @else
      <a href="{{ $paginator->url(1) }}" class="p-2 w-12 h-12 text-sky-400 bg-white hover:border border-sky-400 hover:bg-sky-400 hover:text-white flex items-center justify-center">
        <<
      </a>
    @endif

    {{-- Previous Page Link --}}
    @if ($paginator->onFirstPage())
      <span class="p-2 w-12 h-12 text-gray-500 bg-gray-200 cursor-not-allowed flex items-center justify-center">
        «
      </span>
    @else
      <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
        class="p-2 w-12 h-12 text-sky-400 bg-white hover:border border-sky-400 hover:bg-sky-400 hover:text-white flex items-center justify-center">
        «
      </a>
    @endif

    {{-- Pagination Elements --}}
    @php
        $start = max(1, $paginator->currentPage() - 2);
        $end = min($paginator->lastPage(), $paginator->currentPage() + 2);
    @endphp

    @for ($page = $start; $page <= $end; $page++)
      @if ($page == $paginator->currentPage())
        <span class="p-2 w-12 h-12 text-white bg-sky-400 flex items-center justify-center">
          {{ $page }}
        </span>
      @else
        <a href="{{ $paginator->url($page) }}"
          class="p-2 w-12 h-12 text-sky-400 bg-white hover:border border-sky-400 hover:bg-sky-400 hover:text-white flex items-center justify-center">
          {{ $page }}
        </a>
      @endif
    @endfor

    {{-- Next Page Link --}}
    @if ($paginator->hasMorePages())
      <a href="{{ $paginator->nextPageUrl() }}" rel="next"
        class="p-2 w-12 h-12 text-sky-400 bg-white hover:border border-sky-400 hover:bg-sky-400 hover:text-white flex items-center justify-center">
        »
      </a>
    @else
      <span class="p-2 w-12 h-12 text-gray-500 bg-gray-200 cursor-not-allowed flex items-center justify-center">
        »
      </span>
    @endif

    {{-- Последняя страница --}}
    @if ($paginator->hasMorePages())
      <a href="{{ $paginator->url($paginator->lastPage()) }}" class="p-2 w-12 h-12 text-sky-400 bg-white hover:border border-sky-400 hover:bg-sky-400 hover:text-white flex items-center justify-center">
        >>
      </a>
    @else
      <span class="p-2 w-12 h-12 text-gray-500 bg-gray-200 cursor-not-allowed flex items-center justify-center">
        >>
      </span>
    @endif
  </div>
</div>