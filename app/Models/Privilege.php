<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Privilege extends Model
{
    use HasFactory;

    protected $fillable = [
        'administrator_id',
        'server_id',
    ];
    
    /**
     * Get the server associated with the privilege.
     */
    public function server()
    {
        return $this->belongsTo(Server::class);
    }
}
