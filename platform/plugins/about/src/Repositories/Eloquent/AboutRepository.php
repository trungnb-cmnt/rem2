<?php

namespace Botble\About\Repositories\Eloquent;

use Botble\Support\Repositories\Eloquent\RepositoriesAbstract;
use Botble\About\Repositories\Interfaces\AboutInterface;

class AboutRepository extends RepositoriesAbstract implements AboutInterface
{
    /**
     * @var string
     */
    protected $screen = ABOUT_MODULE_SCREEN_NAME;

    public function getAllPost()
    {
        $data = $this->model->all();

        // $data = $data->orderBy('abouts.order', 'ASC');

        return $this->applyBeforeExecuteQuery($data, $this->screen);
    }
}