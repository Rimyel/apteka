<button {{ $attributes->merge(['type' => 'submit', 'class' => 'justify-start hover:bg-sky-300 bg-sky-400 p-2 text-white rounded-md disabled:opacity-25 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
