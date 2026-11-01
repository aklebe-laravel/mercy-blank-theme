@php
    use Modules\SystemBase\app\Services\ModuleService;
    use Modules\TelegramApi\app\Services\TelegramApiService;
    use Modules\TelegramApi\app\Services\TelegramService;

    /** @var ModuleService $moduleService */
    $moduleService = app(ModuleService::class);
    $_telegramBot = null;
    if ($moduleService->moduleExists('TelegramApi')) {
        $telegramApiService = app(TelegramApiService::class);
        /** @var TelegramService $telegramService */
        $telegramService = app(TelegramService::class);
        $_telegramBot = $telegramApiService->getDefaultBotName();
    }
@endphp
<x-auth-card>
    @include('auth.inc.header')

    <div x-init="document.getElementById('email').focus();">
        <livewire:website-base::form.auth-login :formObjectId="0" :isFormOpen="true" wire:key="login-form" />
    </div>

    @if ($_telegramBot && $telegramService->isTelegramEnabled())
        <div class="dt-edit-form editable pt-5 pb-2">
            <div class="telegram-login">
                <script async src="https://telegram.org/js/telegram-widget.js?22"
                        data-telegram-login="{{ $_telegramBot }}"
                        data-size="large" data-onauth="onTelegramAuth(user)" data-request-access="write"></script>
                <script>
                    // Called by the Telegram widget after the user confirmed the login
                    function onTelegramAuth(user) {
                        const loadingOverlay = document.querySelector('.loading-overlay-default');
                        loadingOverlay?.classList.remove('hidden');

                        fetch(@js(route('telegram-api.login')), {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.head.querySelector('meta[name=csrf-token]').content
                            },
                            body: JSON.stringify({user})
                        })
                            .then(response => {
                                if (!response.ok) {
                                    throw new Error(`Telegram login failed (${response.status})`);
                                }
                                window.location.replace(@js(route('home')));
                            })
                            .catch(() => loadingOverlay?.classList.add('hidden'));
                    }
                </script>
            </div>
            <div class="p-4 text-center" x-data="{ open: false }">
                <button type="button" class="btn-link inline-flex items-center gap-1"
                        x-on:click="open = !open" x-bind:aria-expanded="open" aria-controls="telegram-details">
                    {{ __('More details') }}
                    <x-lucide-chevron-down class="h-5 w-5 transition-transform" x-bind:class="open && 'rotate-180'"/>
                </button>
                <div class="text-start mt-4" id="telegram-details" x-show="open" x-collapse x-cloak>
                    <p>
                        {{ __('telegram_connect_info') }}
                    </p>
                    <p class="alert alert-warning">
                        {{ __('telegram_account_warning') }}
                    </p>
                    <p class="text-sm text-muted-500">
                        {{ __('telegram_privacy_data_info') }}
                    </p>
                </div>
            </div>
        </div>
    @endif
</x-auth-card>
