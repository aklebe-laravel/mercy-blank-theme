@php
    use Modules\WebsiteBase\app\View\Components\Menu\Main;

    /**
     * Main navigation: desktop bar with nested dropdowns (lg and up) and a mobile slide-over.
     * Nested levels are rendered by the partials in components/menu/partials.
     *
     * @var array $navTree
     */
@endphp

<div x-data="{ mobileOpen: false }" class="relative antialiased">
    <nav class="sticky top-0 z-40 transition-colors">
        <div class="w-full mx-auto px-4 h-16 flex items-center justify-between">

            <a href="{{ route('home') }}" class="shrink-0 focus:outline-none btn btn-link">
                <div class="my-auto w-70">
                    <span class="text-secondary-900">Mercy Blank</span> - <span class="text-sm text-muted-600">Mercy Blank Project</span>
                </div>
            </a>

            {{-- Desktop --}}
            <div class="hidden lg:flex items-center gap-6">
                @foreach($navTree as $navItem)
                    @php
                        $item = (object) $navItem;
                        $children = collect($item->children ?? []);
                        $hasChildren = $children->isNotEmpty();

                        $isItemActive = $item->active ?? false;
                        $isDeepActive = $isItemActive || Main::hasActiveDescendant($item);

                        $baseClasses = \Illuminate\Support\Arr::toCssClasses([
                            'flex items-center gap-2 text-sm font-bold py-2 transition-colors focus:outline-none group relative',
                            'text-secondary-600' => $isDeepActive,
                            'text-surface-700 hover:text-secondary-500' => !$isDeepActive,
                        ]);
                    @endphp

                    <div x-data="{ open: false }"
                         class="relative"
                         @mouseenter="open = true"
                         @mouseleave="open = false">

                        <x-menu-link :item="$item" :base-classes="$baseClasses" x-ref="anchor">
                            @if($icon = $item->attributes['icon_class'] ?? null)
                                <x-dynamic-component
                                        :component="'lucide-'.$icon"
                                        class="w-5 h-5 transition-colors"
                                        x-bind:class="(open || {{ $isDeepActive ? 'true' : 'false' }}) ? 'text-secondary-500' : 'text-surface-400'"
                                />
                            @endif

                            <span>{{ $item->title }}</span>

                            @if($hasChildren)
                                <x-lucide-chevron-down
                                        class="w-4 h-4 transition-transform duration-200"
                                        x-bind:class="open ? 'rotate-180 text-secondary-500' : 'text-surface-400'"
                                />
                            @endif

                            @if($isDeepActive)
                                <span class="absolute -bottom-1 left-0 w-full h-0.5 bg-secondary-500 rounded-full"></span>
                            @endif
                        </x-menu-link>

                        @if($hasChildren)
                            {{-- Bridge to close the gap for the mouse cursor --}}
                            <div x-show="open" class="absolute h-3 w-full top-full bg-transparent z-40"></div>

                            <div x-show="open"
                                 x-anchor.bottom-start.offset.8="$refs.anchor"
                                 x-transition:enter="transition ease-out duration-150"
                                 x-transition:enter-start="opacity-0 scale-95"
                                 x-transition:enter-end="opacity-100 scale-100"
                                 x-cloak
                                 @mouseenter="open = true"
                                 class="absolute z-100 min-w-60 rounded-xl border border-surface-200 bg-surface-50 shadow-xl py-2">
                                @include('components.menu.partials.desktop-dropdown-item', ['items' => $children])
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>

            {{-- Mobile trigger --}}
            <div class="lg:hidden">
                <button type="button" @click="mobileOpen = true" class="p-2 rounded-lg text-surface-600 hover:bg-surface-100 transition focus:outline-none">
                    <x-lucide-menu class="w-6 h-6"/>
                </button>
            </div>
        </div>
    </nav>

    {{-- Mobile slide-over --}}
    <div x-show="mobileOpen" x-cloak class="fixed inset-0 z-100">
        <div x-show="mobileOpen" x-transition.opacity @click="mobileOpen = false" class="absolute inset-0 bg-surface-950/60 backdrop-blur-md"></div>
        <div x-show="mobileOpen"
             x-transition:enter="transition duration-300 transform"
             x-transition:enter-start="translate-x-full"
             x-transition:enter-end="translate-x-0"
             x-transition:leave="transition duration-200 transform"
             x-transition:leave-start="translate-x-0"
             x-transition:leave-end="translate-x-full"
             class="absolute inset-y-0 right-0 w-full max-w-xs bg-surface-50 shadow-2xl flex flex-col">

            <div class="flex justify-between items-center px-6 h-16 border-b border-surface-200">
                <span class="font-bold text-surface-800 tracking-wider text-sm uppercase">Navigation</span>
                <button type="button" @click="mobileOpen = false" class="p-2 text-surface-500 hover:bg-surface-100 rounded-full transition focus:outline-none">
                    <x-lucide-x class="w-6 h-6"/>
                </button>
            </div>

            <nav class="flex-1 overflow-y-auto p-6 space-y-1 pb-[env(safe-area-inset-bottom)]">
                @include('components.menu.partials.mobile-nav-item', ['items' => $navTree, 'depth' => 0])
            </nav>
        </div>
    </div>
</div>
