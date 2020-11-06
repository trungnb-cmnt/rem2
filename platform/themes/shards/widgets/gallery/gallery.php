<?php

use Botble\Widget\AbstractWidget;

class GalleryWidget extends AbstractWidget
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
    protected $widgetDirectory = 'gallery';

    /**
     * Widget constructor.
     */
    public function __construct()
    {
        parent::__construct([
            'name' => 'Gallery',
            'description' => __('This is a sample widget'),
            'gallery' => '',
        ]);
    }
}