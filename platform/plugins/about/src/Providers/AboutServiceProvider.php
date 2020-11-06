<?php

namespace Botble\About\Providers;

use Botble\About\Models\About;
use Illuminate\Support\ServiceProvider;
use Botble\About\Repositories\Caches\AboutCacheDecorator;
use Botble\About\Repositories\Eloquent\AboutRepository;
use Botble\About\Repositories\Interfaces\AboutInterface;
use Botble\Base\Supports\Helper;
use Event;
use Botble\Base\Traits\LoadAndPublishDataTrait;
use Illuminate\Routing\Events\RouteMatched;

class AboutServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    /**
     * @var \Illuminate\Foundation\Application
     */
    protected $app;

    public function register()
    {
        $this->app->bind(AboutInterface::class, function () {
            return new AboutCacheDecorator(new AboutRepository(new About));
        });

        Helper::autoload(__DIR__ . '/../../helpers');
    }

    public function boot()
    {
        $this->setNamespace('plugins/about')
            ->loadAndPublishConfigurations(['permissions'])
            ->loadMigrations()
            ->loadAndPublishViews()
            ->loadAndPublishTranslations()
            ->loadRoutes(['web']);

        Event::listen(RouteMatched::class, function () {
            dashboard_menu()->registerItem([
                'id'          => 'cms-plugins-about',
                'priority'    => 5,
                'parent_id'   => null,
                'name'        => 'plugins/about::about.name',
                'icon'        => 'fa fa-list',
                'url'         => route('about.index'),
                'permissions' => ['about.index'],
            ]);
        });
    }
}