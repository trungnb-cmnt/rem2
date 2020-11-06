<?php

namespace Botble\Redirect\Http\Requests;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Support\Http\Requests\Request;
use Illuminate\Validation\Rule;

class RedirectRequest extends Request
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'url' => 'required',
            'target' => 'required',
            'code' => 'required',
//            'is_regex' => 'required',
//            'is_active' => 'required',
        ];
    }
}
