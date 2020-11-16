<?php

namespace Botble\Catalog\Forms;

use Assets;
use Botble\Catalog\Enum\StatusEnum;
use Botble\Base\Forms\FormAbstract;
use Botble\Catalog\Forms\Fields\CategoryMultiField;
use Botble\Catalog\Http\Requests\ProductRequest;
use Botble\Catalog\Repositories\Interfaces\CategoryInterface;

class ProductForm extends FormAbstract
{

    /**
     * @var string
     */
    protected $template = 'core/base::forms.form-tabs';

    public function genSelectCat(&$categories, $category)
    {
        $categories[$category->id] = $category->indent_text . $category->name;
        if ($category->child_cats) {
            foreach ($category->child_cats as $c) {
                $this->genSelectCat($categories, $c);
            }
        }
    }

    /**
     * @return mixed|void
     * @throws \Throwable
     */
    public function buildForm()
    {
        Assets::addScripts(['typeahead', 'moment', 'datetimepicker', 'custom-admin'])
            ->addStyles(['datetimepicker']);

        $selected_categories = [];
        if ($this->getModel()) {
            $selected_categories = $this->getModel()->categories()->pluck('category_id')->all();
        }

        if (empty($selected_categories)) {
            $selected_categories = app(CategoryInterface::class)->getModel()->where(
                'is_default',
                1
            )->pluck('id')->all();
        }

        if (!$this->formHelper->hasCustomField('categoryMulti')) {
            $this->formHelper->addCustomField('categoryMulti', CategoryMultiField::class);
        }

        $categories = ['' => 'None'];
        foreach (get_catalog_categories() as $category) {
            $this->genSelectCat($categories, $category);
        }

        $this
            ->setModuleName(CATALOG_PRODUCT_MODULE_SCREEN_NAME)
            ->setValidatorClass(ProductRequest::class)
            ->withCustomFields()
            ->add('name', 'text', [
                'label'      => trans('core/base::forms.name'),
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'placeholder'  => trans('core/base::forms.name_placeholder'),
                    'data-counter' => 120,
                ],
            ])
            ->add('description', 'editor', [
                'label'      => trans('core/base::forms.description'),
                'label_attr' => ['class' => 'control-label'],
                'attr'       => [
                    'rows'         => 4,
                    'placeholder'  => trans('core/base::forms.description_placeholder'),
                ],
            ])
            ->add('is_featured', 'onOff', [
                'label'         => trans('core/base::forms.is_featured'),
                'label_attr'    => ['class' => 'control-label'],
                'default_value' => false,
            ])
            ->add('content', 'editor', [
                'label'      => trans('core/base::forms.content'),
                'label_attr' => ['class' => 'control-label'],
                'attr'       => [
                    'rows'            => 4,
                    'placeholder'     => trans('core/base::forms.description_placeholder'),
                    'with-short-code' => true,
                ],
            ])
            ->add('status', 'customSelect', [
                'label'      => trans('core/base::tables.status'),
                'label_attr' => ['class' => 'control-label required'],
                'choices'    => StatusEnum::labels(),
            ])
            ->add('code', 'text', [
                'label'      => 'Mã hàng',
                'label_attr' => ['class' => 'control-label'],
                'default_value' => '',
            ])
            ->add('origin', 'text', [
                'label'      => 'Xuất xứ',
                'label_attr' => ['class' => 'control-label'],
                'default_value' => '',
            ])
            ->add('unit', 'text', [
                'label'      => 'Đơn vị tính:',
                'label_attr' => ['class' => 'control-label'],
                'default_value' => '',
            ])
            ->add('price', 'text', [
                'label'      => 'Giá',
                'label_attr' => ['class' => 'control-label'],
                'default_value' => 1000,
            ])
            ->add('discount_price', 'text', [
                'label'      => 'Giảm Giá',
                'label_attr' => ['class' => 'control-label'],
                'default_value' => 0,
            ])
            ->add('order', 'number', [
                'label'      => trans('core/base::tables.order'),
                'label_attr' => ['class' => 'control-label'],
                'default_value' => 999,
            ])
            ->add('format_type', 'customRadio', [
                'label'      => trans('plugins/catalog::products.form.format_type'),
                'label_attr' => ['class' => 'control-label required'],
                'choices'    => get_post_formats(true),
            ])
            ->add('primary_category_id', 'select', [
                'label'      => trans('plugins/catalog::products.form.primary_category'),
                'label_attr' => ['class' => 'control-label'],
                'choices'    => $categories,
                'value'      => old('primary_category_id'),
            ])
            ->add('categories[]', 'categoryMulti', [
                'label'      => trans('plugins/catalog::products.form.categories'),
                'label_attr' => ['class' => 'control-label required'],
                'choices'    => get_catalog_categories_with_children(),
                'value'      => old('categories', $selected_categories),
            ])
            ->add('image', 'mediaImage', [
                'label'      => trans('core/base::forms.image'),
                'label_attr' => ['class' => 'control-label'],
            ])
            ->setBreakFieldPoint('status');
    }
}