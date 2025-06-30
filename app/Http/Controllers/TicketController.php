<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\TicketResource;
use App\Services\TicketService;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\TicketRequest;
use App\Http\Requests\UpdateTicketRequest;
use App\Models\Ticket;

class TicketController extends Controller
{
    protected TicketService $ticketService;

    public function __construct(TicketService $ticketService)
    {
        $this->ticketService = $ticketService;
    }

    public function index(): JsonResponse
    {
        try {
            $tickets = $this->ticketService->index();
            return response()->json(TicketResource::collection($tickets), 200);
        } catch (\Exception $err) {
            return response()->json(['error' => $err->getMessage()], 400);
        }
    }

    public function store(Request $request): JsonResponse
    {
        try {
            $validated = $this->validate($request, [
                'name'           => 'required|string|max:255',
                'email'          => 'required|email',
                'title'          => 'required|string|max:255',
                'description'    => 'nullable|string',
                'ticket_type_id' => 'required|exists:ticket_types,id',
                'project_id'     => 'required|exists:projects,id',
                'assign_at'      => 'required|date_format:Y-m-d',
            ]);

            $ticket = $this->ticketService->store($validated);

            return response()->json(new TicketResource($ticket), 201);
        } catch (\Exception $err) {
            return response()->json(['error' => $err->getMessage()], 400);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $payload = UpdateTicketRequest::validate($request);
            $ticket = $this->ticketService->update($id, $payload);
            return response()->json(new TicketResource($ticket), 200);
        } catch (\Exception $err)
        {
            return response()->json($err->getMessage(), 400);
        }
    }

    public function destroy($id)
    {
        try {
            $this->ticketService->delete($id);
            return response()->json(['message' => 'Ticket deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
