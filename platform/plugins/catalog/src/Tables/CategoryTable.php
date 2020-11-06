<?php

namespace Botble\Catalog\Tables;

use Botble\Catalog\Repositories\Interfaces\CategoryInterface;
use Botble\Table\Abstracts\TableAbstract;
use Illuminate\Contracts\Routing\UrlGenerator;
use Yajra\DataTables\DataTables;
use Html;


class CategoryTable extends TableAbstract
{

    protected $table = 'catalog_categories';

    /**
     * @var bool
     */
    protected $hasActions = true;

    /**
     * @var bool
     */
    protected $useDefaultSorting = false;

    /**
     * CategoryTable constructor.
     * @param DataTables $table
     * @param UrlGenerator $urlGenerator
     * @param CategoryInterface $categoryRepository
     */
    public function __construct(DataTables $table, UrlGenerator $urlGenerator, CategoryInterface $categoryRepository)
    {
        $this->repository = $categoryRepository;
        $this->setOption('id', 'table-catalog_categories');
        parent::__construct($table, $urlGenerator);
    }

    /**
     * Display ajax response.
     *
     * @return \Illuminate\Http\JsonResponse
     * @author Sang Nguyen
     * @since 2.1
     * @throws \Exception
     */
    public function ajax()
    {
        $data = $this->table
            ->of($this->query())
            ->editColumn('name', function ($item) {
                return anchor_link(route('catalog_categories.edit', $item->id), $item->indent_text . ' ' . $item->name);
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
            ->editColumn('created_at', function ($item) {
                return date_from_database($item->created_at, config('core/base.general.date_format.date'));
            })
            ->editColumn('updated_at', function ($item) {
                return date_from_database($item->updated_at, 'd-m-Y');
            })
            ->editColumn('status', function ($item) {
                if ($this->request()->input('action') === 'excel') {
                    return $item->status->getValue();
                }
                return $item->status->toHtml();
            })
            ->removeColumn('is_default');

        return apply_filters(BASE_FILTER_GET_LIST_DATA, $data, CATALOG_CATEGORY_MODULE_SCREEN_NAME)
            ->addColumn('operations', function ($item) {
                return view('plugins/catalog::categories.partials.actions', compact('item'))->render();
            })
            ->escapeColumns([])
            ->make(true);
    }

    /**
     * Get the query object to be processed by table.
     *
     * @return \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder
     * @author Sang Nguyen
     * @since 2.1
     */
    public function query()
    {
        return collect(get_catalog_categories([]));
    }

    /**
     * @return array
     * @author Sang Nguyen
     * @since 2.1
     */
    public function columns()
    {
        return [
            'id'         => [
                'name'  => 'id',
                'title' => trans('core/base::tables.id'),
                'width' => '20px',
            ],
            'name'       => [
                'name'  => 'name',
                'title' => trans('core/base::tables.name'),
                'class' => 'text-left',
            ],
            'image'       => [
                'name'  => 'image',
                'title' => trans('core/base::tables.image'),
                'width' => '70px',
            ],
            'created_at' => [
                'name'  => 'created_at',
                'title' => trans('core/base::tables.created_at'),
                'width' => '100px',
            ],
            'updated_at' => [
                'name'  => 'updated_at',
                'title' => trans('core/base::tables.updated_at'),
                'width' => '100px',
            ],
            'status'     => [
                'name'  => 'status',
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
                'link' => route('catalog_categories.create'),
                'text' => view('core/base::elements.tables.actions.create')->render(),
            ],
        ];

        return apply_filters(BASE_FILTER_TABLE_BUTTONS, $buttons, CATALOG_CATEGORY_MODULE_SCREEN_NAME);
    }

    /**
     * @return array
     * @throws \Throwable
     */
    public function bulkActions(): array
    {
        $actions = parent::bulkActions();

        $actions['delete-many'] = view('core/table::partials.delete', [
            'href'       => route('catalog_categories.delete.many'),
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
            'catalog_categories.name'       => [
                'title'    => trans('core/base::tables.name'),
                'type'     => 'text',
                'validate' => 'required|max:120',
                'callback' => 'getCategories',
            ],
            'catalog_categories.status'     => [
                'title'    => trans('core/base::tables.status'),
                'type'     => 'select',
                'choices'  => [
                    0 => trans('core/base::tables.deactivate'),
                    1 => trans('core/base::tables.activate'),
                ],
                'validate' => 'required|in:0,1',
            ],
            'catalog_categories.created_at' => [
                'title' => trans('core/base::tables.created_at'),
                'type'  => 'date',
            ],
        ];
    }

    /**
     * @return array
     */
    public function getCategories()
    {
        return $this->repository->pluck('catalog_categories.name', 'catalog_categories.id');
    }
}
