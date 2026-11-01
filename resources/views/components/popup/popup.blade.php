@props([
    'title' => null,
    'content' => null,
    'componentView' => null,
    'customData' => [],
    'stableId' => null, // pass a stable unique key (e.g. the VM id), see below
])

@php
    // Fallback only: without a stable id the popover is re-created whenever class or title change
    $id = $stableId ?: 'pop_' . md5($attributes->get('class') . $title);
@endphp

{{-- No max-lg:hidden needed: popoverHandler already hides it on small screens --}}
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
