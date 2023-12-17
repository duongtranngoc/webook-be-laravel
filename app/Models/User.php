<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

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
