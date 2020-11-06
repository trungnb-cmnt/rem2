<?php

namespace Botble\Catalog\Repositories\Caches;

use Botble\Support\Repositories\Caches\CacheAbstractDecorator;
use Botble\Catalog\Repositories\Interfaces\ProductInterface;

class ProductCacheDecorator extends CacheAbstractDecorator implements ProductInterface
{
    /**
     * {@inheritdoc}
     */
    public function getBySlug($slug, $status)
    {
        return $this->getDataIfExistCache(__FUNCTION__, func_get_args());
    }

    /**
     * {@inheritdoc}
     */
    public function getFeatured($limit = 5)
    {
        return $this->getDataIfExistCache(__FUNCTION__, func_get_args());
    }

    /**
     * {@inheritdoc}
     */
    public function getListProductNonInList(array $selected = [], $limit = 12)
    {
        return $this->getDataIfExistCache(__FUNCTION__, func_get_args());
    }

    /**
     * {@inheritdoc}
     */
    public function getByUserId($author_id, $limit = 6)
    {
        return $this->getDataIfExistCache(__FUNCTION__, func_get_args());
    }

    /**
     * {@inheritdoc}
     */
    public function getDataSiteMap()
    {
        return $this->getDataIfExistCache(__FUNCTION__, func_get_args());
    }

    /**
     * {@inheritdoc}
     */
    public function getByTag($tag, $paginate = 12)
    {
        return $this->getDataIfExistCache(__FUNCTION__, func_get_args());
    }

    /**
     * {@inheritdoc}
     */
    public function getRelated($slug, $limit = 3)
    {
        return $this->getDataIfExistCache(__FUNCTION__, func_get_args());
    }

    /**
     * {@inheritdoc}
     */
    public function getRecentProducts($limit = 5, $category_id = 0)
    {
        return $this->getDataIfExistCache(__FUNCTION__, func_get_args());
    }

    /**
     * {@inheritdoc}
     */
    public function getSearch($query, $limit = 10, $paginate = 10)
    {
        return $this->getDataIfExistCache(__FUNCTION__, func_get_args());
    }

    /**
     * {@inheritdoc}
     */
    public function getByCategory($category_id, $paginate = 12, $limit = 0)
    {
        return $this->getDataIfExistCache(__FUNCTION__, func_get_args());
    }

    /**
     * {@inheritdoc}
     */
    public function getAllProducts($perPage = 12, $active = true)
    {
        return $this->getDataIfExistCache(__FUNCTION__, func_get_args());
    }

    /**
     * {@inheritdoc}
     */
    public function getAllProductsNoPaginate($active = true)
    {
        return $this->getDataIfExistCache(__FUNCTION__, func_get_args());
    }

    /**
     * {@inheritdoc}
     */
    public function getPopularProducts($limit, array $args = [])
    {
        return $this->getDataIfExistCache(__FUNCTION__, func_get_args());
    }

    /**
     * {@inheritdoc}
     */
    public function getRelatedCategoryIds($model)
    {
        return $this->getDataIfExistCache(__FUNCTION__, func_get_args());
    }
}
