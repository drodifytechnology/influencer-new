<?php

namespace App\Http\Controllers\Api;

use App\Models\Option;
use App\Http\Controllers\Controller;

class AcnooTermConditionController extends Controller
{
    public function index()
    {
        $about_us = Option::where('key', 'term-condition')->first();
        return response()->json([
            'message' => 'About Us fetched successfully',
            'data' => $about_us
        ]);
    }
}
