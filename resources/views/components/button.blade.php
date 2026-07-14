@php

$classes = match($type){

    'primary' => 'bg-blue-500 text-white',

    'success' => 'bg-green-500 text-white',

    'danger' => 'bg-red-500 text-white',

    'warning' => 'bg-yellow-500 text-black',

    default => 'bg-gray-500 text-white'
};

@endphp

<a href="{{ $link }}"
   class="{{ $classes }} px-5 py-2 rounded-lg">

    {{ $icon }}

    {{ $text }}

</a>