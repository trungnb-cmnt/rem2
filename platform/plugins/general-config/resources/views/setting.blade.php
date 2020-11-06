<div class="flexbox-annotated-section">
    <div class="flexbox-annotated-section-annotation">
        <div class="annotated-section-title pd-all-20">
            <h2>{{ trans('plugins/general-config::general-config.settings.title') }}</h2>
        </div>
        <div class="annotated-section-description pd-all-20 p-none-t">
            <p class="color-note">{{ trans('plugins/general-config::general-config.settings.description') }}</p>
        </div>
    </div>

    <div class="flexbox-annotated-section-content">
        <div class="wrapper-content pd-all-20">
            <div class="form-group">
                <label class="text-title-field"
                       for="company_name">{{ trans('plugins/general-config::general-config.settings.company_name') }}</label>
                <input data-counter="120" type="text" class="next-input" name="company_name" id="company_name"
                       value="{{ setting('company_name') }}" placeholder="{{ trans('plugins/general-config::general-config.settings.company_name') }}">
            </div>

            <div class="form-group">
                <label class="text-title-field"
                       for="company_short_detail">{{ trans('plugins/general-config::general-config.settings.company_short_detail') }}</label>
                <textarea class="next-input form-control" name="company_short_detail" id="company_short_detail" rows="5" placeholder="{{ trans('plugins/general-config::general-config.settings.company_short_detail') }}">{{ setting('company_short_detail') }}</textarea>
            </div>

            <div class="form-group">
                <label class="text-title-field"
                       for="company_email">{{ trans('plugins/general-config::general-config.settings.company_email') }}</label>
                <input data-counter="120" type="text" class="next-input" name="company_email" id="company_email"
                       value="{{ setting('company_email') }}" placeholder="{{ trans('plugins/general-config::general-config.settings.company_email') }}">
            </div>

            <div class="form-group">
                <label class="text-title-field"
                       for="company_fax">{{ trans('plugins/general-config::general-config.settings.company_fax') }}</label>
                <input data-counter="120" type="text" class="next-input" name="company_fax" id="company_fax"
                       value="{{ setting('company_fax') }}" placeholder="{{ trans('plugins/general-config::general-config.settings.company_fax') }}">
            </div>

            <div class="form-group">
                <label class="text-title-field"
                       for="company_phone">{{ trans('plugins/general-config::general-config.settings.company_phone') }}</label>
                <input data-counter="120" type="text" class="next-input" name="company_phone" id="company_phone"
                       value="{{ setting('company_phone') }}" placeholder="{{ trans('plugins/general-config::general-config.settings.company_phone') }}">
            </div>

            <div class="form-group">
                <label class="text-title-field"
                       for="company_address">{{ trans('plugins/general-config::general-config.settings.company_address') }}</label>
                <textarea class="next-input form-control" name="company_address" id="company_address" rows="5" placeholder="{{ trans('plugins/general-config::general-config.settings.company_address') }}">{{ setting('company_address') }}</textarea>
            </div>

            <div class="form-group">
                <label class="text-title-field"
                       for="company_address_locality">{{ trans('plugins/general-config::general-config.settings.company_address_locality') }}</label>
                <input data-counter="120" type="text" class="next-input" name="company_address_locality" id="company_address_locality"
                       value="{{ setting('company_address_locality') }}" placeholder="{{ trans('plugins/general-config::general-config.settings.company_address_locality') }}">
            </div>

            <div class="form-group">
                <label class="text-title-field"
                       for="company_address_region">{{ trans('plugins/general-config::general-config.settings.company_address_region') }}</label>
                <input data-counter="120" type="text" class="next-input" name="company_address_region" id="company_address_region"
                       value="{{ setting('company_address_region') }}" placeholder="{{ trans('plugins/general-config::general-config.settings.company_address_region') }}">
            </div>

            <div class="form-group">
                <label class="text-title-field"
                       for="company_address_postcode">{{ trans('plugins/general-config::general-config.settings.company_address_postcode') }}</label>
                <input data-counter="120" type="text" class="next-input" name="company_address_postcode" id="company_address_postcode"
                       value="{{ setting('company_address_postcode') }}" placeholder="{{ trans('plugins/general-config::general-config.settings.company_address_postcode') }}">
            </div>

            <div class="form-group">
                <label class="text-title-field"
                       for="company_map_lat">{{ trans('plugins/general-config::general-config.settings.company_map_lat') }}</label>
                <input data-counter="120" type="text" class="next-input" name="company_map_lat" id="company_map_lat"
                       value="{{ setting('company_map_lat') }}" placeholder="{{ trans('plugins/general-config::general-config.settings.company_map_lat') }}">
            </div>

            <div class="form-group">
                <label class="text-title-field"
                       for="company_map_long">{{ trans('plugins/general-config::general-config.settings.company_map_long') }}</label>
                <input data-counter="120" type="text" class="next-input" name="company_map_long" id="company_map_long"
                       value="{{ setting('company_map_long') }}" placeholder="{{ trans('plugins/general-config::general-config.settings.company_map_long') }}">
            </div>

        </div>
    </div>
</div>
