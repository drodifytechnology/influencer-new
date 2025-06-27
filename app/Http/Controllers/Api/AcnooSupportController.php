<?php

namespace App\Http\Controllers\Api;

use App\Models\Support;
use App\Helpers\HasUploader;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AcnooSupportController extends Controller
{
    use HasUploader;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Support::where('user_id', auth()->id())->whereNull('support_id')->latest()->paginate(20);
        return response()->json([
            'message' => __('Data fetched successfully.'),
            'data' => $data
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'nullable|string',
            'priority' => 'nullable|string',
            'message' => 'required_without:attachment',
            'support_id' => 'nullable|exists:supports,id',
            'attachment' => 'required_without:message|image|mimes:jpg,jpeg,png,gif|max:1048',
        ]);

        $id = Support::whereNull('support_id')->max('id') + 1;
        $ticket_no = str_pad($id, 5, '0', STR_PAD_LEFT);

        $data = Support::create($request->except('attachment') + [
                    'user_id' => auth()->id(),
                    'status' => !empty($request->support_id) ? null : 'pending',
                    'ticket_no' => $request->support_id ? NULL : $ticket_no,
                    'attachment' => $request->attachment ? $this->upload($request, 'attachment') : NULL
                ]);

        sendPushNotify(
            'New Support Ticket Created',
            'A new support ticket titled "' . $data->subject . '" has been created.',
            $data->user->device_token
        );

        sendNotification($data->id, route('admin.supports.index', ['id' => $data->id]), notify_users([$data->user_id]), admin_msg:__('You have new ticket.'), influ_msg:__('Your message send successfully'), client_msg:__('Your message send successfully'),);

        return response()->json([
            'message' => 'Support created successfully',
            'data' => $data
        ]);
    }

    public function show($id)
    {
        Support::where('support_id', $id)->update([
            'has_new' => false
        ]);

        $data = Support::select('id', 'ticket_no', 'created_at', 'message', 'user_id', 'status', 'attachment')->with('user:id,image')->where('support_id', $id)->orWhere('id', $id)->get();

        return response()->json([
            'message' => __('Data fetched successfully.'),
            'data' => $data
        ]);
    }
}
