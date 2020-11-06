<div class="form-group">
    <label for="widget-name">{{ __('Name') }}</label>
    <input type="text" class="form-control" name="name" value="{{ $config['name'] }}">
</div>
<div class="form-group">
    <label for="widget-name">{{ __('Description') }}</label>
    <textarea class="form-control" name="description" rows="5">{{ $config['description'] }}</textarea>
</div>