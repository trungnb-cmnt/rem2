<?php

return [
    [
        'name' => 'Catalog',
        'flag' => 'plugins/catalog',
    ],
    [
        'name'        => 'Products',
        'flag'        => 'catalog_products.list',
        'parent_flag' => 'plugins/catalog',
    ],
    [
        'name'        => 'Create',
        'flag'        => 'catalog_products.create',
        'parent_flag' => 'catalog_products.list',
    ],
    [
        'name'        => 'Edit',
        'flag'        => 'catalog_products.edit',
        'parent_flag' => 'catalog_products.list',
    ],
    [
        'name'        => 'Delete',
        'flag'        => 'catalog_products.delete',
        'parent_flag' => 'catalog_products.list',
    ],

    [
        'name'        => 'Categories',
        'flag'        => 'catalog_categories.list',
        'parent_flag' => 'plugins/catalog',
    ],
    [
        'name'        => 'Create',
        'flag'        => 'catalog_categories.create',
        'parent_flag' => 'catalog_categories.list',
    ],
    [
        'name'        => 'Edit',
        'flag'        => 'catalog_categories.edit',
        'parent_flag' => 'catalog_categories.list',
    ],
    [
        'name'        => 'Delete',
        'flag'        => 'catalog_categories.delete',
        'parent_flag' => 'catalog_categories.list',
    ],
];
