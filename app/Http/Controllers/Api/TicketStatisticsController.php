<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\TicketStatisticsService;
use App\Http\Requests\TicketStatisticsRequest;
use App\Http\Resources\TicketStatisticsResource;

class TicketStatisticsController extends Controller
{
    public function index(TicketStatisticsRequest $request, TicketStatisticsService $ticketStatisticsService)
    {
        return new TicketStatisticsResource(
            $ticketStatisticsService->handle($request->validated('period'))
        );
    }
}
