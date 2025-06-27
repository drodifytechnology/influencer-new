<?php

namespace App\Http\Controllers\Api;

use App\Models\Option;
use App\Http\Controllers\Controller;

class AcnooAboutUsController extends Controller
{
    public function index()
    {
        $data = Option::where('key', 'about-us')->first();
        return response()->json([
            'message' => 'Term Condition fetched successfully',
            'data' => $data
        ]);
    }
}
