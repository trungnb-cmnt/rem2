@if (function_exists('get_galleries'))
    <?php $banners = gallery_meta_data(1, 'gallery') ?>
    @if (!empty($banners))
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
@endif
