<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Order;
use App\Models\Refund;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\FlareClient\Http\Client;

class AcnooRefundController extends Controller
{
    public function index()
    {
        $refunds = Refund::with('order:id,user_id,service_id', 'order.user:id,name', 'order.service:id,title')
                    ->latest()
                    ->paginate(20);

        return view('admin.refunds.index', compact('refunds'));
    }

    public function maanFilter(Request $request)
    {
        $refunds = Refund::with('order:id,user_id,service_id', 'order.user:id,name', 'order.service:id,title')
                    ->when(request('search'), function ($q) {
                        $q->where('reason', 'like', '%' . request('search') . '%')
                            ->where('status', 'like', '%' . request('search') . '%');

                        $q->orwhereHas('order.user', function ($d) {
                            $d->where('name', 'like', '%' . request('search') . '%');
                        });

                        $q->orwhereHas('order.service', function ($d) {
                            $d->where('title', 'like', '%' . request('search') . '%');
                        });
                    })

                    ->latest()
                    ->paginate($request->per_page ?? 20);

        if ($request->ajax()) {
            return response()->json([
                'data' => view('admin.refunds.datas', compact('refunds'))->render()
            ]);
        }
        return redirect(url()->previous());
    }

    public function approve(Request $request, string $id)
    {
        $refund = Refund::findOrFail($id);

        $order = Order::with('service:id,title', 'user:id,name,device_token')->findOrFail($refund->order_id);

        $influencer = User::findOrFail($order->influencer_id);

        $influencer->balance -= $order->total_amount;
        $influencer->save();

        $refund->update([
            'status' => 'approve',
            'meta' => [
                'admin_reject_reason' => $request->reason
            ]
        ]);

        sendPushNotify(
            'Refund Approved Successfully',
            'Dear ' . $influencer->name . ', your refund request for the order titled "' . $order->service->title . '" has been approved. The amount has been refunded. Thank you for your patience.',
            $influencer->device_token
        );

        sendPushNotify(
            'Refund Approved Successfully',
            'Dear ' . $order->user->name . ', your refund request for the order titled "' . $order->service->title . '" has been successfully approved.',
            $order->user->device_token
        );

        $order->update([
            'payment_status' => 'unpaid',
        ]);

        sendNotification($refund->id, route('admin.refunds.index', ['id' => $refund->id]), notify_users([$order->user_id, $order->influencer_id]), admin_msg:__('Refund successfully'), influ_msg:__('Your refund has been approved.'), client_msg:__('Your order has been refunded'));

        return response()->json([
            'message' => 'Refund approved successfully',
            'redirect' =>  route('admin.refunds.index')
        ]);
    }

    public function reject(Request $request, string $id)
    {
        $refund_reject = Refund::findOrFail($id);

        if ($refund_reject) {

            $refund_reject->update([
                'status' => 'rejected',
                'reason' => $request->reason
            ]);

            sendPushNotify(
                'Refund Rejected Notice',
                'Your refund request for the order titled "' . $refund_reject->order->service->title . '" has been rejected. If you have any questions or need further assistance, please contact support.',
                $refund_reject->order->influencer->device_token
            );

            sendPushNotify(
                'Refund Rejected Notice',
                'Your refund request for the order titled "' . $refund_reject->order->service->title . '" has been rejected. For further details or assistance, please contact support.',
                $refund_reject->order->user->device_token
            );

            sendNotification($refund_reject->id, route('admin.refunds.index', ['id' => $refund_reject->id]),  notify_users([$refund_reject->order->user_id, $refund_reject->order->influencer_id]), admin_msg:__('Refund Rejected successfully'),  influ_msg:__('Your refund has been rejected.'), client_msg:__('Your order refund has been rejected'));

            return response()->json([
                'message' => 'Refund rejected successfully',
                'redirect' =>  route('admin.refunds.index')
            ]);
        } else {
            return response()->json(['message' => 'Refund request not found'], 404);
        }
    }
}
