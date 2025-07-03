<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Helpers\HasUploader;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class AcnooCategoryController extends Controller
{
 use HasUploader;


    public function index()
    {
        $categories = Category::latest()->paginate(20);
        return view('admin.categories.index', compact('categories'));
    }

    public function maanFilter(Request $request)
    {
        $categories = Category::when(request('search'), function($q) use($request) {
                $q->where(function($q) use($request) {
                    $q->where('name', 'like', '%'.$request->search.'%');
                });
            })
            ->latest()
            ->paginate(20);

        if($request->ajax()){
            return response()->json([
                'data' => view('admin.categories.datas',compact('categories'))->render()
            ]);
        }
        return redirect(url()->previous());
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|boolean',
            'icon' => 'required|image|mimes:jpeg,png,jpg,gif'
        ]);

        Category::create($request->except('icon') +[
            'icon' => $request->icon ? $this->upload($request, 'icon') : null,

        ]);

        return response()->json([
            'message' => 'Category created successfully',
            'redirect' => route('admin.categories.index')
        ]);
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|boolean'
        ]);

        $category->update($request->except('icon') +[
            'icon' => $request->icon ? $this->upload($request, 'icon', $category->icon) : $category->icon,

        ]);

        return response()->json([
            'message' => 'Category updated successfully',
            'redirect' => route('admin.categories.index')
        ]);
    }

    public function destroy(Category $category)
    {
        if (file_exists($category->icon)) {
            Storage::delete($category->icon);
        }

        $category->delete();

        return response()->json([
            'message' => ' Category deleted successfully',
            'redirect' => route('admin.categories.index')
        ]);
    }

    public function status(Request $request, $id)
    {
        $categoryStatus = Category::findOrFail($id);
        $categoryStatus->update(['status' => $request->status]);
        return response()->json(['message' => 'Category']);
    }

    public function deleteAll(Request $request)
    {
        $idsToDelete = $request->input('ids');

        $categories = Category::whereIn('id', $idsToDelete)->get();
        foreach ($categories as $Category) {
            if (file_exists($Category->icon)) {
                Storage::delete($Category->icon);
            }
        }

        Category::whereIn('id', $idsToDelete)->delete();

        return response()->json([
            'message' => __('Selected Items deleted successfully.'),
            'redirect' => route('admin.categories.index')
        ]);
    }
}
