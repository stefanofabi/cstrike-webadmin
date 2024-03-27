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
    
    protected $guarded = [
        'name',
        'account_flags',
        'status',
        'rank_id',
        'server_id',
        'user_id',
        'order_id',
        'suspended',

    ];

    /**
     * Get the rank associated with the administrator.
     */
    public function rank()
    {
        return $this->belongsTo(Rank::class);
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

    /**
     * Get the order associated with the administrator.
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'auth', 'expiration']);
    }
}
