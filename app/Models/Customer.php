<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Ticket;

class Customer extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'email',
    ];

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
