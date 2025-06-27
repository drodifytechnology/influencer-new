<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Option;
use App\Models\Expense;
use App\Models\Transaction;
use App\Helpers\HasUploader;
use Illuminate\Http\Request;
use App\Models\ExpenseCategory;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AcnooExpenseController extends Controller
{
    use HasUploader;

    public function index(Request $request)
    {
        $expenses = Expense::with('expense_category:id,name', 'payment_type', 'user:id,name')
                        ->when($request->has('search'), function ($q) use ($request) {
                            $q->where(function ($query) use ($request) {
                                $query->where('amount', 'like', '%' . $request->search . '%')
                                    ->orWhere('notes', 'like', '%' . $request->search . '%');
                            });
                        })
                        ->orWhereHas('expense_category', function ($q) use ($request) {
                            $q->where('name', 'like', '%' . $request->search . '%');
                        })
                        ->orWhereHas('payment_type', function ($q) use ($request) {
                            $q->where('value', 'like', '%' . $request->search . '%');
                        })
                        ->orWhereHas('user', function ($q) use ($request) {
                            $q->where('name', 'like', '%' . $request->search . '%');
                        })
                        ->latest()
                        ->paginate(20);

        if ($request->ajax()) {
            return response()->json([
                'data' => view('admin.expenses.datas', compact('expenses'))->render()
            ]);
        }

        return view('admin.expenses.index', compact('expenses'));
    }

    public function create()
    {
        $users = User::latest()->get();
        $expenseCategories = ExpenseCategory::where('status', 1)->get();
        $payment_types = Option::where('key', 'payment-type')->get();
        return view('admin.expenses.create', compact('expenseCategories', 'users', 'payment_types'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|integer|exists:expense_categories,id',
            'paid_to' => 'required|integer|exists:users,id',
            'type_id' => 'required|integer|exists:options,id',
            'amount' => 'required|numeric',
            'date' => 'required|date',
            'notes' => 'nullable|string'
        ]);

        DB::beginTransaction();
        try {
            $expense = Expense::create($request->except('paid_by') + [
                'paid_by' => auth()->id()
            ]);

            Transaction::create([
                'expense_id' => $expense->id,
                'user_id' => auth()->id(),
                'amount' => $request->amount,
                'type' => 'debit',
                'notes' => $expense->notes
            ]);

            DB::commit();

            return response()->json([
                'message' => 'Expense created successfully',
                'redirect' => route('admin.expenses.index')
            ]);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'message' => 'Failed to create expense',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function edit($id)
    {
        $users = User::latest()->get();
        $expense = Expense::findOrFail($id);
        $expense_categories = ExpenseCategory::where('status', 1)->get();
        $payment_types = Option::where('key', 'payment-type')->get();

        return view('admin.expenses.edit', compact('expense_categories', 'users', 'expense', 'payment_types'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'category_id' => 'required|integer|exists:expense_categories,id',
            'paid_to' => 'required|integer|exists:users,id',
            'type_id' => 'required|integer|exists:options,id',
            'amount' => 'required|numeric',
            'date' => 'required|date',
            'notes' => 'nullable|string'
        ]);

        $expense = Expense::findOrFail($id);

        DB::beginTransaction();
        try {
            $expense->update($request->except('paid_by') + [
                'paid_by' => auth()->id()
            ]);

            $transaction = Transaction::where('expense_id', $expense->id)->firstOrFail();

            $transaction->update([
                'expense_id' => $expense->id,
                'user_id' => auth()->id(),
                'amount' => $request->amount,
                'type' => 'debit',
                'notes' => $expense->notes
            ]);

            DB::commit();
            return response()->json([
                'message' => 'Expense updated successfully',
                'redirect' => route('admin.expenses.index')
            ]);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'message' => 'Failed to create expense',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        $expense = Expense::findOrFail($id);

        DB::beginTransaction();
        try {
            Transaction::where('expense_id', $expense->id)->delete();

            $expense->delete();

            DB::commit();

            return response()->json([
                'message' => 'Expense deleted successfully',
                'redirect' => route('admin.expenses.index')
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Failed to delete expense',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function deleteAll(Request $request)
    {
        $idsDelete = $request->input('ids');

        DB::beginTransaction();
        try {
            $expenses = Expense::whereIn('id', $idsDelete)->get();

            $transaction_Ids = $expenses->pluck('id')->toArray();

            Transaction::whereIn('expense_id', $transaction_Ids)->delete();

            Expense::whereIn('id', $idsDelete)->delete();

            DB::commit();

            return response()->json([
                'message' => __('Selected Items deleted successfully.'),
                'redirect' => route('admin.expenses.index')
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Failed to delete selected items',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
