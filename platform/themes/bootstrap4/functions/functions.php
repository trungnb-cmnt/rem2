<?php

require_once __DIR__ . '/../vendor/autoload.php';

register_page_template([
    'default' => 'Default'
]);

register_sidebar([
    'id' => 'second_sidebar',
    'name' => 'Second sidebar',
    'description' => 'This is a sample sidebar for bootstrap4 theme',
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
                    "longitude": "' . setting('company_map_long') .'"
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
    view()->share( 'additional_meta', $additional_meta);
}

add_action(BASE_ACTION_PUBLIC_RENDER_SINGLE, 'add_meta_pagination', 1, 3);

add_shortcode('contact-info', 'Contact Info', 'Contact Info', function(){
    return Theme::partial('shortcodes.contact-info');
});