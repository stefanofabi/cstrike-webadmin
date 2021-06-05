<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ban extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'steam_id',
        'ip',
        'expiration',
        'reason',
        'private_notes',
        'administrator_id',
        'server_id',
    ];
}
