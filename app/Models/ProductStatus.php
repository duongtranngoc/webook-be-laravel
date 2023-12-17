<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductStatus extends Model
{
    use HasFactory;

    protected $primaryKey = 'product_status_id';

    protected $fillable = [
        'product_status_name',
        'created_at',
        'updated_at',
    ];
}
