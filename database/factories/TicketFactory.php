<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Enums\TicketStatus;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'subject' => $this->faker->sentence(3),
            'message' => $this->faker->paragraph(),
            'status' => $this->faker->randomElement([
                TicketStatus::NEW->value,
                TicketStatus::IN_PROGRESS->value,
                TicketStatus::DONE->value,
            ]),
            'answered_at' => $this->faker->optional()->dateTimeBetween('-1 month', 'now'),
        ];
    }
}
