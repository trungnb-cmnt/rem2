<?php $partners = $config['gallery'];
if (!empty($partners)) {
    $partner_images = gallery_meta_data($partners, 'gallery');
}
$categories = get_all_catalog_categories();
?>
<?php if (count($categories) > 0) : ?>
<?php if (isset($partner_images)) : ?>
<?php if (count($partner_images) > 0) : ?>
<div class="col-md-4 pt-2 pb-4 pb-md-0">
    <h2 class="pb-3">CATEGORIES</h2>
    <div class="row pt-3">
        @foreach($categories as $k => $cate)
        @if(!empty($partner_images[$k]))
        <div class="col-6 pb-3">
            <a href="{{ $cate->slug }}">
                <img src="{{ url(Arr::get($partner_images[$k],'img')) }}"
                    alt="{{ Arr::get($partner_images[$k],'description') }}">
            </a>
        </div>
        @endif
        @endforeach
    </div>
</div>
<?php endif; ?>
<?php endif; ?>
<?php endif; ?>