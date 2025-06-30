<?php

namespace App\Http\Controllers;
use App\Models\TicketType;

class TicketTypeController extends Controller
{
    public function index()
    {
        return response()->json(TicketType::all(), 200);
    }
}

