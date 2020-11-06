<?php

namespace Botble\Order\Repositories\Eloquent;

use Botble\Support\Repositories\Eloquent\RepositoriesAbstract;
use Botble\Order\Repositories\Interfaces\OrderInterface;

class OrderRepository extends RepositoriesAbstract implements OrderInterface
{
    /**
     * @var string
     */
    protected $screen = ORDER_MODULE_SCREEN_NAME;
}
