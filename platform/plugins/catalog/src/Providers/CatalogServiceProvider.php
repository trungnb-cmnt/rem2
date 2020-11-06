<?php

namespace Botble\Catalog\Providers;

use Illuminate\Routing\Events\RouteMatched;
use Botble\Base\Supports\Helper;
use Botble\Base\Traits\LoadAndPublishDataTrait;
use Botble\Catalog\Models\Product;
use Botble\Catalog\Repositories\Caches\ProductCacheDecorator;
use Botble\Catalog\Repositories\Eloquent\ProductRepository;
use Botble\Catalog\Repositories\Interfaces\ProductInterface;
use Botble\Shortcode\View\View;
use Event;
use Illuminate\Support\ServiceProvider;
use Botble\Catalog\Models\Category;
use Botble\Catalog\Repositories\Caches\CategoryCacheDecorator;
use Botble\Catalog\Repositories\Eloquent\CategoryRepository;
use Botble\Catalog\Repositories\Interfaces\CategoryInterface;
use Language;
use SeoHelper;

/**
 * Class CatalogServiceProvider
 * @package Botble\Catalog
 * @author Sang Nguyen
 * @since 02/07/2016 09:50 AM
 */
class CatalogServiceProvider extends ServiceProvider
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
        $this->app->singleton(ProductInterface::class, function () {
            return new ProductCacheDecorator(new ProductRepository(new Product));
        });

        $this->app->singleton(CategoryInterface::class, function () {
            return new CategoryCacheDecorator(new CategoryRepository(new Category));
        });

        Helper::autoload(__DIR__ . '/../../helpers');
    }

    /**
     * Boot the service provider.
     * @author Sang Nguyen
     */
    public function boot()
    {
        $this->setNamespace('plugins/catalog')
            ->loadAndPublishConfigurations(['permissions'])
            ->loadAndPublishViews()
            ->loadAndPublishTranslations()
            ->loadMigrations()
            ->publishPublicFolder()
            ->publishAssetsFolder();

        $this->app->register(RouteServiceProvider::class);
        $this->app->register(HookServiceProvider::class);
        $this->app->register(EventServiceProvider::class);

        Event::listen(RouteMatched::class, function () {
            dashboard_menu()
                ->registerItem([
                    'id'          => 'cms-plugins-catalog',
                    'priority'    => 3,
                    'parent_id'   => null,
                    'name'        => 'plugins/catalog::base.menu_name',
                    'icon'        => 'fa fa-edit',
                    'url'         => route('catalog_products.list'),
                    'permissions' => ['catalog_products.list'],
                ])
                ->registerItem([
                    'id'          => 'cms-plugins-catalog-product',
                    'priority'    => 1,
                    'parent_id'   => 'cms-plugins-catalog',
                    'name'        => 'plugins/catalog::products.menu_name',
                    'icon'        => null,
                    'url'         => route('catalog_products.list'),
                    'permissions' => ['catalog_products.list'],
                ])
                ->registerItem([
                    'id'          => 'cms-plugins-catalog-categories',
                    'priority'    => 2,
                    'parent_id'   => 'cms-plugins-catalog',
                    'name'        => 'plugins/catalog::categories.menu_name',
                    'icon'        => null,
                    'url'         => route('catalog_categories.list'),
                    'permissions' => ['catalog_categories.list'],
                ]);
        });

        $screens = [CATALOG_PRODUCT_MODULE_SCREEN_NAME, CATALOG_CATEGORY_MODULE_SCREEN_NAME];

        if (defined('LANGUAGE_MODULE_SCREEN_NAME')) {
            Language::registerModule($screens);
        }

        $this->app->booted(function () use ($screens) {
            config([
                'packages.slug.general.supported' => array_merge(config('packages.slug.general.supported'), $screens),
            ]);

            SeoHelper::registerModule($screens);
        });

        $catalog_categories = [];
        foreach (get_catalog_categories() as $category) {
            $catalog_categories[$category->id] = $category;
        }
        view()->share( 'catalog_categories', $catalog_categories);

        view()->composer([
            'plugins/catalog::themes.product',
            'plugins/catalog::themes.category',
        ], function (View $view) {
            $view->withShortcodes();
        });
    }
}
