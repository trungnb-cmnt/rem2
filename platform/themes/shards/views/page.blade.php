<!-- {!! Theme::partial('page-intro', ['title' => $page->name]) !!} -->
<?php
if (is_plugin_active('about')) {
    $allPost = get_all_post();
}
?>
<section class="home-section about-page page-section">
    <div class="container-fluid">
        <div class="row align-items-center justify-content-center">
            <img src="{{ theme_option('banner-page-about') }}" alt="banner page about">
        </div>
        <div class="row pt-5">
            <?php if (isset($allPost)) : ?>
            <?php foreach ($allPost as $k => $post) : ?>
            <div class="col-md-8 offset-md-2 pb-5">
                <h1 class="text-center mb-4">{{ $post->name }}</h1>
                <div>
                    {!! $post->content !!}
                </div>
            </div>
            <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</section>