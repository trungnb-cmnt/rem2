<?php

namespace Botble\Order\Http\Controllers;

use Botble\Base\Events\BeforeEditContentEvent;
use Botble\Order\Http\Requests\OrderRequest;
use Botble\Order\Repositories\Interfaces\OrderInterface;
use Botble\Base\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Exception;
use Botble\Order\Tables\OrderTable;
use Botble\Base\Events\CreatedContentEvent;
use Botble\Base\Events\DeletedContentEvent;
use Botble\Base\Events\UpdatedContentEvent;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\Order\Forms\OrderForm;
use Botble\Base\Forms\FormBuilder;

class OrderController extends BaseController
{
    /**
     * @var OrderInterface
     */
    protected $orderRepository;

    /**
     * OrderController constructor.
     * @param OrderInterface $orderRepository
     */
    public function __construct(OrderInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    /**
     * Display all orders
     * @param OrderTable $dataTable
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function getList(OrderTable $table)
    {

        page_title()->setTitle('Order');

        return $table->renderTable();
    }

    /**
     * @param FormBuilder $formBuilder
     * @return string
     */
    public function getCreate(FormBuilder $formBuilder)
    {
        page_title()->setTitle(trans('plugins/order::order.create'));

        return $formBuilder->create(OrderForm::class)->renderForm();
    }

    /**
     * Insert new Order into database
     *
     * @param OrderRequest $request
     * @return BaseHttpResponse
     */
    public function postCreate(OrderRequest $request, BaseHttpResponse $response)
    {
        $order = $this->orderRepository->createOrUpdate($request->input());

        event(new CreatedContentEvent(ORDER_MODULE_SCREEN_NAME, $request, $order));

        return $response
            ->setPreviousUrl(route('order.list'))
            ->setNextUrl(route('order.edit', $order->id))
            ->setMessage(trans('core/base::notices.create_success_message'));
    }

    /**
     * Show edit form
     *
     * @param $id
     * @param Request $request
     * @param FormBuilder $formBuilder
     * @return string
     */
    public function getEdit($id, FormBuilder $formBuilder, Request $request)
    {
        $order = $this->orderRepository->findOrFail($id);

        event(new BeforeEditContentEvent(ORDER_MODULE_SCREEN_NAME, $request, $order));

        page_title()->setTitle(trans('plugins/order::order.edit') . ' "' . $order->name . '"');

        return $formBuilder->create(OrderForm::class, ['model' => $order])->renderForm();
    }

    /**
     * @param $id
     * @param OrderRequest $request
     * @return BaseHttpResponse
     */
    public function postEdit($id, OrderRequest $request, BaseHttpResponse $response)
    {
        $order = $this->orderRepository->findOrFail($id);

        $order->fill($request->input());

        $this->orderRepository->createOrUpdate($order);

        event(new UpdatedContentEvent(ORDER_MODULE_SCREEN_NAME, $request, $order));

        return $response
            ->setPreviousUrl(route('order.list'))
            ->setMessage(trans('core/base::notices.update_success_message'));
    }

    /**
     * @param $id
     * @param Request $request
     * @return BaseHttpResponse
     */
    public function getDelete(Request $request, $id, BaseHttpResponse $response)
    {
        try {
            $order = $this->orderRepository->findOrFail($id);

            $this->orderRepository->delete($order);

            event(new DeletedContentEvent(ORDER_MODULE_SCREEN_NAME, $request, $order));

            return $response->setMessage(trans('core/base::notices.delete_success_message'));
        } catch (Exception $exception) {
            return $response
                ->setError()
                ->setMessage(trans('core/base::notices.cannot_delete'));
        }
    }

    /**
     * @param Request $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     * @throws Exception
     */
    public function postDeleteMany(Request $request, BaseHttpResponse $response)
    {
        $ids = $request->input('ids');
        if (empty($ids)) {
            return $response
                ->setError()
                ->setMessage(trans('core/base::notices.no_select'));
        }

        foreach ($ids as $id) {
            $order = $this->orderRepository->findOrFail($id);
            $this->orderRepository->delete($order);
            event(new DeletedContentEvent(ORDER_MODULE_SCREEN_NAME, $request, $order));
        }

        return $response->setMessage(trans('core/base::notices.delete_success_message'));
    }
}
