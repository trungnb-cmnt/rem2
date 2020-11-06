<section class="breadcrumb-section">
    @foreach (Theme::breadcrumb()->getCrumbs() as $i => $crumb)
        @if ($i != (count(Theme::breadcrumb()->getCrumbs()) - 1))
            <a href="{{ $crumb['url'] }}">{!! $crumb['label'] !!}</a>
            @if ($i != (count(Theme::breadcrumb()->getCrumbs()) - 2))
                <span class="divider">&nbsp;/&nbsp;</span>
            @endif
        @else
            @if (count(Theme::breadcrumb()->getCrumbs()) == 2)
                <span class="divider">&nbsp;/&nbsp;</span>
                <span class="no-link">{!! $crumb['label'] !!}</span>
            @endif
        @endif
    @endforeach
</section>
