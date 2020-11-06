<?php

namespace Botble\GeneralConfig\Repositories\Eloquent;

use Botble\Support\Repositories\Eloquent\RepositoriesAbstract;
use Botble\GeneralConfig\Repositories\Interfaces\GeneralConfigInterface;

class GeneralConfigRepository extends RepositoriesAbstract implements GeneralConfigInterface
{
    /**
     * @var string
     */
    protected $screen = GENERAL_CONFIG_MODULE_SCREEN_NAME;
}
