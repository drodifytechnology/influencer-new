<?php

namespace App\Http\Controllers\Api;

use App\Models\Blog;
use App\Helpers\HasUploader;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AcnooBlogController extends Controller
{
    use HasUploader;

    public function index()
    {
        $blogs = Blog::latest()->paginate(20);

        return response()->json([
            'message' => 'Blog fetched successfully',
            'data' => $blogs
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'             => 'required|unique:blogs,title',
            'image'             => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'status'            => 'boolean',
            'descriptions'      => 'nullable|string',
        ]);

        $blog =  Blog::create($request->except('image') + [
                    'image' => $request->image ? $this->upload($request, 'image') : null,
                ]);

        return response()->json([
            'message'   => __('BLog created successfully'),
            'data'      => $blog
        ]);
    }

    public function show(string $id)
    {
        $blog = Blog::find($id);
        return response()->json([
            'message' => 'Blog fetched successfully',
            'data' => $blog,
        ]);
    }
}
