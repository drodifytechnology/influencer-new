<?php

namespace App\Http\Controllers\Api;

use App\Models\Option;
use App\Http\Controllers\Controller;

class AcnooServiceChargeController extends Controller
{
    public function index()
    {
        $service_charge = Option::where('key', 'service-charge')->first()->value ?? [];

        return response()->json([
            'message' => 'Data fetched successfully',
            'data' => $service_charge
        ]);
    }
}
