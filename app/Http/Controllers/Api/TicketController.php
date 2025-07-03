<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'category' => 'required|integer',
            'order_id' => 'required|integer',
            'title' => 'required|string|max:150',
            'description' => 'required|string',
            'file' => 'nullable|file|max:2048',
        ]);

        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('tickets', 'public');
        }

        $ticket = Ticket::create([
            'user_id' => auth()->id(),
            'category_id' => $request->category,
            'order_id' => $request->order_id,
            'title' => $request->title,
            'description' => $request->description,
            'file_path' => $filePath,
            'status' => 'open',
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Ticket created successfully',
            'data' => $ticket,
        ]);
    }
    public function list(Request $request)
    {
        $query = Ticket::where('user_id', auth()->id());

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('from') && $request->filled('to')) {
            $query->whereBetween('created_at', [$request->from, $request->to]);
        }

        $tickets = $query->latest()->get();

        return response()->json([
            'status' => true,
            'data' => $tickets,
        ]);
    }
    public function show($id)
    {
        $ticket = Ticket::with('user')->where('id', $id)->where('user_id', auth()->id())->first();

        if (!$ticket) {
            return response()->json(['status' => false, 'message' => 'Ticket not found'], 404);
        }

        return response()->json([
            'status' => true,
            'data' => $ticket
        ]);
    }
}
