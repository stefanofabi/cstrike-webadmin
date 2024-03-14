<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Server extends Model
{
    use HasFactory;
    use LogsActivity;
    
    protected $fillable = [
        'name',
        'ip',
        'ranking_url',
    ];

    /**
     * Get the chat for the server.
     */
    public function gameChats()
    {
        return $this->hasMany(GameChat::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'ip']);
    }
}
