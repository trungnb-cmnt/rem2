<?php

use Botble\About\Repositories\Interfaces\AboutInterface;
use Botble\Page\Supports\Template;

if (!function_exists('get_all_post')) {
    /**
     * @param $limit
     * @return mixed
     *
     */
    function get_all_post()
    {
        return app(AboutInterface::class)->getAllPost();
    }
}