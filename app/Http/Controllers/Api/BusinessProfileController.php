<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BusinessProfile;
use App\Models\UserKyc;
use Illuminate\Http\Request;

class BusinessProfileController extends Controller
{
     
    public function index(){
        $profile = BusinessProfile::where('user_id', auth()->id())->first();

        if (!$profile) {
            return response()->json([
                'status' => false,
                'message' => 'Business profile not found',
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data' => $profile,
        ]);
    }
    public function store(Request $request)
    {
        $commonRules = [
            'business_type' => 'required|in:individual,business,brand,company',
            'address' => 'required|string',
            'name' => 'required|string',
        ];

       $typeSpecificRules = match ($request->input('business_type')) {
            'business' => [
                'gst' => 'required|string|regex:/^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}Z[0-9A-Z]{1}$/',
            ],
            'brand' => [
                'cin' => 'required|string|regex:/^([A-Z]{1}[0-9]{5}[A-Z]{2}[0-9]{4}[A-Z]{3}[0-9]{6})$/',
            ],
            'company' => [
                'pan' => 'required|string|regex:/^[A-Z]{5}[0-9]{4}[A-Z]{1}$/',
            ],
            default => [] // Handles 'individual' or any fallback case
        };

        $validator = Validator::make($request->all(), array_merge($commonRules, $typeSpecificRules));

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }
        $profile = BusinessProfile::create([
            'user_id' => Auth::id(), // Or pass in $request->user_id if admin submits
            'business_type' => $request->business_type,
            'name' => $request->name,
            'gst' => $request->gst,
            'cin' => $request->cin,
            'pan' => $request->pan,
            'address' => $request->address,
        ]);
        return response()->json([
            'status' => true,
            'message' => 'Business profile submitted successfully',
        ]);
    }
}
