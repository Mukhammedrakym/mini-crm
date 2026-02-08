<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Http\Resources\TicketResource;
use App\Http\Requests\TicketStoreRequest;
use App\Services\TicketService;

class TicketController extends Controller
{
    
    public function store(TicketStoreRequest $request, TicketService $ticketService)
    {
        try {
            $ticket = $ticketService->create($request->validated());

            return (new TicketResource($ticket))
            ->response()
            ->setStatusCode(201);
            
        } catch (\DomainException $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 422);
        }
    }
    
    
}


