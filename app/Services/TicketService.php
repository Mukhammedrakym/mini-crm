<?php

namespace App\Services;

use App\Models\Customer;
use App\Models\Ticket;
use App\Enums\TicketStatus;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class TicketService
{
    public function create(array $data): Ticket
    {
        return DB::transaction(function () use ($data) {

            $exists = Ticket::whereDate('created_at', Carbon::today())
                ->whereHas('customer', function ($q) use ($data) {
                    $q->where('phone', $data['phone']);

                    if (!empty($data['email'])) {
                        $q->orWhere('email', $data['email']);
                    }
                })
                ->exists();

            if ($exists) {
                throw new \DomainException('Ticket already created today');
            }

            $customer = Customer::firstOrCreate(
                ['phone' => $data['phone']],
                [
                    'name' => $data['name'],
                    'email' => $data['email'],
                ]
            );

            $ticket = Ticket::create([
                'customer_id' => $customer->id,
                'subject' => $data['subject'],
                'message' => $data['message'],
                'status' => TicketStatus::NEW,
            ]);

            if (!empty($data['files'])) {
                foreach ($data['files'] as $file) {
                    $ticket
                        ->addMedia($file)
                        ->toMediaCollection('attachments');
                }
            }

            return $ticket;
        });
    }
}
