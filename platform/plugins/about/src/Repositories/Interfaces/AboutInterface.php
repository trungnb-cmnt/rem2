<?php

namespace Botble\About\Repositories\Interfaces;

use Botble\Support\Repositories\Interfaces\RepositoryInterface;

interface AboutInterface extends RepositoryInterface
{
    public function getAllPost();
}