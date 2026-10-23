<x-auth-card>
    @include('auth.inc.header')

    <div class="mb-4 text-sm text-gray-600">
        {{ __('forgot_password_description') }}
    </div>

    <div x-init="document.getElementById('email').focus();">
        <livewire:website-base::form.auth-password-forget :isFormOpen="true" wire:key="forgot-password-form" />
    </div>
</x-auth-card>