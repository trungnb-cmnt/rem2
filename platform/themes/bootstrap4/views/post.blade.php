{!! Theme::partial('page-intro', ['title' => $post->name]) !!}
<section class="home-section blog-post page-section">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-3 page-sidebar">
                {!! Theme::partial('sidebar') !!}
            </div>
            <div class="col-12 col-lg-9 page-content mb-3">
                <article>
                    <header class="mb-3 mb-lg-4">
                        <h3 class="fs-14">{{ $post->description }}</h3>
                    </header>
                    <div class="post-content pt-3 pb-4 mb-3">
                        {!! $post->content !!}
                    </div>
                    <?php /*
                        <footer class="post-footer">
                            @if (!$post->tags->isEmpty())
                                <div class="row">
                                    <div class="col-12">
                                        <div class="post__tags_wrap border-top border-bottom py-3">
                                            <span class="post__tags font-weight-normal">{{ __('Tags') }}:
                                                @foreach ($post->tags as $tag)
                                                    <a class="px-3 py-2 fs-14 bg-light font-weight-bold"
                                                       href="{{ route('public.tag', $tag->slug) }}">{{ $tag->name }}</a>
                                                @endforeach
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <?php $relatedPost = get_related_posts($post->id, 7) ?>
                            @if (!empty($relatedPost))
                                <div class="row">
                                    <div class="col-12">
                                        <div class="related-post-area py-3">
                                            <h3 class="font-weight-bold mb-3 mb-lg-4 fs-16">{{ __('Các tin khác') }}</h3>
                                            <ul class="list-unstyled">
                                                @foreach ($relatedPost as $related_item)
                                                    <li class="mb-2">
                                                        <article>
                                                            <span class="dot-circle background-gray"></span>
                                                            <a href="{{ route('public.single', $related_item->slug) }}"
                                                               class="fs-14 text-gray-70"> {{ $related_item->name }} ({{ $post->publish_date->format('d/m') }})</a>
                                                        </article>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </footer>
                        */ ?>
                </article>
            </div>
        </div>
    </div>
</section>
