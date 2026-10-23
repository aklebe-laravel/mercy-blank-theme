@php
    use Modules\WebsiteBase\app\View\Components\Menu\Main;
@endphp

@foreach($items as $navItem)
    @php
        $item = (object) $navItem;
        $children = collect($item->children ?? []);
        $hasChildren = $children->isNotEmpty();
        $isDeepActive = ($item->active ?? false) || Main::hasActiveDescendant($item);

        $baseClasses = \Illuminate\Support\Arr::toCssClasses([
            'flex items-center justify-between px-4 py-2 text-sm rounded-lg transition-colors focus:outline-none w-full',
            'bg-secondary-50 text-secondary-600 font-semibold' => $isDeepActive,
            'text-surface-700 hover:bg-surface-100 hover:text-secondary-500' => !$isDeepActive
        ]);
    @endphp

    <div x-data="{ open: false }" class="px-2 relative group/sub" @mouseenter="open = true" @mouseleave="open = false">
        <x-menu-link :item="$item" :base-classes="$baseClasses" x-ref="subAnchor">
            <div class="flex items-center gap-3">
                @if($icon = $item->attributes['icon_class'] ?? null)
                    <x-dynamic-component :component="'lucide-'.$icon"
                                         class="w-4 h-4 transition-colors"
                                         x-bind:class="(open || {{ $isDeepActive ? 'true' : 'false' }}) ? 'text-secondary-500' : 'text-surface-400'"
                    />
                @endif
                <span>{{ $item->title }}</span>
            </div>

            @if($hasChildren)
                <x-lucide-chevron-right class="w-4 h-4 transition-colors"
                                        x-bind:class="open ? 'text-secondary-500' : 'text-surface-400'"
                />
            @endif
        </x-menu-link>

        @if($hasChildren)
            {{-- Horizontal bridge for side-flyout --}}
            <div x-show="open" class="absolute w-3 h-full -right-3 top-0 bg-transparent z-40"></div>

            <div x-show="open"
                 x-anchor.right-start.offset.8="$refs.subAnchor"
                 x-transition:enter="transition ease-out duration-150"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 x-cloak
                 @mouseenter="open = true"
                 class="absolute z-100 min-w-[15rem] rounded-xl border border-surface-200 bg-surface-50 shadow-xl py-2">
                @include('components.menu.partials.desktop-dropdown-item', ['items' => $children])
            </div>
        @endif
    </div>
@endforeach