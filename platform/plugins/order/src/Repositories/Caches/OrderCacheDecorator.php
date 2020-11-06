<?php

namespace Botble\Order\Repositories\Caches;

use Botble\Support\Repositories\Caches\CacheAbstractDecorator;
use Botble\Order\Repositories\Interfaces\OrderInterface;

class OrderCacheDecorator extends CacheAbstractDecorator implements OrderInterface
{

}
