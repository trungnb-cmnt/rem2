<?php

namespace Botble\About\Http\Controllers;

use Botble\Base\Events\BeforeEditContentEvent;
use Botble\About\Http\Requests\AboutRequest;
use Botble\About\Repositories\Interfaces\AboutInterface;
use Botble\Base\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Exception;
use Botble\About\Tables\AboutTable;
use Botble\Base\Events\CreatedContentEvent;
use Botble\Base\Events\DeletedContentEvent;
use Botble\Base\Events\UpdatedContentEvent;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\About\Forms\AboutForm;
use Botble\Base\Forms\FormBuilder;
use Botble\About\Models\About;

class AboutController extends BaseController
{
    /**
     * @var AboutInterface
     */
    protected $aboutRepository;

    /**
     * AboutController constructor.
     * @param AboutInterface $aboutRepository
     */
    public function __construct(AboutInterface $aboutRepository)
    {
        $this->aboutRepository = $aboutRepository;
    }

    /**
     * Display all abouts
     * @param AboutTable $dataTable
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function index(AboutTable $table)
    {

        page_title()->setTitle(trans('plugins/about::about.name'));

        return $table->renderTable();
    }

    /**
     * @param FormBuilder $formBuilder
     * @return string
     */
    public function create(FormBuilder $formBuilder)
    {
        page_title()->setTitle(trans('plugins/about::about.create'));

        return $formBuilder->create(AboutForm::class)->renderForm();
    }

    /**
     * Insert new About into database
     *
     * @param AboutRequest $request
     * @return BaseHttpResponse
     */
    public function store(AboutRequest $request, BaseHttpResponse $response)
    {
        $about = $this->aboutRepository->createOrUpdate($request->input());

        event(new CreatedContentEvent(ABOUT_MODULE_SCREEN_NAME, $request, $about));

        return $response
            ->setPreviousUrl(route('about.index'))
            ->setNextUrl(route('about.edit', $about->id))
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
    public function edit($id, FormBuilder $formBuilder, Request $request)
    {
        $about = $this->aboutRepository->findOrFail($id);

        event(new BeforeEditContentEvent(ABOUT_MODULE_SCREEN_NAME, $request, $about));

        page_title()->setTitle(trans('plugins/about::about.edit') . ' "' . $about->name . '"');

        return $formBuilder->create(AboutForm::class, ['model' => $about])->renderForm();
    }

    /**
     * @param $id
     * @param AboutRequest $request
     * @return BaseHttpResponse
     */
    public function update($id, AboutRequest $request, BaseHttpResponse $response)
    {
        $about = $this->aboutRepository->findOrFail($id);

        $about->fill($request->input());

        $this->aboutRepository->createOrUpdate($about);

        event(new UpdatedContentEvent(ABOUT_MODULE_SCREEN_NAME, $request, $about));

        return $response
            ->setPreviousUrl(route('about.index'))
            ->setMessage(trans('core/base::notices.update_success_message'));
    }

    /**
     * @param $id
     * @param Request $request
     * @return BaseHttpResponse
     */
    public function destroy(Request $request, $id, BaseHttpResponse $response)
    {
        try {
            $about = $this->aboutRepository->findOrFail($id);

            $this->aboutRepository->delete($about);

            event(new DeletedContentEvent(ABOUT_MODULE_SCREEN_NAME, $request, $about));

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
    public function deletes(Request $request, BaseHttpResponse $response)
    {
        $ids = $request->input('ids');
        if (empty($ids)) {
            return $response
                ->setError()
                ->setMessage(trans('core/base::notices.no_select'));
        }

        foreach ($ids as $id) {
            $about = $this->aboutRepository->findOrFail($id);
            $this->aboutRepository->delete($about);
            event(new DeletedContentEvent(ABOUT_MODULE_SCREEN_NAME, $request, $about));
        }

        return $response->setMessage(trans('core/base::notices.delete_success_message'));
    }
}