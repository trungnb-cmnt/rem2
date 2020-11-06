<?php

namespace Botble\Catalog\Providers;

use Botble\Theme\Events\RenderingSiteMapEvent;
use Botble\Catalog\Listeners\RenderingSiteMapListener;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     * @author Sang Nguyen
     */
    protected $listen = [
        RenderingSiteMapEvent::class  => [
            RenderingSiteMapListener::class,
        ],
    ];
}
