<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight text-danger">
            {{ __('Access denied') }}
        </h1>
    </x-slot>

    <div class="page">
        <div class="description">
            <div class="chapter">
                <h2 class="text-danger">{{ __('Access denied') }}</h2>
                <p>
                    @if(\Illuminate\Support\Facades\Auth::id())
                        Du bist zwar registriert und eingeloggt, hast jedoch scheinbar noch nicht die
                        notwendigen Berechtigungen um die Seite zu betrachten.
                    @else
                        Du bist nicht eingeloggt und kann die gewünschte Aktion nicht durchführen.
                    @endif
                </p>
                <p>
                    Möglicherweise ist dies beabsichtigt. Eventuell liegt aber nur ein Missverständnis vor.
                    Solltest du letzteres für wahrscheinlicher halten, dann kontaktiere bitte unser Support-Team.
                </p>
            </div>
        </div>
    </div>
</x-app-layout>

