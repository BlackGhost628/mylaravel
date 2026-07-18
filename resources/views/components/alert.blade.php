@props([
    'type' => 'success', // success, error, warning, info
])

@php
    $colors = [
        'success' => 'bg-green-50 border-green-400 text-green-700',
        'error' => 'bg-red-50 border-red-400 text-red-700',
        'warning' => 'bg-yellow-50 border-yellow-400 text-yellow-700',
        'info' => 'bg-blue-50 border-blue-400 text-blue-700',
    ];
    $icons = [
        'success' => '✅',
        'error' => '❌',
        'warning' => '⚠️',
        'info' => 'ℹ️',
    ];
@endphp

@if(session($type) || $slot->isNotEmpty())
    <div {{ $attributes->merge(['class' => "border-r-4 {$colors[$type]} px-5 py-4 rounded-xl mb-6 flex items-center gap-3"]) }}>
        <span class="text-xl">{{ $icons[$type] }}</span>
        <div class="flex-1">
            {{ $slot }}
            @if(session($type))
                {{ session($type) }}
            @endif
        </div>
    </div>
@endif