<?php

namespace App\Http\Controllers\Api;

use App\Models\Chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AcnooChatController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $latestChats = Chat::select('chats.id', 'chats.sender_id', 'chats.receiver_id', 'chats.message', 'chats.sender_role', 'chats.is_seen', 'chats.created_at', 'users.name', 'users.image')
                        ->join(DB::raw('(SELECT MAX(id) as id FROM chats WHERE sender_id = ? OR receiver_id = ? GROUP BY LEAST(sender_id, receiver_id), GREATEST(sender_id, receiver_id)) latest'), function($join) {
                            $join->on('chats.id', '=', 'latest.id');
                        })
                        ->join('users', function($join) use ($userId) {
                            $join->on('users.id', '=', DB::raw("CASE WHEN chats.sender_id = $userId THEN chats.receiver_id ELSE chats.sender_id END"));
                        })
                        ->setBindings([$userId, $userId])
                        ->orderBy('chats.created_at', 'desc')
                        ->paginate(20);

        return response([
            'message' => 'Data fetched successfully',
            'data' => $latestChats
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
        ]);

        $chat = Chat::create($request->all() + [
                    'sender_role' => auth()->user()->role,
                ]);

        return response([
            'message' => 'Message sent successfully',
            'data' => $chat
        ]);
    }

    public function show($id)
    {
        Chat::findOrFail($id)->update([
            'is_seen' => 1
        ]);

        return response([
            'message' => 'Success',
        ]);
    }
}
