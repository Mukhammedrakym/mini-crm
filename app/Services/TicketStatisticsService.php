<?php

namespace App\Services;

use App\Models\Ticket;
use Carbon\Carbon;
use InvalidArgumentException;

class TicketStatisticsService
{
    public function handle(string $period): array
    {
        $query = Ticket::query();

        $query = match ($period) {
            'day'   => $query->forDay(),
            'week'  => $query->forWeek(),
            'month' => $query->forMonth(),
            default => throw new InvalidArgumentException('Invalid period'),
        };

        return [
            'period' => $period,
            'from' => $this->fromDate($period),
            'to' => Carbon::now()->toDateString(),
            'total' => $query->count(),
            'by_status' => $query
                ->select('status')
                ->selectRaw('COUNT(*) as count')
                ->groupBy('status')
                ->pluck('count', 'status'),
        ];
    }

    private function fromDate(string $period): string
    {
        return match ($period) {
            'day' => Carbon::today()->toDateString(),
            'week' => Carbon::now()->startOfWeek()->toDateString(),
            'month' => Carbon::now()->startOfMonth()->toDateString(),
        };
    }
}
