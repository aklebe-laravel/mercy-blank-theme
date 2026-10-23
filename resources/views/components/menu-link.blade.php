@props(['item', 'baseClasses'])

@php
    $hasUrl = !empty($item->url) && $item->url !== '#';
@endphp

@if($hasUrl)
    <a href="{{ $item->url }}" {{ $attributes->merge(['class' => $baseClasses]) }}>
        {{ $slot }}
    </a>
@else
    <span {{ $attributes->merge(['class' => $baseClasses]) }}>
        {{ $slot }}
    </span>
@endif
