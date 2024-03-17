<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Privilege extends Model
{
    use HasFactory;

    protected $fillable = [
        'package_id',
        'server_id',
        'rank_id',
        
    ];

    /**
     * Get the server associated with the package.
     */
    public function server()
    {
        return $this->belongsTo(Server::class);
    }

    /**
     * Get the rank associated with the package.
     */
    public function rank()
    {
        return $this->belongsTo(Rank::class);
    }

}
