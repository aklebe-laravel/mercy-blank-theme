<div class="grid grid-cols-[1fr_auto] gap-x-4 gap-y-1.5 border-t border-surface-200 mt-2 pt-2">
    @foreach($customData as $key => $value)
        @if($value === '')
            <span class="col-span-2">
            </span>
        @elseif(is_array($value))
            @php
                $v = $value['value'] ?? null;
                $style = $value['style'] ?? 'text-surface-500';
            @endphp
            <span @class(["text-[10px] font-medium truncate uppercase tracking-tight text-left", $style])>
                {{ $value['label'] ?? $key }}
            </span>
            <span @class(["text-[11px] font-mono font-bold text-right", $style])>
                {{ $v }}
            </span>
        @else
            <span class="text-[10px] font-medium text-surface-500 truncate uppercase tracking-tight text-left">
                {{ $key }}
            </span>
            <span class="text-[11px] font-mono font-bold text-surface-900 text-right">
                {{ $value }}
            </span>
        @endif
    @endforeach
</div>
