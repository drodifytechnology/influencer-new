@foreach ($expenseCategories as $ExpenseCategory)
    <tr>
        @can('expense-categories-delete')
        <td class="w-60 checkbox">
            <label class="table-custom-checkbox">
                <input type="checkbox" name="ids[]" class="table-hidden-checkbox checkbox-item"
                   value="{{ $ExpenseCategory->id }}"  data-url="{{ route('admin.expense-category.deleteAll') }}">
                <span class="table-custom-checkmark custom-checkmark td"></span>
            </label>
        </td>
        @endcan
        <td>{{ $loop->iteration }}</td>
        <td>{{ $ExpenseCategory->name }}</td>
        <td>{{ \Illuminate\Support\Str::words($ExpenseCategory->description, 3, '...') }}</td>
        <td class="text-center w-150">
            <label class="switch">
                <input type="checkbox" {{ $ExpenseCategory->status == 1 ? 'checked' : '' }} class="status"
                    data-url="{{ route('admin.expense-category.status', $ExpenseCategory->id) }}">
                <span class="slider round"></span>
            </label>
        </td>
        <td>
            <div class="dropdown table-action">
                <button type="button" data-bs-toggle="dropdown">
                    <i class="far fa-ellipsis-v"></i>
                </button>
                <ul class="dropdown-menu">

                    <li>
                        <a class="expenses-category-view-btn" data-bs-toggle="modal"
                            data-bs-target="#expense-category-modal"
                            data-expenses-category-name="{{ $ExpenseCategory->name }}"
                            data-expense-category-description="{{ $ExpenseCategory->description }}">
                            <i class="fal fa-eye"></i>
                            {{ __('View') }}
                        </a>
                    </li>
                    @can('expense-categories-update')
                    <li>
                        <a href="#expense-category-edit-modal" class="expense-category-edit-btn" data-bs-toggle="modal"
                            data-url="{{ route('admin.expense-category.update', $ExpenseCategory->id) }}"
                            data-expense-category-name="{{ $ExpenseCategory->name }}"
                            data-expense-category-status="{{ $ExpenseCategory->status }}"
                            data-expense-category-description="{{ $ExpenseCategory->description }}">
                            <i class="fal fa-edit"></i>
                            {{ __('Edit') }}
                        </a>
                    </li>
                    @endcan
                    @can('expense-categories-delete')
                    <li>
                        <a href="{{ route('admin.expense-category.destroy', $ExpenseCategory->id) }}"
                            class="confirm-action" data-method="DELETE">
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
