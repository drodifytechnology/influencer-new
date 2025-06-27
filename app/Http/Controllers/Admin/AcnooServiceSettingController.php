<?php

namespace App\Http\Controllers\Admin;

use App\Models\Option;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class AcnooServiceSettingController extends Controller
{
    public function index()
    {
        $service_charge = Option::where('key', 'service-charge')->first();
        return view('admin.settings.service', compact('service_charge'));
    }

    public function store(Request $request)
    {
        $service_charge = Option::where('key', 'service-charge')->first();
        Option::updateOrCreate(
            ['key' => 'service-charge'],
            ['value' => $request->except('_token', '_method'),
        ]);

        Cache::forget($service_charge->key);

        return response()->json([
            'message' => 'Service charge updated successfully',
            'redirect' => route('admin.service-settings.index')
        ]);
    }
}
