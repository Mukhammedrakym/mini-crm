<?php

namespace App\Services;

use App\Models\Ticket;
use Carbon\Carbon;

class TicketStatisticsService
{
    public function get(): array
    {
        return [
            'today' => $this->countToday(),
            'week'  => $this->countThisWeek(),
            'month' => $this->countThisMonth(),
        ];
    }

    protected function countToday(): int
    {
        return Ticket::whereDate('created_at', Carbon::today())->count();
    }

    protected function countThisWeek(): int
    {
        return Ticket::whereBetween('created_at', [
            Carbon::now()->startOfWeek(),
            Carbon::now()->endOfWeek(),
        ])->count();
    }

    protected function countThisMonth(): int
    {
        return Ticket::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();
    }
}
