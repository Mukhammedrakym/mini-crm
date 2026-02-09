<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TicketLimitTest extends TestCase
{
    use RefreshDatabase;

    public function test_one_ticket_can_be_created_per_day(): void
    {
        $payload = [
            'name' => 'Test Name 2',
            'phone' => '+77777777770',
            'email' => 'test2@test.kz',
            'subject' => 'Test subject 2',
            'message' => 'Test message 2',
            'files' => []
        ];
        
        $response = $this->postJson('/api/tickets', $payload)->assertStatus(201);

        $response = $this->postJson('/api/tickets', $payload)
        ->assertStatus(422)
        ->assertJson([
            'message' => 'Ticket already created today',
        ]);

    }
}
