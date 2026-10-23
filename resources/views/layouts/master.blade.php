@php

    use Modules\SystemBase\app\Services\ThemeService;
    use Modules\WebsiteBase\app\Services\WebsiteService;

    /** @var WebsiteService $websiteService */
    $websiteService = app(WebsiteService::class);

    $isStoreVisibleForUser = $websiteService->isStoreVisibleForUser();

    $_currentLocale = \Illuminate\Support\Facades\App::currentLocale();
    if ($_currentLocale === 'en') {
        $_trans = json_encode(app('system_base')->getTranslations());
    } else {
        $_trans = json_encode(app('system_base')->getTranslations(['en', $_currentLocale]));
    }

    // @todo: or do just the current locale by:
    // $_trans = json_encode(app('system_base')->getTranslations([$_currentLocale]));

@endphp<!DOCTYPE html>
<html x-data="tallstackui_darkTheme()" x-bind:class="{ 'dark': darkTheme }">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title') - {{ config('app.name', 'Laravel') }}</title>
        <link rel="icon" href="{{ theme_asset('images/no_image_available.png') }}">
        <style>
            [x-cloak] {
                display: none !important;
            }
        </style>

        <script>
            document.addEventListener('livewire:init', () => {
                window.onerror = (message, source, lineno, colno, error) => {
                    Livewire.dispatch('browser-error-detected', {
                        error: {message, source, lineno, stack: error?.stack}
                    });
                };
            });

            // check if user switched to dark mode
            if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
            window.laravelConfig = {
                reverb: {
                    key: "{{ config('broadcasting.connections.reverb.key') }}",
                    host: "{{ config('broadcasting.connections.reverb.options.host') }}",
                    port: "{{ config('broadcasting.connections.reverb.options.port') }}",
                    scheme: "{{ config('broadcasting.connections.reverb.options.scheme') }}"
                }
            };
            var appData = {!! app('php_to_js')->toJson() !!};
            var translations = {!! $_trans !!};
            var currentLocale = '{{ $_currentLocale }}';
            var messageBoxConfig = {!! json_encode(config('message-boxes')) !!};
            var currentUser = {!! \Illuminate\Support\Facades\Auth::check() ? json_encode(app('website_base_settings')->currentUser()) : '{}' !!};
        </script>

        <!-- 2. TallStackUI Skript (MUSS direkt vor Vite stehen) -->
        <tallstackui:script/>

        <!-- 3. Vite Assets -->
        @vite(['resources/css/app.css', 'resources/js/app.js'], 'build')
    </head>

    <body class="px-2">

        <div class="min-h-screen {{ session()->has('admin_user_id') ? 'bg-red-500' : '' }}"
             x-data="new websiteBase.Website()"
             x-init="start()"
        >
            @include('components.message-box')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="my-4 flex bg-surface-100">
                    <div class="py-2 px-4 flex-1">
                        {{--                        {{ $header }}--}}
                        <x-website-base::menu-main/>
                    </div>

                    <div class="text-end p-4">
                        <x-theme-switch/>
                    </div>

                </header>
            @endif

            <!-- Page Content -->
            <main>
                @if($randomQuote ?? null)
                    <div class="my-2 messages">
                        <div class="message border rounded-3 font-semibold alert text-primary-900/50 bg-surface-200">
                            <span>{{ $randomQuote->content }}</span> <span class="my-auto italic text-sm text-muted-400">({{ $randomQuote->author }})</span>
                        </div>
                    </div>
                @endif

                {{ $slot }}
            </main>


            @include('inc.footer')
        </div>
        <livewire:website-base::global-error-handler/>

        @livewireScripts
    </body>
</html>
