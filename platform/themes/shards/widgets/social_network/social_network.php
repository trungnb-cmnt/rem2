<?php

use Botble\Widget\AbstractWidget;

class SocialNetworkWidget extends AbstractWidget
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
    protected $widgetDirectory = 'social_network';

    /**
     * Widget constructor.
     */
    public function __construct()
    {
        parent::__construct([
            'name' => 'SocialNetwork',
            'description' => __('Social Network'),
            'facebook' => __(''),
            'linkedin' => __(''),
            'twitter' => __(''),
            'instagram' => __(''),
            'telegram' => __(''),
        ]);
    }
}