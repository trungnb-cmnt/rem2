<?php

use Botble\Widget\AbstractWidget;

class FacebookWidget extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * @var string
     */
    protected $frontendTemplate = 'frontend';

    /**
     * @var string
     */
    protected $backendTemplate = 'backend';

    /**
     * @var string
     */
    protected $widgetDirectory = 'facebook';

    /**
     * Widget constructor.
     */
    public function __construct()
    {
        parent::__construct([
            'name' => 'Facebook',
            'description' => __('Link facebook'),
            'link' => '',
        ]);
    }
}