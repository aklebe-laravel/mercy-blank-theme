@php
    use Illuminate\Mail\Markdown;
    use Illuminate\Support\Carbon;

    /** @var array $groupedChangelog */
    /** @var int $nearestSeconds */
@endphp
<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl leading-tight">
            {{ __('Changelog') }}
        </h1>
    </x-slot>

    <div class="page">
        <div class="description">
            <h4>
                {{ __('Changelog') }} - {{ __('Adjacent commits grouped within :seconds seconds.', ['seconds' => $nearestSeconds]) }}
            </h4>
        </div>
        <div class="chapter">
            <div class="changelog-markdown">
                @foreach($groupedChangelog as $group)
                    <div class="grid grid-cols-12 gap-4">
                        <div class="col-span-12 text-start bg-surface-100 p-3">
                            {{ Carbon::createFromFormat('Y-m-d H:i:s', $group['created'][count($group['created']) - 1])->diffForHumans() }}
                            @if($group['paths'] ?? null)
                                <span class="text-sm">{{ implode(',', $group['paths']) }}</span>
                            @endif
                            @if($group['authors'] ?? null)
                                <span class="text-sm">({{ implode(',', $group['authors']) }})</span>
                            @endif
                        </div>
                    </div>
                    <div class="grid grid-cols-12 gap-4 mb-5">
                        @if($group['messages_public'] ?? null)
                            <div class="col-span-12 text-start text-success-500 bg-surface-50 p-3">
                                @foreach($group['messages_public'] as $message)
                                    {{ Markdown::parse($message) }}
                                @endforeach
                            </div>
                        @endif
                        @if($group['messages_staff'] ?? null)
                            <div class="col-span-12 text-start text-primary-500 bg-surface-50 p-3">
                                @foreach($group['messages_staff'] as $message)
                                    {{ Markdown::parse($message) }}
                                @endforeach
                            </div>
                        @endif
                        @if($group['messages'] ?? null)
                            <div class="col-span-12 text-start bg-surface-100 p-3 text-sm text-muted-500">
                                @foreach($group['messages'] as $message)
                                    {{ Markdown::parse($message) }}
                                @endforeach
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
