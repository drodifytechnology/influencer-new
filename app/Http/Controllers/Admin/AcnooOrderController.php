<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AcnooOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $orders = Order::with('influencer:id,name', 'service:id,title')
                    ->when(request('search'), function ($q) {
                        $q->where('total_amount', 'like', '%' . request('search') . '%')
                            ->orWhere('status', 'like', '%' . request('search') . '%')
                            ->orWhere('end_date', 'like', '%' . request('search') . '%');

                        $q->orwhereHas('influencer', function($influencer) {
                            $influencer->where('name', 'like', '%'.request('search').'%');
                        });

                        $q->orwhereHas('service', function($service) {
                            $service->where('title', 'like', '%'.request('search').'%');
                        });

                    })
                    ->when($request->id, function($query) use ($request) {
                        $query->where('id', $request->id);
                    })
                    ->latest()
                    ->paginate(20);

        if (request()->ajax()) {
            return response()->json([
                'data' => view('admin.orders.datas', compact('orders'))->render()
            ]);
        }

        return view('admin.orders.index', compact('orders'));
    }

    public function order_reject(Request $request, string $id)
    {
        $request->validate([
            'reason' => 'required|string|max:255',
        ]);

        $order_reject = Order::with('service:id,title', 'user:id,device_token', 'influencer:id,device_token')
                                ->findOrFail($id);

        if ($order_reject) {
            $order_reject->update([
                'status' => 'canceled',
                'reason' => $request->reason,
            ]);

            sendPushNotify(
                'Order Rejection Notice',
                'We regret to inform you that your order titled "' . $order_reject->service->title . '" has been rejected by the admin. The reason for this decision is: "' . $order_reject->reason . '". Please contact support if you have any questions or need further assistance.',
                $order_reject->user->device_token
            );

            sendPushNotify(
                'Order Rejection Notice',
                'We regret to inform you that the order titled "' . $order_reject->service->title . '" has been rejected by the admin. The reason for this decision is: "' . $order_reject->reason . '". Please reach out to support if you require more information.',
                $order_reject->influencer->device_token
            );

            sendNotification($order_reject->id, route('admin.orders.index', ['id' => $order_reject->id]), notify_users([$order_reject->user_id, $order_reject->influencer_id]), admin_msg:__('Order has been rejected'), influ_msg:__($order_reject->user->name.' your order has been rejected by the admin for the following reason: '.$order_reject->reason), client_msg:__('Order has been rejected by the admin for the following reason: '.$order_reject->reason));

            return response()->json([
                'message' => 'Order rejected successfully',
                'redirect' => route('admin.orders.index')
            ]);
        } else {
            return response()->json(['message' => 'Order request not found'], 404);
        }
    }

    public function paid(Request $request, string $id)
    {
        $request->validate([
            'reason' => 'required|string|max:255',
        ]);

        $paid_order = Order::with('influencer:id,name,balance,device_token', 'service:id,title')
                                ->findOrFail($id);

        if ($paid_order) {
            $paid_order->update([
                'payment_status' => 'paid',
                'reason' => $request->reason,
            ]);

            sendPushNotify(
                'Payment Confirmation Notice',
                'Dear ' . $paid_order->influencer->name . ', your payment for the order titled "' . $paid_order->service->title . '" has been successfully processed. Thank you for your continued partnership.',
                $paid_order->influencer->device_token
            );

            sendNotification($paid_order->id, route('admin.orders.index', ['id' => $paid_order->id]), notify_users([$paid_order->influencer_id]), admin_msg:__('Paid successfully'), influ_msg:__($paid_order->influencer->name.'  Your payment for the order has been successfully processed'), );

            return response()->json([
                'message' => 'Order paid successfully',
                'redirect' => route('admin.orders.index')
            ]);
        } else {
            return response()->json(['message' => 'Paid request not found'], 404);
        }
    }

    public function destroy(string $id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return response()->json([
            'message' => __('Order deleted successfully'),
            'redirect' => route('admin.orders.index')
        ]);
    }


    public function deleteAll(Request $request)
    {
        Order::whereIn('id', $request->ids)->delete();
        return response()->json([
            'message' => __('Selected Items deleted successfully.'),
            'redirect' => route('admin.orders.index')
        ]);
    }
}
