<?php

namespace Botble\QuestionAndAnswer\Http\Requests;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Support\Http\Requests\Request;
use Illuminate\Validation\Rule;

class QuestionAndAnswerRequest extends Request
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'question'   => 'required',
            'answer'   => 'required',
            'status' => Rule::in(BaseStatusEnum::values()),
        ];
    }
}
