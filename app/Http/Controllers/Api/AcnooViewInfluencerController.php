<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Review;
use App\Models\Service;
use App\Http\Controllers\Controller;

class AcnooViewInfluencerController extends Controller
{
  
    public function show(string $id)
    {
        $influencer = User::with('categories')->findOrFail($id);

        return response()->json([
            'message' => 'Data fetched successfully',
            'data' => $influencer
        ]);

    }

    public function review(string $id) {

        $service_ids = Service::where('user_id', $id)->pluck('id');


        $review = Review::with('user:id,name')->whereIn('service_id', $service_ids)->get();
        $review_count = $review->count();

         return response()->json([
            'message' => 'Data fetched successfully',
            'review_count' => $review_count,
            'data' => $review
        ]);
    }
}
