<?php

use Botble\Base\Supports\SortItemsWithChildrenHelper;
use Illuminate\Support\Arr;
use Botble\Base\Enums\BaseStatusEnum;
use Botble\QuestionAndAnswer\Repositories\Interfaces\QuestionAndAnswerInterface;

if (!function_exists('get_latest_questions')) {
    /**
     * @param $limit
     * @return mixed
     */
    function get_latest_questions($limit)
    {
        return app(QuestionAndAnswerInterface::class)->getLatest($limit);
    }
}
