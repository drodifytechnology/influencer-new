<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Coupon;

class CouponController extends Controller
{
    public function index()
    {
        $data = Coupon::whereDate('end_date' , '>=', now())->latest()->get();

        return response()->json([
            'message'   => __('Data fetched successfully'),
            'data'      => $data
        ]);
    }
}
