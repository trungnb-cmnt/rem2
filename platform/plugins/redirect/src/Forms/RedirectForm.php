<?php

namespace Botble\Redirect\Forms;

use Botble\Base\Forms\FormAbstract;
use Botble\Base\Enums\BaseStatusEnum;
use Botble\Redirect\Http\Requests\RedirectRequest;

class RedirectForm extends FormAbstract
{

    /**
     * @return mixed|void
     * @throws \Throwable
     */
    public function buildForm()
    {
        $this
            ->setModuleName(REDIRECT_MODULE_SCREEN_NAME)
            ->setValidatorClass(RedirectRequest::class)
            ->withCustomFields()
            ->add('url', 'text', [
                'label' => 'Url',
                'label_attr' => ['class' => 'control-label required'],
                'attr' => [
                    'placeholder'  => 'Url',
                    'data-counter' => 120,
                ],
            ])
            ->add('target', 'text', [
                'label' => 'Target',
                'label_attr' => ['class' => 'control-label required'],
                'attr' => [
                    'placeholder'  => 'Target',
                    'data-counter' => 120,
                ],
            ])
            ->add('code', 'select', [
                'label' => __('Code'),
                'label_attr' => ['class' => 'control-label required'],
                'choices' => [
                    301 => __('301'),
                    302 => __('302'),
                ],
            ])
            ->add('is_regex', 'onOff', [
                'label' => __('Is Regex'),
                'label_attr' => ['class' => 'control-label'],
                'default_value' => false,
            ])
            ->add('is_active', 'onOff', [
                'label' => __('Is Active'),
                'label_attr' => ['class' => 'control-label'],
                'default_value' => true,
            ]);
    }
}