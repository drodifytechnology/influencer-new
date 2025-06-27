<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Transaction;
use App\Helpers\HasUploader;
use Illuminate\Http\Request;
use App\Models\ExpenseCategory;
use App\Http\Controllers\Controller;

class AcnooExpenseController extends Controller
{
    use HasUploader;

    public function index(Request $request)
    {
        $expenses = Transaction::with('expenseCategory')
                        ->when($request->has('search'), function ($q) use ($request) {
                            $q->where(function ($query) use ($request) {
                                $query->where('amount', 'like', '%' . $request->search . '%')
                                    ->orWhere('type', 'like', '%' . $request->search . '%')
                                    ->orWhere('payment_method', 'like', '%' . $request->search . '%')
                                    ->orWhere('reference_no', 'like', '%' . $request->search . '%')
                                    ->orWhere('notes', 'like', '%' . $request->search . '%');
                            });
                        })
                        ->orWhereHas('expenseCategory', function ($q) use ($request) {
                            $q->where('name', 'like', '%' . $request->search . '%');
                        })
                        ->latest()
                        ->paginate(20);

        if ($request->ajax()) {
            return view('admin.expenses.datas', compact('expenses'))->render();
        }

        return view('admin.expenses.index', compact('expenses'));
    }

    public function create()
    {
        $users = User::latest()->get();
        $expenseCategories = ExpenseCategory::where('status', 1)->get();
        return view('admin.expenses.create', compact('expenseCategories', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|integer|exists:expense_categories,id',
            'amount' => 'required|integer',
            'date' => 'required|date',
            'description' => 'nullable|string'
        ]);

        Transaction::create($request->all());

        return response()->json([
            'message' => 'Expense created successfully',
            'redirect' => route('admin.expenses.index')
        ]);
    }

    public function edit($id)
    {
        $users = User::latest()->get();
        $expense = Transaction::findOrFail($id);
        $expenseCategories = ExpenseCategory::where('status', 1)->get();
        return view('admin.expenses.edit', compact('expenseCategories', 'users', 'expense'));
    }


    public function update(Request $request, $id)
    {

        $request->validate([
            'category_id' => 'required|integer|exists:expense_categories,id',
            'amount' => 'required|integer',
            'date' => 'required|date',
            'description' => 'nullable|string'
        ]);

        $expense = Transaction::findOrFail($id);
        $expense->update($request->all());

        return response()->json([
            'message' => 'Expense updated successfully',
            'redirect' => route('admin.expenses.index')
        ]);
    }

    public function destroy($id)
    {
        $expense = Transaction::findOrFail($id);
        $expense->delete();

        return response()->json([
            'message' => 'Expense deleted successfully',
            'redirect' => route('admin.expenses.index')
        ]);
    }

    public function deleteAll(Request $request)
    {
        $idsDelete = $request->input('ids');
        $salary = Transaction::whereIn('id', $idsDelete);
        $salary->delete();

        return response()->json([
            'message' => __('Selected Items deleted successfully.'),
            'redirect' => route('admin.expenses.index')
        ]);
    }
}
