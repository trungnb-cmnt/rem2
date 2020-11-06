<?php

return [
    [
        'name' => 'GeneralConfig',
        'flag' => 'general_config.list',
    ],
    [
        'name' => 'Create',
        'flag' => 'general_config.create',
        'parent_flag' => 'general_config.list',
    ],
    [
        'name' => 'Edit',
        'flag' => 'general_config.edit',
        'parent_flag' => 'general_config.list',
    ],
    [
        'name' => 'Delete',
        'flag' => 'general_config.delete',
        'parent_flag' => 'general_config.list',
    ],
];