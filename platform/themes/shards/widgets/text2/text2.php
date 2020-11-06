<?php

use Botble\Widget\AbstractWidget;

class Text2Widget extends AbstractWidget
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
    protected $widgetDirectory = 'text2';

    /**
     * Widget constructor.
     */
    public function __construct()
    {
        parent::__construct([
            'name' => 'Text2',
            'description' => __('Text2'),
        ]);
    }
}