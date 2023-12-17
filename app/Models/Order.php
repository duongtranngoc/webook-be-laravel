<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $primaryKey = 'order_id';

    protected $fillable = [
        'order_date',
        'order_status_id',
        'cart_id',
        'user_id',
        'seller_id',
        'created_at',
        'updated_at',
    ];
}
