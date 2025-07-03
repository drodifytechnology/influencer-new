<?php

namespace App\Http\Controllers\Admin;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AcnooServiceController extends Controller
{
    public function index(Request $request)
    {
        $services = Service::with('category:id,name', 'user:id,name')
                    ->withCount(['orders as completed_orders' => function ($query) {
                        $query->where('status', 'complete');
                    }])
                    ->withCount(['orders as total_orders' => function ($query) {
                        $query->where('payment_status', 'paid');
                    }])
                    ->when(request('search'), function ($q) {
                        $q->where('discount_type', 'like', '%' . request('search') . '%')
                            ->orWhere('title', 'like', '%' . request('search') . '%')
                            ->orWhere('discount', 'like', '%' . request('search') . '%')
                            ->orWhere('price', 'like', '%' . request('search') . '%')
                            ->orWhere('duration', 'like', '%' . request('search') . '%')
                            ->orWhere('description', 'like', '%' . request('search') . '%')
                            ->orWhere('features', 'like', '%' . request('search') . '%')
                            ->orWhere('category_id', 'like', '%' . request('search') . '%')
                            ->orWhereHas('category', function ($query) {
                                $query->where('name', 'like', '%' . request('search') . '%')
                                    ->orWhere('id', 'like', '%' . request('search') . '%');
                            })
                            ->orWhereHas('user', function ($query) {
                                $query->where('name', 'like', '%' . request('search') . '%');
                            });
                    })
                    ->when(request('min_price') && request('max_price'), function ($query) {
                        $query->whereBetween('price', [request('min_price'), request('max_price')]);
                    })
                    ->when($request->id, function ($query) use ($request) {
                        $query->where('id', $request->id);
                    })
                    ->latest()
                    ->paginate(20);

        if (request()->ajax()) {
            return response()->json([
                'data' => view('admin.services.datas', compact('services'))->render()
            ]);
        }

        return view('admin.services.index', compact('services'));
    }

   

    public function maanFilter(Request $request)
    {
        $services = Service::with('category:id,name', 'user:id,name')
            ->withCount('orders')
            ->withCount(['orders as completed_orders' => function ($query) {
                $query->where('status', 'complete');
            }])
            ->when(request('search'), function ($q) use ($request) {
                $q->where(function ($q) use ($request) {
                    $q->where('discount_type', 'like', '%' . request('search') . '%')
                        ->orWhere('title', 'like', '%' . request('search') . '%')
                        ->orWhere('title', 'like', '%' . request('search') . '%')
                        ->orWhere('discount', 'like', '%' . request('search') . '%')
                        ->orWhere('price', 'like', '%' . request('search') . '%')
                        ->orWhere('duration', 'like', '%' . request('search') . '%')
                        ->orWhere('description', 'like', '%' . request('search') . '%')
                        ->orWhere('features', 'like', '%' . request('search') . '%')
                        ->orWhere('category_id', 'like', '%' . request('search') . '%')
                        ->orWhereHas('category', function ($query) {
                            $query->where('name', 'like', '%' . request('search') . '%')
                                ->orWhere('id', 'like', '%' . request('search') . '%');
                        })
                        ->orWhereHas('user', function ($query) {
                            $query->where('name', 'like', '%' . request('search') . '%');
                        })
                        ->when(request('min_price') && request('max_price'), function ($query) {
                            $query->whereBetween('price', [request('min_price'), request('max_price')]);
                        })
                        ->when($request->id, function ($query) use ($request) {
                            $query->where('id', $request->id);
                        });
                });
            })
            ->latest()
            ->paginate($request->per_page ?? 20);

        if ($request->ajax()) {
            return response()->json([
                'data' => view('admin.services.datas', compact('services'))->render()
            ]);
        }
        return redirect(url()->previous());
    }


    public function update(Request $request, string $id){
         $request->validate([
            'price' => 'required',
        ]);
         $service_reject = Service::findOrFail($id);
         $service_reject->update([
            'admin_price' => $request->price,
        ]);
        return response()->json([
            'message' => 'Service price updated successfully',
            'redirect' => route('admin.services.index')
        ]);   
    }
    public function reject(Request $request, string $id)
    {
        $request->validate([
            'reason' => 'required|string|max:255',
        ]);

        $service_reject = Service::with('user:id,name,device_token')->findOrFail($id);

        if ($service_reject->status === 'pending' || $service_reject->status === 'active') {
            $service_reject->update([
                'status' => 'rejected',
                'reason' => $request->reason,
            ]);

            sendPushNotify(
                'Service Rejected Notice',
                'Dear ' . $service_reject->user->name . ', your service titled "' . $service_reject->title . '" has been rejected. Please contact support if you have any questions.',
                $service_reject->user->device_token
            );


            sendNotification($service_reject->id, route('admin.services.index', ['id' => $service_reject->id]), notify_users([$service_reject->user_id]), admin_msg: __('Service has been rejected.'),  influ_msg: __('Your ' . $service_reject->title . ' service has been rejected'),);

            return response()->json([
                'message' => 'Service rejected successfully',
                'redirect' => route('admin.services.index')
            ]);
        } else {
            $service_reject->update([
                'status' => 'active',
                'reason' => $request->reason,
            ]);

            sendPushNotify(
                'Service approved Notice',
                'Dear ' . $service_reject->user->name . ', your service titled "' . $service_reject->title . '" has been approved.',
                $service_reject->user->device_token
            );

            sendNotification($service_reject->id, route('admin.services.index', ['id' => $service_reject->id]), notify_users([$service_reject->user_id]), admin_msg: __('Service has been approved.'),  influ_msg: __('Your ' . $service_reject->title . ' service has been approved'),);

            return response()->json([
                'message' => 'Service approved successfully',
                'redirect' => route('admin.services.index')
            ]);        }
    }

    public function deleteAll(Request $request)
    {
        Service::whereIn('id', $request->ids)->delete();
        return response()->json([
            'message' => __('Selected Services deleted successfully.'),
            'redirect' => route('admin.services.index')
        ]);
    }
}
