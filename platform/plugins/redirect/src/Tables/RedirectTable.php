<?php

namespace Botble\Redirect\Tables;

use Auth;
use Botble\Redirect\Repositories\Interfaces\RedirectInterface;
use Botble\Table\Abstracts\TableAbstract;
use Illuminate\Contracts\Routing\UrlGenerator;
use Yajra\DataTables\DataTables;

class RedirectTable extends TableAbstract
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
     * RedirectTable constructor.
     * @param DataTables $table
     * @param UrlGenerator $urlDevTool
     * @param RedirectInterface $redirectRepository
     */
    public function __construct(DataTables $table, UrlGenerator $urlDevTool, RedirectInterface $redirectRepository)
    {
        $this->repository = $redirectRepository;
        $this->setOption('id', 'table-plugins-redirect');
        parent::__construct($table, $urlDevTool);

        if (!Auth::user()->hasAnyPermission(['redirect.edit', 'redirect.delete'])) {
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
            ->editColumn('checkbox', function ($item) {
                return table_checkbox($item->id);
            });

        return apply_filters(BASE_FILTER_GET_LIST_DATA, $data, REDIRECT_MODULE_SCREEN_NAME)
            ->addColumn('operations', function ($item) {
                return table_actions('redirect.edit', 'redirect.delete', $item);
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
            'redirects.id',
            'redirects.url',
            'redirects.target',
            'redirects.code',
            'redirects.is_regex',
            'redirects.is_active',
        ]);

        return $this->applyScopes(apply_filters(BASE_FILTER_TABLE_QUERY, $query, $model, REDIRECT_MODULE_SCREEN_NAME));
    }

    /**
     * @return array
     * @since 2.1
     */
    public function columns()
    {
        return [
            'id' => [
                'name' => 'redirects.id',
                'title' => trans('core/base::tables.id'),
                'width' => '20px',
            ],
            'url' => [
                'name' => 'redirects.url',
                'title' => 'Url',
                'class' => 'text-left',
            ],
            'target' => [
                'name' => 'redirects.target',
                'title' => 'Target',
                'width' => '100px',
            ],
            'code' => [
                'name' => 'redirects.code',
                'title' => 'Code',
                'width' => '100px',
            ],
            'is_regex' => [
                'name' => 'redirects.is_regex',
                'title' => 'Is Regex',
                'width' => '100px',
            ],
            'is_active' => [
                'name' => 'redirects.is_active',
                'title' => 'Is Active',
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
        $buttons = $this->addCreateButton(route('redirect.create'), 'redirect.create');

        return apply_filters(BASE_FILTER_TABLE_BUTTONS, $buttons, REDIRECT_MODULE_SCREEN_NAME);
    }

    /**
     * @return array
     * @throws \Throwable
     */
    public function bulkActions(): array
    {
        return $this->addDeleteAction(route('redirect.delete.many'), 'redirect.delete', parent::bulkActions());
    }

//    /**
//     * @return array
//     */
//    public function getBulkChanges(): array
//    {
//        return [
//            'redirects.name' => [
//                'title'    => trans('core/base::tables.name'),
//                'type'     => 'text',
//                'validate' => 'required|max:120',
//                'callback' => 'getNames',
//            ],
//            'redirects.status' => [
//                'title'    => trans('core/base::tables.status'),
//                'type'     => 'select',
//                'choices'  => BaseStatusEnum::labels(),
//                'validate' => 'required|in:' . implode(',', BaseStatusEnum::values()),
//            ],
//            'redirects.created_at' => [
//                'title' => trans('core/base::tables.created_at'),
//                'type'  => 'date',
//            ],
//        ];
//    }

//    /**
//     * @return array
//     */
//    public function getNames()
//    {
//        return $this->repository->pluck('redirects.name', 'redirects.id');
//    }
}
