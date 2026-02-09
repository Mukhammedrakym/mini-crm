<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Ticket;

class CreateTicketTest extends TestCase
{
    use RefreshDatabase;

    public function test_ticket_can_be_created(): void
    {
        $response = $this->postJson('/api/tickets', [
            'name' => 'Test Name',
            'phone' => '+77777777777',
            'email' => 'test@test.kz',
            'subject' => 'Test subject',
            'message' => 'Test message',
            'files' => []
        ]);

        $response->assertStatus(201);

        $this->assertDatabaseHas('tickets', [
            'subject' => 'Test subject',
        ]);

        $this->assertDatabaseHas('customers', [
            'phone' => '+77777777777',
        ]);
    }
}
