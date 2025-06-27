<?php

namespace App\Http\Controllers\Api;

use App\Models\Report;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AcnooReportController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'service_id' => 'required|exists:services,id',
            'reported_id' => 'required',
            'reason_id' => 'required',
            'notes' => 'nullable|string',
        ]);

        $report =  Report::create($request->except('user_id') + [
            'user_id' => auth()->id()
        ]);

        sendPushNotify(
            'You have complain',
            'A complaint has been filed against you by the client.',
            $report->reported_user->device_token
        );

        sendPushNotify(
            'Complain Successful',
            'You have filed a complain against the influencer.',
            $report->user->device_token
        );

        sendNotification($report->id, route('admin.complains.index', ['id' => $report->id]), notify_users([$report->user_id, $report->reported_id]), admin_msg:__('You have new complain'), influ_msg: __('You have new complain.'));

        return response()->json([
            'meassage' => 'Data fetch successfully',
            'data' => $report
        ]);
    }
}
