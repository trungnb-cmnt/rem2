<?php

use Botble\Widget\AbstractWidget;

class BannerWidget extends AbstractWidget
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
    protected $widgetDirectory = 'banner';

    /**
     * Widget constructor.
     */
    public function __construct()
    {
        parent::__construct([
            'name' => 'BannerSlider',
            'gallery_id' => '',
            'description' => __('Banner Slider Widget'),
        ]);
    }
}