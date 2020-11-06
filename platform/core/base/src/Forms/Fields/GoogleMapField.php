<?php

namespace Botble\Base\Forms\Fields;

use Kris\LaravelFormBuilder\Fields\FormField;

class GoogleMapField extends FormField
{

    /**
     * Get the template, can be config variable or view path.
     *
     * @return string
     */
    protected function getTemplate()
    {
        return 'core/base::forms.fields.google-map';
    }
}
