<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TicketResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'email' => $this->email,
            'name' => $this->name,
            'title' => $this->title,
            'description' => $this->description,
            'status' => $this->status,
            'assign_at' => $this->assign_at,
            'ticket_type' => $this->ticketType ? $this->ticketType->name : null,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}