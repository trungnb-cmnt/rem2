<?php

namespace Botble\Redirect\Models;

use Eloquent;

/**
 * Botble\Redirect\Models\Redirect
 *
 * @mixin \Eloquent
 */
class Redirect extends Eloquent
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'redirects';

    /**
     * @var array
     */
    protected $fillable = [
        'url',
        'target',
        'code',
        'is_regex',
        'is_active',
    ];

    /**
     * @var string
     */
    protected $screen = REDIRECT_MODULE_SCREEN_NAME;

    public static function boot()
    {
        parent::boot();

        self::creating(function($model){
            $model->url = rtrim(ltrim($model->url, '/'), '/');
            $model->target = rtrim(ltrim($model->target, '/'), '/');
        });

        self::updating(function($model){
            $model->url = rtrim(ltrim($model->url, '/'), '/');
            $model->target = rtrim(ltrim($model->target, '/'), '/');
        });
    }

}
