<?php

namespace App\Http\Controllers\Api;

use App\Models\Service;
use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;

class ReportController extends Controller
{
    public function topCategories()
    {
        $top_category_ids = Service::select('category_id')
                            ->selectRaw('count(*) as total')
                            ->groupBy('category_id')
                            ->orderByDesc('total')
                            ->limit(10)
                            ->pluck('category_id');

        $data = Category::whereIn('id', $top_category_ids)->get();

        return response()->json([
            'message' => 'Data fetched successfully.',
            'data' => $data
        ]);
    }

    public function topServices()
    {
        $top_service_ids = Order::select('service_id')
                            ->selectRaw('count(*) as total')
                            ->groupBy('service_id')
                            ->orderByDesc('total')
                            ->limit(10)
                            ->pluck('service_id');

        $services = Service::whereIn('id', $top_service_ids)
                        ->with(['category:id,name', 'user:id,name,image'])
                        ->withCount('reviews')
                        ->withAvg('reviews', 'rating')
                        ->get();

        return response()->json([
            'message' => 'Data fetched successfully.',
            'data' => $services
        ]);
    }

    public function topInfluencers()
    {
        $top_influencers_ids = Order::select('influencer_id')
                                ->selectRaw('count(*) as total')
                                ->groupBy('influencer_id')
                                ->orderByDesc('total')
                                ->limit(10)
                                ->pluck('influencer_id'); 

        $influencers = User::select('id', 'name', 'image')->with('categories:id,name')->whereIn('id', $top_influencers_ids)
                        ->withCount('reviews')
                        ->withAvg('reviews', 'rating')
                        ->get();

        return response()->json([
            'message' => 'Data fetched successfully.',
            'data' => $influencers
        ]);
    }

    public function allInfluencers()
    {

        $all_influencers = User::select('id', 'name', 'image')->with('categories:id,name')
                        ->where('role', 'influencer')
                        ->withCount('reviews')
                        ->withAvg('reviews', 'rating')
                        ->latest()
                        ->get();

        return response()->json([
            'message' => 'Data fetched successfully.',
            'data' => $all_influencers
        ]);
    }
}
