<?php

namespace Botble\GeneralConfig\Models;

use Botble\Base\Traits\EnumCastable;
use Botble\Base\Enums\BaseStatusEnum;
use Eloquent;

/**
 * Botble\GeneralConfig\Models\GeneralConfig
 *
 * @mixin \Eloquent
 */
class GeneralConfig extends Eloquent
{
    use EnumCastable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'general_configs';

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'status',
    ];

    /**
     * @var string
     */
    protected $screen = GENERAL_CONFIG_MODULE_SCREEN_NAME;

    /**
     * @var array
     */
    protected $casts = [
        'status' => BaseStatusEnum::class,
    ];
}
