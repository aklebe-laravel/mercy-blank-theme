@php
    use Modules\SystemBase\app\Http\Livewire\Pagination;

    /**
     * @var Pagination $this
     */
    $lucideIcon = ($icon ?? null) ? "lucide-{$icon}" : '';
@endphp
<li class="">
    <button class="btn p-0 w-9 h-9 flex items-center justify-center {{ ($active ?? false) ? 'text-accent-500' : 'text-primary-500' }} bg-surface-200 border border-1 border-surface-300 rounded-none hover:bg-surface-300 hover:text-heading font-medium rounded-s-base text-sm focus:outline-none disabled:bg-surface-100 disabled:border-surface-200 disabled:text-muted-300 {{ $class ?? '' }}"
            @if ($disabled ?? false) disabled="disabled" @endif
            @unless(empty($link))
                @if ($this->pageLink) onclick="window.location.href='{{ sprintf($this->pageLink, $link) }}'" @endif
                @if ($this->pageLinkWire) wire:click="{{ sprintf($this->pageLinkWire, $link) }}" @endif
            @endunless
            aria-label="Start">
        @if ($lucideIcon)
            <span aria-hidden="true">
            <x-dynamic-component :component="$lucideIcon" class="h-5 w-5"/>
        </span>
        @endif
        @if ($label ?? null)
            {{ $label }}
        @endif
    </button>
</li>