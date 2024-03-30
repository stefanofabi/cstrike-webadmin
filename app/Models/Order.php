<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'user_id', 
        'total_paid',
        'status',
        'package_id',
        'last_change'
    ];

    /**
     * Get the package associated with the order.
     */
    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    /**
     * Get the user associated with the package.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the administrators associated with the order.
     */
    public function administrators()
    {
        return $this->hasMany(Administrator::class);
    }
}
