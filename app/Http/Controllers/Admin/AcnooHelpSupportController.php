<?php

namespace App\Http\Controllers\Admin;

use App\Models\Option;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class AcnooHelpSupportController extends Controller
{
    public function index()
    {
        $help_support = Option::where('key', 'help-supports')->first();
        return view('admin.settings.help-support.help-support', compact('help_support'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|string',
            'number' => 'required|integer',
        ]);

        $help_support = Option::updateOrCreate(['key' => 'help-supports'],
                            ['value' => [
                                'email' => $request->email,
                                'number' => $request->number,
                            ]
                        ]);

        Cache::forget($help_support->key);

        return response()->json([
            'message'   => __('Help Support updated successfully'),
            'redirect'  => route('admin.help-supports.index')
        ]);
    }
}
