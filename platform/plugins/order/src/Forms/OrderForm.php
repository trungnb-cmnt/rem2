<?php

namespace Botble\Order\Forms;

use Botble\Base\Forms\FormAbstract;
use Botble\Order\Enum\StatusEnum;
use Botble\Order\Http\Requests\OrderRequest;
use Illuminate\Support\Facades\DB;

class OrderForm extends FormAbstract
{

    /**
     * @return mixed|void
     * @throws \Throwable
     */
    public function buildForm()
    {
        $list = get_all_products(true, 0);
        $country = $countries = DB::table('countries')->whereIn('name', ['Canada', 'United States', 'Mexico'])->get();

        $products = [];
        $newCountry = [];

        foreach ($country as $item) {
            $newCountry [$item->name] = $item->name;
        }

        foreach ($list as $row) {
            if ($this->getModel() && $this->model->id == $row->id) {
                continue;
            }
            $products[$row->id] = $row->name . ' (ID: ' . $row->id . ')';
        }
        $products = [null => __('Select one product')] + $products;

        $this
            ->setModuleName(ORDER_MODULE_SCREEN_NAME)
            ->setValidatorClass(OrderRequest::class)
            ->withCustomFields()
            ->add('product_id', 'select', [
                'label' => 'Product',
                'label_attr' => ['class' => 'control-label required'],
                'attr' => [
                    'class' => 'select-search-full',
                ],
                'choices' => $products,
            ])
            ->add('qty', 'number', [
                'label' => 'Qty',
                'label_attr' => ['class' => 'control-label required'],
            ])
            ->add('customer_name', 'text', [
                'label' => 'Customer Name',
                'label_attr' => ['class' => 'control-label'],
            ])
            ->add('customer_phone', 'text', [
                'label' => 'Customer Phone',
                'label_attr' => ['class' => 'control-label'],
            ])
            ->add('customer_email', 'text', [
                'label' => 'Customer Email',
                'label_attr' => ['class' => 'control-label required'],
            ])
            ->add('Country', 'text', [
                'label' => 'Country',
                'label_attr' => ['class' => 'control-label'],
            ])
            ->add('Province', 'text', [
                'label' => 'Province',
                'label_attr' => ['class' => 'control-label'],
            ])
            ->add('District', 'text', [
                'label' => 'District',
                'label_attr' => ['class' => 'control-label'],
            ])
            ->add('Address_Detail', 'text', [
                'label' => 'Customer Address',
                'label_attr' => ['class' => 'control-label'],
            ])
            ->add('time_to_delivery', 'select', [
                'label' => 'Time to delivery',
                'label_attr' => ['class' => 'control-label'],
                'choices' => [
                    0 => __('Out office hours'),
                    1 => __('During office hours'),
                ],
            ])
            ->add('payment_type', 'text', [
                'label' => 'Payment type',
                'label_attr' => ['class' => 'control-label'],
            ])
            ->add('content', 'textarea', [
                'label' => 'Content',
                'label_attr' => ['class' => 'control-label'],
            ])
            ->add('status', 'select', [
                'label' => trans('core/base::tables.status'),
                'label_attr' => ['class' => 'control-label required'],
                'attr' => [
                    'class' => 'form-control select-full',
                ],
                'choices' => StatusEnum::labels(),
            ])
            ->setBreakFieldPoint('status');
    }
}
