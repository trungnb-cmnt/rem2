<?php

namespace Botble\Catalog\Models;

use Botble\Base\Traits\EnumCastable;
use Botble\Base\Enums\BaseStatusEnum;
use Botble\Slug\Traits\SlugTrait;
use Eloquent;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Eloquent
{
    use SlugTrait;
    use EnumCastable;
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'catalog_categories';

    /**
     * @var string
     */
    protected $primaryKey = 'id';

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
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'parent_id',
        'icon',
        'is_featured',
        'order',
        'is_default',
        'status',
        'author_id',
        'image'
    ];

    /**
     * @var array
     */
    protected $casts = [
        'status' => BaseStatusEnum::class,
    ];

    /**
     * @var string
     */
    protected $screen = CATALOG_CATEGORY_MODULE_SCREEN_NAME;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     * @author Sang Nguyen
     */
    public function products()
    {
        return $this->belongsToMany(Product::class, 'catalog_product_categories', 'category_id', 'product_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @author Sang Nguyen
     */
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id')->withDefault();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * @author Sang Nguyen
     */
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    protected static function boot()
    {
        parent::boot();

        self::deleting(function (Category $category) {
            $category->products()->detach();
        });
    }
}
