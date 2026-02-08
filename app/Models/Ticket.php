<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;
use App\Enums\TicketStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'subject',
        'message',
        'status',
        'answered_at',
    ];

    protected $casts = [
        'answered_at' => 'datetime',
        'status' => TicketStatus::class,
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
