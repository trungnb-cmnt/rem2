<?php

namespace Botble\Order\Models;

use Botble\Base\Traits\EnumCastable;
use Botble\Order\Enum\StatusEnum;
use Botble\Catalog\Models\Product;
use Eloquent;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Botble\Order\Models\Order
 *
 * @mixin \Eloquent
 */
class Order extends Eloquent
{
    use EnumCastable;
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'orders';

    /**
     * @var array
     */
    protected $fillable = [
        'product_id',
        'qty',
        'customer_name',
        'customer_phone',
        'customer_email',
        'customer_address',
        'content',
        'status',
        'Country',
        'Province',
        'District',
        'Address_Detail',
        'time_to_delivery',
        'payment_type',
        'description',
    ];

    /**
     * @var string
     */
    protected $screen = ORDER_MODULE_SCREEN_NAME;

    /**
     * @var array
     */
    protected $casts = [
        'status' => StatusEnum::class,
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
