<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $primaryKey = 'contact_id';

    protected $fillable = [
        'contact_facebook',
        'contact_instagram',
        'contact_twiter',
        'contact_youtube',
        'contact_google',
        'contact_pinterest',
        'contact_email',
        'contact_phone_number',
        'contact_address',
        'contact_status_id',
        'created_at',
        'updated_at',
    ];
}
