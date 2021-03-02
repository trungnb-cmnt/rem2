<!-- {!! Theme::partial('page-intro', ['title' => $category->name]) !!} -->
<section class="home-section blog-category page-section">
    <div class="container-fluid">
        <div class="row align-items-center justify-content-center">
            <img src="{{ $category->image ? $category->image : '' }}" alt="{{ $category->name }}">
            <!-- <div class="container d-flex align-items-center justify-content-center">
                <h1 class="pr-5">{{ $category->name }}</h1>
            </div> -->
        </div>
    </div>
    <form action="get">
        <input type="hidden" value="active" id="active">
    </form>
    <div class="container">
        @if(count($products) > 0 )
        <div class="row pb-5">
            <div class="col-12 py-3">
                <div>
                    <hr>
                </div>
            </div>
            <div class="col-12">
                <div class="row">
                    <div class="d-none d-lg-block">
                        {!! Theme::partial('sidebar') !!}
                    </div>
                    <div class="col">
                        <div class="row">
                            @foreach($products as $key => $product)
                            <div class="col-sm-6 col-md-3 mb-4">
                                <div class="Product-Item">
                                    <div class="text-center img-Item mb-3">
                                        <div class="image medium-image">
                                            <a href="{{ url($product->slug) }}">
                                                <img class="image-product"
                                                    src="{{ !empty($product->image) ? get_object_image($product->image, 'medium') : '' }}"
                                                    alt="{{ $product->name }}">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="DesProHome">
                                        <a href="{{ url($product->slug) }}">
                                            <p class="NameProHome text-center mb-0">{{ $product->name }}</p>
                                        </a>
                                        <hr>
                                        <div class="PriceProHome">
                                            <?php if ($product->discount_price) : ?>
                                            <span
                                                class="font-18">{{ number_format($product->discount_price,0,',','.') }}
                                                VND</span>
                                            <del class="font-14">{{ number_format($product->price,0,',','.') }}
                                                VND</del>
                                            <?php else : ?>
                                            <span class="font-18">{{ number_format($product->price,0,',','.') }}
                                                VND</span>
                                            <?php endif ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="col-12 pt-3">
                            <div class="page-pagination text-right my-3 justify-content-end">
                                {!! $products->links() !!}
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="category-description">
                                <h3 class="py-3">Mô Tả</h3>
                                <div class="py-4">
                                    {!! $category->content !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <i>Nếu quý vị đang có nhu cầu lắp đặt rèm cuốn cho gia đình, văn phòng mình, hãy liên hệ
                                hotline <a href="tel:1900 100" style="color: #fcaf17">097 2222 614</a> của chúng tôi để
                                được xem mẫu ngay tại
                                nhà, đo đạc tư vấn miễn
                                phí, thi công nhanh nhất tại Hà Nội.</i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</section>