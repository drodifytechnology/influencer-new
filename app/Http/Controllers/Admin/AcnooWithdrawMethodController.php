<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\WithdrawMethod;
use Illuminate\Http\Request;

class AcnooWithdrawMethodController extends Controller
{
    public function index()
    {
        $withdrawMethods = WithdrawMethod::with('currency:id,name')->latest()->paginate(20);
        return view('admin.withdrawals.withdrawal-method.index', compact('withdrawMethods'));
    }

    public function maanFilter(Request $request)
    {
        $withdrawMethods = WithdrawMethod::with('currency:id,name')
        ->when(request('search'), function($q) {
            $q->where('name', 'like', '%'.request('search').'%')
                ->orWhere('min_amount', 'like', '%'.request('search').'%')
                ->orWhere('max_amount', 'like', '%'.request('search').'%')
                ->orWhere('charge', 'like', '%'.request('search').'%');

            $q->orWhereHas('currency', function($q) {
                $q->where('name', 'like', '%'.request('search').'%');
            });
        })
        ->latest()
        ->paginate($request->per_page ?? 20);

        if ($request->ajax()) {
            return response()->json([
                'data' => view('admin.withdrawals.withdrawal-method.datas', compact('withdrawMethods'))->render()
            ]);
        }
        return redirect(url()->previous());
    }

    public function create()
    {
        $currencies = Currency::latest()->get();
        return view('admin.withdrawals.withdrawal-method.create',compact('currencies'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'min_amount' => 'required|numeric',
            'max_amount' => 'required|numeric',
            'charge' => 'required|numeric',
            'charge_type' => 'required|string',
            'instructions' => 'nullable|string',
            'account_no' => 'nullable|string',
        ]);

        WithdrawMethod::create($request->all());

        return response()->json([
            'message'   => __('Payment Method Created successfully'),
            'redirect'  => route('admin.withdraw_methods.index')
        ]);
    }

    public function edit(WithdrawMethod $withdrawMethod)
    {
        $currencies= Currency::latest()->get();
        return view('admin.withdrawals.withdrawal-method.edit',compact('withdrawMethod','currencies'));
    }

    public function update(Request $request, WithdrawMethod $withdrawMethod)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'min_amount' => 'required|numeric',
            'max_amount' => 'required|numeric',
            'charge' => 'required|numeric',
            'instructions' => 'nullable|string',
        ]);

        $withdrawMethod->update($request->all());

        return response()->json([
            'message'   => __('Payment Method Updated successfully'),
            'redirect'  => route('admin.withdraw_methods.index')
        ]);
    }

    public function destroy(WithdrawMethod $withdrawMethod)
    {
        $withdrawMethod->delete();
        return response()->json([
            'message' => __('Withdraw Method Deleted Successfully'),
            'redirect' => route('admin.withdraw_methods.index')
        ]);
    }

    public function status(Request $request, $id)
    {
        $withdrawMethod = WithdrawMethod::findOrFail($id);
        $withdrawMethod->update(['status' => $request->status]);
        return response()->json(['message' => 'withdrawMethod']);
    }

    public function deleteAll(Request $request) {
        WithdrawMethod::whereIn('id', $request->ids)->delete();
        return response()->json([
            'message' => __('Selected Items deleted successfully.'),
            'redirect' => route('admin.withdraw_methods.index')
        ]);
    }
}
