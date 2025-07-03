<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UserKyc;
use Illuminate\Http\Request;

class KYCController extends Controller
{

    public function index(){
        $kyc = UserKyc::where('user_id', auth()->id())->latest()->first();

        if (!$kyc) {
            return response()->json([
                'status' => false,
                'message' => 'KYC data not found',
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data' => $kyc,
        ]);
    }
    public function uploadOfflineKYC(Request $request)
    {
          $validated = $request->validate([
                'document_type' => 'required|in:pan,adhaar,voter_id,driving_license',
                'document_number' => 'required|string|max:50',
                'document_file' => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120',
            ]);

            $file = $request->file('document_file');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('kyc_documents', $filename, 'public');

            // Save to database
            $kyc = UserKyc::create([
                'user_id' => auth()->id(), // or pass user_id from request if not using auth
                'document_type' => $validated['document_type'],
                'document_number' => $validated['document_number'],
                'kyc_mode' => 'offline',
                'file' => $path,
            ]);

            return response()->json([
                'status' => true,
                'message' => 'KYC document uploaded successfully.',
                'data' => $kyc,
            ]);
    }
}
