<?php

namespace Botble\Redirect\Http\Controllers;

use Botble\Base\Events\BeforeEditContentEvent;
use Botble\Redirect\Http\Requests\RedirectRequest;
use Botble\Redirect\Repositories\Interfaces\RedirectInterface;
use Botble\Base\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Exception;
use Botble\Redirect\Tables\RedirectTable;
use Botble\Base\Events\CreatedContentEvent;
use Botble\Base\Events\DeletedContentEvent;
use Botble\Base\Events\UpdatedContentEvent;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\Redirect\Forms\RedirectForm;
use Botble\Base\Forms\FormBuilder;

class RedirectController extends BaseController
{
    /**
     * @var RedirectInterface
     */
    protected $redirectRepository;

    /**
     * RedirectController constructor.
     * @param RedirectInterface $redirectRepository
     */
    public function __construct(RedirectInterface $redirectRepository)
    {
        $this->redirectRepository = $redirectRepository;
    }

    /**
     * Display all redirects
     * @param RedirectTable $dataTable
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function getList(RedirectTable $table)
    {

        page_title()->setTitle(trans('plugins/redirect::redirect.name'));

        return $table->renderTable();
    }

    /**
     * @param FormBuilder $formBuilder
     * @return string
     */
    public function getCreate(FormBuilder $formBuilder)
    {
        page_title()->setTitle(trans('plugins/redirect::redirect.create'));

        return $formBuilder->create(RedirectForm::class)->renderForm();
    }

    /**
     * Insert new Redirect into database
     *
     * @param RedirectRequest $request
     * @return BaseHttpResponse
     */
    public function postCreate(RedirectRequest $request, BaseHttpResponse $response)
    {
        $redirect = $this->redirectRepository->createOrUpdate(array_merge($request->input(), [
            'is_regex' => $request->input('is_regex', 0),
            'is_active' => $request->input('is_active', 0),
        ]));

        event(new CreatedContentEvent(REDIRECT_MODULE_SCREEN_NAME, $request, $redirect));

        return $response
            ->setPreviousUrl(route('redirect.list'))
            ->setNextUrl(route('redirect.edit', $redirect->id))
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
        $redirect = $this->redirectRepository->findOrFail($id);

        event(new BeforeEditContentEvent(REDIRECT_MODULE_SCREEN_NAME, $request, $redirect));

        page_title()->setTitle(trans('plugins/redirect::redirect.edit') . ' "' . $redirect->name . '"');

        return $formBuilder->create(RedirectForm::class, ['model' => $redirect])->renderForm();
    }

    /**
     * @param $id
     * @param RedirectRequest $request
     * @return BaseHttpResponse
     */
    public function postEdit($id, RedirectRequest $request, BaseHttpResponse $response)
    {
        $redirect = $this->redirectRepository->findOrFail($id);

        $redirect->fill(array_merge($request->input(), [
            'is_regex' => $request->input('is_regex', 0),
            'is_active' => $request->input('is_active', 0),
        ]));

        $this->redirectRepository->createOrUpdate($redirect);

        event(new UpdatedContentEvent(REDIRECT_MODULE_SCREEN_NAME, $request, $redirect));

        return $response
            ->setPreviousUrl(route('redirect.list'))
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
            $redirect = $this->redirectRepository->findOrFail($id);

            $this->redirectRepository->delete($redirect);

            event(new DeletedContentEvent(REDIRECT_MODULE_SCREEN_NAME, $request, $redirect));

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
            $redirect = $this->redirectRepository->findOrFail($id);
            $this->redirectRepository->delete($redirect);
            event(new DeletedContentEvent(REDIRECT_MODULE_SCREEN_NAME, $request, $redirect));
        }

        return $response->setMessage(trans('core/base::notices.delete_success_message'));
    }
}
