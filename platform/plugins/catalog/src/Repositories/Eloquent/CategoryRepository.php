<?php

namespace Botble\Catalog\Repositories\Eloquent;

use Botble\Catalog\Enum\StatusEnum;
use Botble\Support\Repositories\Eloquent\RepositoriesAbstract;
use Botble\Catalog\Repositories\Interfaces\CategoryInterface;
use Eloquent;
use Botble\Base\Enums\BaseStatusEnum;

class CategoryRepository extends RepositoriesAbstract implements CategoryInterface
{

    /**
     * {@inheritdoc}
     */
    protected $screen = CATALOG_CATEGORY_MODULE_SCREEN_NAME;

    /**
     * {@inheritdoc}
     */
    public function getDataSiteMap()
    {
        $data = $this->model
            ->where('catalog_categories.status', '=', BaseStatusEnum::PUBLISHED)
            ->select('catalog_categories.*')
            ->orderBy('catalog_categories.created_at', 'desc');

        return $this->applyBeforeExecuteQuery($data, $this->screen)->get();
    }

    /**
     * {@inheritdoc}
     */
    public function getFeaturedCategories($limit)
    {
        $data = $this->model
            ->where([
                'catalog_categories.status'      => BaseStatusEnum::PUBLISHED,
                'catalog_categories.is_featured' => 1,
            ])
            ->select([
                'catalog_categories.id',
                'catalog_categories.name',
                'catalog_categories.icon',
            ])
            ->orderBy('catalog_categories.order', 'asc')
            ->select('catalog_categories.*')
            ->limit($limit);

        return $this->applyBeforeExecuteQuery($data, $this->screen)->get();
    }

    /**
     * {@inheritdoc}
     */
    public function getAllCategories(array $condition = [])
    {
        $data = $this->model->select('catalog_categories.*');
        if (!empty($condition)) {
            $data = $data->where($condition);
        }

        $data = $data->orderBy('catalog_categories.order', 'ASC');

        return $this->applyBeforeExecuteQuery($data, $this->screen)->get();
    }

    /**
     * {@inheritdoc}
     */
    public function getCategoryById($id)
    {
        $data = $this->model->where([
            'catalog_categories.id'     => $id,
            'catalog_categories.status' => BaseStatusEnum::PUBLISHED,
        ]);

        return $this->applyBeforeExecuteQuery($data, $this->screen, true)->first();
    }

    /**
     * {@inheritdoc}
     */
    public function getCategories(array $select, array $orderBy)
    {
        $data = $this->model->select($select);
        foreach ($orderBy as $by => $direction) {
            $data = $data->orderBy($by, $direction);
        }

        return $this->applyBeforeExecuteQuery($data, $this->screen)->get();
    }

    /**
     * {@inheritdoc}
     */
    public function getAllRelatedChildrenIds($id)
    {
        if ($id instanceof Eloquent) {
            $model = $id;
        } else {
            $model = $this->getFirstBy(['catalog_categories.id' => $id]);
        }
        if (!$model) {
            return null;
        }

        $result = [];

        $children = $model->children()->select('catalog_categories.id')->get();

        foreach ($children as $child) {
            $result[] = $child->id;
            $result = array_merge($this->getAllRelatedChildrenIds($child), $result);
        }
        $this->resetModel();

        return array_unique($result);
    }

    /**
     * {@inheritdoc}
     */
    public function getAllCategoriesWithChildren(array $condition = [], array $with = [], array $select = ['*'])
    {
        $data = $this->model
            ->where($condition)
            ->with($with)
            ->select($select);

        return $this->applyBeforeExecuteQuery($data, $this->screen)->get();
    }
}
