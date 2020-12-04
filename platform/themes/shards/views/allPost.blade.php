<section class="all-post">
    <div class="container py-4">
        <div class="row">
            <div class="py-50 d-none d-lg-block">
                {!! Theme::partial('sidebar') !!}
            </div>
            @if(!empty($posts))
            <div class="col py-50 content">
                <?php $num = count($posts); ?>
                @foreach($posts as $key => $post)
                <div class="row py-3 <?php if ($key < $num - 1) echo 'bd-item' ?> post-items">
                    <div class="col-md-4 px-3">
                        <div>
                            <a href="{{ $post->slug }}">
                                <img src="{{ !empty($post->image) ? get_object_image($post->image, 'small') : '' }}"
                                    alt="{{ $post->name }}">
                            </a>
                        </div>
                    </div>
                    <div class="col-md-8 pt-4 pt-md-0">
                        <div>
                            <h2 class="post-title"><a href="{{ $post->slug }}">{{ $post->name }}</a></h2>
                            <p class="post-des">{{ $post->description }}</p>
                        </div>
                        <div class="pt-3">
                            <a href="{{ $post->slug }}">
                                <i class="icon-news pr-2"></i>
                                <span>Xem ngay</span>
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
            @endif
        </div>
    </div>
</section>