<?php

require_once __DIR__ . '/../vendor/autoload.php';
$galleries = [];
if (is_plugin_active('gallery')) {
    $AllGallery = get_all_gallery();
    foreach ($AllGallery as $key => $val) {
        $galleries[$val->id] = $val->name;
    }
}
register_page_template([
    'default' => 'Default',
    'about' => 'About',
    'contact' => 'Contact'
]);
register_sidebar([
    'id' => 'second_sidebar',
    'name' => 'Second sidebar',
    'description' => 'This is a sample sidebar for shards theme',
]);
register_sidebar([
    'id' => 'footer_sidebar',
    'name' => 'Footer sidebar',
    'description' => 'Custom footer sidebar',
]);
register_sidebar([
    'id' => 'footer_copyright',
    'name' => 'Footer copyright',
    'description' => 'Custom footer copyright',
]);
theme_option()
    ->setArgs(['debug' => config('app.debug')])
    ->setSection([
        'title' => __('General'),
        'desc' => __('General settings'),
        'id' => 'opt-text-subsection-general',
        'subsection' => true,
        'icon' => 'fa fa-home',
    ])
    ->setSection([
        'title' => __('Logo'),
        'desc' => __('Change logo'),
        'id' => 'opt-text-subsection-logo',
        'subsection' => true,
        'icon' => 'fa fa-image',
        'fields' => [
            [
                'id' => 'logo',
                'type' => 'mediaImage',
                'label' => __('Logo'),
                'attributes' => [
                    'name' => 'logo',
                    'value' => null,
                ],
            ],
        ],
    ])
    ->setSection([
        'title' => __('Mạng xã hội'),
        'desc' => __('Mạng xã hội'),
        'id' => 'socal_network',
        'subsection' => true,
        'icon' => 'fa fa-image',
    ])
     ->setField([
        'id' => 'facebook',
        'section_id' => 'socal_network',
        'type' => 'text', // text, password, email, number
        'label' => __('Facebook'),
        'attributes' => [
            'name' => 'facebook',
            'value' => null,
            'options' => [
                'class' => 'form-control',
                'placeholder' => __('Enter link facebook'),
            ]
        ],
    ])
     ->setField([
        'id' => 'zalo',
        'section_id' => 'socal_network',
        'type' => 'text', // text, password, email, number
        'label' => __('Zalo'),
        'attributes' => [
            'name' => 'zalo',
            'value' => null,
            'options' => [
                'class' => 'form-control',
                'placeholder' => __('Enter link zalo'),
            ]
        ],
    ])
     ->setField([
        'id' => 'instagram',
        'section_id' => 'socal_network',
        'type' => 'text', // text, password, email, number
        'label' => __('Instagram'),
        'attributes' => [
            'name' => 'instagram',
            'value' => null,
            'options' => [
                'class' => 'form-control',
                'placeholder' => __('Enter link instagram'),
            ]
        ],
    ])
     ->setField([
        'id' => 'facebook-page',
        'section_id' => 'socal_network',
        'type' => 'editor', // text, password, email, number
        'label' => __('Trang Facebook'),
        'attributes' => [
            'name' => 'facebook-page',
            'value' => null,
            'options' => [
                'class' => 'form-control',
                'placeholder' => __('Enter mã nhúng trang facebook'),
            ]
        ],
    ])
    ->setSection([
        'title' => __('Banner of pages'),
        'desc' => __('Banner của các trang'),
        'id' => 'banner_of_page',
        'subsection' => true,
        'icon' => 'fa fa-image',
    ])
    ->setSection([
        'title' => __('Banner page news'),
        'desc' => __('Change banner'),
        'id' => 'banner_of_page',
        'subsection' => true,
        'icon' => 'fa fa-image',
        'fields' => [
            [
                'id' => 'banner_page_news',
                'type' => 'mediaImage',
                'label' => __('Banner page news'),
                'attributes' => [
                    'name' => 'banner-page-news',
                    'value' => null,
                ],
            ],
        ],
    ])
    ->setSection([
        'title' => __('Banner page'),
        'desc' => __('Change banner'),
        'id' => 'banner_of_page',
        'subsection' => true,
        'icon' => 'fa fa-image',
        'fields' => [
            [
                'id' => 'banner_page_about',
                'type' => 'mediaImage',
                'label' => __('Banner page about'),
                'attributes' => [
                    'name' => 'banner-page-about',
                    'value' => null,
                ],
            ],
        ],
    ])
    ->setSection([
        'title' => __('Banner page'),
        'desc' => __('Change banner'),
        'id' => 'banner_of_page',
        'subsection' => true,
        'icon' => 'fa fa-image',
        'fields' => [
            [
                'id' => 'banner_page_contact',
                'type' => 'mediaImage',
                'label' => __('Banner page contact'),
                'attributes' => [
                    'name' => 'banner-page-contact',
                    'value' => null,
                ],
            ],
        ],
    ])
    ->setField([
        'id' => 'email',
        'section_id' => 'opt-text-subsection-general',
        'type' => 'text', // text, password, email, number
        'label' => __('Email'),
        'attributes' => [
            'name' => 'email',
            'value' => null,
            'options' => [
                'class' => 'form-control',
                'placeholder' => __('Enter Email'),
            ]
        ],
    ])
   
    ->setField([
        'id' => 'Office-Phone',
        'section_id' => 'opt-text-subsection-general',
        'type' => 'text', // text, password, email, number
        'label' => __('Điện thoại'),
        'attributes' => [
            'name' => 'phone',
            'value' => null,
            'options' => [
                'class' => 'form-control',
                'placeholder' => __('Số điện thoại'),
            ]
        ],
    ])
    ->setField([
        'id' => 'cskh',
        'section_id' => 'opt-text-subsection-general',
        'type' => 'text', // text, password, email, number
        'label' => __('Điện thoại CSKH'),
        'attributes' => [
            'name' => 'cskh',
            'value' => null,
            'options' => [
                'class' => 'form-control',
                'placeholder' => __('Số điện thoại CSKH'),
            ]
        ],
    ])
    ->setField([
        'id' => 'Partner',
        'section_id' => 'opt-text-subsection-general',
        'type' => 'select', // select or customSelect
        'label' => __('Partner'),
        'attributes' => [
            'name' => 'Partner',
            'data' => $galleries,
            'value' => ' ', // default value
            'options' => [
                'class' => 'form-control',
            ],
        ],
    ])
    ->setField([
        'id' => 'Banner',
        'section_id' => 'opt-text-subsection-general',
        'type' => 'select', // select or customSelect
        'label' => __('Banner'),
        'attributes' => [
            'name' => 'Banner',
            'data' => $galleries,
            'value' => ' ', // default value
            'options' => [
                'class' => 'form-control',
            ],
        ],
    ])
    ->setField([
        'id' => 'field_name',
        'section_id' => 'opt-text-subsection-general',
        'type' => 'editor',
        'label' => __('Mô tả sản phẩm'),
        'attributes' => [
            'name' => 'description_product',
            'value' => null, // Default value
            'options' => [ // Optional
                'class' => 'form-control theme-option-textarea',
                'row' => '10',
            ],
        ],
        'helper' => __('Helper for this field (optional)'),
    ])
    ->setField([
        'id' => 'description',
        'section_id' => 'opt-text-subsection-general',
        'type' => 'textarea',
        'label' => __('Description'),
        'attributes' => [
            'name' => 'description',
            'value' => '© 2020  All right reserved.',
            'options' => [
                'class' => 'form-control',
                'placeholder' => __('Change Description'),
            ]
        ],
    ])
    ->setField([
        'id' => 'copyright',
        'section_id' => 'opt-text-subsection-general',
        'type' => 'text',
        'label' => __('Copyright'),
        'attributes' => [
            'name' => 'copyright',
            'value' => '© 2016 Botble Technologies. All right reserved. Designed by Nghia Minh',
            'options' => [
                'class' => 'form-control',
                'placeholder' => __('Change copyright'),
                'data-counter' => 120,
            ]
        ],
        'helper' => __('Copyright on footer of site'),
    ])
    ->setSection([
        'title' => __('Scripts'),
        'desc' => __('Scripts'),
        'id' => 'opt-text-subsection-script',
        'subsection' => true,
        'icon' => 'fa fa-home',
    ])
    ->setField([
        'id' => 'google_analytic_script',
        'section_id' => 'opt-text-subsection-script',
        'type' => 'textarea',
        'label' => __('Google Analytic Script'),
        'attributes' => [
            'name' => 'google_analytic_script',
            'value' => '',
            'options' => [
                'class' => 'form-control'
            ]
        ]
    ]);

