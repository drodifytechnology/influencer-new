<?php

namespace App\Http\Controllers\Api;

use App\Models\UserMethod;
use App\Helpers\HasUploader;
use Illuminate\Http\Request;
use App\Models\WithdrawMethod;
use App\Http\Controllers\Controller;

class WithdrawMethodController extends Controller
{
    use HasUploader;

    public function index()
    {
        $data = WithdrawMethod::where('status', 1)->get();
        return response()->json([
            'message' => __('Data fetched successfully.'),
            'data' => $data
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'method_id' => 'required|integer',
            'account_no' => 'required|integer',
        ]);

        $userMethod = UserMethod::create($request->except('user_id') +[
            'user_id' => auth()->id()
        ]);

        return response()->json([
            'message' => __('Withdraw method setup successfully.'),
            'data' => $userMethod,
        ]);
    }

    public function show($id)
    {
        $method = UserMethod::with('withdraw_method')->where('user_id', $id)->get();

        return response()->json([
            'message' => __('Data fetched successfully.'),
            'data' => $method
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'method_id' => 'required|integer',
            'account_no' => 'required|integer',
        ]);

        $method = UserMethod::findOrFail($id);
        $method->update($request->all());

        return response()->json([
            'message' => __('Withdraw method setup successfully.'),
            'data' => $method,
        ]);
    }

    public function destroy($id)
    {
        UserMethod::findOrFail($id)->delete();

        return response()->json([
            'message' => __('Withdraw method deleted successfully.')
        ]);
    }

    public function setup_methods()
    {
        $data = UserMethod::with('withdraw_method:id,name,charge,charge_type,meta')->where('user_id', auth()->id())->get();

        return response()->json([
            'message' => __('Data fetched successfully.'),
            'data' => [
                'balance' => auth()->user()->balance,
                'methods' => $data,
            ],
        ]);
    }
}
