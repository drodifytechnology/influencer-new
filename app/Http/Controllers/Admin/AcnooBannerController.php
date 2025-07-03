<?php

namespace App\Http\Controllers\Admin;

use App\Models\Banner;
use App\Helpers\HasUploader;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class AcnooBannerController extends Controller
{
    use HasUploader;

    public function index()
    {
        $banners = Banner::when(request('search'), function ($q) {
                        $q->where('title', 'like', '%' . request('search') . '%');
                    })
                    ->latest()
                    ->paginate(20);

        if (request()->ajax()) {
            return response()->json([
                'data' => view('admin.banners.datas', compact('banners'))->render()
            ]);
        }

        return view('admin.banners.index', compact('banners'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'status' => 'nullable|string',
            'image'  => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        Banner::create($request->except('image') + [
            'image' => $request->image ? $this->upload($request, 'image') : NULL,
        ]);

        return response()->json([
            'message' => __('Banner saved successfully'),
            'redirect' => route('admin.banners.index')
        ]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string',
            'status' => 'nullable|string',
            'image'  => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $banner = Banner::findOrFail($id);

        $banner->update($request->except('image') + [
            'image' => $request->image ? $this->upload($request, 'image', $banner->image) : $banner->image,
        ]);

        return response()->json([
            'message' => __('Banner updated successfully'),
            'redirect' => route('admin.banners.index')
        ]);
    }

    public function destroy(string $id)
    {
        $banner = Banner::findOrFail($id);

        if (file_exists($banner->image)) {
            Storage::delete($banner->image);
        }

        $banner->delete();

        return response()->json([
            'message' => __('Banners deleted successfully'),
            'redirect' => route('admin.banners.index')
        ]);
    }

    public function status(Request $request, $id)
    {
        $banner = Banner::findOrFail($id);
        $banner->update(['status' => $request->status]);
        return response()->json(['message' => 'Banner']);
    }

    public function deleteAll(Request $request)
    {

        $idsToDelete = $request->input('ids');

        $banners = Banner::whereIn('id', $idsToDelete)->get();
        foreach ($banners as $banner) {
            if (file_exists($banner->image)) {
                Storage::delete($banner->image);
            }
        }

        Banner::whereIn('id', $idsToDelete)->delete();

        return response()->json([
            'message' => __('Banners deleted successfully'),
            'redirect' => route('admin.banners.index')
        ]);
    }
}
