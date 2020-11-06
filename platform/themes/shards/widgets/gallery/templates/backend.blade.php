<?php $galleries = [];
if (is_plugin_active('gallery')) {
    $AllGallery = get_all_gallery();
    foreach ($AllGallery as $key => $val) {
        $galleries[$val->id] = $val->name;
    }
}
?>
<div class="form-group">
    <label for="widget-name">{{ __('Name') }}</label>
    <input type="text" class="form-control" name="name" value="{{ $config['name'] }}">
</div>
<div class="form-group">
    <label for="widget-name">Gallery</label>
    <select class="form-control" name="gallery" value="{{ $config['gallery'] }}">
        @foreach($galleries as $key=>$value)
        <?php if ($key == $config['gallery']) : ?>
        <option value="{{ $key }}" selected="selected">{{ $value }}</option>
        <?php else : ?>
        <option value="{{ $key }}">{{ $value }}</option>
        <?php endif; ?>
        @endforeach
    </select>
</div>