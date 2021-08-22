<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'message',
    ];

    /**
     * Get the user associated with the message.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
