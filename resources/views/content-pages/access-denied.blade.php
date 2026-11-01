<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl leading-tight text-danger-500">
            {{ __('Access denied') }}
        </h1>
    </x-slot>

    <div class="page">
        <div class="description">
            <div class="chapter">
                <h2 class="text-danger-500">{{ __('Access denied') }}</h2>
                <p>
                    @auth
                        {{ __('access_denied_logged_in') }}
                    @else
                        {{ __('access_denied_guest') }}
                    @endauth
                </p>
                <p>
                    {{ __('access_denied_support') }}
                </p>
            </div>
        </div>
    </div>
</x-app-layout>
