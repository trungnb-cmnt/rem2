<?php

namespace Botble\QuestionAndAnswer\Repositories\Eloquent;

use Botble\Support\Repositories\Eloquent\RepositoriesAbstract;
use Botble\QuestionAndAnswer\Repositories\Interfaces\QuestionAndAnswerInterface;

class QuestionAndAnswerRepository extends RepositoriesAbstract implements QuestionAndAnswerInterface
{
    /**
     * @var string
     */
    protected $screen = QUESTION_AND_ANSWER_MODULE_SCREEN_NAME;

    public function getLatest($limit = 5) {
        $data = $this->model
            ->where('status', 'published')
            ->limit($limit)
            ->select('question_and_answers.*')
            ->orderBy('question_and_answers.created_at', 'desc');

        return $this->applyBeforeExecuteQuery($data, $this->screen)->get();
    }

    /**
     * {@inheritdoc}
     */
    public function getAllQuestions($perPage = 12)
    {
        $data = $this->model->select('question_and_answers.*')->orderBy('question_and_answers.created_at', 'desc');

        return $this->applyBeforeExecuteQuery($data, $this->screen)->paginate($perPage);
    }
}
