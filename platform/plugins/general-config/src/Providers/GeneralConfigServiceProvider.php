<?php

namespace Botble\GeneralConfig\Providers;

use Botble\GeneralConfig\Models\GeneralConfig;
use Illuminate\Support\ServiceProvider;
use Botble\GeneralConfig\Repositories\Caches\GeneralConfigCacheDecorator;
use Botble\GeneralConfig\Repositories\Eloquent\GeneralConfigRepository;
use Botble\GeneralConfig\Repositories\Interfaces\GeneralConfigInterface;
use Botble\Base\Supports\Helper;
use Event;
use Botble\Base\Traits\LoadAndPublishDataTrait;
use Illuminate\Routing\Events\RouteMatched;

class GeneralConfigServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    /**
     * @var \Illuminate\Foundation\Application
     */
    protected $app;

    /**
     * @author Sang Nguyen
     */
    public function register()
    {
        $this->app->singleton(GeneralConfigInterface::class, function () {
            return new GeneralConfigCacheDecorator(new GeneralConfigRepository(new GeneralConfig));
        });

        Helper::autoload(__DIR__ . '/../../helpers');
    }

    /**
     * @author Sang Nguyen
     */
    public function boot()
    {
        $this->setNamespace('plugins/general-config')
            ->loadAndPublishConfigurations(['permissions'])
            ->loadMigrations()
            ->loadAndPublishViews()
            ->loadAndPublishTranslations()
            ->loadRoutes();

//        Event::listen(RouteMatched::class, function () {
//            dashboard_menu()->registerItem([
//                'id'          => 'cms-plugins-general_config',
//                'priority'    => 5,
//                'parent_id'   => null,
//                'name'        => 'plugins/general-config::general-config.name',
//                'icon'        => 'fa fa-list',
//                'url'         => route('general_config.list'),
//                'permissions' => ['general_config.list'],
//            ]);
//        });

        $this->app->register(HookServiceProvider::class);
    }
}
