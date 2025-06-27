<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Order;
use App\Models\Review;
use App\Models\Support;
use App\Mail\ClientMail;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class AcnooClientController extends Controller
{
    public function index(Request $request)
    {
        $clients = User::withCount(['orders as completed_orders' => function ($query) {
                        $query->where('status', 'complete');
                    }])
                        ->where('role', 'user')
                        ->when($request->has('status'), function ($q) use ($request) {
                            $q->where('status', $request->status);
                        })
                        ->when($request->has('search'), function ($q) use ($request) {
                            $search = $request->search;
                            $q->where(function ($query) use ($search) {
                                $query->where('name', 'like', '%' . $search . '%')
                                    ->orWhere('email', 'like', '%' . $search . '%')
                                    ->orWhere('country', 'like', '%' . $search . '%');
                            });
                        })
                        ->when($request->id, function ($query) use ($request) {
                            $query->where('id', $request->id);
                        })
                        ->latest()
                        ->paginate(20);

        return view('admin.clients.index', compact('clients'));
    }

    public function maanFilter(Request $request)
    {
        $clients = User::withCount(['orders as completed_orders' => function ($query) {
            $query->where('status', 'complete');
        }])
            ->where('role', 'user')
            ->when($request->has('status'), function ($q) use ($request) {
                $q->where('status', $request->status);
            })
            ->when($request->has('search'), function ($q) use ($request) {
                $search = $request->search;
                $q->where(function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%')
                        ->orWhere('email', 'like', '%' . $search . '%')
                        ->orWhere('country', 'like', '%' . $search . '%');
                });
            })
            ->when($request->id, function ($query) use ($request) {
                $query->where('id', $request->id);
            })
            ->latest()
            ->paginate($request->per_page ?? 20);

        if (request()->ajax()) {
            return response()->json([
                'data' => view('admin.clients.datas', compact('clients'))->render(),
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

        $parentTicket = Support::with('user:id,device_token')->find($request->support_id);
        $parentTicket->update([
            'has_new' => true,
            'status' => $parentTicket->status == 'closed' ? 'closed' : 'progress',
        ]);

        sendPushNotify('You have new messages.', $parentTicket->message . '.', $parentTicket->user->device_token);

        sendNotification($parentTicket->id, route('admin.order.details', ['id' => $parentTicket->id]), notify_users([$parentTicket->user_id]), admin_msg:__('Message send successfully'), client_msg:__('You have new messages'));

        return response()->json([
            'message' => 'Message sent successfully',
            'redirect' => route('admin.order.details', ['id' => $parentTicket->id])
        ]);
    }

    public function show($id)
    {
        $transaction = Transaction::where('user_id', $id)->get();
        $orders = Order::where('user_id', $id)
                    ->with('service:id,user_id,title', 'service.user:id,name')
                    ->latest()
                    ->paginate(10);

        $user = User::with('categories')->findOrFail($id);

        $supports = Support::with('user:id,name,role')->withCount('messages')->where('user_id', $id)->whereNull('support_id')
                    ->latest()
                    ->paginate(10);
        $reviews = Review::where('user_id', $id)
                        ->latest()
                        ->paginate(10);

        return view('admin.clients.details.index', compact('orders', 'supports', 'user', 'reviews', 'transaction'));
    }



    public function banned(Request $request, string $id)
    {
        $request->validate([
            'reason' => 'required|string|max:255',
        ]);

        $client_banned = User::findOrFail($id);

        if ($client_banned) {
            $client_banned->update([
                'status' => 'banned',
                'reason' => $request->reason,
            ]);

            sendPushNotify('Account Suspension Notice','Your account has been suspended due to policy violations. For further details, please contact support.', $client_banned->device_token);

            sendNotification($client_banned->id, route('admin.clients.index', ['id' => $client_banned->id]), notify_users([$client_banned->id]), admin_msg:__('Client has been banned'), client_msg: $client_banned->name . ' You are banned in our system');

            return response()->json([
                'message' => 'Client banned successfully',
                'redirect' => route('admin.clients.index'),
            ]);
        } else {
            return response()->json(['message' => 'Client request not found'], 404);
        }
    }

    public function approve(Request $request, string $id)
    {
        $request->validate([
            'reason' => 'required|string|max:255',
        ]);

        $client_approve = User::findOrFail($id);

        if ($client_approve) {
            $client_approve->update([
                'status' => 'approved',
                'reason' => $request->reason,
            ]);

            sendPushNotify('Account Approval Notice', 'Congratulations! Your account has been approved. You now have full access to our system.', $client_approve->device_token);

            sendNotification($client_approve->id, route('admin.clients.index', ['id' => $client_approve->id]), notify_users([$client_approve->id]), admin_msg:__('Client has been Approved'), client_msg: $client_approve->name . ' You are Approved in our system');

            return response()->json([
                'message' => 'Client Approved successfully',
                'redirect' => route('admin.clients.index'),
            ]);
        } else {
            return response()->json(['message' => 'Client request not found'], 404);
        }
    }


    public function send_email(Request $request)
    {
        $data = [
            'subject' => $request->subject,
            'message' => $request->message,
        ];

        if (env('QUEUE_MAIL')) {
            Mail::to($request->email)->queue(new ClientMail($data));
        } else {
            Mail::to($request->email)->send(new ClientMail($data));
        }

        return response()->json([
            'message' => 'Mail send successfully',
            'redirect' => route('admin.clients.index'),
        ]);
    }

    public function order_details($id)
    {
        $order = Order::where('id', $id)
            ->with('service:id,user_id,title', 'service.user:id,name')
            ->first();

        $messages = Support::where('support_id', $id)->orWhere('id', $id)->get();

        $support = Support::where('support_id', $id)->orWhere('id', $id)
            ->with('user:id,name,role,email,phone')
            ->first();

        return view('admin.clients.details.orders.view', compact('order', 'messages', 'support', 'id'));
    }

    public function getMessage($id)
    {
        $messages = Support::where('support_id', $id)->orWhere('id', $id)->get();
        return view('admin.clients.details.orders.message-data', compact('messages'))->render();
    }

    public function destroy($id)
    {
        $client = User::findOrFail($id);
        $client->delete();

        return response()->json([
            'message' => 'Client deleted successfully',
            'redirect' => route('admin.clients.index'),
        ]);
    }

    public function deleteAll(Request $request)
    {
        User::whereIn('id', $request->ids)->delete();
        return response()->json([
            'message' => __('Selected Items deleted successfully.'),
            'redirect' => route('admin.clients.index'),
        ]);
    }

    public function showOrderFilter(Request $request, $id)
    {
        $orders = Order::where('user_id', $id)
        ->with('service:id,user_id,title', 'service.user:id,name')
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
            ->latest()
            ->paginate($request->per_page ?? 20);

        if (request()->ajax()) {
            return response()->json([
                'data' => view('admin.clients.details.datas', compact('orders'))->render(),
            ]);
        }
        return redirect(url()->previous());
    }


    public function showTicketFilter(Request $request, $id)
    {
        $supports = Support::with('user:id,name,role')->withCount('messages')->where('user_id', $id)->whereNull('support_id')
        ->when(function ($query) use ($request) {
            $query->where('subject', 'like', '%' . $request->search . '%')
                ->orWhere('priority', 'like', '%' . $request->search . '%')
                ->orWhere('message', 'like', '%' . $request->search . '%')
                ->orWhereHas('user', function ($query) use ($request) {
                    $query->where('name', 'like', '%' . $request->search . '%');
                });
        })
        ->latest()
        ->paginate($request->per_page ?? 20);

        if (request()->ajax()) {
            return response()->json([
                'data' => view('admin.clients.details.ticket-datas', compact('supports'))->render(),
            ]);
        }
        return redirect(url()->previous());
    }
}
