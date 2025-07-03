<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AcnooUserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::where('role', $request->role )->get();

        return response()->json([
            'message' => 'Data fetched successfully',
            'data' => $users
        ]);
    }
}
