<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, HasApiTokens;

    protected $primaryKey = 'user_id';

    protected $fillable = [
        'user_username',
        'user_password',
        'user_full_name',
        'user_phone_number',
        'user_address',
        'created_at',
        'updated_at',
    ];
}
