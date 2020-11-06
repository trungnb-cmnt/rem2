<?php

namespace Botble\Redirect\Repositories\Eloquent;

use Botble\Support\Repositories\Eloquent\RepositoriesAbstract;
use Botble\Redirect\Repositories\Interfaces\RedirectInterface;

class RedirectRepository extends RepositoriesAbstract implements RedirectInterface
{
    /**
     * @var string
     */
    protected $screen = REDIRECT_MODULE_SCREEN_NAME;
}
