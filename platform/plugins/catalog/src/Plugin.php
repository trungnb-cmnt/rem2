<?php

namespace Botble\Catalog;

use Botble\Dashboard\Repositories\Interfaces\DashboardWidgetInterface;
use Schema;
use Botble\Base\Interfaces\PluginInterface;

class Plugin implements PluginInterface
{

    /**
     * @author Sang Nguyen
     */
    public static function activate()
    {
    }

    /**
     * @author Sang Nguyen
     */
    public static function deactivate()
    {
    }

    /**
     * @author Sang Nguyen
     */
    public static function remove()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('catalog_product_categories');
        Schema::dropIfExists('catalog_products');
        Schema::dropIfExists('catalog_categories');

        //app(DashboardWidgetInterface::class)->deleteBy(['name' => 'widget_posts_recent']);
    }
}
