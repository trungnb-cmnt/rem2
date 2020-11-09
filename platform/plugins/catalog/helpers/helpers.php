<?php

use Botble\Base\Supports\SortItemsWithChildrenHelper;
use Botble\Catalog\Repositories\Interfaces\CategoryInterface;
use Botble\Catalog\Repositories\Interfaces\ProductInterface;
use Botble\Catalog\Supports\ProductFormat;
use Illuminate\Support\Arr;
use Botble\Base\Enums\BaseStatusEnum;

if (!function_exists('get_featured_products')) {
    /**
     * @param $limit
     * @return mixed
     * @author Sang Nguyen
     */
    function get_featured_products($limit)
    {
        return app(ProductInterface::class)->getFeatured($limit);
    }
}

if (!function_exists('get_latest_products')) {
    /**
     * @param $limit
     * @param array $excepts
     * @return mixed
     * @author Sang Nguyen
     */
    function get_latest_products($limit, $excepts = [])
    {
        return app(ProductInterface::class)->getListProductNonInList($excepts, $limit);
    }
}


if (!function_exists('get_related_products')) {
    /**
     * @param $current_slug
     * @param $limit
     * @return mixed
     * @author Sang Nguyen
     */
    function get_related_products($current_slug, $limit)
    {
        return app(ProductInterface::class)->getRelated($current_slug, $limit);
    }
}

if (!function_exists('get_products_by_category')) {
    /**
     * @param $category_id
     * @param $paginate
     * @param $limit
     * @return mixed
     * @author Sang Nguyen
     */
    function get_products_by_category($category_id, $paginate = 12, $limit = 0)
    {
        return app(ProductInterface::class)->getByCategory($category_id, $paginate, $limit);
    }
}

if (!function_exists('get_all_products')) {
    /**
     * @param boolean $active
     * @param int $perPage
     * @return mixed
     * @author Sang Nguyen
     */
    function get_all_products($active = true, $limit)
    {
        return app(ProductInterface::class)->getAllProducts($active, $limit);
    }
}

if (!function_exists('get_all_products_no_paginate')) {
    /**
     * @param boolean $active
     * @param int $perPage
     * @return mixed
     * @author Sang Nguyen
     */
    function get_all_products_no_paginate($active = true)
    {
        return app(ProductInterface::class)->getAllProductsNoPaginate($active);
    }
}

if (!function_exists('get_recent_products')) {
    /**
     * @param $limit
     * @return mixed
     * @author Sang Nguyen
     */
    function get_recent_products($limit)
    {
        return app(ProductInterface::class)->getRecentProducts($limit);
    }
}


if (!function_exists('get_featured_catalog_categories')) {
    /**
     * @param $limit
     * @return mixed
     * @author Sang Nguyen
     */
    function get_featured_catalog_categories($limit)
    {
        return app(CategoryInterface::class)->getFeaturedCategories($limit);
    }
}

if (!function_exists('get_all_catalog_categories')) {
    /**
     * @param array $condition
     * @return mixed
     * @author Sang Nguyen
     */
    function get_all_catalog_categories(array $condition = [])
    {
        return app(CategoryInterface::class)->getAllCategories($condition);
    }
}

if (!function_exists('get_popular_products')) {
    /**
     * @param integer $limit
     * @param array $args
     * @return mixed
     * @author Sang Nguyen
     */
    function get_popular_products($limit = 10, array $args = [])
    {
        return app(ProductInterface::class)->getPopularProducts($limit, $args);
    }
}

if (!function_exists('get_catalog_category_by_id')) {
    /**
     * @param integer $id
     * @return mixed
     * @author Sang Nguyen
     */
    function get_catalog_category_by_id($id)
    {
        return app(CategoryInterface::class)->getCategoryById($id);
    }
}

if (!function_exists('get_catalog_categories')) {
    /**
     * @param array $args
     * @return array|mixed
     */
    function get_catalog_categories(array $args = [])
    {
        $indent = Arr::get($args, 'indent', '——');

        $repo = app(CategoryInterface::class);

        $categories = $repo->getCategories(Arr::get($args, 'select', ['*']), [
            'catalog_categories.is_default' => 'DESC',
            'catalog_categories.order'      => 'ASC',
        ]);

        $categories = sort_item_with_children($categories);

        foreach ($categories as $category) {
            $indentText = '';
            $depth = (int)$category->depth;
            for ($i = 0; $i < $depth; $i++) {
                $indentText .= $indent;
            }
            $category->indent_text = $indentText;
        }

        return $categories;
    }
}

if (!function_exists('get_catalog_categories_with_children')) {
    /**
     * @return array
     * @throws Exception
     */
    function get_catalog_categories_with_children()
    {
        $categories = app(CategoryInterface::class)
            ->getAllCategoriesWithChildren(['status' => BaseStatusEnum::PUBLISHED], [], ['id', 'name', 'parent_id']);
        $sortHelper = app(SortItemsWithChildrenHelper::class);
        $sortHelper
            ->setChildrenProperty('child_cats')
            ->setItems($categories);

        return $sortHelper->sort();
    }
}

if (!function_exists('register_product_format')) {
    /**
     * @param array $formats
     * @return void
     * @author Sang Nguyen
     */
    function register_product_format(array $formats)
    {
        ProductFormat::registerProductFormat($formats);
    }
}

if (!function_exists('get_product_formats')) {
    /**
     * @param bool $convert_to_list
     * @return array
     * @author Sang Nguyen
     */
    function get_product_formats($convert_to_list = false)
    {
        return ProductFormat::getProductFormats($convert_to_list);
    }
}