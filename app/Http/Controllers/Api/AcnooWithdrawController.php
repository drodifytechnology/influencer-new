<?php

namespace App\Http\Controllers\Api;

use App\Models\Withdraw;
use App\Models\UserMethod;
use Illuminate\Http\Request;
use App\Models\WithdrawMethod;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AcnooWithdrawController extends Controller
{
    public function index()
    {
        $withdraws = Withdraw::with('withdraw_method:id,name')->where('user_id', auth()->id())->get();

        return response([
            'meassage' => 'Data fetched successfully',
            'data' => $withdraws
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_method_id' => 'required|integer',
            'amount' => 'required|string',
            'status' => 'nullable|string'
        ]);

        $user = auth()->user();
        $user_method = UserMethod::findOrFail($request->user_method_id);
        $method = WithdrawMethod::findOrFail($user_method->method_id);

        $charge = $method->charge;
        if ($method->charge_type == 'percentage') {
            $charge = ($request->amount / 100) * $method->charge;
        }

        $total_amount = $request->amount + $charge;

        DB::beginTransaction();
        try {

            if ($user->balance >= $total_amount) {

                $withdraw = Withdraw::create([
                    'user_id' => $user->id,
                    'amount' => $total_amount,
                    'user_method_id' => $user_method->method_id,
                    'charge' => $method->charge,
                    'notes' => $request->notes
                ]);

                $user->update([
                    'balance' => $user->balance - $total_amount,
                ]);

                DB::commit();

                sendPushNotify(
                    'Withdrawal Request Submitted',
                    'Your withdrawal request of ' . $total_amount . ' has been successfully submitted. We will notify you once it is processed.',
                    $user->device_token 
                );

                sendNotification($withdraw->id, route('admin.withdraw-request.index', ['id' => $withdraw->id]), notify_users([$withdraw->user_id]), admin_msg:__('New withdraw request'), influ_msg:__('withdraw request successfully'),);

                return response()->json([
                    'message' => 'Balance withdrawn successfully',
                    'amount' => $withdraw->amount
                ]);

            } else {
                return response()->json([
                    'message' => 'Insufficient balance']
                , 400);
            }
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => 'Transaction failed: ' . $e->getMessage()], 500);
        }
    }
}
