<?php

namespace Botble\Blog\Models;

use Botble\ACL\Models\User;
use Botble\Base\Traits\EnumCastable;
use Botble\Base\Enums\BaseStatusEnum;
use Botble\Revision\RevisionableTrait;
use Botble\Slug\Traits\SlugTrait;
use Botble\Base\Models\BaseModel;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class Post extends BaseModel
{
    use RevisionableTrait;
    use SlugTrait;
    use EnumCastable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'posts';

    /**
     * @var mixed
     */
    protected $revisionEnabled = true;

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
        'description',
        'content',
        'image',
        'is_featured',
        'format_type',
        'status',
        'author_id',
        'author_type',
        'publish_date',
        'primary_category_id'
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
    protected $screen = POST_MODULE_SCREEN_NAME;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tags');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'post_categories');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function author()
    {
        return $this->morphTo();
    }

    public function scopePublished(Builder $query)
    {
        return $query->where([
            ['posts.status', BaseStatusEnum::PUBLISHED],
            ['posts.publish_date', '<=', Carbon::now()->toDateTimeString()]
        ])->orWhere([
            ['posts.status', BaseStatusEnum::PUBLISHED],
            ['posts.publish_date', null]
        ]);
    }

    public function scopeFeatured(Builder $query)
    {
        return $query->where('posts.is_featured', 1);
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function (Post $post) {
            $post->categories()->detach();
            $post->tags()->detach();
        });
    }
}
