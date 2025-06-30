<?php

namespace App\Repositories;

use App\Models\Ticket;

class TicketRepository
{
    public function getAllTicket()
    {
        return Ticket::with('ticketType')->get();
    }

    public function storeNewTicket(array $data)
    {
        return Ticket::create($data);
    }

    public function updateTicket($id, array $data)
    {
        Ticket::where('id', $id)->update($data);
        return Ticket::find($id);
    }

    public function deleteTicket($id)
    {
        $ticket = Ticket::find($id);
        if ($ticket->status !== 'cancel') {
            throw new \Exception("Tiket hanya bisa dihapus jika status-nya 'cancel'.");
        }

        return $ticket->delete(); 
    }
}