<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class AcnooNotificationsController extends Controller
{
    public function index()
    {
        $notifications = auth()->user()->unreadNotifications;

        return response()->json([
            'message' => 'Data fetched successfully',
            'data' => $notifications
        ]);
    }

    public function readAll()
    {
       auth()->user()->unreadNotifications()->update(['read_at' => now()]);

       return response()->json([
            'message' => 'Mark all read successfully',
        ]);
    }
}
