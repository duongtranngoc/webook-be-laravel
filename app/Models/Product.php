<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $primaryKey = 'product_id';

    protected $fillable = [
        'product_name',
        'product_image',
        'product_description',
        'product_cost',
        'product_promotional_price',
        'product_status_id',
        'factory_id',
        'author_id',
        'category_id',
        'created_at',
        'updated_at',
    ];
}
