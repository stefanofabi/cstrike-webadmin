<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rank extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $fillable = [
        'name',
        'access_flags',
        'price',
        'purchase_link',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'access_flags', 'price', 'purchase_link']);
    }
}
