<?php

namespace App\Models;

use App\User;
use App\Utils\Concerns\Models\Imageable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use MuratEnes\LaravelMetaTags\Traits\MetaTaggable;

class Blog extends Model
{
    use Imageable;
    use MetaTaggable;
    use SoftDeletes;
    use HasFactory;

    public const MODULE_NAME = 'blog';

    const TYPES = [
      'home_page_top_left_slider' => 'Anasayfa Üst Sol Slider',
      'home_page_top_right' => "Anasayfa Üst Sağ 2'li Kutu",
      'home_page_category_popular' => "Anasayfa Kategori Öne Çıkanlar",
      'home_page_bottom_tab' => "Anasayfa Alt Tab",
      'editor_picks' => "Editörün Seçtikleri",
    ];

    public const IMAGE_RESIZE = null;
    public $timestamps = true;
    public $guarded = [];
    protected $perPage = 20;
    protected $table = 'blog';

    protected $casts = [
        'tags' => 'array',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function categories()
    {
        return $this->morphToMany(Category::class, 'categorizable');
    }

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
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sub_category()
    {
        return $this->belongsTo(Category::class, 'sub_category_id', 'id');
    }

    public function getDisplayDateAttribute()
    {
        return $this->created_at->translatedFormat('d M Y');
    }

    public function getImagePathAttribute()
    {
        return imageUrl('public/blog',$this->image);
    }

    protected static function boot()
    {
        parent::boot();

        self::saving(function (self $blog) {
            return $blog->slug = createSlugFromTitleByModel($blog, $blog->title, $blog->id);
        });
    }
}
