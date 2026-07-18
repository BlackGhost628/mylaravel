@props([
    'padding' => 'p-6',
    'shadow' => 'shadow-md',
    'hover' => false,
])

<div {{ $attributes->merge(['class' => "bg-white rounded-2xl border border-gray-100 {$padding} {$shadow} " . ($hover ? 'hover:shadow-xl transition-all duration-300 hover:-translate-y-1' : '')]) }}>
    {{ $slot }}
</div>