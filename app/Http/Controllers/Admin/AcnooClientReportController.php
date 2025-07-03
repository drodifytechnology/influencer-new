<?php

namespace App\Http\Controllers\Admin;

use App\Models\Option;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AcnooClientReportController extends Controller
{
    public function index()
    {
        $report_types = Option::where('key', 'report-types')
                        ->when(request('search'), function($q){
                            $q->where('value', 'like', '%'.request('search').'%');
                        })
                        ->latest()
                        ->paginate(20);

        if(request()->ajax()) {
            return response()->json([
                'data' => view('admin.report-types.datas', compact('report_types'))->render()
            ]);
        }
        return view('admin.report-types.index', compact('report_types'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
        ]);

        Option::create([
            'key' => 'report-types',
            'value' => $request->except('_token','_method'),
        ]);

        return response()->json([
            'message'   => __('Report Types save successfully'),
            'redirect'  => route('admin.report-types.index')
        ]);
    }

    public function status(Request $request, $id)
    {
        $blog_status = Option::findOrFail($id);
        $blog_status->update(['status' => $request->status]);
        return response()->json(['message' => 'Report Type']);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string',
        ]);

        $report_type = Option::findOrFail($id);


        $report_type->update([
            'key' => 'report-types',
            'value' => $request->except('_token','_method'),
        ]);

        return response()->json([
            'message'   => __('Report Types updated successfully'),
            'redirect'  => route('admin.report-types.index')
        ]);
    }

    public function destroy(string $id)
    {
        $report_type = Option::findOrFail($id);

        $report_type->delete();

        return response()->json([
            'message' => 'Report Type deleted successfully',
            'redirect' => route('admin.report-types.index')
        ]);
    }

    public function deleteAll(Request $request)
    {
        Option::whereIn('id', $request->ids)->delete();
        return response()->json([
            'message' => __('Selected Items deleted successfully.'),
            'redirect' => route('admin.report-types.index')
        ]);
    }
}
