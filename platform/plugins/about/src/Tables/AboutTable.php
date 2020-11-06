<?php

namespace Botble\About\Tables;

use Auth;
use Botble\Base\Enums\BaseStatusEnum;
use Botble\About\Repositories\Interfaces\AboutInterface;
use Botble\Table\Abstracts\TableAbstract;
use Illuminate\Contracts\Routing\UrlGenerator;
use Yajra\DataTables\DataTables;

class AboutTable extends TableAbstract
{

    /**
     * @var bool
     */
    protected $hasActions = true;

    /**
     * @var bool
     */
    protected $hasFilter = true;

    /**
     * AboutTable constructor.
     * @param DataTables $table
     * @param UrlGenerator $urlDevTool
     * @param AboutInterface $aboutRepository
     */
    public function __construct(DataTables $table, UrlGenerator $urlDevTool, AboutInterface $aboutRepository)
    {
        $this->repository = $aboutRepository;
        $this->setOption('id', 'table-plugins-about');
        parent::__construct($table, $urlDevTool);

        if (!Auth::user()->hasAnyPermission(['about.edit', 'about.destroy'])) {
            $this->hasOperations = false;
            $this->hasActions = false;
        }
    }

    /**
     * Display ajax response.
     *
     * @return \Illuminate\Http\JsonResponse
     * @since 2.1
     */
    public function ajax()
    {
        $data = $this->table
            ->eloquent($this->query())
            ->editColumn('name', function ($item) {
                if (!Auth::user()->hasPermission('about.edit')) {
                    return $item->name;
                }
                return anchor_link(route('about.edit', $item->id), $item->name);
            })
            ->editColumn('checkbox', function ($item) {
                return table_checkbox($item->id);
            })
            ->editColumn('created_at', function ($item) {
                return date_from_database($item->created_at, config('core.base.general.date_format.date'));
            })
            ->editColumn('status', function ($item) {
                return $item->status->toHtml();
            });

        return apply_filters(BASE_FILTER_GET_LIST_DATA, $data, ABOUT_MODULE_SCREEN_NAME)
            ->addColumn('operations', function ($item) {
                return table_actions('about.edit', 'about.destroy', $item);
            })
            ->escapeColumns([])
            ->make(true);
    }

    /**
     * Get the query object to be processed by table.
     *
     * @return \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder
     * @since 2.1
     */
    public function query()
    {
        $model = $this->repository->getModel();
        $query = $model->select([
            'abouts.id',
            'abouts.name',
            'abouts.content',
            'abouts.order',
            'abouts.created_at',
            'abouts.status',
        ]);

        return $this->applyScopes(apply_filters(BASE_FILTER_TABLE_QUERY, $query, $model, ABOUT_MODULE_SCREEN_NAME));
    }

    /**
     * @return array
     * @since 2.1
     */
    public function columns()
    {
        return [
            'id' => [
                'name' => 'abouts.id',
                'title' => trans('core/base::tables.id'),
                'width' => '20px',
            ],
            'name' => [
                'name' => 'abouts.name',
                'title' => trans('core/base::tables.name'),
                'class' => 'text-left',
            ],
            'order' => [
                'name' => 'abouts.order',
                'title' => 'Order',
                'class' => 'text-left',
            ],
            'created_at' => [
                'name' => 'abouts.created_at',
                'title' => trans('core/base::tables.created_at'),
                'width' => '100px',
            ],
            'status' => [
                'name' => 'abouts.status',
                'title' => trans('core/base::tables.status'),
                'width' => '100px',
            ],
        ];
    }

    /**
     * @return array
     * @since 2.1
     * @throws \Throwable
     */
    public function buttons()
    {
        $buttons = $this->addCreateButton(route('about.create'), 'about.create');

        return apply_filters(BASE_FILTER_TABLE_BUTTONS, $buttons, ABOUT_MODULE_SCREEN_NAME);
    }

    /**
     * @return array
     * @throws \Throwable
     */
    public function bulkActions(): array
    {
        return $this->addDeleteAction(route('about.deletes'), 'about.destroy', parent::bulkActions());
    }

    /**
     * @return array
     */
    public function getBulkChanges(): array
    {
        return [
            'abouts.name' => [
                'title'    => trans('core/base::tables.name'),
                'type'     => 'text',
                'validate' => 'required|max:120',
                'callback' => 'getNames',
            ],
            'abouts.status' => [
                'title'    => trans('core/base::tables.status'),
                'type'     => 'select',
                'choices'  => BaseStatusEnum::labels(),
                'validate' => 'required|in:' . implode(',', BaseStatusEnum::values()),
            ],
            'abouts.created_at' => [
                'title' => trans('core/base::tables.created_at'),
                'type'  => 'date',
            ],
        ];
    }

    /**
     * @return array
     */
    public function getNames()
    {
        return $this->repository->pluck('abouts.name', 'abouts.id');
    }
}
