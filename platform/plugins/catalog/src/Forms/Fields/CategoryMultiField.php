<?php

namespace Botble\Catalog\Forms\Fields;

use Kris\LaravelFormBuilder\Fields\FormField;

class CategoryMultiField extends FormField
{

    /**
     * @return string
     * @author Sang Nguyen
     */
    protected function getTemplate()
    {
        return 'plugins/catalog::categories.partials.categories-multi';
    }
}
