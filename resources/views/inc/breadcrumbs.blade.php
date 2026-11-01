@php
    $navigation = app('website_base_settings')->getNavigation();
    if (!($current = $navigation->current())) {
        return;
    }
    $sisters = app('website_base_settings')->getNavigationSisters($current['url']);
    $breadCrumbs = $navigation->breadcrumbs();
    $sistersCounter = 0;
@endphp
<div class="w-full">
    <div class="hidden md:block">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                @foreach ($breadCrumbs as $item)
                    @php($active = ($item['url'] == $current['url']))
                    <li @class(['breadcrumb-item', 'active' => $active]) @if($active) aria-current="page" @endif>
                        @if ($active)
                            <span>{{ __($item['title']) }}</span>
                        @else
                            <a href="{{ $item['url'] }}">{{ __($item['title']) }}</a>
                        @endif
                    </li>
                @endforeach
            </ol>
        </nav>
    </div>

    {{-- The current page is one of the sisters, so there is only something to show with more than one --}}
    @if(count($sisters) > 1)

        <div class="hidden md:block">
            <x-lucide-ellipsis-vertical class="h-5 w-5"/>
        </div>

        <div class="hidden md:block">
            <nav aria-label="{{ __('Related pages') }}">
                <ol class="breadcrumb">
                    @foreach ($sisters as $item)
                        @if ($item['url'] && $item['url'] != $current['url'])
                            <li>
                                @if($sistersCounter++ > 0)
                                    <x-lucide-ellipsis-vertical class="h-5 w-5"/>
                                @endif
                                <a href="{{ $item['url'] }}">{{ __($item['title']) }}</a>
                            </li>
                        @endif
                    @endforeach
                </ol>
            </nav>
        </div>

    @endif
</div>
