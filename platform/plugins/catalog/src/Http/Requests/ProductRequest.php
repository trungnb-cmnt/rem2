<?php

namespace Botble\Catalog\Http\Requests;

use Botble\Catalog\Enum\StatusEnum;
use Botble\Support\Http\Requests\Request;
use Illuminate\Validation\Rule;

class ProductRequest extends Request
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     * @author Sang Nguyen
     */
    public function rules()
    {
        return [
            'name'        => 'required|max:255',
            'categories'  => 'required',
            'slug'        => 'required|max:255',
            'status'      => Rule::in(StatusEnum::values()),
        ];
    }
}
