<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TicketStatisticsController extends Controller
{
    public function index(TicketStatisticsService $ticketStatisticsService)
    {
        return response()->json($ticketStatisticsService->get());
    }
}
