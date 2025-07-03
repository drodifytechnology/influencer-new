<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Order;
use App\Models\Review;
use App\Models\Service;
use App\Models\Withdraw;
use App\Mail\InfluencerMail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class AcnooInfluencerController extends Controller
{
    public function index(Request $request)
    {
        $influencers = User::withCount('services', 'orders')
                        ->withSum('orders', 'amount')
                        ->withCount(['orders as completed_orders' => function ($query) {
                            $query->where('status', 'complete');
                        }])
                        ->where('role', 'influencer')
                        ->when($request->has('status'), function ($q) use ($request) {
                            $q->where('status', $request->status);
                        })
                        ->latest()
                        ->paginate(20);

        if (request()->ajax()) {
            return response()->json([
                'data' => view('admin.influencers.datas', compact('influencers'))->render()
            ]);
        }

        return view('admin.influencers.index', compact('influencers'));
    }

    public function maanFilter(Request $request)
    {
        $influencers = User::withCount('services', 'orders')
            ->withSum('orders', 'amount')
            ->withCount(['orders as completed_orders' => function ($query) {
                $query->where('status', 'complete');
            }])
            ->where('role', 'influencer')
            ->when($request->has('status'), function ($q) use ($request) {
                $q->where('status', $request->status);
            })
            ->when($request->has('search'), function ($q) use ($request) {
                $search = $request->search;
                $q->where(function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%')
                        ->orWhere('email', 'like', '%' . $search . '%');
                });
            })
            ->when($request->id, function ($query) use ($request) {
                $query->where('id', $request->id);
            })
            ->latest()
            ->paginate($request->per_page ?? 20);

        if (request()->ajax()) {
            return response()->json([
                'data' => view('admin.influencers.datas', compact('influencers'))->render()
            ]);
        }
        return redirect(url()->previous());
    }


    public function show($id)
    {
        $withdraws = Withdraw::where('user_id', $id)->get();

        $orders = Order::where('influencer_id', $id)->latest()->paginate(10);
        $total_active = $orders->where('status', 'active')->count();
        $total_complete = $orders->where('status', 'complete')->count();
        $total_pending = $orders->where('status', 'pending')->count();

        $services = Service::with('category')->where('user_id', $id)->latest()->paginate(10);
        $user = User::with('categories')->findOrFail($id);
        $reviews = Review::whereHas('service', function ($query) use ($id) {
                        $query->where('user_id', $id);
                     })
                    ->latest()
                    ->paginate(10);

        return view('admin.influencers.details.index', compact('user', 'orders', 'services', 'reviews', 'total_active', 'total_complete', 'total_pending', 'withdraws'));
    }

    public function showOrderFilter(Request $request, $id)
    {
        $orders = Order::where('influencer_id', $id)
        ->with('service:id,user_id,title', 'service.user:id,name')
            ->when(request('search'), function ($q) {
                $q->where('total_amount', 'like', '%' . request('search') . '%')
                    ->orWhere('status', 'like', '%' . request('search') . '%')
                    ->orWhere('end_date', 'like', '%' . request('search') . '%');

                $q->orwhereHas('user', function($influencer) {
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
                'data' => view('admin.influencers.details.order-datas', compact('orders'))->render(),
            ]);
        }
        return redirect(url()->previous());
    }


    public function showServiceFilter(Request $request, $id)
    {
        $services = Service::with('category')->where('user_id', $id)
        ->when(request('search'), function ($q) use ($request) {
            $q->where(function ($q) use ($request) {
                $q->where('discount_type', 'like', '%' . request('search') . '%')
                    ->orWhere('title', 'like', '%' . request('search') . '%')
                    ->orWhere('price', 'like', '%' . request('search') . '%')
                    ->orWhereHas('category', function ($query) {
                        $query->where('name', 'like', '%' . request('search') . '%')
                            ->orWhere('id', 'like', '%' . request('search') . '%');
                    })
                    ->orWhereHas('user', function ($query) {
                        $query->where('name', 'like', '%' . request('search') . '%');
                    });

            });
        })
            ->latest()
            ->paginate($request->per_page ?? 20);

        if (request()->ajax()) {
            return response()->json([
                'data' => view('admin.influencers.details.datas', compact('services'))->render(),
            ]);
        }
        return redirect(url()->previous());
    }

    public function destroy(string $id)
    {
        $influencer = User::findOrFail($id);
        $influencer->delete();

        return response()->json([
            'message' => __('Influencer deleted successfully'),
            'redirect' => route('admin.influencers.index')
        ]);
    }

    public function deleteAll(Request $request)
    {
        User::whereIn('id', $request->ids)->delete();
        return response()->json([
            'message' => __('Selected Items deleted successfully.'),
            'redirect' => route('admin.influencers.index'),
        ]);
    }

    public function reject(Request $request, string $id)
    {
        $request->validate([
            'reason' => 'required|string|max:255',
        ]);

        $influencer_reject = User::findOrFail($id);

        if ($influencer_reject) {
            $influencer_reject->update([
                'status' => 'rejected',
                'reason' => $request->reason,
            ]);
            sendPushNotify(
                'Account Rejection Notice',
                'Your account application has been reviewed and unfortunately was not approved at this time. For more information, please contact support.',
                $influencer_reject->device_token
            );
            sendNotification($influencer_reject->id, route('admin.influencers.index', ['id' => $influencer_reject->id]), notify_users([$influencer_reject->id]), admin_msg:__('influencer has been rejected'), influ_msg: __($influencer_reject->name . ' You are rejected in our system'));

            return response()->json([
                'message' => 'Influencer rejected successfully',
                'redirect' => route('admin.influencers.index'),
            ]);
        } else {
            return response()->json(['message' => 'Influencers request not found'], 404);
        }
    }

    public function approve(Request $request, string $id)
    {
        $request->validate([
            'reason' => 'required|string|max:255',
        ]);

        $influencer_approve = User::findOrFail($id);

        if ($influencer_approve) {
            $influencer_approve->update([
                'status' => 'active',
                'reason' => $request->reason,
            ]);

            sendPushNotify(
                'Account Approval Notice',
                'Congratulations! Your account application has been approved. You now have full access to our system.',
                $influencer_approve->device_token
            );

            sendNotification($influencer_approve->id, route('admin.influencers.index', ['id' => $influencer_approve->id]), notify_users([$influencer_approve->id]), admin_msg:__('influencer has been approved'), influ_msg: __($influencer_approve->name . ' You are approved in our system'));

            return response()->json([
                'message' => 'Influencer Approve successfully',
                'redirect' => route('admin.influencers.index'),
            ]);
        } else {
            return response()->json(['message' => 'Influencer request not found'], 404);
        }
    }

    public function banned(Request $request, string $id)
    {
        $request->validate([
            'reason' => 'required|string|max:255',
        ]);

        $influencer_banned = User::findOrFail($id);

        if ($influencer_banned) {
            $influencer_banned->update([
                'status' => 'banned',
                'reason' => $request->reason,
            ]);

            sendPushNotify(
                'Account banned Notice',
                'Your account has been banned due to policy violations. For further details, please contact support.',
                $influencer_banned->device_token
            );

            sendNotification($influencer_banned->id, route('admin.influencers.index', ['id' => $influencer_banned->id]), notify_users([$influencer_banned->id]), admin_msg:__('influencer has been banned'), influ_msg: __($influencer_banned->name . ' You are banned in our system'));

            return response()->json([
                'message' => 'Influencer banned successfully',
                'redirect' => route('admin.influencers.index'),
            ]);
        } else {
            return response()->json(['message' => 'Influencer request not found'], 404);
        }
    }

    public function service_reject(Request $request, string $id)
    {
        $request->validate([
            'reason' => 'required|string|max:255',
        ]);

        $service_reject = Service::with('user:id,device_token')->findOrFail($id);

        if ($service_reject) {
            $service_reject->update([
                'status' => 'rejected',
                'reason' => $request->reason,
            ]);

            sendPushNotify(
                'Service Rejection Notice',
                'We regret to inform you that your service titled "' . $service_reject->title . '" has been rejected by the admin. For further details or assistance, please contact support.',
                $service_reject->user->device_token
            );

            sendNotification($service_reject->id, route('admin.services.index', ['id' => $service_reject->id]), notify_users([$service_reject->user_id]), admin_msg:__(' Service has been rejected'), influ_msg: __('Your ' . $service_reject->title . ' service has been rejected by admin.'));

            return response()->json([
                'message' => 'Service rejected successfully',
                'redirect' => route('admin.influencers.index'),
            ]);
        } else {
            return response()->json(['message' => 'Service request not found'], 404);
        }
    }

    public function send_email(Request $request)
    {
        $data = [
            'subject' => $request->subject,
            'message' => $request->message,
        ];

        if (env('QUEUE_MAIL')) {
            Mail::to($request->email)->queue(new InfluencerMail($data));
        } else {
            Mail::to($request->email)->send(new InfluencerMail($data));
        }

        return response()->json([
            'message' => 'Mail send successfully',
            'redirect' => route('admin.influencers.index'),
        ]);
    }
}
