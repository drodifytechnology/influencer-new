<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ExpenseCategory;
use Illuminate\Http\Request;

class AcnooExpenseCategoryController extends Controller
{
    public function index(Request $request)
    {
        $expenseCategories = ExpenseCategory::latest()->paginate(20);
        return view('admin.expense-categories.index', compact('expenseCategories'));
    }

    public function maanFilter(Request $request)
    {
        $expenseCategories = ExpenseCategory::when(request('search'), function ($q) {
                                $q->where('name', 'like', '%' . request('search') . '%')
                                    ->orWhere('description', 'like', '%' . request('search') . '%');
                            })
                            ->latest()
                            ->paginate($request->per_page ?? 20);

        if (request()->ajax()) {
            return response()->json([
                'data' => view('admin.expense-categories.datas', compact('expenseCategories'))->render()
            ]);
        }

        return redirect(url()->previous());
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|boolean',
            'description' => 'nullable|string'
        ]);

        ExpenseCategory::create($request->all());

        return response()->json([
            'message' => 'Expense Category created successfully',
            'redirect' => route('admin.expense-category.index')
        ]);
    }

    public function update(Request $request, ExpenseCategory $expenseCategory)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|boolean',
            'description' => 'nullable|string'
        ]);

        $expenseCategory->update($request->all());

        return response()->json([
            'message' => 'Expense Category updated successfully',
            'redirect' => route('admin.expense-category.index')
        ]);
    }

    public function destroy(ExpenseCategory $expenseCategory)
    {
        $expenseCategory->delete();

        return response()->json([
            'message' => 'Expense Category deleted successfully',
            'redirect' => route('admin.expense-category.index')
        ]);
    }

    public function status(Request $request, $id)
    {
        $expenseCategoryStatus = ExpenseCategory::findOrFail($id);
        $expenseCategoryStatus->update(['status' => $request->status]);
        return response()->json(['message' => 'Expense Category']);
    }

    public function deleteAll(Request $request)
    {
        ExpenseCategory::whereIn('id', $request->ids)->delete();
        return response()->json([
            'message' => __('Selected Items deleted successfully.'),
            'redirect' => route('admin.expense-category.index')
        ]);
    }
}
