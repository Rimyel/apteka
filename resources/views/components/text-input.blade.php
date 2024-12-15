@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => '
                 h-7 rounded-md w-full outline border-2 border-sky-300  outline-none focus:ring-0']) !!}>
