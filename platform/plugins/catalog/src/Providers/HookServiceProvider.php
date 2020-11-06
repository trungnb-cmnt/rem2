<?php

namespace Botble\Catalog\Providers;

use Assets;
use Botble\Catalog\Enum\StatusEnum;
use Botble\Base\Enums\BaseStatusEnum;
use Botble\Dashboard\Supports\DashboardWidgetInstance;
use Illuminate\Routing\Events\RouteMatched;
use Botble\Base\Supports\Helper;
use Botble\Page\Models\Page;
use Botble\Page\Repositories\Interfaces\PageInterface;
use Botble\SeoHelper\SeoOpenGraph;
use Eloquent;
use Event;
use Html;
use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;
use Botble\Catalog\Repositories\Interfaces\CategoryInterface;
use Illuminate\Support\Str;
use Menu;
use Botble\Catalog\Repositories\Interfaces\ProductInterface;
use Auth;
use SeoHelper;
use Theme;

class HookServiceProvider extends ServiceProvider
{
    /**
     * @var \Illuminate\Foundation\Application
     */
    protected $app;

    /**
     * Boot the service provider.
     * @author Sang Nguyen
     * @throws \Throwable
     */
    public function boot()
    {
        if (defined('MENU_ACTION_SIDEBAR_OPTIONS')) {
            add_action(MENU_ACTION_SIDEBAR_OPTIONS, [$this, 'registerMenuOptions'], 2);
        }
        add_filter(BASE_FILTER_PUBLIC_SINGLE_DATA, [$this, 'handleSingleView'], 2, 1);

        Event::listen(RouteMatched::class, function () {
            admin_bar()->registerLink('Product', route('catalog_products.create'), 'add-new');
        });

        add_shortcode('gallery_by_id', trans('Gallery By Id'), trans('Gallery By Id'), [$this, 'render']);
        shortcode()->setAdminConfig('gallery_by_id', view('plugins/catalog::partials.gallery-short-code-admin-config')->render());
    }

    /**
     * Register sidebar options in menu
     * @throws \Throwable
     */
    public function registerMenuOptions()
    {
        if (Auth::user()->hasPermission('catalog_categories.list')) {
            $categories = Menu::generateSelect([
                'model'   => $this->app->make(CategoryInterface::class)->getModel(),
                'screen'  => CATALOG_CATEGORY_MODULE_SCREEN_NAME,
                'theme'   => false,
                'options' => [
                    'class' => 'list-item',
                ],
            ]);
            echo view('plugins/catalog::categories.partials.menu-options', compact('categories'));
        }
    }

