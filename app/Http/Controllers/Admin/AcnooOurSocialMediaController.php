<?php

namespace App\Http\Controllers\Admin;

use App\Models\Option;
use App\Helpers\HasUploader;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class AcnooOurSocialMediaController extends Controller
{
    use HasUploader;

    public function index()
    {
        $social_medias = Option::where('key', 'social-medias')
                        ->when(request('search'), function($q){
                            $q->where('value', 'like', '%'.request('search').'%');
                        })
                        ->latest()
                        ->paginate(20);

        if(request()->ajax()) {
            return response()->json([
                'data' => view('admin.medias.datas', compact('social_medias'))->render()
            ]);
        }

        return view('admin.medias.index', compact('social_medias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'url' => 'required|string',
            'icon'  => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        Option::create([
            'key' => 'social-medias',
            'value' => $request->except('_token', '_method', 'icon') + [
              'icon' => $request->icon ? $this->upload($request, 'icon') : NULL,
            ]
        ]);

        return response()->json([
            'message'   => __('Social Media save successfully'),
            'redirect'  => route('admin.social-medias.index')
        ]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string',
            'url' => 'required|string',
            'icon'  => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $social_media = Option::findOrFail($id);

        $social_media->update([
            'key' => 'social-medias',
            'value' => $request->except('_token', '_method', 'icon') + [
              'icon' => $request->icon ? $this->upload($request, 'icon', $social_media->value['icon'] ?? '') : $social_media->value['icon'] ?? '',
            ]
        ]);

        return response()->json([
            'message'   => __('Social Media updated successfully'),
            'redirect'  => route('admin.social-medias.index')
        ]);
    }

    public function status(Request $request, $id)
    {
        $social_media = Option::findOrFail($id);
        $social_media->update(['status' => $request->status]);
        return response()->json(['message' => 'Social Media']);
    }

    public function destroy(string $id)
    {
        $social_media = Option::findOrFail($id);
            if (file_exists($social_media->value['icon'] ?? '')) {
                Storage::delete($social_media->value['icon'] ?? '');
        }
        $social_media->delete();

        return response()->json([
            'message' => 'Social Media deleted successfully',
            'redirect' => route('admin.social-medias.index')
        ]);
    }

    public function deleteAll(Request $request)
    {
        $idsToDelete = $request->input('ids');

        $social_medias = Option::whereIn('id', $idsToDelete)->get();
        foreach ($social_medias as $social_media) {
            if (file_exists($social_media->value['icon'] ?? '')) {
                Storage::delete($social_media->value['icon'] ?? '');
            }
        }
        Option::whereIn('id', $idsToDelete)->delete();

        return response()->json([
            'message' => __('Selected Items deleted successfully.'),
            'redirect' => route('admin.social-medias.index')
        ]);
    }
}
