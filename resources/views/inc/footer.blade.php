<div class="">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if (!app('system_base')->isEnvGroupProduction())
            <div class="staging-head staging-{{ config('app.env') }}"
                 title="Marked as '{{ config('app.env') }}' environment"></div>
        @endif
    </div>
</div>
