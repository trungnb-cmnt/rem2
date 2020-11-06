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
                    <div class="col-2 d-none d-lg-block">
                        {!! Theme::partial('sidebar') !!}
                    </div>
                    <div class="col-12 col-lg-10 ">
                        <div class="row">
                            @foreach($products as $key => $product)
                            <div class="col-sm-6 col-md-4">
                                <div class="Product-Item">
                                    <div class="p-3 text-center img-Item">
                                        <div class="image large-image">
                                            <a href="{{ url($product->slug) }}">
                                                <?php if (!empty($product->image_demo)) : ?>
                                                <img class="image-product"
                                                    src="{{ !empty($product->image) ? get_object_image($product->image, 'large3') : '' }}"
                                                    alt="{{ $product->name }}">
                                                <img class="image-demo"
                                                    src="{{ !empty($product->image_demo) ? get_object_image($product->image_demo, 'large3') : '' }}"
                                                    alt="{{ $product->name }}">
                                                <?php else : ?>
                                                <img src="{{ !empty($product->image) ? get_object_image($product->image, 'large3') : '' }}"
                                                    alt="{{ $product->name }}">
                                                <?php endif; ?>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="DesProHome">
                                        <a href="{{ url($product->slug) }}">
                                            <p class="NameProHome text-center">{{ $product->name }}</p>
                                        </a>
                                        <hr>
                                        <div class="PriceProHome">
                                            <?php if ($product->discount_price) : ?>
                                            <span class="font-18">$ {{ ($product->discount_price) }}</span>
                                            <del class="font-14"> $ {{ $product->price }}</del>
                                            <?php else : ?>
                                            <span class="font-18">$ {{ ($product->price) }}</span>
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
                                    {!! $category->description !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <i>Nếu quý vị đang có nhu cầu lắp đặt rèm cuốn cho gia đình, văn phòng mình, hãy liên hệ
                                hotline <a href="tel:1900 100" style="color: #fcaf17">0986. 496.912</a> của chúng tôi để
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