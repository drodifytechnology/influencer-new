<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Service;
use App\Models\Transaction;
use App\Http\Controllers\Controller;
use App\Models\Withdraw;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:dashboard-read')->only('index');
    }

    public function index()
    {
        $users = User::withCount('orders')->whereRole('user')->latest()->take(5)->get();
        $influencers = User::withCount('services')->whereRole('influencer')->latest()->take(5)->get();

        return view('admin.dashboard.index', compact('users', 'influencers'));
    }

    public function getDashboardData()
    {
        $data['app_user'] = User::count();
        $data['total_client'] = User::whereRole('user')->count();
        $data['active_client'] = User::whereRole('user')->where('status', 'active')->count();
        $data['total_influencer'] = User::whereRole('influencer')->count();
        $data['active_influencer'] = User::whereRole('influencer')->where('status', 'active')->count();
        $data['total_service'] = Service::count();
        $data['total_expense'] = currency_format(Transaction::where('type', 'debit')->sum('amount'));
        $data['total_income'] = currency_format(Transaction::where('type', 'credit')->sum('amount'));

        return response()->json($data);

    }

    public function yearlyWithdraw()
    {
        $year = request('year') ?? date('Y');
        $data['year'] = Withdraw::whereStatus('approve')
                            ->whereYear('created_at', $year)
                            ->selectRaw('MONTHNAME(created_at) as month, SUM(amount) as total_withdraw, MONTH(created_at) as month_number')
                            ->groupBy('month', 'month_number')
                            ->orderBy('month_number')
                            ->get();

        return response()->json($data);
    }

    public function yearlyincome()
    {
        $year = request('year') ?? date('Y');
        $data['year_value'] = Transaction::whereType('credit')
                                ->whereYear('created_at', $year)
                                ->selectRaw('MONTHNAME(created_at) as month, SUM(amount) as total_income, MONTH(created_at) as month_number')
                                ->groupBy('month', 'month_number')
                                ->orderBy('month_number')
                                ->get();

        return response()->json($data);
    }

}
