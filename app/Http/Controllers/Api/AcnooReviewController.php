<?php

namespace App\Http\Controllers\Api;

use App\Helpers\HasUploader;
use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class AcnooReviewController extends Controller
{
    use HasUploader;

    public function store(Request $request)
    {
        $request->validate([
            'service_id' => 'required|integer|exists:services,id',
            'description' => 'nullable|string',
            'rating' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $existingReview = Review::where('service_id', $request->service_id)
                            ->where('user_id', auth()->id())
                            ->first();

        if ($existingReview) {
            return response()->json([
                'message' => 'You have already reviewed this order.',
            ], 403);
        }

        $review = Review::create($request->except('user_id','image') + [
                        'user_id' => auth()->id(),
                        'image' => $request->image ? $this->upload($request, 'image') : null
                    ]);

        return response()->json([
            'meassage' => 'Data fetch successfully',
            'data' => $review
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'rating' => 'required|integer',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $review = Review::findOrFail($id);

        $review->update($request->except('user_id', 'image') + [
                    'image' => $request->image ? $this->upload($request, 'image', $review->image) : $review->image
                ]);

        return response()->json([
            'meassage' => 'Review updated successfully',
            'data' => $review
        ]);
    }
}
