<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TicketStatisticsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'period' => $this['period'],
            'from' => $this['from'],
            'to' => $this['to'],
            'total' => $this['total'],
            'by_status' => $this['by_status'],
        ];
    }
}
