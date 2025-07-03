<?php

namespace App\Http\Controllers\Admin;

use App\Models\Option;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class AcnooTermConditionController extends Controller
{
    public function index()
    {
        $term_condition = Option::where('key', 'term-condition')->first();
        return view('admin.settings.term-condition.index', compact('term_condition'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required|string',
        ]);

        $term_condition = Option::updateOrCreate(
            ['key' => 'term-condition'],
            ['value' => ['description' => $request->description]]
        );

        if ($term_condition) {
            Cache::forget($term_condition->key);
        }

        return response()->json([
            'message'   => __('Term And Condition updated successfully'),
            'redirect'  => route('admin.term-conditions.index')
        ]);
    }
}
