<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        
    ];

    /**
     * Get the privileges for the package.
     */
    public function privileges()
    {
        return $this->hasMany(Privilege::class);
    }
}
