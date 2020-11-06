<?php

namespace Botble\About\Repositories\Caches;

use Botble\Support\Repositories\Caches\CacheAbstractDecorator;
use Botble\About\Repositories\Interfaces\AboutInterface;

class AboutCacheDecorator extends CacheAbstractDecorator implements AboutInterface
{
    public function getAllPost()
    {
        return $this->getDataIfExistCache(__FUNCTION__, func_get_args());
    }
}