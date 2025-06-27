<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;

class AcnooTransactionController extends Controller
{
    public function index()
    {
        $transaction = Order::with('influencer:id,name')
                        ->select('id', 'influencer_id', 'user_id', 'total_amount', 'created_at')
                        ->where(['user_id' => auth()->id(), 'payment_status' => 'paid'])
                        ->when(request('filter') == 'today', function ($q) {
                            $q->whereDate('created_at', today());
                        })
                        ->when(request('filter') == 'weekly', function ($q) {
                            $q->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
                        })
                        ->when(request('filter') == 'monthly', function ($q) {
                            $q->whereBetween('created_at', [now()->startOfMonth(), now()->endOfMonth()]);
                        })
                        ->when(request('filter') == 'yearly', function ($q) {
                            $q->whereBetween('created_at', [now()->startOfYear(), now()->endOfYear()]);
                        })
                        ->latest()
                        ->paginate();

        return response()->json([
            'message' => 'Data fetched successfully',
            'data' => $transaction
        ]);
    }
}
