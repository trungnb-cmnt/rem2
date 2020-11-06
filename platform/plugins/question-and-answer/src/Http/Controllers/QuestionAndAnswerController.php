<?php

namespace Botble\QuestionAndAnswer\Http\Controllers;

use Botble\Base\Events\BeforeEditContentEvent;
use Botble\QuestionAndAnswer\Http\Requests\QuestionAndAnswerRequest;
use Botble\QuestionAndAnswer\Repositories\Interfaces\QuestionAndAnswerInterface;
use Botble\Base\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Exception;
use Botble\QuestionAndAnswer\Tables\QuestionAndAnswerTable;
use Botble\Base\Events\CreatedContentEvent;
use Botble\Base\Events\DeletedContentEvent;
use Botble\Base\Events\UpdatedContentEvent;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\QuestionAndAnswer\Forms\QuestionAndAnswerForm;
use Botble\Base\Forms\FormBuilder;

class QuestionAndAnswerController extends BaseController
{
    /**
     * @var QuestionAndAnswerInterface
     */
    protected $questionAndAnswerRepository;

    /**
     * QuestionAndAnswerController constructor.
     * @param QuestionAndAnswerInterface $questionAndAnswerRepository
     */
    public function __construct(QuestionAndAnswerInterface $questionAndAnswerRepository)
    {
        $this->questionAndAnswerRepository = $questionAndAnswerRepository;
    }

    /**
     * Display all question_and_answers
     * @param QuestionAndAnswerTable $dataTable
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function getList(QuestionAndAnswerTable $table)
    {

        page_title()->setTitle(trans('plugins/question-and-answer::question-and-answer.question'));

        return $table->renderTable();
    }

    /**
     * @param FormBuilder $formBuilder
     * @return string
     */
    public function getCreate(FormBuilder $formBuilder)
    {
        page_title()->setTitle(trans('plugins/question-and-answer::question-and-answer.create'));

        return $formBuilder->create(QuestionAndAnswerForm::class)->renderForm();
    }

    /**
     * Insert new QuestionAndAnswer into database
     *
     * @param QuestionAndAnswerRequest $request
     * @return BaseHttpResponse
     */
    public function postCreate(QuestionAndAnswerRequest $request, BaseHttpResponse $response)
    {
        $question_and_answer = $this->questionAndAnswerRepository->createOrUpdate($request->input());

        event(new CreatedContentEvent(QUESTION_AND_ANSWER_MODULE_SCREEN_NAME, $request, $question_and_answer));

        return $response
            ->setPreviousUrl(route('question_and_answer.list'))
            ->setNextUrl(route('question_and_answer.edit', $question_and_answer->id))
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
        $question_and_answer = $this->questionAndAnswerRepository->findOrFail($id);

        event(new BeforeEditContentEvent(QUESTION_AND_ANSWER_MODULE_SCREEN_NAME, $request, $question_and_answer));

        page_title()->setTitle(trans('plugins/question-and-answer::question-and-answer.edit') . ' "' . $question_and_answer->name . '"');

        return $formBuilder->create(QuestionAndAnswerForm::class, ['model' => $question_and_answer])->renderForm();
    }

    /**
     * @param $id
     * @param QuestionAndAnswerRequest $request
     * @return BaseHttpResponse
     */
    public function postEdit($id, QuestionAndAnswerRequest $request, BaseHttpResponse $response)
    {
        $question_and_answer = $this->questionAndAnswerRepository->findOrFail($id);

        $question_and_answer->fill($request->input());

        $this->questionAndAnswerRepository->createOrUpdate($question_and_answer);

        event(new UpdatedContentEvent(QUESTION_AND_ANSWER_MODULE_SCREEN_NAME, $request, $question_and_answer));

        return $response
            ->setPreviousUrl(route('question_and_answer.list'))
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
            $question_and_answer = $this->questionAndAnswerRepository->findOrFail($id);

            $this->questionAndAnswerRepository->delete($question_and_answer);

            event(new DeletedContentEvent(QUESTION_AND_ANSWER_MODULE_SCREEN_NAME, $request, $question_and_answer));

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
            $question_and_answer = $this->questionAndAnswerRepository->findOrFail($id);
            $this->questionAndAnswerRepository->delete($question_and_answer);
            event(new DeletedContentEvent(QUESTION_AND_ANSWER_MODULE_SCREEN_NAME, $request, $question_and_answer));
        }

        return $response->setMessage(trans('core/base::notices.delete_success_message'));
    }
}
