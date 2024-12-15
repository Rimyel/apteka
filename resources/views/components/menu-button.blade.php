<button 
    id="{{ $buttonId }}" 
    class="menu-button h-16 px-4 border-l-2 flex rounded-r-lg items-center space-x-3 bg-white transition duration-300 ease-in-out hover:bg-sky-50 hover:border-sky-300 hover:opacity-90 hover:scale-105"
    onclick="{{"handleButtonClick('$buttonId', '$functionName')" }}">
    <img src="{{ asset($icon) }}" class="w-5">
    <p>{{ $label }}</p>
</button>