<?php

namespace Botble\QuestionAndAnswer\Forms;

use Botble\Base\Forms\FormAbstract;
use Botble\Base\Enums\BaseStatusEnum;
use Botble\QuestionAndAnswer\Http\Requests\QuestionAndAnswerRequest;

class QuestionAndAnswerForm extends FormAbstract
{

    /**
     * @return mixed|void
     * @throws \Throwable
     */
    public function buildForm()
    {
        $this
            ->setModuleName(QUESTION_AND_ANSWER_MODULE_SCREEN_NAME)
            ->setValidatorClass(QuestionAndAnswerRequest::class)
            ->withCustomFields()
            ->add('question', 'textarea', [
                'label' => trans('plugins/question-and-answer::question-and-answer.question'),
                'label_attr' => ['class' => 'control-label required'],
                'attr' => [
                    'placeholder'  => trans('plugins/question-and-answer::question-and-answer.question'),
                ],
            ])
            ->add('answer', 'textarea', [
                'label' => trans('plugins/question-and-answer::question-and-answer.answer'),
                'label_attr' => ['class' => 'control-label required'],
                'attr' => [
                    'placeholder'  => trans('plugins/question-and-answer::question-and-answer.answer'),
                ],
            ])
            ->add('group', 'text', [
                'label' => trans('plugins/question-and-answer::question-and-answer.group'),
                'label_attr' => ['class' => 'control-label'],
                'attr' => [
                    'placeholder'  => trans('plugins/question-and-answer::question-and-answer.group'),
                    'data-counter' => 120,
                ],
            ])
            ->add('status', 'select', [
                'label'      => trans('core/base::tables.status'),
                'label_attr' => ['class' => 'control-label required'],
                'attr' => [
                    'class' => 'form-control select-full',
                ],
                'choices'    => BaseStatusEnum::labels(),
            ])
            ->setBreakFieldPoint('status');
    }
}