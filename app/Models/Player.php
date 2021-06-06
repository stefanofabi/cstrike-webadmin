<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;

    /**
     * Get the server associated with the player.
     */
    public function server()
    {
        return $this->belongsTo(Server::class);
    }
}
