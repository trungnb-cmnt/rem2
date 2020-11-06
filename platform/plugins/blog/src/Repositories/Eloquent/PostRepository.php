<?php

namespace Botble\Blog\Repositories\Eloquent;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Support\Repositories\Eloquent\RepositoriesAbstract;
use Botble\Blog\Repositories\Interfaces\PostInterface;
use Eloquent;
use Exception;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Arr;

class PostRepository extends RepositoriesAbstract implements PostInterface
{

    /**
     * {@inheritdoc}
     */
    public function getFirstBy(array $condition = [], array $select = ['*'], array $with = [])
    {
        $this->make($with);

        if (!empty($select)) {
            $data = $this->model->published()->where($condition)->select($select);
        } else {
            $data = $this->model->published()->where($condition);
        }

        return $this->applyBeforeExecuteQuery($data, $this->screen, true)->first();
    }

    /**
     * {@inheritdoc}
     */
    protected $screen = POST_MODULE_SCREEN_NAME;

    /**
     * {@inheritdoc}
     */
    public function getFeatured($limit = 5)
    {
        $data = $this->model
            ->published()
            ->featured()
            ->limit($limit)
            ->orderBy('posts.publish_date', 'desc');

        return $this->applyBeforeExecuteQuery($data, $this->screen)->get();
    }

    /**
     * {@inheritdoc}
     */
    public function getListPostNonInList(array $selected = [], $limit = 7)
    {
        $data = $this->model
            ->published()
            ->whereNotIn('posts.id', $selected)
            ->limit($limit)
            ->orderBy('posts.publish_date', 'desc');

        return $this->applyBeforeExecuteQuery($data, $this->screen)->get();
    }

    /**
     * {@inheritdoc}
     */
    public function getRelated($id, $limit = 3)
    {
        $post = $this->findById($id);
        if ($post) {
            $data = $this->model
                ->published()
                ->where([
                    ['posts.id', '!=', $id],
                    ['posts.primary_category_id', $post->primary_category_id]
                ])
                ->limit($limit)
                ->orderBy('posts.publish_date', 'desc');
        } else {
            $data = $this->model
                ->published()
                ->where('posts.id', '!=', $id)
                ->limit($limit)
                ->orderBy('posts.publish_date', 'desc');
        }

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
            ->published()
            ->join('post_categories', 'post_categories.post_id', '=', 'posts.id')
            ->join('categories', 'post_categories.category_id', '=', 'categories.id')
            ->whereIn('post_categories.category_id', $category_id)
            ->select('posts.*')
            ->distinct()
            ->orderBy('posts.publish_date', 'desc');

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
            ->published()
            ->where('posts.author_id', $author_id)
            ->select('posts.*')
            ->orderBy('posts.views', 'desc');

        return $this->applyBeforeExecuteQuery($data, $this->screen)->paginate($paginate);
    }

    /**
     * {@inheritdoc}
     */
    public function getDataSiteMap()
    {
        $data = $this->model
            ->published()
            ->select('posts.*')
            ->orderBy('posts.publish_date', 'desc');

        return $this->applyBeforeExecuteQuery($data, $this->screen)->get();
    }

    /**
     * {@inheritdoc}
     */
    public function getByTag($tag, $paginate = 12)
    {
        $data = $this->model
            ->published()
            ->whereHas('tags', function ($query) use ($tag) {
                /**
                 * @var Builder $query
                 */
                $query->where('tags.id', $tag);
            })
            ->select('posts.*')
            ->orderBy('posts.publish_date', 'desc');

        return $this->applyBeforeExecuteQuery($data, $this->screen)->paginate($paginate);
    }

    /**
     * {@inheritdoc}
     */
    public function getRecentPosts($limit = 5, $category_id = 0)
    {
        $posts = $this->model->published();

        if ($category_id != 0) {
            $posts = $posts->join('post_categories', 'post_categories.post_id', '=', 'posts.id')
                ->where('post_categories.category_id', '=', $category_id);
        }

        $data = $posts->limit($limit)
            ->select('posts.*')
            ->orderBy('posts.publish_date', 'desc');

        return $this->applyBeforeExecuteQuery($data, $this->screen)->get();
    }

    /**
     * {@inheritdoc}
     */
    public function getSearch($query, $limit = 10, $paginate = 10)
    {
        $posts = $this->model->published();
        foreach (explode(' ', $query) as $term) {
            $posts = $posts->where('name', 'LIKE', '%' . $term . '%');
        }

        $data = $posts->select('posts.*')
            ->orderBy('posts.publish_date', 'desc');

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
    public function getAllPosts($perPage = 12, $active = true)
    {
        $data = $this->model->select('posts.*')
            ->orderBy('posts.publish_date', 'desc');

        if ($active) {
            $data = $data->published();
        }

        return $this->applyBeforeExecuteQuery($data, $this->screen)->paginate($perPage);
    }

    /**
     * {@inheritdoc}
     */
    public function getPopularPosts($limit, array $args = [])
    {
        $data = $this->model
            ->published()
            ->where([
                ['posts.is_featured', 1]
            ])
            ->orderBy('posts.views', 'DESC')
            ->select('posts.*')
            ->limit($limit);

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
}
