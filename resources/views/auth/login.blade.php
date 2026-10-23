@php
    use Modules\SystemBase\app\Services\ModuleService;
    use Modules\TelegramApi\app\Services\TelegramApiService;
    use Modules\TelegramApi\app\Services\TelegramService;

    $publicPortal = config('website-base.module_website_public', false);

    /** @var ModuleService $moduleService */
    $moduleService = app(ModuleService::class);
    $_telegramBot = null;
    if ($moduleTelegramExists = $moduleService->moduleExists('TelegramApi')) {
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
        <div class="card dt-edit-form editable pt-5 pb-2">
            <div class="telegram-login">
                <script async src="https://telegram.org/js/telegram-widget.js?22"
                        data-telegram-login="{{ $_telegramBot }}"
                        data-size="large" data-onauth="onTelegramAuth(user)" data-request-access="write"></script>
                <script type="text/javascript">
                    function onTelegramAuth(user) {

                        // alert('Logged in as ' + user.first_name + ' ' + user.last_name + ' (' + user.id + (user.username ? ', @' + user.username : '') + ')');
                        let loadingOverlay = document.querySelector(".loading-overlay-default");
                        loadingOverlay.classList.remove("hidden");

                        fetch(`{{ route('telegram-api.login') }}`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                // 'Content-Type': 'multipart/form-data',
                                'X-CSRF-TOKEN': document.head.querySelector('meta[name=csrf-token]').content
                            },
                            body: JSON.stringify({'user': user})
                        })
                            .then(response => {
                                response.json()
                            })
                            .then(response => {
                                window.location.replace("{{ route('home') }}");
                            })
                            .catch(function (err) {
                                loadingOverlay.classList.add("hidden");
                            });


                    }
                </script>
            </div>
            <div class="p-4 text-center">
                <a class="link-offset-2 link-underline link-underline-opacity-0" data-bs-toggle="collapse"
                   href="#collapseTelegramDetails" role="button"
                   aria-expanded="false" aria-controls="collapseTelegramDetails">
                    {{ __('More details') }}
                    <x-lucide-chevron-down class="h-5 w-5"/>
                </a>
                <div class="collapse text-start mt-4" id="collapseTelegramDetails">
                    <p>
                        {{ __("telegram_connect_info") }}
                    </p>
                    <p class="alert alert-warning">
                        {{ __("telegram_account_warning") }}
                    </p>
                    <p class="decent">
                        {{ __("telegram_privacy_data_info") }}
                    </p>
                </div>
            </div>
        </div>
    @endif

</x-auth-card>
