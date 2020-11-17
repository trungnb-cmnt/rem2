<?php 
    $featureCategories = get_featured_catalog_categories(6);
    
    $banners = theme_option('Banner');
    if (!empty($banners)) {
        $banner_web_images = gallery_meta_data($banners, 'gallery');
    }
?>
<section>
    <?php if (!empty($banner_web_images)) : ?>
        <div id="banner" class="carousel slide" data-ride="carousel">
           <ol class="carousel-indicators">
                @foreach($banner_web_images as $key => $banner)
                <li data-target="#banner" data-slide-to="<?php echo $key ?>"
                    class="<?php if ($key == 0) echo 'active'; ?>"></li>
                @endforeach
            </ol>
            <div class="carousel-inner" role="listbox">
                @foreach($banner_web_images as $key => $banner)
                <?php $url = Arr::get($banner, 'img'); ?>
                <!-- Slide Two - Set the background image for this slide in the line below -->
                <div class="carousel-item <?php if ($key == 0) echo 'active' ?>"
                    style="background-image: url(<?php echo $url?>)">
                </div>
                @endforeach
            </div>
            <a class="carousel-control-prev" href="#banner" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#banner" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    <?php endif;?>
</section>
<section>
    <div class="container">
        <div class="row">
            <div class="py-50 d-none d-lg-block">
                {!! Theme::partial('sidebar') !!}
            </div>
            <div class="col py-50 content">
                <div class="row">
                    <div class="col-12 d-flex flex-column align-items-center">
                        <h2 class="mb-3">Sản phẩm của chúng tôi</h2>
                        <p class="text-center">Các sản phẩm của chúng tôi đều ược nhập khẩu chính hãng, có giấy chứng
                            nhận hợp quy của cơ quan chức năng. Sử dụng rèm cửa Minh Phương mang tới cho bạn một không gian thật sự thoải mái và sang
                            trọng, thân thiện với môi trường, gần gũi hơn với thiên nhiên với các gam màu tự nhiên.</p>
                        <div class="line-icon mt-4"> <span class="icon-icon-3color"><span class="path1"></span><span
                                    class="path2"></span><span class="path3"></span></span></div>
                    </div>
                    <div class="col-12 py-4">
                        <?php  if(!empty($featureCategories)): ?>
                            @foreach ($featureCategories as $featureCategories)
                                 <?php $productsByCateId = get_products_by_category($featureCategories->id,0,4); ?>
                                <?php if(!empty($productsByCateId)): ?>
                                    <div class="row list-product">
                                        <div class="col-12 pb-4">
                                            <div class="title-cate">
                                                <a href="{{ url($featureCategories->slug) }}"><span class="bg-category">{{ $featureCategories->name }} <span class="fa fa-forward"></span></span></a>
                                            </div>
                                        </div>
                                        <?php foreach ($productsByCateId as $key => $product): ?>
                                            <div class="col-6 col-md-3">
                                                <div class="image medium-image">
                                                    <a href="{{ url($product->slug) }}">
                                                      <img src="{{ !empty($product->image) ? get_object_image($product->image,'medium') : '' }}" alt="{{ $product->name }}" />
                                                    </a>
                                                </div>
                                                <div class="text-center">
                                                    <a href="{{ url($product->slug) }}"><h3 class="product-name py-3 mb-0">{{ $product->name }}</h3></a>
                                                    <p class="product-price">{{ number_format($product->price,0,',','.') }} VND</p>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                            @endforeach
                        <?php endif;?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="why-choose-us py-70">
    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center pb-40">
                    <h3 class="title">lÝ DO TẠI SAO NÊN CHỌN CHÚNG TÔI?</h3>
                </div>
                <div class="col-md-4 pb-4">
                    <div class="why-choose-item p-4 d-flex justify-content-between">
                        <div class="flex-none">
                            <img src="{{ Theme::asset()->url('images/money.png') }}" alt="Money" />
                        </div>
                        <div class="pl-3">
                            <p class="reason">Giá thành phải chăng</p>
                            Một trong những ưu điểm vượt trội của rèm cửa Minh Phương đó chính là giá cả phải chăng của
                            các sản phẩm...
                        </div>
                    </div>
                </div>
                <div class="col-md-4 pb-4">
                    <div class="why-choose-item p-4 d-flex justify-content-between">
                        <div class="flex-none">
                            <img src="{{ Theme::asset()->url('images/quality.png') }}" alt="Money" />
                        </div>
                        <div class="pl-3">
                            <p class="reason">Chất lượng tuyệt mỹ</p>
                            Tuy có giá thành tương đối thấp so với sàn gỗ khác, nhưng các sản phẩm rèm cửa Minh Phương vẫn đảm bảo chất lượng ưu việt cho người sử dung.
                        </div>
                    </div>
                </div>

                <div class="col-md-4 pb-4">
                    <div class="why-choose-item p-4 d-flex justify-content-between">
                        <div class="flex-none">
                            <img src="{{ Theme::asset()->url('images/Beauty.png') }}" alt="Money" />
                        </div>
                        <div class="pl-3">
                            <p class="reason">Tính thẩm mỹ cao</p>
                            Rèm cửa Minh Phương không chỉ có tính đa dạng về mẫu mã mà còn có tính thẩm mỹ cao nên dễ dàng được khách hàng ưu chuộng.
                        </div>
                    </div>
                </div>
                <div class="col-md-4 pb-4">
                    <div class="why-choose-item p-4 d-flex justify-content-between">
                        <div class="flex-none">
                            <img src="{{ Theme::asset()->url('images/easy.png') }}" alt="Money" />
                        </div>
                        <div class="pl-3">
                            <p class="reason">Thi công dễ dàng</p>
                           Thời gian thi công rèm cửa Minh Phương chỉ bằng một nửa hay một phần 3 so với thi công khác.
                        </div>
                    </div>
                </div>
                <div class="col-md-4 pb-4">
                    <div class="why-choose-item p-4 d-flex justify-content-between">
                        <div class="flex-none">
                            <img src="{{ Theme::asset()->url('images/environment.png') }}" alt="Money" />
                        </div>
                        <div class="pl-3">
                            <p class="reason">Bảo vệ môi trường</p>
                            Rèm cửa Minh Phương được chế tạo từ những nguyên liệu không gây ảnh hưởng đến tài nguyên và môi trường.
                        </div>
                    </div>
                </div>
                <div class="col-md-4 pb-4">
                    <div class="why-choose-item p-4 d-flex justify-content-between">
                        <div class="flex-none">
                            <img src="{{ Theme::asset()->url('images/much.png') }}" alt="Money" />
                        </div>
                        <div class="pl-3">
                            <p class="reason">Nguồn hàng dồi dào</p>
                           Các dòng sản phẩm Rèm cửa Minh Phương đa dạng về mẫu  mã, chủng loại, phù hợp với nhiều đối tượng tiêu dùng khác nhau.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>