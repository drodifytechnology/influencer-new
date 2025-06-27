<?php

namespace App\Http\Controllers\Admin;

use App\Models\Notification;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:notifications-read')->only('mtIndex');
    }

    public function mtIndex()
    {
        $notifications = auth()->user()->notifications()
                        ->whereDate('created_at', today())
                        ->latest()
                        ->get();

        return view('admin.notifications.index', compact('notifications'));
    }

    public function maanFilter(Request $request)
    {
        $notifications = Notification::when(request('days') == 'daily', function ($q) {
                                $q->whereDate('created_at', now()->format('Y-m-d'));
                            })
                            ->when(request('days') == 'weekly', function ($q) {
                                $q->whereBetween('created_at', [now()->startOfWeek()->format('Y-m-d'), now()->endOfWeek()->format('Y-m-d')] );
                            })
                            ->when(request('days') == '15_days', function ($q) {
                                $q->whereDate('created_at', '>=', now()->subDays(15)->format('Y-m-d'));
                            })
                            ->when(request('days') == 'monthly', function ($q) {
                                $q->whereMonth('created_at', now()->format('m'));
                            })
                            ->when(request('days') == 'yearly', function ($q) {
                                $q->whereYear('created_at', now()->format('Y'));
                            })
                            ->latest()
                            ->get();

        return response()->json([
            'data' => view('admin.notifications.datas', compact('notifications'))->render()
        ]);
    }


    public function mtView($id)
    {
        $notify = Notification::find($id);
        if ($notify) {
            $notify->read_at = now();
            $notify->save();
            return redirect($notify->data['url'] ?? '/');
        }

        return back()->with('error', __('Premission denied.'));
    }

    public function mtReadAll()
    {
        auth()->user()->unreadNotifications()->update(['read_at' => now()]);
        return back();
    }
}
