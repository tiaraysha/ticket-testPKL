<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TicketController extends Controller
{
    public function index()
    {
        return Ticket::with('project', 'ticketType')->get();
    }

    public function store(Request $request)
{
    $validator = Validator::make($request->all(), [
        'name' => 'required|string',
        'email' => 'required|email',
        'title' => 'required|string',
        'description' => 'nullable|string',
        'assign_at' => 'required|date',
        'ticket_type_id' => 'required|uuid|exists:ticket_types,id',
        'project_id' => 'required|uuid|exists:projects,id',
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }

    $ticket = Ticket::create($validator->validated());
    return response()->json($ticket, 200);
}

    public function update(Request $request, $id)
    {
        $ticket = Ticket::findOrFail($id);

        $validator = Validator::make($request->all(), [   
            'email' => 'required|email',
            'description' => 'nullable|string',
            'status' => 'required|in:open,progress,closed,cancel',
            'ticket_type_id' => 'required|uuid|exists:ticket_types,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $ticket->update($validator->validated());

        return $ticket;
    }

    public function destroy($id)
    {
        $ticket = Ticket::findOrFail($id);

        if ($ticket->status !== 'cancel') {
            return response()->json(['message' => 'Hanya tiket dengan status cancel yang bisa dihapus'], 400);
        }

        $ticket->delete();
        return response()->json(['message' => 'Deleted']);
    }
}
