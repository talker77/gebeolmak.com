<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForumComment extends Model
{
    use HasFactory;

    const STATUS_PENDING = 1;
    const STATUS_PUBLISHED = 2;
    const STATUS_REJECTED = 3;

    protected $guarded = ['id'];

    protected $appends = ['status_label'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function replied()
    {
        return $this->belongsTo(self::class, 'replied_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * get status label
     *
     * @return string|null
     */
    public function getStatusLabelAttribute()
    {
        return __('admin.modules.forum_comment.status.' . $this->status . '.title');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function forum()
    {
        return $this->belongsTo(Forum::class);
    }
}
