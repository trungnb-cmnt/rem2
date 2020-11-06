<?php

namespace Botble\About\Forms;

use Botble\Base\Forms\FormAbstract;
use Botble\Base\Enums\BaseStatusEnum;
use Botble\About\Http\Requests\AboutRequest;

class AboutForm extends FormAbstract
{

    /**
     * @return mixed|void
     * @throws \Throwable
     */
    public function buildForm()
    {
        $this
            ->setModuleName(ABOUT_MODULE_SCREEN_NAME)
            ->setValidatorClass(AboutRequest::class)
            ->withCustomFields()
            ->add('name', 'text', [
                'label' => trans('core/base::forms.name'),
                'label_attr' => ['class' => 'control-label required'],
                'attr' => [
                    'placeholder'  => trans('core/base::forms.name_placeholder'),
                    'data-counter' => 120,
                ],
            ])
            ->add('content', 'editor', [
                'label' => 'Nội dung',
                'label_attr' => ['class' => 'control-label required'],
                'attr' => [
                    'placeholder'  => "Content"
                ],
            ])
            ->add('order', 'number', [
                'label' => 'Thứ tự',
                'label_attr' => ['class' => 'control-label required'],
                'attr' => [
                    'placeholder'  => "Order"
                ],
            ])
            ->add('status', 'customSelect', [
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
