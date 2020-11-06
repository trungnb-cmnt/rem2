<?php

namespace Botble\QuestionAndAnswer\Models;

use Botble\Base\Traits\EnumCastable;
use Botble\Base\Enums\BaseStatusEnum;
use Eloquent;

/**
 * Botble\QuestionAndAnswer\Models\QuestionAndAnswer
 *
 * @mixin \Eloquent
 */
class QuestionAndAnswer extends Eloquent
{
    use EnumCastable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'question_and_answers';

    /**
     * @var array
     */
    protected $fillable = [
        'question',
        'answer',
        'group',
        'status',
    ];

    /**
     * @var string
     */
    protected $screen = QUESTION_AND_ANSWER_MODULE_SCREEN_NAME;

    /**
     * @var array
     */
    protected $casts = [
        'status' => BaseStatusEnum::class,
    ];
}
