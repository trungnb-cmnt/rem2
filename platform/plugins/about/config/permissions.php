<?php

return [
    [
        'name' => 'About',
        'flag' => 'about.index',
    ],
    [
        'name' => 'Create',
        'flag' => 'about.create',
        'parent_flag' => 'about.index',
    ],
    [
        'name' => 'Edit',
        'flag' => 'about.edit',
        'parent_flag' => 'about.index',
    ],
    [
        'name' => 'Delete',
        'flag' => 'about.destroy',
        'parent_flag' => 'about.index',
    ],
];