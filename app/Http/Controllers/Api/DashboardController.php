<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Withdraw;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $month = request('filter') == 'this_month' ? date('m') : Carbon::now()->subMonth()->month;

        $total_charge = Order::where('user_id', auth()->id())->where('status', 'complete')->sum('charge');
        $current_charge = Order::where('user_id', auth()->id())->where('status', 'complete')->whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->sum('charge'); // current month charge

        $data['total_earnings'] = Order::where('user_id', auth()->id())->where('status', 'complete')->sum('amount') - $total_charge;
        $data['total_withdraws'] = Withdraw::where('user_id', auth()->id())->where('status', 'completed')->sum('amount');
        $data['current_month'] = Withdraw::where('user_id', auth()->id())->where('status', 'completed')->whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->sum('amount') - $current_charge;
        $data['available_balance'] = auth()->user()->balance;

        $data['total_orders'] = Order::where('influencer_id', auth()->id())->whereMonth('created_at', $month)->count();
        $data['active_orders'] = Order::where('influencer_id', auth()->id())->whereMonth('created_at', $month)->where('status', 'active')->count();
        $data['complete_orders'] = Order::where('influencer_id', auth()->id())->whereMonth('created_at', $month)->where('status', 'complete')->count();
        $data['canceled_orders'] = Order::where('influencer_id', auth()->id())->whereMonth('created_at', $month)->where('status', 'canceled')->count();

        return response()->json([
            'message' => __('Data fetched successfully'),
            'data' => $data
        ]);
    }
}
