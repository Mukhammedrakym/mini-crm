<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Ticket;
use App\Enums\TicketStatus;
use App\Models\Customer;

class TicketStatisticsTest extends TestCase
{
    use RefreshDatabase;

    public function test_statistics_can_be_get(): void
    {
        $customer = Customer::factory()->create();

        Ticket::factory()
            ->count(3)
            ->for($customer)
            ->create([
                'status' => TicketStatus::NEW,
                'created_at' => now(),
            ]);

        $response = $this->getJson('/api/tickets/statistics?period=day');

        $response
            ->assertOk()
            ->assertJsonStructure([
                'data' => [
                    'period',
                    'from',
                    'to',
                    'total',
                    'by_status',
                ],
            ])
            ->assertJson([
                'data' => [
                    'period' => 'day',
                    'total' => 3,
                ],
            ]);
    }
}
