@foreach ($expenses as $expense)
    <tr>
        @can('expenses-delete')
        <td class="w-60 checkbox">
            <label class="table-custom-checkbox">
                <input type="checkbox" name="ids[]" class="table-hidden-checkbox checkbox-item"
                   value="{{ $expense->id }}"  data-url="{{ route('admin.expenses.deleteAll') }}">
                <span class="table-custom-checkmark custom-checkmark td"></span>
            </label>
        </td>
        @endcan
        <td>{{ $loop->iteration }}</td>
        <td>{{ formatted_date($expense->date ?? '') }}</td>
        <td>{{ $expense->expense_category->name ?? 'null' }}</td>
        <td>{{ currency_format($expense->amount ?? 0) }}</td>
        <td>{{ $expense->payment_type['value']['name'] ?? '' }}</td>
        <td>{{ $expense->user->name ?? '' }}</td>
        <td>
            <div class="dropdown table-action">
                <button type="button" data-bs-toggle="dropdown">
                    <i class="far fa-ellipsis-v"></i>
                </button>
                <ul class="dropdown-menu">
                    <li>
                        <a href="" class="expenses-view-btn" data-bs-toggle="modal"
                            data-bs-target="#expense-modal" data-expense-date="{{ formatted_date($expense->date) }}"
                            data-expense-name="{{ $expense->user->name ?? '' }}"
                            data-expense-category="{{ $expense->expense_category->name ?? '' }}"
                            data-expense-type="{{ $expense->payment_type['value']['name'] ?? '' }}"
                            data-expense-amount="{{ $expense->amount }}"
                            data-expense-description="{{ $expense->notes }}"
                            >
                            <i class="fal fa-eye"></i>
                            {{ __('View') }}
                        </a>
                    </li>
                    @can('expenses-update')
                    <li>
                        <a href="{{ route('admin.expenses.edit', $expense->id) }}"
                            {{ Route::is('admin.expenses.edit') ? 'active' : '' }}>
                            <i class="fal fa-edit"></i>
                            {{ __('Edit') }}
                        </a>
                    </li>
                    @endcan
                    @can('expenses-delete')
                    <li>
                        <a href="{{ route('admin.expenses.destroy', $expense->id) }}" class="confirm-action"
                            data-method="DELETE">
                            <i class="fal fa-trash-alt"></i>
                            {{ __('Delete') }}
                        </a>
                    </li>
                    @endcan
                </ul>
            </div>
        </td>
    </tr>
@endforeach
