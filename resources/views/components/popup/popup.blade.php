{{-- resources/views/components/popover.blade.php --}}
@props([
    'title' => null,
    'content' => null,
    'componentView' => null,
    'customData' => [],
    'stableId' => null, // CRITICAL: Pass the VM-ID or unique key here
])

@php
    // Fallback if no stableId is provided, but aim for stableId!
    $id = $stableId ?: 'pop_' . md5($attributes->get('class') . $title);
@endphp

<div
        id="{{ $id }}"
        popover="manual"
        x-data="popoverHandler"
        wire:ignore.self
        wire:key="popover-node-{{ $id }}"
        class="popover-box"
>
    <div class="flex flex-col min-w-[180px] max-w-[320px]">
        @if($title)
            <header class="flex items-center gap-2 pb-1.5">
                <div class="w-1.5 h-1.5 rounded-full bg-primary-500 shadow-[0_0_8px_var(--color-primary-500)]"></div>
                <span class="text-[10px] font-black uppercase tracking-widest text-surface-700">
                    {{ $title }}
                </span>
            </header>
        @endif

        <div class="mt-2 text-[11px] text-surface-600 leading-snug font-medium">
            {{ $slot }}
        </div>

        @if($componentView || $content)
            <div class="mt-2 text-[11px] text-surface-500 leading-relaxed italic">
                @if($componentView)
                    {!! view($componentView, ['customData' => $customData])->render() !!}
                @else
                    {!! $content !!}
                @endif
            </div>
        @endif
    </div>
</div>
