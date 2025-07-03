<?php

namespace App\Http\Controllers\Admin;

use App\Models\Option;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class AcnooAboutUsController extends Controller
{
    public function index()
    {
        $about_us = Option::where('key', 'about-us')->first();
        return view('admin.settings.about-us.about', compact('about_us'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required|string',
        ]);

        $about_us = Option::updateOrCreate(['key' => 'about-us'],
                        ['value' => ['description' => $request->description]
                    ]);

        Cache::forget($about_us->key);

        return response()->json([
            'message'   => __('About Us updated successfully'),
            'redirect'  => route('admin.about-us.index')
        ]);
    }
}
