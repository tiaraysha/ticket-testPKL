<?php

namespace App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Validation\Factory;

class TicketRequest
{
    public static function validate(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'ticket_type_id' => 'required|exists:ticket_types,id',
            'assign_at' => 'required|date_format:Y-m-d',
        ];

        $validator = app(Factory::class)->make($request->all(), $rules);

        if($validator->fails()) {
            response()->json($validator->errors(), 400)->send();
            exit;
        } else {
            return $validator->validated();
        }
    }
}