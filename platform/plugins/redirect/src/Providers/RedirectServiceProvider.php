<?php

namespace Botble\Redirect\Providers;

use Botble\Redirect\Models\Redirect;
use Illuminate\Support\ServiceProvider;
use Botble\Redirect\Repositories\Caches\RedirectCacheDecorator;
use Botble\Redirect\Repositories\Eloquent\RedirectRepository;
use Botble\Redirect\Repositories\Interfaces\RedirectInterface;
use Botble\Base\Supports\Helper;
use Event;
use Botble\Base\Traits\LoadAndPublishDataTrait;
use Illuminate\Routing\Events\RouteMatched;
use Botble\Redirect\Http\Middleware\Redirect as RedirectMiddleware;
use Illuminate\Contracts\Http\Kernel;

class RedirectServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    /**
     * @var \Illuminate\Foundation\Application
     */
    protected $app;

    public function register()
    {
        $this->app->bind(RedirectInterface::class, function () {
            return new RedirectCacheDecorator(new RedirectRepository(new Redirect));
        });

        Helper::autoload(__DIR__ . '/../../helpers');
    }

    public function boot()
    {
        $kernel = $this->app->make(Kernel::class);
        if (!$kernel->hasMiddleware(RedirectMiddleware::class)) {
            $kernel->prependMiddleware(RedirectMiddleware::class);
        }

        $this->setNamespace('plugins/redirect')
            ->loadAndPublishConfigurations(['permissions'])
            ->loadMigrations()
            ->loadAndPublishViews()
            ->loadAndPublishTranslations()
            ->loadRoutes(['web']);

        Event::listen(RouteMatched::class, function () {
            dashboard_menu()->registerItem([
                'id' => 'cms-plugins-redirect',
                'priority' => 5,
                'parent_id' => null,
                'name' => 'plugins/redirect::redirect.name',
                'icon' => 'fa fa-list',
                'url' => route('redirect.list'),
                'permissions' => ['redirect.list'],
            ]);
        });
    }
}
