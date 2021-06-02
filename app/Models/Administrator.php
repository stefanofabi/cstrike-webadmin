<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administrator extends Model
{
    use HasFactory;

    /**
     * Get the rank associated with the administrator.
     */
    public function rank()
    {
        return $this->belongsTo(Rank::class);
    }
}
