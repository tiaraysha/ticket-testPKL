<?php

namespace App\Services;

use App\Repositories\TicketRepository;
use App\Models\Ticket;
use App\Models\TicketType;

class TicketService
{
    protected $ticketRepository;

    public function __construct(TicketRepository $ticketRepository)
    {
        $this->ticketRepository = $ticketRepository;
    }

    public function index()
    {
        return $this->ticketRepository->getAllTicket();
    }

    public function store(array $data)
{
    $ticketType = TicketType::where('name', $data['ticket_type'])->first();
    if (!$ticketType) {
        throw new \Exception("Invalid ticket type.");
    }

    $ticket = Ticket::create([
        'email' => $data['email'],
        'title' => $data['title'],
        'description' => $data['description'],
        'ticket_type_id' => $ticketType->id,
        'status' => $data['status'],
        'assign_at' => $data['assign_at'],
    ]);

    return $ticket;
}

    public function update($id, array $data)
    {
        return $this->ticketRepository->updateTicket($id, $data);
    }

    public function delete($id)
    {
        return $this->ticketRepository->deleteTicket($id);
    }
}
