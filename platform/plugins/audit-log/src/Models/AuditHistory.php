<?php

namespace Botble\AuditLog\Models;

use Botble\ACL\Models\User;
use Botble\Base\Models\BaseModel;

class AuditHistory extends BaseModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'audit_histories';

    /**
     * The date fields for the model.clear
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * @var array
     */
    protected $fillable = [
        'user_agent',
        'ip_address',
        'module',
        'action',
        'user_id',
        'reference_user',
        'reference_id',
        'reference_name',
        'type',
        'request',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     *
     */
    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }
}