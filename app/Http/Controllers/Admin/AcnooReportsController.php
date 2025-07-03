<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Expense;
use App\Models\Withdraw;
use App\Http\Controllers\Controller;

class AcnooReportsController extends Controller
{
    public function clientReport()
    {
        $active_client = User::where('role', 'user')->where('status', 'active')->count();
        $inactive_client = User::where('role', 'user')->where('status', 'inactive')->count();
        $client_reports = User::withCount('orders')->where('role', 'user')->latest()->paginate(20);

        return view('admin.reports.client.index', compact('client_reports', 'active_client', 'inactive_client'));
    }

    public function clientFilter(Request $request)
    {
        $client_reports = User::withCount('orders')->where('role', 'user')
                            ->when($request->role, function ($query) use ($request) {
                                $query->where('role', $request->role);
                            })
                            ->when($request->search, function ($query) use ($request) {
                                $search = $request->search;
                                $query->where(function ($q) use ($search) {
                                    $q->where('name', 'like', '%' . $search . '%')
                                        ->orWhere('email', 'like', '%' . $search . '%')
                                        ->orWhere('phone', 'like', '%' . $search . '%')
                                        ->orWhere('country', 'like', '%' . $search . '%');
                                });
                            })
                            ->latest()
                            ->paginate($request->per_page ?? 20);

        $active_client = User::where('role', 'user')->where('status', 'active')->count();
        $inactive_client = User::where('role', 'user')->where('role', 'user')->where('status', 'inactive')->count();

        if ($request->ajax()) {
            return response()->json([
                'data' => view('admin.reports.client.datas', compact('client_reports', 'active_client', 'inactive_client'))->render()
            ]);
        }

        return redirect()->back();
    }


    public function influencerReport()
    {
        $influencer_reports = User::withCount('orders')->withCount('services')->withCount(['orders as completed_orders' => function ($query) {
                                    $query->where('status', 'complete');
                                }])
                                ->where('role', 'influencer')
                                ->latest()
                                ->paginate(20);

        $active_influencer =  User::where('role', 'influencer')->where('status', 'active')->count();
        $inactive_influencer =  User::where('role', 'influencer')->where('status', 'inactive')->count();

        return view('admin.reports.influencer.index', compact('influencer_reports', 'active_influencer', 'inactive_influencer'));
    }

