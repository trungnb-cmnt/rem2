<section class="catalog-product">
    <?php $NameCate = get_catalog_category_by_id($product->primary_category_id); ?>
    <div class="container">
        <div class="row py-5">
            <div class="d-none d-lg-block">
                {!! Theme::partial('sidebar') !!}
            </div>
            <div class="col">
                <div class="row">
                    <div class="col-md-6">
                        <div class="pb-4 text-center">
                            <div class="cursor-pointer d-none d-md-block">
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
                        <div>
                            <h2 class="mb-4 text-uppercase prod-title">{{ $product->name }}</h2>
                            <div class="description">
                                <p class="product-price font-weight-bold">{{ number_format($product->price,0,',','.') }} VND/m2</p>
                                {!! $product->description !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="content-prod">
                            <h3 class="py-3">Thông tin chi tiết</h3>
                            <div class="py-4">
                                {!! $product->content !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="content-prod">
                    <h3 class="py-3">Sản phẩm cùng loại</h3>
                    <div class="py-4">
                        {!! $product->content !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>