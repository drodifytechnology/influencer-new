<?php

namespace App\Http\Controllers\Api;

use App\Models\Option;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AcnooOurSocialMediaController extends Controller
{
    public function index()
    {
        $social_medias = Option::where('key', 'social-medias')
                        ->whereStatus(1)
                        ->latest()
                        ->get();

        return response()->json([
            'message'   => __('Social Media fetched successfully'),
            'data'  => $social_medias
        ]);
    }
}
