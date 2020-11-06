<?php if (!empty($config['gallery_id'])) $banners = gallery_meta_data((int)$config['gallery_id'], 'gallery') ?>
@if (!empty($banners) && count($banners))
    <section class="banner">
        <div class="container">
            <div class="hero-area owl-carousel">
                @foreach ($banners as $banner)
                    <div class="item">
                        <img src="{{ url(Arr::get($banner, 'img')) }}" alt="{{ Arr::get($banner, 'description') }}">
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif