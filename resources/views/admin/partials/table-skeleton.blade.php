@php
    $cols = $cols ?? 4;
    $widths = [
        ['w-3/4', 'w-24', 'w-20', 'w-24', 'w-24'],
        ['w-2/3', 'w-28', 'w-24', 'w-24', 'w-20'],
        ['w-4/5', 'w-24', 'w-20', 'w-28', 'w-24'],
        ['w-1/2', 'w-28', 'w-24', 'w-20', 'w-24'],
    ];
@endphp

@for ($r = 0; $r < 4; $r++)
    <tr class="skeleton-row">
        @for ($c = 0; $c < $cols; $c++)
            <td class="py-4 {{ $c === $cols - 1 ? 'text-right' : '' }}">
                <div class="skeleton skeleton-shimmer h-3.5 {{ $widths[$r][$c] ?? 'w-24' }} {{ $c === $cols - 1 ? 'ml-auto' : '' }}"></div>
            </td>
        @endfor
    </tr>
@endfor
