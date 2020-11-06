<?php

return [
    [
        'name' => 'QuestionAndAnswer',
        'flag' => 'question_and_answer.list',
    ],
    [
        'name' => 'Create',
        'flag' => 'question_and_answer.create',
        'parent_flag' => 'question_and_answer.list',
    ],
    [
        'name' => 'Edit',
        'flag' => 'question_and_answer.edit',
        'parent_flag' => 'question_and_answer.list',
    ],
    [
        'name' => 'Delete',
        'flag' => 'question_and_answer.delete',
        'parent_flag' => 'question_and_answer.list',
    ],
];