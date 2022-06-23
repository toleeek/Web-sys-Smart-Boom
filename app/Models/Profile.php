<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model {
    protected $fillable = [
        'user_id',
        'title',
        'name',
        'email',
        'phone',
        'address',
        'comment',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() {
        return $this->belongsTo(User::class);
    }
}
