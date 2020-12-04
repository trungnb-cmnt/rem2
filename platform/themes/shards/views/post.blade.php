<section class="all-post">
    <div class="container py-4">
        <div class="row">
            <div class="py-50 d-none d-lg-block">
                {!! Theme::partial('sidebar') !!}
            </div>
            <div class="col py-50 content">
                {!! $post->content !!}
            </div>
        </div>
    </div>
</section>