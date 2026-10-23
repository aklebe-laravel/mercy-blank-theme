@php
    $publicPortal = config('website-base.module_website_public', false);
@endphp
<x-auth-card>
    @include('auth.inc.header')

    @if (!$publicPortal)
        <div class="title">
            {{ __("register_info") }}
        </div>
    @endif

    <div x-init="document.getElementById('name').focus();">
        <livewire:website-base::form.auth-register :isFormOpen="true" wire:key="register-form" />
    </div>

</x-auth-card>