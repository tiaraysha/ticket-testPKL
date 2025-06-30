<?php

namespace App\Http\Controllers;

use App\Models\User; 
use Illuminate\Http\Request;
use App\Http\Resources\UserResource; 

class UserController extends Controller
{
    public function index()
    {
        try {
            $users = User::all();
            return UserResource::collection($users);
        } catch (\Exception $e) {
            \Log::error("Error fetching users: " . $e->getMessage());
            return response()->json(['error' => 'Failed to fetch users', 'message' => $e->getMessage()], 500);
        }
    }
}