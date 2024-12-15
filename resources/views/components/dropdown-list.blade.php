<div class="dropdown-container rounded-lg">
    <div
        class="dropdown-header select-none h-16 hover:text-sky-500 hover:bg-sky-100 transition-colors duration-300 flex items-center justify-center cursor-pointer">
        {{ $header }}
    </div>
    <div class="dropdown-content no-scrollbar-buttons transition-all duration-300 ease-in-out max-h-0 overflow-hidden">
        @foreach($items as $item)
            <x-dropdown-item :id="$item['id']" :label="$item['label']" :checked="$item['checked'] ?? false" />
        @endforeach
    </div>
    <button type="button" class="show-all-button hidden p-2 text-sky-600 hover:text-sky-400 transition-colors duration-300 border-t">
        Показать все
    </button>
    <button type="button"
        class="collapse-button hidden sticky bottom-0 p-2 text-sky-600 hover:text-sky-400 transition-colors duration-300 border-t">
        Свернуть
    </button>
</div>