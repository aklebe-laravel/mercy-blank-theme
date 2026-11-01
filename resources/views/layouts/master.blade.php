@php
    use Illuminate\Support\Facades\App;
    use Illuminate\Support\Facades\Auth;

    $_currentLocale = App::currentLocale();
    // English is always included as fallback for keys missing in the current locale
    $_trans = json_encode($_currentLocale === 'en'
        ? app('system_base')->getTranslations()
        : app('system_base')->getTranslations(['en', $_currentLocale]));
@endphp<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', $_currentLocale) }}" x-data="tallstackui_darkTheme()" x-bind:class="{ 'dark': darkTheme }">
    <head>
        <script>
            // New visitors follow the OS setting; afterwards TallStackUI's own key ("dark-theme") decides
            if (localStorage.getItem('dark-theme') === null) {
                localStorage.setItem('dark-theme', window.matchMedia('(prefers-color-scheme: dark)').matches ? 'true' : 'false');
            }

            // Set the class before first paint to avoid a light flash
            if (localStorage.getItem('dark-theme') === 'true') {
                document.documentElement.classList.add('dark');
            }
        </script>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title') - {{ config('app.name', 'Laravel') }}</title>
        <link rel="icon" href="{{ theme_asset('images/no_image_available.webp') }}">
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
            var currentUser = {!! Auth::check() ? json_encode(app('website_base_settings')->currentUser()) : '{}' !!};
        </script>

        {{-- TallStackUI script must be loaded right before the Vite assets --}}
        <tallstackui:script/>

        @vite(['resources/css/app.css', 'resources/js/app.js'], 'build')
    </head>

    <body class="px-2">

        <div class="min-h-screen {{ session()->has('admin_user_id') ? 'bg-red-500' : '' }}"
             x-data="new websiteBase.Website()"
             x-init="start()"
        >
            @include('components.message-box')

            @if (isset($header))
                <header class="my-4 flex bg-surface-100">
                    <div class="py-2 px-4 flex-1">
                        <x-website-base::menu-main/>
                    </div>

                    <div class="text-end p-4">
                        <x-theme-switch/>
                    </div>

                </header>
            @endif

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
