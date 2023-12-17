<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BannerStatus extends Model
{
    use HasFactory;

    protected $primaryKey = 'banner_status_id';

    protected $fillable = [
        'banner_status_name',
        'created_at',
        'updated_at',
    ];
}