    /**
     * @param Eloquent $slug
     * @return array|Eloquent
     * @author Sang Nguyen
     */
    public function handleSingleView($slug)
    {
        if ($slug instanceof Eloquent) {
            $data = [];
            switch ($slug->reference) {
                case CATALOG_PRODUCT_MODULE_SCREEN_NAME:
                    $product = $this->app->make(ProductInterface::class)
                        ->getFirstBy([
                            'id'     => $slug->reference_id,
                            'status' => StatusEnum::IN_STOCK,
                        ]);
                    if (!empty($product)) {
                        Helper::handleViewCount($product, 'viewed_post');

                        SeoHelper::setTitle($product->name)->setDescription($product->description);

                        $meta = new SeoOpenGraph();
                        if ($product->image) {
                            $meta->setImage(url($product->image));
                        }
                        $meta->setDescription($product->description);
                        $meta->setUrl(route('public.single', $slug->key));
                        $meta->setTitle($product->name);
                        $meta->setType('article');

                        SeoHelper::setSeoOpenGraph($meta);

                        admin_bar()->registerLink(trans('plugins/catalog::products.edit_this_post'),
                            route('catalog_products.edit', $product->id));

                        Theme::breadcrumb()->add(__('Home'), url('/'));

                        if ($product->primary_category_id) {
                            $primaryCategory = $this->app->make(CategoryInterface::class)
                                ->getFirstBy([
                                    'id'     => $product->primary_category_id,
                                    'status' => BaseStatusEnum::PUBLISHED,
                                ]);
                            if ($primaryCategory) {
                                if ($primaryCategory) {
                                    if ($primaryCategory->parent_id) {
                                        $parentCategory = $this->app->make(CategoryInterface::class)
                                            ->getFirstBy([
                                                'id'     => $primaryCategory->parent_id,
                                                'status' => BaseStatusEnum::PUBLISHED,
                                            ]);
                                        if ($parentCategory) {
                                            Theme::breadcrumb()->add($parentCategory->name,
                                                route('public.single', $parentCategory->getSlugAttribute()));
                                        }
                                    }
                                    Theme::breadcrumb()->add($primaryCategory->name,
                                        route('public.single', $primaryCategory->getSlugAttribute()));
                                }
                            }
                        }

                        Theme::breadcrumb()->add($product->name, route('public.single', $slug->key));

                        // LdJson
                        SeoHelper::setBreadCrumbs(Theme::breadcrumb()->getCrumbs());
                        SeoHelper::setProduct($product);

                        do_action(BASE_ACTION_PUBLIC_RENDER_SINGLE, CATALOG_PRODUCT_MODULE_SCREEN_NAME, $product);

                        $data = [
                            'view'         => 'catalog_product',
                            'default_view' => 'plugins/catalog::themes.product',
                            'data'         => compact('product'),
                            'slug'         => $product->slug,
                        ];
                    }
                    break;
                case CATALOG_CATEGORY_MODULE_SCREEN_NAME:
                    $category = $this->app->make(CategoryInterface::class)
                        ->getFirstBy([
                            'id'     => $slug->reference_id,
                            'status' => BaseStatusEnum::PUBLISHED,
                        ]);
                    if (!empty($category)) {
                        SeoHelper::setTitle($category->name)->setDescription($category->description);

                        $meta = new SeoOpenGraph();
                        if ($category->image) {
                            $meta->setImage(url($category->image));
                        }
                        $meta->setDescription($category->description);
                        $meta->setUrl(route('public.single', $slug->key));
                        $meta->setTitle($category->name);
                        $meta->setType('article');

                        SeoHelper::setSeoOpenGraph($meta);

                        admin_bar()->registerLink(trans('plugins/catalog::categories.edit_this_category'),
                            route('catalog_categories.edit', $category->id));

                        $allRelatedCategoryIds = array_unique(array_merge($this->app->make(CategoryInterface::class)->getAllRelatedChildrenIds($category),
                            [$category->id]));

                        $products = $this->app->make(ProductInterface::class)->getByCategory($allRelatedCategoryIds, 12);

                        Theme::breadcrumb()->add(__('Home'), url('/'));


                        if ($category->parent_id) {
                            $parentCategory = $this->app->make(CategoryInterface::class)
                                ->getFirstBy([
                                    'id'     => $category->parent_id,
                                    'status' => BaseStatusEnum::PUBLISHED,
                                ]);
                            if ($parentCategory) {
                                Theme::breadcrumb()->add($parentCategory->name,
                                    route('public.single', $parentCategory->getSlugAttribute()));
                            }
                        }

                        Theme::breadcrumb()->add($category->name, route('public.single', $slug->key));

                        do_action(BASE_ACTION_PUBLIC_RENDER_SINGLE, CATALOG_CATEGORY_MODULE_SCREEN_NAME, $category, $products);

                        return [
                            'view'         => 'category',
                            'default_view' => 'plugins/catalog::themes.category',
                            'data'         => compact('category', 'products'),
                            'slug'         => $category->slug,
                        ];
                    }
                    break;
            }
            if (!empty($data)) {
                return $data;
            }
        }

        return $slug;
    }

    public function render($shortcode)
    {
        return view('plugins/catalog::galleries.bootstrap', ['gallery_id' => $shortcode->gallery_id]);
    }
}
