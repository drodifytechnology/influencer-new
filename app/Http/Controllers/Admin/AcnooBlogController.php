<?php

namespace App\Http\Controllers\Admin;

use App\Models\Blog;
use App\Helpers\HasUploader;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class AcnooBlogController extends Controller
{
    use HasUploader;

    public function index(Request $request)
    {
        $blogs = Blog::when(request('search'), function ($q) {
                    $q->where('title', 'like', '%' .request('search'). '%')
                        ->orWhere('slug', 'like', '%' .request('search'). '%')
                        ->orWhere('descriptions', 'like', '%' .request('search'). '%');
                    })
                    ->latest()
                    ->paginate(20);

        if (request()->ajax()) {
            return response()->json([
                'data' => view('admin.blogs.datas', compact('blogs'))->render()
            ]);
        }

        return view('admin.blogs.index', compact('blogs'));
    }

    public function create()
    {
        return view('admin.blogs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:blogs,title',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'status' => 'boolean',
            'descriptions' => 'nullable|string',
        ]);

        Blog::create($request->except('image') + [
            'image' => $request->image ? $this->upload($request, 'image') : null,
        ]);

        return response()->json([
            'message'   => __('BLog created successfully'),
            'redirect'  => route('admin.blogs.index')
        ]);
    }

    public function edit(Blog $blog)
    {
        return view('admin.blogs.edit', compact('blog'));
    }

    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'title' => 'required|unique:blogs,title,' . $blog->id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'status' => 'boolean',
            'descriptions' => 'nullable|string',
        ]);

        $blog->update($request->except('image') + [
            'image' => $request->image ? $this->upload($request, 'image', $blog->image) : $blog->image,
        ]);

        return response()->json([
            'message'   => __('BLog updated successfully'),
            'redirect'  => route('admin.blogs.index')
        ]);
    }

    public function destroy(Blog $blog)
    {
        if (file_exists($blog->image)) {
            Storage::delete($blog->image);
        }

        $blog->delete();

        return response()->json([
            'message' => __('Blog deleted successfully'),
            'redirect' => route('admin.blogs.index')
        ]);
    }

    public function status(Request $request, $id)
    {
        $blog_status = Blog::findOrFail($id);
        $blog_status->update(['status' => $request->status]);
        return response()->json(['message' => 'Blog']);
    }

    public function deleteAll(Request $request)
    {
        $idsToDelete = $request->input('ids');

        $blogs = Blog::whereIn('id', $idsToDelete)->get();
        foreach ($blogs as $blog) {
            if (file_exists($blog->image)) {
                Storage::delete($blog->image);
            }
        }

        Blog::whereIn('id', $idsToDelete)->delete();
        return response()->json([
            'message' => __('Selected Blog deleted successfully'),
            'redirect' => route('admin.blogs.index')
        ]);
    }
}
