<?php

namespace Botble\QuestionAndAnswer\Repositories\Caches;

use Botble\Support\Repositories\Caches\CacheAbstractDecorator;
use Botble\QuestionAndAnswer\Repositories\Interfaces\QuestionAndAnswerInterface;

class QuestionAndAnswerCacheDecorator extends CacheAbstractDecorator implements QuestionAndAnswerInterface
{
    public function getLatest($limit)
    {
        return $this->getDataIfExistCache(__FUNCTION__, func_get_args());
    }

    public function getAllQuestions()
    {
        return $this->getDataIfExistCache(__FUNCTION__, func_get_args());
    }
}
