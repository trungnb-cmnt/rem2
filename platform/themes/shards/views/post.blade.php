<!-- {!! Theme::partial('page-intro', ['title' => $post->name]) !!} -->
<?php $NewPost = get_popular_posts(4); ?>
<section class="home-section blog-post page-section">
    <div class="container">
        <div class="row py-5">
            <div class="col-12 col-lg-9 page-sidebar">
                <article>
                    <header class="mb-3 mb-lg-4">
                        <h1>{{ $post->name }}</h1>
                        <?php if (!empty(theme_option('Facebook')) && !empty(theme_option('twitter')) && !empty(theme_option('linkedin'))) : ?>
                        <div class="d-flex align-items-center justify-content-between">
                            <p class="post-date"><?php echo get_date($post->created_at); ?> <span class="px-2">|</span>
                                <i class="far fa-eye pr-1"></i> {{ $post->views }}
                            </p>
                            <ul class="LeftSocial d-flex">
                                <?php if (!empty(theme_option('Facebook'))) : ?>
                                <li class="px-2"><a href="#"><i class="icon-facebook-rectangle"></i></a></li>
                                <?php endif; ?>
                                <?php if (!empty(theme_option('twitter'))) : ?>
                                <li class="px-2"><a href="#"><i class="icon-twitter-rectangle"></i></a></li>
                                <?php endif; ?>
                                <?php if (!empty(theme_option('linkedin'))) : ?>
                                <li class="px-2"><a href="#"><i class="icon-pinterest-rectangle"></i></a></li>
                                <?php endif; ?>
                            </ul>
                        </div>
                        <?php endif; ?>
                    </header>
                    <div class="post-content pb-4 mb-3">
                        {!! $post->content !!}
                    </div>
                </article>
            </div>
            <div class="col-12 col-lg-3 sidebar-content mb-3">
                <div>
                    <img src="{{ Theme::asset()->url('images/405.png') }}" alt="">
                </div>
                <?php if ($NewPost) : ?>
                <div class="row">
                    <div class="col-12 pt-4 pb-1">
                        <h2>Feature article</h2>
                    </div>
                    <div class="col-12 sidebar">
                        @foreach($NewPost as $key => $post)
                        <div class="row pt-1 pb-1">
                            <div class="col-6 col-lg-8">
                                <a href="{{ $post->slug }}">
                                    <h3>{{ $post->name }}</h3>
                                </a>
                                <p class="des-sidebar d-lg-none">{{ $post->description }}</p>
                                <p class="date-post"><?php echo get_date($post->created_at); ?></p>
                            </div>
                            <div class="col-6 col-lg-4">
                                <a href="{{ $post->slug }}">
                                    <img src="{{ $post->image }}" alt="{{ $post->name }}">
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>