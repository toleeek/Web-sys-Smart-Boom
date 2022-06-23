<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Order extends Model {
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'phone',
        'address',
        'comment',
        'amount',
        'status',
    ];

    public const STATUSES = [
        0 => 'Новий',
        1 => 'Оброблений',
        2 => 'Оплачений',
        3 => 'Доставлений',
        4 => 'Завершений',
    ];

    /**
     * @param $value
     * @return \Carbon\Carbon|false
     */
    public function getCreatedAtAttribute($value) {
        return Carbon::createFromFormat('Y-m-d H:i:s', $value)->timezone('Europe/Moscow');
    }

    /**
     * @param $value
     * @return \Carbon\Carbon|false
     */
    public function getUpdatedAtAttribute($value) {
        return Carbon::createFromFormat('Y-m-d H:i:s', $value)->timezone('Europe/Moscow');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items() {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() {
        return $this->belongsTo(User::class);
    }
}
