{!! Theme::partial('page-intro', ['title' => $page->name]) !!}
<section class="home-section blog-post page-section">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-3 page-sidebar">
                {!! Theme::partial('sidebar') !!}
            </div>
            <div class="col-12 col-lg-9 page-content mb-3">
                {!! apply_filters(PAGE_FILTER_FRONT_PAGE_CONTENT, $page->content, $page) !!}
            </div>
        </div>
    </div>
</section>
