{!! Theme::partial('page-intro', ['title' => $category->name]) !!}
<section class="home-section blog-category page-section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="page-content">
                    @if ($posts->count() > 0)
                        <?php $count_post = 1 ?>
                        <div class="row list-product mb-3 mb-md-4 mb-lg-5">
                            @foreach ($posts as $key => $post)
                                <article class="col-12 col-md-6 col-lg-4">
                                    <div class="image image-5-3">
                                        <a href="{{ route('public.single', $post->slug) }}">
                                            <img src="{{ get_object_image($post->image, 'medium') }}" alt="{{ $post->name }}"><a href="{{ route('public.single', $post->slug) }}" class="post__overlay"></a>
                                        </a>
                                    </div>
                                    <div class="py-3">
                                        <p class="fs-12 mb-1 meta">
                                            <span class="post-category">
                                                <a href="{{ route('public.single', $category->slug) }}">{{ $category->name }}</a>
                                            </span>
                                            &nbsp;-&nbsp;
                                            {{ date_from_database($post->publish_date, 'd M Y') }}
                                        </p>
                                        <header>
                                            <h2 class="title fs-16 font-weight-bold mb-3">
                                                <a href="{{ route('public.single', $post->slug) }}">{{ Str::limit($post->name, 100) }}</a>
                                            </h2>
                                        </header>
                                    </div>
                                </article>
                            @endforeach
                            <div class="page-pagination text-right my-3 px-3">
                                {!! $posts->links() !!}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 text-center">
                                <button id="load-more" class="btn btn-danger">{{ __('Xem thêm') }}</button>
                            </div>
                        </div>
                    @else
                        <div class="alert alert-info">
                            <span>{{ __('Hiện tại chưa có sản phẩm nào') }}</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>