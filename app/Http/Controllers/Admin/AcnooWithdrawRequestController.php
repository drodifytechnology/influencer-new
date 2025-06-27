<?php

namespace App\Http\Controllers\Admin;

use App\Models\Withdraw;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AcnooWithdrawRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $withdraws = Withdraw::with('withdraw_method:id,name', 'user:id,name')->latest()->paginate(20);
        return view('admin.withdrawals.index', compact('withdraws'));
    }

    public function maanFilter(Request $request)
    {
        $withdraws = Withdraw::with('withdraw_method:id,name', 'user:id,name')
                    ->when(request('search'), function ($q) {
                        $q->where('amount', 'like', '%' . request('search') . '%')
                            ->orWhere('charge', 'like', '%' . request('search') . '%')
                            ->orWhere('status', 'like', '%' . request('search') . '%');

                        $q->orWhereHas('withdraw_method', function ($q) {
                            $q->where('name', 'like', '%' . request('search') . '%');
                        });

                        $q->orWhereHas('user', function ($q) {
                            $q->where('name', 'like', '%' . request('search') . '%');
                        });
                    })
                    ->when($request->id, function ($query) use ($request) {
                        $query->where('id', $request->id);
                    })
                    ->latest()
                    ->paginate($request->per_page ?? 20);

        if (request()->ajax()) {
            return response()->json([
                'data' => view('admin.withdrawals.datas', compact('withdraws'))->render()
            ]);
        }
        return redirect(url()->previous());
    }

    public function show(string $id)
    {
        $withdraw = Withdraw::with('withdraw_method:id,name', 'user:id,name', 'account_info')
            ->where('id', $id)
            ->latest()
            ->first();

        return view('admin.withdrawals.show', compact('withdraw'));
    }

    public function reject(Request $request, string $id)
    {
        $request->validate([
            'reason' => 'required|string|max:255',
        ]);

        $withdraw_reject = Withdraw::with('user:id,name,device_token')->findOrFail($id);

        if ($withdraw_reject) {

            $withdraw_reject->update([
                'status' => 'rejected',
                'reason' => $request->reason,
            ]);

            sendPushNotify(
                'Withdrawal Request Rejected',
                'Dear ' . $withdraw_reject->user->name . ', your withdrawal request has been rejected. The reason for this decision is: "' . $request->reason . '". Please contact support if you have any questions or need assistance.',
                $withdraw_reject->user->device_token
            );

            sendNotification($withdraw_reject->id, route('admin.withdraw-request.index', ['id' => $withdraw_reject->id]), notify_users([$withdraw_reject->user_id]), admin_msg:__('Withdraw rejected'), influ_msg:__('Your withdraw has been rejected.') );

            return response()->json([
                'message' => 'Withdrawal rejected successfully',
                'redirect' => route('admin.withdraw-request.index')
            ]);
        } else {
            return response()->json(['message' => 'Withdrawal request not found'], 404);
        }
    }

    public function approve(Request $request, string $id)
    {
        $request->validate([
            'reason' => 'required|string|max:255',
        ]);

        $withdraw = Withdraw::with('user:id,name,device_token')->findOrFail($id);

        if ($withdraw) {

            DB::beginTransaction();
            try {
                Transaction::create([
                    'type' => 'debit',
                    'user_id' => $withdraw->user_id,
                    'amount' => $withdraw->amount,
                    'notes' => $withdraw->notes,
                ]);

                $withdraw->update([
                    'status' => 'approve',
                    'reason' => $request->reason,
                ]);

                DB::commit();

                sendPushNotify(
                'Withdrawal Request Approved',
                'Dear ' . $withdraw->user->name . ', your withdrawal request of ' . $withdraw->amount . ' has been approved and processed successfully. Thank you for your patience.',
                $withdraw->user->device_token
               );

                sendNotification($withdraw->id, route('admin.withdraw-request.index', ['id' => $withdraw->id]), notify_users([$withdraw->user_id]), admin_msg:__('Withdraw approved'), influ_msg:__('Your withdraw has been approved.') );

                return response()->json([
                    'message' => 'Withdrawal Approve successfully',
                    'redirect' => route('admin.withdraw-request.index')
                ]);
            } catch (\Exception $e) {
                DB::rollback();
                return response()->json(['error' => 'Transaction failed: ' . $e->getMessage()], 500);
            }
        } else {
            return response()->json(['message' => 'Withdrawal request not found'], 404);
        }
    }
}
