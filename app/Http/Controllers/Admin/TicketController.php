<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Enums\TicketStatus;
use App\Http\Requests\TicketUpdateStatusRequest;

class TicketController extends Controller
{
    public function index(Request $request)
    {
        $query = Ticket::with('customer')
            ->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $tickets = $query->paginate(10)->withQueryString();

        return view('admin.tickets.index', [
            'tickets' => $tickets,
            'statuses' => TicketStatus::cases(),
            'currentStatus' => $request->status,
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

    public function updateStatus(TicketUpdateStatusRequest $request, Ticket $ticket)
    {
        $status = $request->validated('status');

        $ticket->update([
            'status' => $status,
            'answered_at' => now(),
        ]);

        return redirect()
            ->route('admin.tickets.show', $ticket)
            ->with('success', 'Ticket status updated');
    }
}
