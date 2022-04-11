<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    /**
     * Get the owning followable model.
     */
    public function followable()
    {
        return $this->morphTo();
    }
}
