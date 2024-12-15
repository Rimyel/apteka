@props(['id', 'label', 'checked' => false])

<label class="dropdown-item select-none space-x-3 h-8 hover:bg-sky-100 px-2 flex w-full items-center">
    <input 
        type="checkbox" 
        class="focus:outline-none focus:ring-0 rounded" 
        id="{{ $id }}" 
        name="{{ str_starts_with($id, 'category_') ? 'categories[]' : 'brands[]' }}" 
        value="{{ str_replace(['category_', 'brand_'], '', $id) }}" 
        {{ $checked ? 'checked' : '' }}
    >
    <label class="w-full block text-sky-900" for="{{ $id }}">{{ $label }}</label>
</label>