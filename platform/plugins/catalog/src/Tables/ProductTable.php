<?php

namespace Botble\Catalog\Tables;

use Botble\Catalog\Enum\StatusEnum;
use Botble\Catalog\Exports\ProductExport;
use Botble\Catalog\Models\Product;
use Botble\Catalog\Repositories\Interfaces\CategoryInterface;
use Botble\Catalog\Repositories\Interfaces\ProductInterface;
use Botble\Table\Abstracts\TableAbstract;
use Carbon\Carbon;
use Html;
use Illuminate\Contracts\Routing\UrlGenerator;
use Yajra\DataTables\DataTables;

class ProductTable extends TableAbstract
{
    protected $table = 'catalog_products';

    /**
     * @var bool
     */
    protected $hasActions = true;

    /**
     * @var bool
     */
    protected $hasFilter = true;

    /**
     * @var CategoryInterface
     */
    protected $categoryRepository;

    /**
     * @var string
     */
    protected $exportClass = ProductExport::class;

    /**
     * ProductTable constructor.
     * @param DataTables $table
     * @param UrlGenerator $urlGenerator
     * @param ProductInterface $productRepository
     * @param CategoryInterface $categoryRepository
     */
    public function __construct(
        DataTables $table,
        UrlGenerator $urlGenerator,
        ProductInterface $productRepository,
        CategoryInterface $categoryRepository
    ) {
        $this->repository = $productRepository;
        $this->setOption('id', 'table-products');
        $this->categoryRepository = $categoryRepository;
        parent::__construct($table, $urlGenerator);
    }

    /**
     * Display ajax response.
     *
     * @return \Illuminate\Http\JsonResponse
     * @author Sang Nguyen
     * @since 2.1
     */
    public function ajax()
    {
        $data = $this->table
            ->eloquent($this->query())
            ->editColumn('name', function ($item) {
                return anchor_link(route('catalog_products.edit', $item->id), $item->name);
            })
            ->editColumn('image', function ($item) {
                if ($this->request()->input('action') === 'excel') {
                    return get_object_image($item->image, 'thumb');
                }
                return Html::image(get_object_image($item->image, 'thumb'), $item->name, ['width' => 50]);
            })
            ->editColumn('checkbox', function ($item) {
                return table_checkbox($item->id);
            })
            ->editColumn('category', function ($item) {
                return implode(', ', $item->categories->pluck('name')->all());
            })
            ->editColumn('status', function ($item) {
                if ($this->request()->input('action') === 'excel') {
                    return $item->status->getValue();
                }
                return $item->status->toHtml();
            });

        return apply_filters(BASE_FILTER_GET_LIST_DATA, $data, CATALOG_PRODUCT_MODULE_SCREEN_NAME)
            ->addColumn('operations', function ($item) {
                return table_actions('catalog_products.edit', 'catalog_products.delete', $item);
            })
            ->escapeColumns([])
            ->make(true);
    }

    /**
     * Get the query object to be processed by the table.
     *
     * @return \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder
     * @author Sang Nguyen
     * @since 2.1
     */
    public function query()
    {
        $model = $this->repository->getModel();
        $query = $model
            ->with(['categories'])
            ->select([
                'catalog_products.id',
                'catalog_products.name',
                'catalog_products.price',
                'catalog_products.image',
                'catalog_products.status',
            ]);

        return $this->applyScopes(apply_filters(BASE_FILTER_TABLE_QUERY, $query, $model, CATALOG_PRODUCT_MODULE_SCREEN_NAME));
    }

