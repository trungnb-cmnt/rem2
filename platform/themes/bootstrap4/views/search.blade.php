<section style="background-image:url({{ Theme::asset()->url('images/breadcrumb-background.jpg') }})"
         class="page-intro">
    <div class="container">
        <section class="breadcrumb-section">
            @foreach (Theme::breadcrumb()->getCrumbs() as $i => $crumb)
                @if ($i != (count(Theme::breadcrumb()->getCrumbs()) - 1))
                    <a class="text-gray-70" href="{{ $crumb['url'] }}">{!! $crumb['label'] !!}</a>
                @endif
            @endforeach
                <span class="divider text-gray-70">|</span>
                <span class="no-link">{{ __('Search') }}</span>
        </section>

        <h3 class="page-intro__title font-weight-bold fs-25 mt-3 mt-lg-4">{{ __('Search result for: ') . '"' . Request::input('q') . '"' }}</h3>
    </div>
</section>

<section class="home-section catalog-category-page">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="page-content">
                    @if ($posts->count() > 0)
                        <?php $count_post = 1 ?>
                        <div class="row list-product">
                            @foreach ($posts as $key => $post)
                                <div class="col-12 col-md-6 single-product mb-2rem">
                                    <div class="image image-5-3">
                                        <a href="{{ route('public.single', $post->slug) }}">
                                            <img src="{{ get_object_image($post->image, 'medium') }}" alt="{{ $post->name }}"><a href="{{ route('public.single', $post->slug) }}" class="post__overlay"></a>
                                        </a>
                                    </div>
                                    <div class="p-3 product-content">
                                        <h3 class="title fs-16 font-weight-bold text-red mb-3">
                                            <a href="{{ route('public.single', $post->slug) }}">{{ $post->name }}</a>
                                        </h3>
                                        <p class="fs-14 mb-2">{{ Str::limit($post->description, 100) }}</p>
                                    </div>
                                </div>
                            @endforeach
                            <div class="page-pagination text-right my-3 px-3">
                                {!! $posts->links() !!}
                            </div>
                        </div>
                    @else
                        <div class="alert alert-warning">
                            <span>{{ __('Hiện tại chưa có sản phẩm nào') }}</span>
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-12 col-lg-4">
                <div class="page-sidebar">
                    {!! Theme::partial('sidebar') !!}
                </div>
            </div>
        </div>
    </div>
</section>
