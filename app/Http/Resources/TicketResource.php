<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TicketResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'customer' => new CustomerResource($this->customer),
            'subject' => $this->subject,
            'message' => $this->message,
            'status' => $this->status,
            'answered_at' => $this->answered_at,
            'created_at' => $this->created_at,
            'files' => $this->getMedia('attachments')->map(function ($file) {
                return [
                    'id' => $file->id,
                    'url' => $file->getUrl(),
                    'name' => $file->name,
                ];
            }),
        ];
    }
}
