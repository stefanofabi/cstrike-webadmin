<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Rank extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $fillable = [
        'name',
        'access_flags',
        'price',
        'purchase_link',
        'color',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'access_flags', 'price', 'purchase_link']);
    }
}
