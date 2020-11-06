<?php

namespace Botble\Order\Http\Requests;

use Botble\Order\Enum\StatusEnum;
use Botble\Support\Http\Requests\Request;
use Illuminate\Validation\Rule;

class OrderRequest extends Request
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'product_id'        => 'required',
            'qty'               => 'required',
            'customer_email'    => 'required',
            'status' => Rule::in(StatusEnum::values()),
        ];
    }
}
