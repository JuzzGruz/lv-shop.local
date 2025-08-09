<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'phone',
        'address',
        'comment',
        'status',
        'amount',
    ];
    
    public const STATUS = [
        0 => 'Новый',
        1 => 'Обработан',
        2 => 'Оплачен',
        3 => 'Доставлен',
        4 => 'Завершен',
    ];

    /*
    *   Связь «один ко многим» таблицы `orders` с таблицей `order_items`
    */
    public function items() : HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
