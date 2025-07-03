<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AcnooNotificationSettingController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $user->update([
            'notify_allow' => !$user->notify_allow
        ]);

        return response()->json([
            'message' => 'notify update successfully',

        ]);
    }
}
