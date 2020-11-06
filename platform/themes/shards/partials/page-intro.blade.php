<section class="page-intro">
    <div class="container">
        @if (!empty($title))
            <h1 class="title mt-3 mt-lg-4">{{ $title }}</h1>
        @endif
        {!! Theme::partial('breadcrumb') !!}
    </div>
</section>
