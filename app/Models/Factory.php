<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factory extends Model
{
    use HasFactory;

    protected $primaryKey = 'factory_id';

    protected $fillable = [
        'factory_name',
        'factory_phone_number',
        'factory_address',
        'created_at',
        'updated_at',
    ];
}
