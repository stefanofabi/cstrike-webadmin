<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Ban extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $fillable = [
        'name',
        'steam_id',
        'ip',
        'expiration',
        'reason',
        'private_notes',
    ];

    protected $casts = [
        'expiration' => 'datetime:Y-m-d\TH:i',
    ];

    /**
     * Get the administrator associated with the ban.
     */
    public function administrator()
    {
        return $this->belongsTo(Administrator::class);
    }

    /**
     * Get the server associated with the ban.
     */
    public function server()
    {
        return $this->belongsTo(Server::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'steam_id', 'ip', 'expiration', 'reason', 'private_notes']);
    }
}
