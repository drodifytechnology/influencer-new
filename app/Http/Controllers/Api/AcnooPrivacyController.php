<?php

namespace App\Http\Controllers\Api;

use App\Models\Option;
use App\Http\Controllers\Controller;

class AcnooPrivacyController extends Controller
{
    public function index()
    {
        $policy = Option::where('key', 'policy')->first()->value;
        return response()->json([
            'status' => 200,
            'message' => __('Data fetched successfully.'),
            'data' => $policy ?? 'Privacy Policy',
        ]);
    }
}
