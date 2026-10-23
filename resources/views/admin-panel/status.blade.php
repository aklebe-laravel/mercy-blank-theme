@php
    $relevantUserId = Auth::id();
    $livewireTable = 'website-base::data-table.key-value';
    $modelName = 'CoreConfig';
    $formObjectId = null;
    $isFormOpen = false;
    $objectInstanceDefaultValues = [
        'user_id' => $relevantUserId,
    ];

    $remainingCount = '-';
    if ($maxAttempts = (int)app('website_base_config')->getValue('email.rate-limiter.max', 0)) {
        $remainingCount = RateLimiter::remaining('email-rate-limiter', $maxAttempts);
    }

    $livewireTableOptions=[
        'editable' => false,
        'selectable' => false,
        'hasCommands' => false,
        'keyValueList' => [
                ['key' => 'stage', 'value' => config('app.env')],
                ['key' => 'db connection', 'value' => config('database.default')],
                ['key' => 'database', 'value' => config('database.connections.' . config('database.default') . '.database')],
                ['key' => 'email rate limiter remaining', 'value' => $remainingCount],
        ],
    ];
@endphp
@include('website-base::components.data-tables.tables.dt-simple')