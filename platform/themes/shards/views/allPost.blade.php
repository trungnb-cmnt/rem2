<section class="all-post">
    <div class="container-fluid">
        <div class="row align-items-center justify-content-center">
            <img src="{{ theme_option('banner-page-news') }}" alt="banner page news">
        </div>
    </div>
    <div class="container py-4">
        <div class="row">
            <div class="col-2 d-none d-lg-block">
                {!! Theme::partial('sidebar') !!}
            </div>
            <div class="col-12 col-lg-10 ">
                <?php $num = count($posts); ?>
                @foreach($posts as $key => $post)
                <div class="row py-3 <?php if ($key < $num - 1) echo 'bd-item' ?> post-items">
                    <div class="col-md-5 px-3">
                        <div>
                            <a href="{{ $post->slug }}">
                                <img src="{{ !empty($post->image) ? get_object_image($post->image, 'medium') : '' }}"
                                    alt="{{ $post->name }}">
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6 pt-4 pt-md-0">
                        <div>
                            <h2 class="post-title"><a href="{{ $post->slug }}">{{ $post->name }}</a></h2>
                            <p class="post-des">{{ $post->description }}</p>
                        </div>
                        <div class="pt-3">
                            <a href="{{ $post->slug }}">
                                <i class="icon-news pr-2"></i>
                                <span>Read more</span>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
                <div class="row">
                    <div class="col-12">
                        <div class="page-pagination text-right my-3">
                            {!! $posts->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>