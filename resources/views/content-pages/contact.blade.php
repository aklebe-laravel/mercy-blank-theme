<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
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
                    Wenn du Zugang zu unseren Telegram-Gruppen hast, dann versuche bitte uns
                    dort zu konsultieren. Andernfalls kannst du dieses Formular nutzen:
                </p>
                <p class="fst-italic text-muted">
                    (dein Benutzername wird automatisch dieser Nachricht zugeordnet)
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
