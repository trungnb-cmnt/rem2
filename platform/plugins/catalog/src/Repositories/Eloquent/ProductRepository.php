<?php

namespace Botble\Catalog\Repositories\Eloquent;

use Botble\Catalog\Repositories\Interfaces\ProductInterface;
use Botble\Support\Repositories\Eloquent\RepositoriesAbstract;
use Eloquent;
use Exception;
use Illuminate\Support\Arr;

class ProductRepository extends RepositoriesAbstract implements ProductInterface
{

    /**
     * {@inheritdoc}
     */
    protected $screen = CATALOG_PRODUCT_MODULE_SCREEN_NAME;

    /**
     * {@inheritdoc}
     */
    public function getFeatured($limit = 5)
    {
        $data = $this->model
            ->published()
            ->featured()
            ->limit($limit)
            ->orderBy('catalog_products.order', 'asc');

        return $this->applyBeforeExecuteQuery($data, $this->screen)->get();
    }

    /**
     * {@inheritdoc}
     */
    public function getListProductNonInList(array $selected = [], $limit = 7)
    {
        $data = $this->model
            ->whereNotIn('catalog_products.id', $selected)
            ->limit($limit)
            ->orderBy('catalog_products.order', 'asc');

        return $this->applyBeforeExecuteQuery($data, $this->screen)->get();
    }

    /**
     * {@inheritdoc}
     */
    public function getRelated($id, $limit = 3)
    {
        $data = $this->model
            ->where('catalog_products.id', '!=', $id)
            ->limit($limit)
            ->orderBy('catalog_products.order', 'asc');

        return $this->applyBeforeExecuteQuery($data, $this->screen)->get();
    }

    /**
     * {@inheritdoc}
     */
    public function getByCategory($category_id, $paginate = 12, $limit = 0)
    {
        if (!is_array($category_id)) {
            $category_id = [$category_id];
        }

        $data = $this->model
            ->join('catalog_product_categories', 'catalog_product_categories.product_id', '=', 'catalog_products.id')
            ->join('catalog_categories', 'catalog_product_categories.category_id', '=', 'catalog_categories.id')
            ->whereIn('catalog_product_categories.category_id', $category_id)
            ->select('catalog_products.*')
            ->orderBy('catalog_products.order', 'asc')
            ->distinct();

        if ($paginate != 0) {
            return $this->applyBeforeExecuteQuery($data, $this->screen)->paginate($paginate);
        }

        return $this->applyBeforeExecuteQuery($data, $this->screen)->limit($limit)->get();
    }

    /**
     * {@inheritdoc}
     */
    public function getByUserId($author_id, $paginate = 6)
    {
        $data = $this->model
            ->where('catalog_products.author_id', $author_id)
            ->select('catalog_products.*')
            ->orderBy('catalog_products.order', 'asc');

        return $this->applyBeforeExecuteQuery($data, $this->screen)->paginate($paginate);
    }

    /**
     * {@inheritdoc}
     */
    public function getDataSiteMap()
    {
        $data = $this->model
            ->select('catalog_products.*')
            ->orderBy('catalog_products.order', 'asc');;

        return $this->applyBeforeExecuteQuery($data, $this->screen)->get();
    }

    /**
     * {@inheritdoc}
     */
    public function getRecentProducts($limit = 5, $category_id = 0)
    {
        $catalog_products = $this->model->published();

        if ($category_id != 0) {
            $catalog_products = $catalog_products->join('catalog_product_categories', 'catalog_product_categories.product_id', '=', 'catalog_products.id')
                ->where('catalog_product_categories.category_id', '=', $category_id)
                ->orderBy('catalog_products.order', 'asc');
        }

        $data = $catalog_products->limit($limit)
            ->select('catalog_products.*')
            ->orderBy('catalog_products.order', 'asc');

        return $this->applyBeforeExecuteQuery($data, $this->screen)->get();
    }

    /**
     * {@inheritdoc}
     */
    public function getSearch($query, $limit = 10, $paginate = 10)
    {
        $catalog_products = $this->model;
        foreach (explode(' ', $query) as $term) {
            $catalog_products = $catalog_products->where('name', 'LIKE', '%' . $term . '%');
        }

        $data = $catalog_products->select('catalog_products.*')
            ->orderBy('catalog_products.order', 'asc');

        if ($limit) {
            $data = $data->limit($limit);
        }

        if ($paginate) {
            return $this->applyBeforeExecuteQuery($data, $this->screen)->paginate($paginate);
        }

        return $this->applyBeforeExecuteQuery($data, $this->screen)->get();
    }

    /**
     * {@inheritdoc}
     */
    public function getAllProducts($active = true, $limit)
    {
        $data = $this->model->select('catalog_products.*');

        if ($active) {
            $data = $data->orderBy('catalog_products.views', 'DESC')->limit(3);
        }

        return $this->applyBeforeExecuteQuery($data, $this->screen)->get();
    }

    /**
     * {@inheritdoc}
     */
    public function getAllProductsNoPaginate($active = true)
    {
        $data = $this->model->select('catalog_products.*');

        if ($active) {
            $data = $data->orderBy('catalog_products.order', 'asc');
        }

        return $this->applyBeforeExecuteQuery($data, $this->screen)->get();
    }

    /**
     * {@inheritdoc}
     */
    public function getPopularProducts($limit, array $args = [])
    {
        $data = $this->model
            ->orderBy('catalog_products.views', 'DESC')
            ->select('catalog_products.*')
            ->limit($limit);

        if (!empty(Arr::get($args, 'where'))) {
            $data = $data->where($args['where']);
        }

        return $this->applyBeforeExecuteQuery($data, $this->screen)->get();
    }

    /**
     * {@inheritdoc}
     */
    public function getRelatedCategoryIds($model)
    {
        $model = $model instanceof Eloquent ? $model : $this->findById($model);

        try {
            return $model->categories()->allRelatedIds()->toArray();
        } catch (Exception $exception) {
            return [];
        }
    }

    /**
     * @param int $tag
     * @param int $paginate
     * @return mixed
     * @author Sang Nguyen
     */
    public function getByTag($tag, $paginate = 12)
    {
        // TODO: Implement getByTag() method.
    }
}