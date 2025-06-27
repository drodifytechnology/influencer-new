<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Support;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AcnooSupportController extends Controller
{
    public function index(Request $request)
    {
        $supports = Support::with('user:id,name,role')->withCount('messages')->whereNull('support_id')
                    ->when($request->id, function ($query) use ($request) {
                        $query->where('id', $request->id);
                    })
                    ->latest()->paginate(20);

        return view('admin.tickets.index', compact('supports'));
    }

    public function maanFilter(Request $request)
    {
        $supports = Support::with('user:id,name,role')
            ->withCount('messages')
            ->whereNull('support_id')
            ->when($request->id, function ($query) use ($request) {
                $query->where('id', $request->id);
            })
            ->where(function ($query) use ($request) {
                $query->where('subject', 'like', '%' . $request->search . '%')
                    ->orWhere('priority', 'like', '%' . $request->search . '%')
                    ->orWhere('message', 'like', '%' . $request->search . '%')
                    ->orWhereHas('user', function ($query) use ($request) {
                        $query->where('name', 'like', '%' . $request->search . '%');
                    });
            })
            ->latest()
            ->paginate($request->per_page ?? 20);

        if ($request->ajax()) {
            return response()->json([
                'data' => view('admin.tickets.datas', compact('supports'))->render()
            ]);
        }

        return redirect(url()->previous());
    }


    public function store(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
            'support_id' => 'required|string'
        ]);

        Support::create($request->all() + [
            'user_id' => auth()->id(),
        ]);

        $parentTicket = Support::find($request->support_id);
        $parentTicket->update([
            'has_new' => true,
            'status' => $parentTicket->status == 'closed' ? 'closed' : 'progress',
        ]);

        $user = User::findOrFail($parentTicket->user_id);

        sendPushNotify(
            'New Support Message',
            $parentTicket->message,
            $user->device_token
        );

        sendNotification($parentTicket->id, route('admin.supports.index', ['id' => $parentTicket->id]), notify_users([$parentTicket->user_id]), admin_msg:__('Message send successfully'),  influ_msg:__('You have new messages'), client_msg:__('You have new messages'));

        return response()->json([
            'message' => 'Message sent successfully',
            'redirect' => route('admin.supports.index')
        ]);
    }

    public function close(Request $request)
    {
        $support_close = Support::find($request->support_id);
        $support_close->update(['status' => 'closed']);

        $user = User::findOrFail($support_close->user_id);

        sendPushNotify(
            'Support Ticket Closed',
            'Dear ' . $user->name . ', your support ticket has been closed successfully. If you need further assistance, please contact support.',
            $user->device_token
        );
        
        sendNotification($support_close->id, route('admin.supports.index', ['id' => $support_close->id]), notify_users([$support_close->user_id]), admin_msg:__('Ticket close successfully'),  influ_msg:__('Your ticket has been closed'), client_msg:__('Your ticket has been closed'));

        return response()->json([
            'message' => 'Closed successfully',
            'redirect' => route('admin.supports.index')
        ]);
    }

    public function show(string $id)
    {
        $messages = Support::where('support_id', $id)->orWhere('id', $id)->get();

        $support = Support::where('support_id', $id)->orWhere('id', $id)
            ->with('user:id,name,role,email,phone')
            ->first();

        return view('admin.tickets.show', compact('messages', 'support', 'id'));
    }

    public function getMessage($id)
    {
        $messages = Support::where('support_id', $id)->orWhere('id', $id)->get();
        return view('admin.tickets.message-data', compact('messages'))->render();
    }

    public function deleteAll(Request $request)
    {
        Support::whereIn('id', $request->ids)->delete();
        return response()->json([
            'message' => __('Selected Items deleted successfully.'),
            'redirect' => route('admin.supports.index')
        ]);
    }
}
