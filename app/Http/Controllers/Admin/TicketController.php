<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Enums\TicketStatus;
use App\Http\Requests\TicketUpdateStatusRequest;
use App\Services\TicketService;

class TicketController extends Controller
{
    public function index(Request $request, TicketService $service)
    {
        return view('admin.tickets.index', [
            'tickets' => $service->paginateForAdmin(
                $request->only(['status', 'date_from', 'date_to', 'email', 'phone'])
            ),
            'statuses' => TicketStatus::cases(),
            'filters' => $request->all(),
        ]);
    }


    public function show(Ticket $ticket)
    {
        $ticket->load('customer', 'media');

        return view('admin.tickets.show', [
            'ticket' => $ticket,
            'statuses' => TicketStatus::cases(),
        ]);
    }

    public function updateStatus(TicketUpdateStatusRequest $request, Ticket $ticket, TicketService $ticketService) 
    {
        $ticketService->updateStatus(
            $ticket,
            $request->validated('status')
        );
    
        return redirect()
            ->route('admin.tickets.show', $ticket)
            ->with('success', 'Ticket status updated');
    }
}
