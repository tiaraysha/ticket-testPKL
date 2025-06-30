<?php

namespace App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Validation\Factory;

class UpdateTicketRequest
{
    public static function validate(Request $request)
    {
        $rules = [
            'email' => 'required|email|max:255',
            'description' => 'nullable|string',
            'ticket_type_id' => 'required',
            'status' => 'required|in:open,progress,closed,cancel',
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