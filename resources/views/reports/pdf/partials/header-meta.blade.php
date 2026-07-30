<div class="header-eyebrow">{{ $eyebrow }}</div>
<div class="header-title">{{ $report->getTitle() }}</div>
<div class="header-stamp">
    @if($rtl)
        <span class="ltr">{{ $generatedAt }}</span> {{ $generatedLabel }}:
    @else
        {{ $generatedLabel }}: <span class="ltr">{{ $generatedAt }}</span>
    @endif
</div>
