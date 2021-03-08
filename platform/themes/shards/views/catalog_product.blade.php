<?php 
$relatedProduct = get_related_products($product->id,10);
?>
<section class="catalog-product">
    <?php $NameCate = get_catalog_category_by_id($product->primary_category_id); ?>
    <div class="container">
        <div class="row pt-5 pb-3">
            <div class="d-none d-lg-block">
                {!! Theme::partial('sidebar') !!}
            </div>
            <div class="col">
                <div class="row">
                    <div class="col-md-6">
                        <div class="pb-4 text-center">
                            <div class="cursor-pointer">
                                <img id="Img-product" class="position-relative"
                                    src="{{ !empty($product->image) ? get_object_image($product->image,'medium') : '' }}"
                                    alt="{{ $product->name }}">
                            </div>
                        </div>
                        @if (defined('GALLERY_MODULE_SCREEN_NAME') && !empty($galleries =
                        gallery_meta_data($product->id,
                        CATALOG_PRODUCT_MODULE_SCREEN_NAME)))
                        <div class="owl-carousel owl-theme gallery-product px-3 pb-4">
                            @foreach ($galleries as $image)
                            <div class="item-imgGall">
                                <img src="{{ get_object_image(Arr::get($image, 'img'), 'large3') }}"
                                    name-img="{{ get_object_image(Arr::get($image, 'img'), 'medium') }}"
                                    alt="{{ $product->name }}">
                            </div>
                            @endforeach
                        </div>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <h2 class="mb-4 text-uppercase prod-title">{{ $product->name }}</h2>
                            <div class="description">
                                <p class="mb-2">Giá: <span
                                        class="product-price font-weight-bold">{{ number_format($product->price,0,',','.') }}
                                        VND</span></p>
                                @if ($product->code)
                                <p class="mb-2">Mã hàng: {{ $product->code }}</p>
                                @endif
                                @if ($product->origin)
                                <p class="mb-2">Xuất xứ: {{ $product->origin }}</p>
                                @endif
                                @if ($product->unit)
                                <p class="mb-2">Đơn vị tính: {{ $product->unit }}</p>
                                @endif
                                <a href="tel:{{ theme_option('phone') }}">
                                    <button class="btn-submit">GỌI NGAY</button>
                                </a>
                                @if (theme_option('description_product'))
                                <div class="description_product mt-3">
                                    {!! theme_option('description_product') !!}
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="content-prod">
                            <h3 class="p-3">Thông tin chung</h3>
                            <div class="py-4">
                                {!! $product->content !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if (count($relatedProduct) > 0)
        <div class="row">
            <div class="col-12">
                <div class="related-product">
                    <h3 class="pt-4 text-center">Sản phẩm cùng loại</h3>
                    <div class="py-4">
                        <div class="owl-carousel owl-theme owl-ProdHome">
                            @foreach($relatedProduct as $key => $Pro)
                            <div class="Product-Item">
                                <div class="image medium-image">
                                    <a href="{{ $Pro->slug }}">
                                        <img src="{{ !empty($Pro->image) ? get_object_image($Pro->image,'medium') : '' }}"
                                            alt="{{ $Pro->name }}">
                                    </a>
                                </div>
                                <div class="DesProHome">
                                    <p class="NameProHome text-center pt-2">
                                        <a href="{{ $Pro->slug }}">{{ $Pro->name }}</a>
                                    </p>
                                    <hr>
                                    <p class="PriceProHome">
                                        <?php if ($Pro->discount_price) : ?>
                                        <span class="font-18 product-price">{{ ($Pro->discount_price) }} VND</span>
                                        <del class="font-14">{{ $Pro->price }} VND</del>
                                        <?php else : ?>
                                        @if($Pro->price > 0)
                                        <span class="font-18 product-price">{{ ($Pro->price) }} VND</span>
                                        @else
                                        <a href="tel:{{ theme_option('phone') }}" class="product-price">
                                            Liên hệ
                                        </a>
                                        @endif
                                        <?php endif ?>
                                    </p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</section>