    public function influencerFilter(Request $request)
    {
        $influencer_reports = User::withCount('orders')->withCount('services')->withCount(['orders as completed_orders' => function ($query) {
            $query->where('status', 'complete');
        }])
            ->where('role', 'influencer')
            ->when($request->search, function ($query) use ($request) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%')
                        ->orWhere('email', 'like', '%' . $search . '%')
                        ->orWhere('phone', 'like', '%' . $search . '%')
                        ->orWhere('country', 'like', '%' . $search . '%');
                });
            })
            ->latest()
            ->paginate($request->per_page ?? 20);

        $active_influencer = User::where('role', 'influencer')->where('status', 'active')->count();
        $inactive_influencer = User::where('role', 'influencer')->where('status', 'inactive')->count();

        if ($request->ajax()) {
            return response()->json([
                'data' => view('admin.reports.influencer.datas', compact('influencer_reports', 'active_influencer', 'inactive_influencer'))->render()
            ]);
        }

        return redirect()->back();
    }

    public function withdrawReport()
    {
        $withdraws = Withdraw::with('withdraw_method:id,name', 'user:id,name')->latest()->paginate(20);
        $withdraw_success = Withdraw::where('status', 'approve')->count();
        $withdraw_rejected = Withdraw::where('status', 'rejected')->count();
        $total_amount = Withdraw::sum('amount');

        return view('admin.reports.withdraw.index', compact('withdraws', 'withdraw_success', 'withdraw_rejected', 'total_amount'));
    }

    public function withdrawFilter(Request $request)
    {
        $withdraws = Withdraw::with('withdraw_method:id,name', 'user:id,name')
                        ->when(request('search'), function ($q) {
                            $q->where('charge', 'like', '%' . request('search') . '%')
                                ->orWhere('amount', 'like', '%' . request('search') . '%')
                                ->orWhere('status', 'like', '%' . request('search') . '%')
                                ->orWhereHas('withdraw_method', function ($q) {
                                    $q->where('name', 'like', '%' . request('search') . '%');
                                })

                                ->orWhereHas('user', function ($q) {
                                    $q->where('name', 'like', '%' . request('search') . '%');
                                });
                        })
                        ->latest()
                        ->paginate($request->per_page ?? 20);

        $withdraw_success = Withdraw::where('status', 'approve')->count();
        $withdraw_rejected = Withdraw::where('status', 'rejected')->count();
        $total_amount = Withdraw::sum('amount');

        if ($request->ajax()) {
            return response()->json([
                'data' => view('admin.reports.withdraw.datas', compact('withdraws', 'withdraw_success', 'withdraw_rejected', 'total_amount'))->render()
            ]);
        }

        return redirect()->back();
    }

    public function incomeReport()
    {
        $income_reports = Order::with('gateway:id,name', 'service:id,title')
                            ->where('status', 'complete')
                            ->latest()
                            ->paginate(20);

        $total_income = Order::sum('charge');

        return view('admin.reports.income.index', compact('income_reports', 'total_income'));
    }

    public function incomeFilter(Request $request)
    {
        $search = $request->input('search');

        $income_reports = Order::with('gateway:id,name', 'service:id,title')
            ->where('status', 'complete')
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('charge', 'like', '%' . $search . '%')
                        ->orWhere('amount', 'like', '%' . $search . '%')
                        ->orWhere('status', 'like', '%' . $search . '%')
                        ->orWhere('payment_status', 'like', '%' . $search . '%')
                        ->orWhereHas('gateway', function ($q) use ($search) {
                            $q->where('name', 'like', '%' . $search . '%');
                        })
                        ->orWhereHas('service', function ($q) use ($search) {
                            $q->where('title', 'like', '%' . $search . '%');
                        });
                });
            })
            ->latest()
            ->paginate($request->per_page ?? 20);

        $total_income = Order::sum('charge');

        if ($request->ajax()) {
            return response()->json([
                'data' => view('admin.reports.income.datas', compact('income_reports', 'total_income'))->render()
            ]);
        }

        return redirect()->back();
    }


    public function expenseReport()
    {
        $expenses = Expense::with('expense_category:id,name', 'payment_type', 'user:id,name')->latest()->paginate(20);
        $total_expense = Expense::sum('amount');

        return view('admin.reports.expense.index', compact('expenses', 'total_expense'));
    }

    public function expenseFilter(Request $request)
    {
        $expenses = Expense::with('expense_category:id,name', 'payment_type', 'user:id,name')
            ->when(request('search'), function ($q) {
                $q->where('created_at', 'like', '%' . request('search') . '%')
                    ->where('amount', 'like', '%' . request('search') . '%')
                    ->orWhereHas('expense_category', function ($q) {
                        $q->where('name', 'like', '%' . request('search') . '%');
                    })
                    ->orWhereHas('user', function ($q) {
                        $q->where('name', 'like', '%' . request('search') . '%');
                    })
                    ->orWhereHas('payment_type', function ($q) {
                        $q->where('value', 'like', '%' . request('search') . '%');
                    });
            })
            ->latest()
            ->paginate($request->per_page ?? 20);

        $total_expense = Expense::sum('amount');

        if ($request->ajax()) {
            return response()->json([
                'data' => view('admin.reports.expense.datas', compact('expenses', 'total_expense'))->render()
            ]);
        }

        return redirect(url()->previous());
    }

    public function orderReport()
    {
        $orders = Order::with('influencer:id,name', 'service:id,title')->latest()->paginate(20);
        $total_orders = Order::count();
        return view('admin.reports.orders.index', compact('orders','total_orders'));
    }

    public function orderFilter(Request $request)
    {
        $orders = Order::with('influencer:id,name', 'service:id,title')
                    ->when(request('search'), function ($q) {
                        $q->where('total_amount', 'like', '%' . request('search') . '%')
                            ->where('end_date', 'like', '%' . request('search') . '%')
                            ->where('payment_status', 'like', '%' . request('search') . '%')
                            ->where('status', 'like', '%' . request('search') . '%')
                            ->orWhereHas('influencer', function ($q) {
                                $q->where('name', 'like', '%' . request('search') . '%');
                            })
                            ->orWhereHas('service', function ($q) {
                                $q->where('title', 'like', '%' . request('search') . '%');
                            });
                    })
                    ->latest()
                    ->paginate($request->per_page ?? 20);

        if ($request->ajax()) {
            return response()->json([
                'data' => view('admin.reports.orders.datas', compact('orders'))->render()
            ]);
        }

        return redirect(url()->previous());
    }
}
