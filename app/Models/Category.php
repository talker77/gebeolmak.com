<?php

namespace App\Models;

use App\Repositories\Traits\Cachable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use MuratEnes\LaravelMetaTags\Traits\MetaTaggable;

class Category extends Model
{
    use Cachable;
    use HasFactory;
    use MetaTaggable;

    public const TYPES = [
        \App\Models\Blog::class,
        \App\Models\Forum::class,
//        \App\Models\Content::class,
    ];

    protected $guarded = ['id'];

    protected $appends = ['type_label'];

    /**
     * Get all of the banners that are assigned this tag.
     */
    public function banners(): \Illuminate\Database\Eloquent\Relations\MorphToMany
    {
        return $this->morphedByMany(Banner::class, 'categorizable');
    }

//    /**
//     * üst kategori forum bağlantısını getir
//     */
//    public function forums()
//    {
//        return $this->hasMany(Forum::class, 'category_id', 'id');
//    }

    /**
     * alt kategori forum bağlantısını getir
     */
    public function sub_category_forums()
    {
        return $this->hasMany(Forum::class, 'sub_category_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sub_categories()
    {
        return $this->hasMany(self::class, 'parent_category_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sub_categories_active()
    {
        return $this->hasMany(self::class, 'parent_category_id', 'id')->where('is_active', 1);
    }

    /**
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    function forums()
    {
        return $this->hasManyThrough(Forum::class, Category::class, 'id', 'category_id', 'id', 'id');
    }

    /**
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    function blogs()
    {
        return $this->hasManyThrough(Blog::class, Category::class, 'id', 'category_id', 'id', 'id');
    }

    /**
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    function last_active_blogs()
    {
        return $this->hasManyThrough(Blog::class, Category::class, 'id', 'category_id', 'id', 'id')
            ->where('blog.is_active',true)->take(40)->latest('updated_at');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    function forums_active()
    {
        return $this->hasManyThrough(Forum::class, Category::class, 'id', 'category_id', 'id', 'id')
            ->where('status', Forum::STATUS_PUBLISHED);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    function forums_active_comments()
    {
        return $this->hasManyThrough(Forum::class, Category::class, 'id', 'category_id', 'id', 'id')
            ->hasMany(ForumComment::class)->where('status',ForumComment::STATUS_PUBLISHED);
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent_category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_category_id', 'id');
    }

    /**
     * get type label.
     *
     * @return string
     */
    public function getTypeLabelAttribute()
    {
        return __('admin.modules.category.' . $this->categorizable_type . '.title');
    }

    protected static function boot()
    {
        parent::boot();

        self::creating(function (self $category) {
            return $category->slug = createSlugFromTitleByModel($category, $category->title, $category->id);
        });
    }
}
