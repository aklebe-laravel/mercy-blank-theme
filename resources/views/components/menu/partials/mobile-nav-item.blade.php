@php
    use Modules\WebsiteBase\app\View\Components\Menu\Main;
@endphp

@foreach ($items as $navItem)
    @php
        $item = (object) $navItem;
        $children = collect($item->children ?? []);
        $hasChildren = $children->isNotEmpty();

        // Deep activity check (self or children)
        $isItemActive = $item->active ?? false;
        $isDeepActive = $isItemActive || Main::hasActiveDescendant($item);

        $icon = $item->attributes['icon_class'] ?? null;

        // Using explicit secondary shades
        $textColor = $isDeepActive ? 'text-secondary-600 font-bold' : 'text-surface-700 font-semibold';

        $textSize = ($depth === 0 ? 'text-lg' : 'text-base');
        $iconSize = ($depth === 0 ? 'w-5 h-5' : 'w-4 h-4');
        $paddingY = ($depth === 0 ? 'py-3' : 'py-2');

        $baseClasses = "{$textColor} {$textSize} transition-colors flex-1 flex items-center gap-3 focus:outline-none";
    @endphp

    <div x-data="{ subOpen: {{ $isDeepActive ? 'true' : 'false' }} }" class="block w-full">
        <div class="flex items-center justify-between {{ $paddingY }}">

            {{-- Using the editor-safe menu-link component --}}
            <x-menu-link :item="$item" :base-classes="$baseClasses">
                @if($icon)
                    <x-dynamic-component
                            :component="'lucide-' . $icon"
                            class="{{ $iconSize }} transition-colors"
                            x-bind:class="(subOpen || {{ $isDeepActive ? 'true' : 'false' }}) ? 'text-secondary-500' : 'text-surface-400'"
                    />
                @endif

                <span class="truncate">{{ $item->title }}</span>
            </x-menu-link>

            @if($hasChildren)
                <button
                        @click="subOpen = !subOpen"
                        class="p-2 transition-colors focus:outline-none"
                        x-bind:class="subOpen ? 'text-secondary-500' : 'text-surface-400 hover:text-secondary-500'"
                >
                    <svg
                            x-bind:class="subOpen ? 'rotate-180' : ''"
                            class="w-5 h-5 transition-transform duration-200"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                    >
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
            @endif
        </div>

        @if($hasChildren)
            <div
                    x-show="subOpen"
                    x-collapse
                    x-cloak
                    {{-- Secondary-200 for the indicator line if active --}}
                    class="pl-4 border-l-2 ml-2.5 space-y-1 mb-2"
                    x-bind:class="subOpen ? 'border-secondary-200' : 'border-surface-200'"
            >
                @include('components.menu.partials.mobile-nav-item', [
                    'items' => $children,
                    'depth' => $depth + 1
                ])
            </div>
        @endif
    </div>
@endforeach