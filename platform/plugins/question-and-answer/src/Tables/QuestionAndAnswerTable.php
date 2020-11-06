<?php

namespace Botble\QuestionAndAnswer\Tables;

use Auth;
use Botble\Base\Enums\BaseStatusEnum;
use Botble\QuestionAndAnswer\Repositories\Interfaces\QuestionAndAnswerInterface;
use Botble\Table\Abstracts\TableAbstract;
use Illuminate\Contracts\Routing\UrlGenerator;
use Yajra\DataTables\DataTables;

class QuestionAndAnswerTable extends TableAbstract
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
     * QuestionAndAnswerTable constructor.
     * @param DataTables $table
     * @param UrlGenerator $urlDevTool
     * @param QuestionAndAnswerInterface $questionAndAnswerRepository
     */
    public function __construct(DataTables $table, UrlGenerator $urlDevTool, QuestionAndAnswerInterface $questionAndAnswerRepository)
    {
        $this->repository = $questionAndAnswerRepository;
        $this->setOption('id', 'table-plugins-question_and_answer');
        parent::__construct($table, $urlDevTool);

        if (!Auth::user()->hasAnyPermission(['question_and_answer.edit', 'question_and_answer.delete'])) {
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
                if (!Auth::user()->hasPermission('question_and_answer.edit')) {
                    return $item->name;
                }
                return anchor_link(route('question_and_answer.edit', $item->id), $item->name);
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

        return apply_filters(BASE_FILTER_GET_LIST_DATA, $data, QUESTION_AND_ANSWER_MODULE_SCREEN_NAME)
            ->addColumn('operations', function ($item) {
                return table_actions('question_and_answer.edit', 'question_and_answer.delete', $item);
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
            'question_and_answers.id',
            'question_and_answers.question',
            'question_and_answers.answer',
            'question_and_answers.group',
            'question_and_answers.created_at',
            'question_and_answers.status',
        ]);

        return $this->applyScopes(apply_filters(BASE_FILTER_TABLE_QUERY, $query, $model, QUESTION_AND_ANSWER_MODULE_SCREEN_NAME));
    }

    /**
     * @return array
     * @since 2.1
     */
    public function columns()
    {
        return [
            'id' => [
                'name' => 'question_and_answers.id',
                'title' => trans('core/base::tables.id'),
                'width' => '20px',
            ],
            'question' => [
                'name' => 'question_and_answers.question',
                'title' => trans('plugins/question-and-answer::question-and-answer.question'),
                'class' => 'text-left',
            ],
            'answer' => [
                'name' => 'question_and_answers.answer',
                'title' => trans('plugins/question-and-answer::question-and-answer.answer'),
                'class' => 'text-left',
            ],
            'group' => [
                'name' => 'question_and_answers.group',
                'title' => trans('plugins/question-and-answer::question-and-answer.group'),
                'class' => 'text-left',
            ],
            'created_at' => [
                'name' => 'question_and_answers.created_at',
                'title' => trans('core/base::tables.created_at'),
                'width' => '100px',
            ],
            'status' => [
                'name' => 'question_and_answers.status',
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
        $buttons = $this->addCreateButton(route('question_and_answer.create'), 'question_and_answer.create');

        return apply_filters(BASE_FILTER_TABLE_BUTTONS, $buttons, QUESTION_AND_ANSWER_MODULE_SCREEN_NAME);
    }

    /**
     * @return array
     * @throws \Throwable
     */
    public function bulkActions(): array
    {
        return $this->addDeleteAction(route('question_and_answer.delete.many'), 'question_and_answer.delete', parent::bulkActions());
    }

    /**
     * @return array
     */
    public function getBulkChanges(): array
    {
        return [
//            'question_and_answers.name' => [
//                'title'    => trans('core/base::tables.name'),
//                'type'     => 'text',
//                'validate' => 'required|max:120',
//                'callback' => 'getNames',
//            ],
            'question_and_answers.status' => [
                'title'    => trans('core/base::tables.status'),
                'type'     => 'select',
                'choices'  => BaseStatusEnum::labels(),
                'validate' => 'required|in:' . implode(',', BaseStatusEnum::values()),
            ],
            'question_and_answers.created_at' => [
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
        return $this->repository->pluck('question_and_answers.name', 'question_and_answers.id');
    }
}
