<table class="grid">
    <tr>
        @if($rtl)
            <td class="end">
                <div class="brand-name">{{ $company }}</div>
                @if($tagline)<div class="brand-tagline">{{ $tagline }}</div>@endif
            </td>
            @if($logo)
                <td class="end" width="60"><img src="{{ $logo }}" class="brand-logo" alt=""></td>
            @endif
        @else
            @if($logo)
                <td class="start" width="60"><img src="{{ $logo }}" class="brand-logo" alt=""></td>
            @endif
            <td class="start">
                <div class="brand-name">{{ $company }}</div>
                @if($tagline)<div class="brand-tagline">{{ $tagline }}</div>@endif
            </td>
        @endif
    </tr>
</table>
