<?php

return [
    [
        'name' => 'Redirect',
        'flag' => 'redirect.list',
    ],
    [
        'name' => 'Create',
        'flag' => 'redirect.create',
        'parent_flag' => 'redirect.list',
    ],
    [
        'name' => 'Edit',
        'flag' => 'redirect.edit',
        'parent_flag' => 'redirect.list',
    ],
    [
        'name' => 'Delete',
        'flag' => 'redirect.delete',
        'parent_flag' => 'redirect.list',
    ],
];