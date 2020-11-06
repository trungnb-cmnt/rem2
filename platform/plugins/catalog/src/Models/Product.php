<?php

namespace Botble\Catalog\Models;

use Botble\ACL\Models\User;
use Botble\Base\Traits\EnumCastable;
use Botble\Catalog\Enum\StatusEnum;
use Botble\Revision\RevisionableTrait;
use Botble\Slug\Traits\SlugTrait;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Eloquent
{
    use RevisionableTrait;
    use SlugTrait;
    use EnumCastable;
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'catalog_products';

    /**
     * @var mixed
     */
    protected $revisionEnabled = false;

    /**
     * @var mixed
     */
    protected $revisionCleanup = true;

    /**
     * @var int
     */
    protected $historyLimit = 20;

    /**
     * @var array
     */
    protected $dontKeepRevisionOf = [
        'content',
        'views',
    ];

    /**
     * The date fields for the model.clear
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'publish_date'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'price',
        'discount_price',
        'description',
        'extra_description',
        'content',
        'image',
        'is_featured',
        'order',
        'format_type',
        'status',
        'linkBuy',
        'image_demo',
        'author_id',
        'author_type',
        'publish_date',
        'primary_category_id'
    ];

    /**
     * @var array
     */
    protected $casts = [
        'status' => StatusEnum::class,
    ];

    /**
     * @var string
     */
    protected $screen = CATALOG_PRODUCT_MODULE_SCREEN_NAME;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @author Sang Nguyen
     */
    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     * @author Sang Nguyen
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'catalog_product_categories', 'product_id', 'category_id');
    }

    public function author()
    {
        return $this->morphTo();
    }

    public function scopePublished(Builder $query)
    {
        return $query->where([
            ['catalog_products.status', StatusEnum::IN_STOCK],
        ]);
    }

    public function scopeFeatured(Builder $query)
    {
        return $query->where('catalog_products.is_featured', 1);
    }

    /**
     * @author Sang Nguyen
     */
    protected static function boot()
    {
        parent::boot();

        static::deleting(function (Product $product) {
            $product->categories()->detach();
        });
    }

    protected function newBaseQueryBuilder()
    {
        $connection = $this->getConnection();

        return new ProductQueryBuilder(
            $connection,
            $connection->getQueryGrammar(),
            $connection->getPostProcessor()
        );
    }
}