<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl leading-tight">
            {{ __('Contact') }}
        </h1>
    </x-slot>

    <div class="page">
        <div class="description">
            <div class="chapter">
                <h2>
                    {{ __('Send Request') }}
                </h2>
                <p>
                    {{ __('contact_telegram_hint') }}
                </p>
                <p class="italic text-muted-500">
                    {{ __('contact_username_hint') }}
                </p>
                <div>
                    <div x-init="document.getElementById('content').focus();">
                        <livewire:website-base::form.contact
                                :isFormOpen="true"
                                wire:key="contact"
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
