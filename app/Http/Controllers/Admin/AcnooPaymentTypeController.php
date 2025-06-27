<?php

namespace App\Http\Controllers\Admin;

use App\Models\Option;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class AcnooPaymentTypeController extends Controller
{
    public function index()
    {
        $payment_types = Option::where('key', 'payment-type')
                            ->when(request('search'), function($q){
                                $q->where('value', 'like', '%'.request('search').'%');
                            })
                            ->latest()
                            ->paginate(20);

        if(request()->ajax()) {
            return response()->json([
                'data' => view('admin.payment-type.datas', compact('payment_types'))->render()
            ]);
        }

        return view('admin.payment-type.index', compact('payment_types'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

       Option::create([
            'key' => 'payment-type',
            'value' => $request->except('_token','_method'),
        ]);

        return response()->json([
            'message'   => __('Payment Type updated successfully'),
            'redirect'  => route('admin.payment-type.index')
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
                    'name' => 'required|string|max:255',
                    'description' => 'nullable|string',
                ]);

        $payment_type = Option::findOrFail($id);

        Cache::forget($payment_type->key);

        $payment_type->update([
            'key' => 'payment-type',
            'value' => $request->except('_token','_method')

        ]);

        return response()->json([
            'message'   => __('Payment Type updated successfully'),
            'redirect'  => route('admin.payment-type.index')
        ]);
    }

    public function status(Request $request, $id)
    {

        $exitType = Option::findOrFail($id);
        $exitType->update(['status' => $request->status]);
        return response()->json(['message' => 'Payment Type']);
    }

    public function destroy($id)
    {
        $option = Option::findOrFail($id);
        $option->delete();

        return response()->json([
            'message' => __('Payment Type deleted successfully'),
            'redirect' => route('admin.payment-type.index')
        ]);

    }

    public function deleteAll(Request $request) {

        $idsToDelete = $request->input('ids');
        $option = Option::whereIn('id', $idsToDelete);
        $option->delete();
        return response()->json([
            'message' => __('All Payment Type Deleted successfully'),
            'redirect' => route('admin.payment-type.index')
        ]);
    }
}
