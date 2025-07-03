<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\Request;

class AcnooComplainController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $complains = Report::with('user:id,name', 'reported_user:id,name', 'service:id,title', 'reason')->latest()->paginate(20);
        return view('admin.complains.index', compact('complains'));
    }

    public function maanFilter(Request $request)
    {
        $complains = Report::with('user:id,name', 'reported_user:id,name', 'service:id,title', 'reason')
                        ->when(request('search'), function ($q) {
                            $q->where('notes', 'like', '%' . request('search') . '%');

                            $q->orwhereHas('user', function ($d) {
                                $d->where('name', 'like', '%' . request('search') . '%');
                            });

                            $q->orwhereHas('service', function ($d) {
                                $d->where('title', 'like', '%' . request('search') . '%');
                            });

                            $q->orwhereHas('reported_user', function ($d) {
                                $d->where('name', 'like', '%' . request('search') . '%');
                            });

                            $q->orwhereHas('reason', function ($d) {
                                $d->where('value', 'like', '%' . request('search') . '%');
                            });
                        })
                        ->when($request->id, function ($query) use ($request) {
                            $query->where('id', $request->id);
                        })
                        ->latest()
                        ->paginate($request->per_page ?? 20);

        if (request()->ajax()) {
            return response()->json([
                'data' => view('admin.complains.datas', compact('complains'))->render()
            ]);
        }

        return redirect(url()->previous());
    }


    public function destroy(string $id)
    {
        $complain = Report::findOrFail($id);
        $complain->delete();

        return response()->json([
            'message' => 'Complain deleted successfully',
            'redirect' => route('admin.complains.index')
        ]);
    }


    public function deleteAll(Request $request)
    {
        Report::whereIn('id', $request->ids)->delete();
        return response()->json([
            'message' => __('Selected Items deleted successfully.'),
            'redirect' => route('admin.complains.index')
        ]);
    }
}
