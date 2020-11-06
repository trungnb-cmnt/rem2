<?php

namespace Botble\GeneralConfig\Http\Controllers;

use Botble\Base\Events\BeforeEditContentEvent;
use Botble\GeneralConfig\Http\Requests\GeneralConfigRequest;
use Botble\GeneralConfig\Repositories\Interfaces\GeneralConfigInterface;
use Botble\Base\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Exception;
use Botble\GeneralConfig\Tables\GeneralConfigTable;
use Botble\Base\Events\CreatedContentEvent;
use Botble\Base\Events\DeletedContentEvent;
use Botble\Base\Events\UpdatedContentEvent;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\GeneralConfig\Forms\GeneralConfigForm;
use Botble\Base\Forms\FormBuilder;

class GeneralConfigController extends BaseController
{
    /**
     * @var GeneralConfigInterface
     */
    protected $generalConfigRepository;

    /**
     * GeneralConfigController constructor.
     * @param GeneralConfigInterface $generalConfigRepository
     * @author Sang Nguyen
     */
    public function __construct(GeneralConfigInterface $generalConfigRepository)
    {
        $this->generalConfigRepository = $generalConfigRepository;
    }

    /**
     * Display all general_configs
     * @param GeneralConfigTable $dataTable
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @author Sang Nguyen
     * @throws \Throwable
     */
    public function getList(GeneralConfigTable $table)
    {

        page_title()->setTitle(trans('plugins/general-config::general-config.name'));

        return $table->renderTable();
    }

    /**
     * @param FormBuilder $formBuilder
     * @return string
     * @author Sang Nguyen
     */
    public function getCreate(FormBuilder $formBuilder)
    {
        page_title()->setTitle(trans('plugins/general-config::general-config.create'));

        return $formBuilder->create(GeneralConfigForm::class)->renderForm();
    }

    /**
     * Insert new GeneralConfig into database
     *
     * @param GeneralConfigRequest $request
     * @return BaseHttpResponse
     * @author Sang Nguyen
     */
    public function postCreate(GeneralConfigRequest $request, BaseHttpResponse $response)
    {
        $general_config = $this->generalConfigRepository->createOrUpdate($request->input());

        event(new CreatedContentEvent(GENERAL_CONFIG_MODULE_SCREEN_NAME, $request, $general_config));

        return $response
            ->setPreviousUrl(route('general_config.list'))
            ->setNextUrl(route('general_config.edit', $general_config->id))
            ->setMessage(trans('core/base::notices.create_success_message'));
    }

    /**
     * Show edit form
     *
     * @param $id
     * @param Request $request
     * @param FormBuilder $formBuilder
     * @return string
     * @author Sang Nguyen
     */
    public function getEdit($id, FormBuilder $formBuilder, Request $request)
    {
        $general_config = $this->generalConfigRepository->findOrFail($id);

        event(new BeforeEditContentEvent(GENERAL_CONFIG_MODULE_SCREEN_NAME, $request, $general_config));

        page_title()->setTitle(trans('plugins/general-config::general-config.edit') . ' #' . $id);

        return $formBuilder->create(GeneralConfigForm::class, ['model' => $general_config])->renderForm();
    }

    /**
     * @param $id
     * @param GeneralConfigRequest $request
     * @return BaseHttpResponse
     * @author Sang Nguyen
     */
    public function postEdit($id, GeneralConfigRequest $request, BaseHttpResponse $response)
    {
        $general_config = $this->generalConfigRepository->findOrFail($id);

        $general_config->fill($request->input());

        $this->generalConfigRepository->createOrUpdate($general_config);

        event(new UpdatedContentEvent(GENERAL_CONFIG_MODULE_SCREEN_NAME, $request, $general_config));

        return $response
            ->setPreviousUrl(route('general_config.list'))
            ->setMessage(trans('core/base::notices.update_success_message'));
    }

    /**
     * @param $id
     * @param Request $request
     * @return BaseHttpResponse
     * @author Sang Nguyen
     */
    public function getDelete(Request $request, $id, BaseHttpResponse $response)
    {
        try {
            $general_config = $this->generalConfigRepository->findOrFail($id);

            $this->generalConfigRepository->delete($general_config);

            event(new DeletedContentEvent(GENERAL_CONFIG_MODULE_SCREEN_NAME, $request, $general_config));

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
     * @author Sang Nguyen
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
            $general_config = $this->generalConfigRepository->findOrFail($id);
            $this->generalConfigRepository->delete($general_config);
            event(new DeletedContentEvent(GENERAL_CONFIG_MODULE_SCREEN_NAME, $request, $general_config));
        }

        return $response->setMessage(trans('core/base::notices.delete_success_message'));
    }
}
