<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class AcnooWishlistController extends Controller
{
    public function index()
    {
        $wishlists = Wishlist::with([
            'user:id,name,image',
            'service:id,title,user_id,category_id,images',
            'service.user:id,name,image',
            'service.category:id,name',
        ])
        ->with([
            'service' => function ($query) {
                $query->withCount('reviews')
                    ->withAvg('reviews', 'rating');
            }
        ])
        ->where('user_id', auth()->id())
        ->latest()->get();

        return response()->json([
            'message' => 'Data fetched successfully',
            'data' => $wishlists
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'service_id' => 'required|integer|exists:services,id',
        ]);

        $exists = Wishlist::where('user_id', auth()->id())
            ->where('service_id', $request->service_id)
            ->exists();

        if ($exists) {
            return response()->json([
                'message' => 'This service is already in your wishlist',
            ], 422);
        } else {

            $wishlist = Wishlist::create($request->except('user_id') +[
                'user_id' => auth()->id()
            ]);

            return response()->json([
                'message' => 'Wishlist added successfully',
                'data' => $wishlist
            ]);
        }
    }

    public function destroy(string $id)
    {
        $wishlist = Wishlist::findOrFail($id);

        $wishlist->delete();

        return response()->json([
            'message' => 'Wishlist deleted successfully',
        ]);
    }
}