    /**
     * @return array
     * @author Sang Nguyen
     * @since 2.1
     */
    public function columns()
    {
        return [
            'id' => [
                'name' => 'catalog_products.id',
                'title' => trans('core/base::tables.id'),
                'width' => '20px',
            ],
            'image' => [
                'name' => 'catalog_products.image',
                'title' => trans('core/base::tables.image'),
                'width' => '70px',
            ],
            'name' => [
                'name' => 'catalog_products.name',
                'title' => trans('core/base::tables.name'),
                'class' => 'text-left',
            ],
            'price' => [
                'name' => 'catalog_products.price',
                'title' => 'Giá',
                'class' => 'text-left',
            ],
            'category' => [
                'name' => 'catalog_products.primary_category_id',
                'title' => trans('plugins/catalog::products.categories'),
                'width' => '150px',
                'class' => 'no-sort',
                'orderable' => false,
            ],
            'status' => [
                'name' => 'catalog_products.status',
                'title' => trans('core/base::tables.status'),
                'width' => '100px',
            ],
        ];
    }

    /**
     * @return array
     * @author Sang Nguyen
     * @since 2.1
     * @throws \Throwable
     */
    public function buttons()
    {
        $buttons = [
            'create' => [
                'link' => route('catalog_products.create'),
                'text' => view('core/base::elements.tables.actions.create')->render(),
            ],
        ];

        return apply_filters(BASE_FILTER_TABLE_BUTTONS, $buttons, CATALOG_PRODUCT_MODULE_SCREEN_NAME);
    }

    /**
     * @return array
     * @throws \Throwable
     */
    public function bulkActions(): array
    {
        $actions = parent::bulkActions();

        $actions['delete-many'] = view('core/table::partials.delete', [
            'href' => route('catalog_products.delete.many'),
            'data_class' => get_class($this),
        ]);

        return $actions;
    }

    /**
     * @return array
     */
    public function getBulkChanges(): array
    {
        return [
            'catalog_products.name' => [
                'title' => trans('core/base::tables.name'),
                'type' => 'text',
                'validate' => 'required|max:120',
                'callback' => 'getProducts',
            ],
            'catalog_products.status' => [
                'title' => trans('core/base::tables.status'),
                'type' => 'select',
                'choices' => StatusEnum::labels(),
                'validate' => 'required|in:' . implode(',', StatusEnum::values()),
            ],
            'catalog_products.created_at' => [
                'title' => trans('core/base::tables.created_at'),
                'type' => 'date',
                'validate' => 'required',
            ],
            'catalog_category' => [
                'title' => __('Category'),
                'type' => 'select-search',
                'validate' => 'required',
                'callback' => 'getCategories',
            ],
        ];
    }

    /**
     * @return array
     */
    public function getProducts()
    {
        return $this->repository->pluck('catalog_products.name', 'catalog_products.id');
    }

    /**
     * @return array
     */
    public function getCategories()
    {
        return $this->categoryRepository->pluck('catalog_categories.name', 'catalog_categories.id');
    }

    /**
     * @param \Illuminate\Database\Query\Builder $query
     * @param string $key
     * @param string $operator
     * @param string $value
     * @return $this|\Illuminate\Database\Query\Builder|string|static
     */
    public function applyFilterCondition($query, string $key, string $operator, ?string $value)
    {
        switch ($key) {
            case 'products.created_at':
                $value = Carbon::createFromFormat('Y/m/d', $value)->toDateString();
                $query = $query->whereDate($key, $operator, $value);
                break;
            case 'catalog_category':
                $query->join('catalog_product_categories', 'catalog_product_categories.product_id', '=', 'catalog_products.id')
                    ->join('catalog_categories', 'catalog_product_categories.category_id', '=', 'catalog_categories.id')
                    ->where('catalog_product_categories.category_id', $operator, $value);
                break;
            default:
                if ($operator !== '=') {
                    $value = (float)$value;
                }
                $query = $query->where($key, $operator, $value);
        }

        return $query;
    }

    /**
     * @param Product $item
     * @param string $input_key
     * @param string $input_value
     * @return false|\Illuminate\Database\Eloquent\Model
     */
    public function saveBulkChangeItem($item, string $input_key, ?string $input_value)
    {
        if ($input_key === 'catalog_category') {
            $item->categories()->sync([$input_value]);
            return $item;
        }

        return parent::saveBulkChangeItem($item, $input_key, $input_value);
    }

    /**
     * @return array
     */
    public function getDefaultButtons(): array
    {
        return ['excel', 'reload'];
    }
}