function local_business()
{
    $logo = !empty(theme_option('logo')) ? url(theme_option('logo')) : Theme::asset()->url('img/logo.png');
    return '
        <script type="application/ld+json">
            {
                "@context": "http://schema.org",
                "@type": "LocalBusiness",
                "address": {
                    "@type": "PostalAddress",
                    "addressLocality": "' . setting('company_address_locality') . '",
                    "addressRegion": "' . setting('company_address_region') . '",
                    "postalCode":"' . setting('company_address_postcode') . '",
                    "streetAddress": "' . setting('company_address') . '"
                },
                "description": "' . setting('company_short_detail') . '",
                "name": "' . setting('company_name') . '",
                "telephone": "' . setting('company_phone') . '",
                "openingHours": "Mo,Tu,We,Th,Fr,Sa,Su 08:00-18:00",
                "geo": {
                    "@type": "GeoCoordinates",
                    "latitude": "' . setting('company_map_lat') . '",
                    "longitude": "' . setting('company_map_long') . '"
                },
                "image": "' . $logo . '",
                "priceRange": "$30-$50"
            }
        </script>
    ';
}

function additional_meta($collection = null)
{
    $pagination = '';
    if ($collection) {
        $pagination = '';
        if ($collection->nextPageUrl()) {
            $pagination .= '<link rel="next" href="' . $collection->nextPageUrl() . '">';
        }
        if ($collection->previousPageUrl()) {
            $pagination .= '<link rel="prev" href="' . $collection->previousPageUrl() . '">';
        }
    }

    $canonical = null;
    $currentPage = request()->get('page');
    if ($currentPage) $canonical = url()->current() . '?page=' . $currentPage;

    $localBusiness = local_business();

    $additional_meta = [];
    if ($pagination) $additional_meta['pagination'] = $pagination;
    if ($canonical) $additional_meta['canonical'] = $canonical;
    if ($localBusiness) $additional_meta['local_business'] = $localBusiness;

    return $additional_meta;
}

function add_meta_pagination($screen, $object, $collection = null)
{
    $additional_meta = additional_meta($collection);
    view()->share('additional_meta', $additional_meta);
}

add_action(BASE_ACTION_PUBLIC_RENDER_SINGLE, 'add_meta_pagination', 1, 3);

add_shortcode('contact-info', 'Contact Info', 'Contact Info', function () {
    return Theme::partial('shortcodes.contact-info');
});