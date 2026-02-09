<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;
use App\Enums\TicketStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;

class Ticket extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

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

    public function scopeFilter(Builder $query, array $filters): Builder
    {
        return $query
            ->when($filters['status'] ?? null, fn ($q, $status) =>
                $q->where('status', $status)
            )
            ->when($filters['date_from'] ?? null, fn ($q, $date) =>
                $q->whereDate('created_at', '>=', $date)
            )
            ->when($filters['date_to'] ?? null, fn ($q, $date) =>
                $q->whereDate('created_at', '<=', $date)
            )
            ->when($filters['email'] ?? null, fn ($q, $email) =>
                $q->whereHas('customer', fn ($c) =>
                    $c->where('email', 'like', "%{$email}%")
                )
            )
            ->when($filters['phone'] ?? null, fn ($q, $phone) =>
                $q->whereHas('customer', fn ($c) =>
                    $c->where('phone', 'like', "%{$phone}%")
                )
            );
    }

    public function scopeForDay(Builder $query): Builder
    {
        return $query->whereDate('created_at', Carbon::today());
    }

    public function scopeForWeek(Builder $query): Builder
    {
        return $query->whereBetween('created_at', [
            Carbon::now()->startOfWeek(),
            Carbon::now()->endOfWeek(),
        ]);
    }

    public function scopeForMonth(Builder $query): Builder
    {
        return $query
            ->whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', Carbon::now()->month);
    }
}
