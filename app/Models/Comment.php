<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $guarded = ['id'];

    /**
     * Get the parent commentable model (post or video).
     */
    public function commentable()
    {
        return $this->morphTo();
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    public function getStatusTextAttribute()
    {
        return $this->status === null
            ? 'Onay bekliyor'
            : (
                $this->status == 1 ? 'Onaylandı' : 'Reddedildi'
            );
    }

}
