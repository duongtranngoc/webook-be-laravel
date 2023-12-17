<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    protected $primaryKey = 'banner_id';

    protected $fillable = [
        'banner_image',
        'banner_index',
        'banner_status_id',
        'created_at',
        'updated_at',
    ];
}
