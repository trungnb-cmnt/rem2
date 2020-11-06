<?php

namespace Botble\Order\Tables;

use Auth;
use Botble\Order\Enum\StatusEnum;
use Botble\Order\Repositories\Interfaces\OrderInterface;
use Botble\Table\Abstracts\TableAbstract;
use Illuminate\Contracts\Routing\UrlGenerator;
use Yajra\DataTables\DataTables;

class OrderTable extends TableAbstract
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
     * OrderTable constructor.
     * @param DataTables $table
     * @param UrlGenerator $urlDevTool
     * @param OrderInterface $orderRepository
     */
    public function __construct(DataTables $table, UrlGenerator $urlDevTool, OrderInterface $orderRepository)
    {
        $this->repository = $orderRepository;
        $this->setOption('id', 'table-plugins-order');
        parent::__construct($table, $urlDevTool);

        if (!Auth::user()->hasAnyPermission(['order.edit', 'order.delete'])) {
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
            ->editColumn('product_id', function ($item) {
                return $item->product->name;
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

        return apply_filters(BASE_FILTER_GET_LIST_DATA, $data, ORDER_MODULE_SCREEN_NAME)
            ->addColumn('operations', function ($item) {
                return table_actions('order.edit', 'order.delete', $item);
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
            'orders.id',
            'orders.product_id',
            'orders.qty',
            'orders.customer_name',
            'orders.customer_email',
            'orders.customer_phone',
            'orders.created_at',
            'orders.status',
        ]);

        return $this->applyScopes(apply_filters(BASE_FILTER_TABLE_QUERY, $query, $model, ORDER_MODULE_SCREEN_NAME));
    }

    /**
     * @return array
     * @since 2.1
     */
    public function columns()
    {
        return [
            'id' => [
                'name' => 'orders.id',
                'title' => trans('core/base::tables.id'),
                'width' => '20px',
            ],
            'product_id' => [
                'name' => 'orders.product_id',
                'title' => 'Product',
                'class' => 'text-left',
            ],
            'qty' => [
                'name' => 'orders.qty',
                'title' => 'Qty',
                'class' => 'text-left',
            ],
            'customer_name' => [
                'name' => 'orders.customer_name',
                'title' => 'Customer Name',
                'class' => 'text-left',
            ],
            'customer_email' => [
                'name' => 'orders.customer_email',
                'title' => 'Customer Email',
                'class' => 'text-left',
            ],
            'customer_phone' => [
                'name' => 'orders.customer_email',
                'title' => 'Customer Phone',
                'class' => 'text-left',
            ],
            'created_at' => [
                'name' => 'orders.created_at',
                'title' => trans('core/base::tables.created_at'),
                'width' => '100px',
            ],
            'status' => [
                'name' => 'orders.status',
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
        $buttons = $this->addCreateButton(route('order.create'), 'order.create');

        return apply_filters(BASE_FILTER_TABLE_BUTTONS, $buttons, ORDER_MODULE_SCREEN_NAME);
    }

    /**
     * @return array
     * @throws \Throwable
     */
    public function bulkActions(): array
    {
        return $this->addDeleteAction(route('order.delete.many'), 'order.delete', parent::bulkActions());
    }

    /**
     * @return array
     */
    public function getBulkChanges(): array
    {
        return [
            'orders.qty' => [
                'title'    => 'Qty',
                'type'     => 'number',
                'validate' => 'required|max:120',
            ],
            'orders.status' => [
                'title'    => trans('core/base::tables.status'),
                'type'     => 'select',
                'choices'  => StatusEnum::labels(),
                'validate' => 'required|in:' . implode(',', StatusEnum::values()),
            ],
            'orders.created_at' => [
                'title' => trans('core/base::tables.created_at'),
                'type'  => 'date',
            ],
        ];
    }
}
