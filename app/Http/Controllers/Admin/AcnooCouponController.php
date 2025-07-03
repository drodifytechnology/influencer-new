<?php

namespace App\Http\Controllers\Admin;

use App\Models\Coupon;
use App\Helpers\HasUploader;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AcnooCouponController extends Controller
{
    use HasUploader;

    public function index(Request $request)
    {
        $coupons = Coupon::latest()->paginate(20);
        return view('admin.coupons.index', compact('coupons'));
    }

    public function maanFilter(Request $request)
    {
        $coupons = Coupon::when(request('search'), function ($q) {
                        $q->where('title', 'like', '%' . request('search') . '%')
                            ->orWhere('discount_type', 'like', '%' . request('search') . '%')
                            ->orWhere('discount', 'like', '%' . request('search') . '%')
                            ->orWhere('start_date', 'like', '%' . request('search') . '%')
                            ->orWhere('end_date', 'like', '%' . request('search') . '%');
                    })
                    ->latest()
                    ->paginate($request->per_page ?? 20);

        if (request()->ajax()) {
            return response()->json([
                'data' => view('admin.coupons.datas', compact('coupons'))->render()
            ]);
        }

        return redirect(url()->previous());
    }

    public function create()
    {
        return view('admin.coupons.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'code' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'discount_type' => 'required',
            'discount' => 'required',
            'status' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',
            'description' => 'nullable|string',

        ]);

        Coupon::create($request->except('image') + [
            'image' => $request->image ? $this->upload($request, 'image') : NULL,
        ]);

        return response()->json([
            'message' => 'Coupon created successfully',
            'redirect' => route('admin.coupons.index')
        ]);
    }

    public function edit(Coupon $coupon)
    {
        return view('admin.coupons.edit', compact('coupon'));
    }

    public function update(Request $request, Coupon $coupon)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'code' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'discount_type' => 'required',
            'discount' => 'required',
            'status' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',
            'description' => 'nullable|string'

        ]);

        $coupon->update($request->except('image') + [
            'image' => $request->image ? $this->upload($request, 'image') : $coupon->image,
        ]);

        return response()->json([
            'message' => 'Coupon Updated successfully',
            'redirect' => route('admin.coupons.index')
        ]);
    }


    public function destroy(Coupon $coupon)
    {
        $coupon->delete();
        return response()->json([
            'message' => 'Coupon Deleted Successfully',
            'redirect' => route('admin.coupons.index')
        ]);
    }

    public function status(Request $request, $id)
    {
        $coupon_status = Coupon::findOrFail($id);
        $coupon_status->update(['status' => $request->status]);
        return response()->json(['message' => 'Coupon']);
    }

    public function deleteAll(Request $request)
    {
        Coupon::whereIn('id', $request->ids)->delete();
        return response()->json([
            'message' => __('Selected Items deleted successfully.'),
            'redirect' => route('admin.coupons.index')
        ]);
    }
}
