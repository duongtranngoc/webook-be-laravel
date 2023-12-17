<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactStatus extends Model
{
    use HasFactory;

    protected $primaryKey = 'contact_status_id';

    protected $fillable = [
        'contact_status_name',
        'created_at',
        'updated_at',
    ];
}
