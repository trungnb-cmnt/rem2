<?php

namespace Botble\About\Models;

use Botble\Base\Traits\EnumCastable;
use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Models\BaseModel;

class About extends BaseModel
{
    use EnumCastable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'abouts';

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'content',
        'order',
        'status',
    ];

    /**
     * @var string
     */
    protected $screen = ABOUT_MODULE_SCREEN_NAME;

    /**
     * @var array
     */
    protected $casts = [
        'status' => BaseStatusEnum::class,
    ];
}
