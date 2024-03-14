<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Administrator extends Model
{
    use HasFactory;
    use LogsActivity;
    
    protected $fillable = [
        'name',
        'auth',
        'password',
        'account_flags',
        'rank_id',
        'expiration',
        'user_id',
        'suspended',
        'server_id',

    ];

    /**
     * Get the rank associated with the administrator.
     */
    public function rank()
    {
        return $this->belongsTo(Rank::class);
    }

    /**
     * Get the privileges for the administrator.
     */
    public function privileges()
    {
        return $this->hasMany(Privilege::class);
    }

    /**
     * Get the user associated with the administrator.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the server associated with the administrator.
     */
    public function server()
    {
        return $this->belongsTo(Server::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'auth', 'expiration']);
    }
}
