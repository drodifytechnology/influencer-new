<?php

namespace App\Http\Controllers\Api;

use App\Models\Option;
use App\Http\Controllers\Controller;

class AcnooReportTypeController extends Controller
{
    public function index()
    {
        $report_types = Option::where('key', 'report-types')->get();

        return response()->json([
            'message' => 'Data fetched successfully',
            'data' => $report_types
        ]);
    }
}
