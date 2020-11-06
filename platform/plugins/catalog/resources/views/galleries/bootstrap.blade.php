@if (!empty($gallery_id) && defined('GALLERY_MODULE_SCREEN_NAME') && !empty($galleries = gallery_meta_data($gallery_id, GALLERY_MODULE_SCREEN_NAME)))
    <div class="row">
        @foreach ($galleries as $image)
            <div class="col-12 col-sm-6 col-md-4 my-3 text-center">
                <img src="{{ get_object_image(Arr::get($image, 'img'), 'medium') }}" alt="{{ Arr::get($image, 'description') }}">
            </div>
        @endforeach
    </div>
@endif