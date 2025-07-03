<?php

namespace App\Http\Controllers\Api;

use App\Models\Order;
use App\Models\Review;
use App\Models\Refund;
use App\Helpers\HasUploader;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class   AcnooOrderController extends Controller
{
    use HasUploader;

    public function index()
    {
        $order = Order::where('payment_status', 'paid')
                    ->with('service:id,title,category_id,images', 'service.category:id,name', 'user:id,name,image', 'influencer:id,name,image', 'review:id,rating,order_id')
                    ->when(request('status') ?? false, function ($q) {
                        $q->where('status', request('status'));
                    })
                    ->when(auth()->user()->role == 'influencer' || request('influencer_id'), function ($q) {
                        $q->where('influencer_id', request('influencer_id') ?? auth()->id());
                    })
                    ->when(auth()->user()->role == 'user', function ($q) {
                        $q->where('user_id', auth()->id());
                    })
                    ->latest();

        return response()->json([
            'message' => 'Order fetched successfully',
            'data' => $order
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'service_id' => 'required',
            'amount' => 'required',
            'charge' => 'required|string',
            'discount_amount' => 'nullable',
            'total_amount' => 'required',
            'start_date' => 'nullable|string',
            'end_date' => 'nullable|string',
            'start_time' => 'nullable|string',
            'end_time' => 'nullable|string',
            'description' => 'nullable|string',
            'influencer_id' => 'required|exists:users,id',
            'file' => 'nullable|file|mimes:jpg,jpeg,png,gif,pdf|max:204800',
        ]);

        $user = auth()->user();

        $order = Order::create($request->except('file') + [
                    'user_id' => $user->id,
                    'file' => $request->file ? $this->upload($request, 'file') : NULL,
                ]);

        sendNotification($order->id, route('admin.orders.index', ['id' => $order->id]), notify_users([$order->user_id, $order->influencer_id]), admin_msg:__('New order created.'), influ_msg:__('You have new order'), client_msg:__('New order has been created'));

        return response([
            'message' => 'Order saved successfully',
            'payment_url' => route('payments-gateways.index', $order->id),
            'data' => $order,
        ]);
    }

    public function show($id)
    {
        $review = Review::where('order_id', $id)->where('user_id', auth()->id())->first();
        $order = Order::with('user:id,name,image', 'influencer:id,name,image', 'service:id,title,images,category_id', 'service.category:id,name', 'gateway:id,name')->findOrFail($id);

        return response()->json([
            'message' => 'Data fetched successfully',
            'data' => $order,
            'review' => $review,
        ]);
    }

    public function approve(Request $request, string $id)
    {
        $order = Order::with('influencer', 'user:id,device_token', 'service:id,title')->findOrFail($id);

        $order->influencer->update([
            'balance' => $order->influencer->balance + ($order->total_amount - $order->charge)
        ]);

        sendPushNotify(
            'Order Approved',
            'Your order titled "' . $order->service->title . '" has been approved successfully.',
            $order->influencer->device_token
        );

        sendPushNotify(
            'Order Approved',
            'Your order titled "' . $order->service->title . '" has been approved by the influencer.',
            $order->user->device_token
        );

        sendNotification($order->id, route('admin.orders.index', ['id' => $order->id]), notify_users([$order->user_id, $order->influencer_id]), admin_msg:__('Influencer approved a order'), influ_msg:__('Approved has been successfully'), client_msg:__('Your order has been approved'));

        $order->update([
            'status' => 'active',
        ]);

        return response()->json([
            'message' => 'Order Approve successfully',
            'data' =>  $order->status
        ]);
    }

    public function reject(Request $request, string $id)
    {
        $request->validate([
            'reason' => 'required|string|max:255',
        ]);

        $order_reject = Order::with('influencer', 'user:id,device_token', 'service:id,title')->findOrFail($id);

        if ($order_reject) {
            if ($order_reject->payment_status === 'paid') {

                $order_reject->update([
                    'status' => 'canceled',
                    'reason' => $request->reason,
                ]);

                Refund::create([
                    'order_id' => $order_reject->id,
                    'status' => 'pending',
                    'reason' => $request->reason,
                ]);

                sendPushNotify(
                    'Order Rejected',
                    'Your order titled "' . $order_reject->service->title . '" has been rejected',
                    $order_reject->influencer->device_token
                );

                sendPushNotify(
                    'Order Rejected',
                    'Your order titled "' . $order_reject->service->title . '" has been rejected by the influencer. A refund is being processed.',
                    $order_reject->user->device_token
                );

                sendNotification($order_reject->id, route('admin.orders.index', ['id' => $order_reject->id]), notify_users([$order_reject->user_id, $order_reject->influencer_id]), admin_msg:__('Influencer rejected a order'), influ_msg:__('Order reject successfully'), client_msg:__('Influencer rejected your order. A refund is being processed. Reason: ' . $order_reject->reason), );

                return response()->json([
                    'message' => 'Order rejected successfully',
                    'data' => $order_reject->status
                ]);
            } else {
                return response()->json([
                    'message' => 'Order not found'
                ]);
            }
        } else {
            return response()->json([
                'message' => 'Order not found'
            ]);
        }
    }

    public function order_delivery(Request $request, $id)
    {
        $request->validate([
            'delivered_message' => 'required|string|max:255',
            'delivered_file' => 'required|file'
        ]);

        $order = Order::with('influencer:id,device_token', 'user:id,device_token', 'service:id,title')->findOrFail($id);

        $meta_data = $order->meta ?? [];

        $meta_data['delivered_message'] = $request->delivered_message;
        $meta_data['delivered_file'] = $request->delivered_file ? $this->upload($request, 'delivered_file') : null;

        $order->update([
            'meta' => $meta_data,
            'status' => 'in_review'
        ]);

        sendPushNotify(
            'Order Delivered',
            'You have successfully delivered the order titled "' . $order->service->title . '".',
            $order->influencer->device_token
        );

        sendPushNotify(
            'Order Delivered',
            'Your order titled "' . $order->service->title . '" has been delivered by the influencer.',
            $order->user->device_token
        );

        sendNotification($order->id, route('admin.orders.index', ['id' => $order->id]), notify_users([$order->user_id, $order->influencer_id]), admin_msg:__('influencer delivered a order'), influ_msg:__('Order delivered successfully'),  client_msg:__('Your order has been successfully delivered.'),);

        return response()->json([
            'message' => 'Order delivered successfully',
            'data' =>  $order->status
        ]);
    }

    public function file_download($id)
    {
        $order = Order::findOrFail($id);

        if (is_null($order->file)) {
            return response()->json([
                'message' => 'File not found',
            ]);
        }

        $filePath = $order->file;

        if (Storage::exists($filePath)) {
            return Storage::download($filePath);
        }
    }


    public function delivered_file($id)
    {
        $order = Order::findOrFail($id);

        if (is_null($order->meta['delivered_file'])) {
            return response()->json([
                'message' => 'File not found',
            ]);
        }

        $filePath = $order->meta['delivered_file'];

        if (Storage::exists($filePath)) {
            return Storage::download($filePath);
        }
    }

    public function client_cancel(Request $request, string $id)
    {

        $request->validate([
            'reason' => 'required|string|max:255',
        ]);

        $order_cancel = Order::with('influencer:id,device_token', 'user:id,device_token', 'service:id,title')->findOrFail($id);

        if ($order_cancel) {

            $order_cancel->update([
                'status' => 'canceled',
                'reason' => $request->reason,
            ]);

            sendPushNotify(
                'Order Canceled',
                'Your order titled "' . $order_cancel->service->title . '" has been canceled by the client. Reason: ' . $order_cancel->reason,
                $order_cancel->user->device_token
            );

            sendPushNotify(
                'Order Canceled',
                'The client has canceled your order titled "' . $order_cancel->service->title . '". Reason: ' . $order_cancel->reason,
                $order_cancel->influencer->device_token
            );

            sendNotification($order_cancel->id, route('admin.orders.index', ['id' => $order_cancel->id]), notify_users([$order_cancel->influencer_id, $order_cancel->user_id ]), admin_msg:__('Client rejected a order'), influ_msg:__('The client has canceled the order. Reason: ' . $order_cancel->reason), client_msg:__('Order rejected successfully'));

            return response()->json([
                'message' => 'Order cancel successfully',
                'data' =>  $order_cancel->status
            ]);
        } else {
            return response()->json(['message' => 'Order not found'], 404);
        }
    }

    public function client_approve(Request $request, string $id)
    {
        $client_approve = Order::with('influencer:id,device_token', 'user:id,device_token', 'service:id,title')->findOrFail($id);

        if ($client_approve) {
            $client_approve->update([
                'status' => 'complete',
            ]);

            sendPushNotify(
                'Order Approved',
                'Your order titled "' . $client_approve->service->title . '" has been approved by the client.',
                $client_approve->influencer->device_token
            );

            sendPushNotify(
                'Order Approved',
                'The client has approved your order titled "' . $client_approve->service->title . '".',
                $client_approve->user->device_token
            );

            sendNotification($client_approve->id, route('admin.orders.index', ['id' => $client_approve->id]), notify_users([$client_approve->influencer_id,$client_approve->user_id ]), admin_msg:__('Client approved a order'), influ_msg:__('The client has approved the order.'), client_msg:__('Order approved successfully'),);

            return response()->json([
                'message' => 'Client Approve successfully',
                'data' =>  $client_approve->status
            ]);
        } else {
            return response()->json(['message' => 'Request not found'], 404);
        }
    }
}
