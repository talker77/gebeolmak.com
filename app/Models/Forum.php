<?php

namespace App\Models;

use App\Repositories\Traits\Cachable;
use App\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use MuratEnes\LaravelMetaTags\Traits\MetaTaggable;

class Forum extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Cachable;
    use MetaTaggable;

    public const MODULE_NAME = 'forum';

    const STATUS_PENDING = 1;
    const STATUS_PUBLISHED = 2;
    const STATUS_REJECTED = 3;

    protected $casts = [
        'tags' => 'array',
    ];


    protected $guarded = ['id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function writer()
    {
        return $this->belongsTo(User::class, 'writer_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(ForumComment::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function active_comments()
    {
        return $this->hasMany(ForumComment::class)->where('status',ForumComment::STATUS_PUBLISHED);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sub_category()
    {
        return $this->belongsTo(Category::class, 'sub_category_id', 'id');
    }

    /**
     * get status label
     *
     * @return string|null
     */
    public function getStatusLabelAttribute()
    {
        return __('admin.modules.forum.status.' . $this->status . '.title');
    }

    /**
     * Get the follows.
     */
    public function follows()
    {
        return $this->morphMany(Follow::class, 'followable');
    }

    protected static function boot()
    {
        parent::boot();

        self::saving(function (self $forum) {
            return $forum->slug = createSlugFromTitleByModel($forum, $forum->title, $forum->id);
        });
    }

}
