@foreach ($withdrawMethods as $withdrawMethod)
    <tr>
        @can('withdraw-methods-delete')
        <td class="w-60 checkbox">
            <label class="table-custom-checkbox">
                <input type="checkbox" name="ids[]" class="table-hidden-checkbox checkbox-item"
                value="{{ $withdrawMethod->id }}"  data-url="{{ route('admin.withdraw_methods.delete-all') }}">
                <span class="table-custom-checkmark custom-checkmark td"></span>
            </label>
        </td>
        @endcan
        <td>{{ $loop->iteration }}</td>
        <td>{{ $withdrawMethod->name ?? '' }}</td>
        <td>{{ $withdrawMethod->currency->name ?? 'null' }}</td>
        <td>{{ $withdrawMethod->min_amount ?? '' }}</td>
        <td>{{ $withdrawMethod->max_amount ?? '' }}</td>
        <td>{{ $withdrawMethod->charge ?? '' }}</td>

        <td class="text-center w-150">
            <label class="switch">
                <input type="checkbox" {{ $withdrawMethod->status == 1 ? 'checked' : '' }} class="status"
                    data-url="{{ route('admin.withdraw_methods.status', $withdrawMethod->id) }}">
                <span class="slider round"></span>
            </label>
        </td>
        <td>
            <div class="dropdown table-action">
                <button type="button" data-bs-toggle="dropdown">
                    <i class="far fa-ellipsis-v"></i>
                </button>
                <ul class="dropdown-menu">
                    <li><a href="" class="withdraw-method-view-btn" data-bs-toggle="modal"
                            data-bs-target="#withdraw-method-view-modal"
                            data-payment-method="{{ $withdrawMethod->name ?? '' }}"
                            data-method-currency="{{ $withdrawMethod->currency->name ?? '' }}"
                            data-payment-min-amount="{{ $withdrawMethod->min_amount ?? '' }}"
                            data-payment-max-amount="{{ $withdrawMethod->max_amount ?? '' }}"
                            data-payment-charge="{{ $withdrawMethod->charge ?? '' }}"
                            data-method-status="{{ ($withdrawMethod->status == 1 ? 'Active' : 'Deactive') ?? '' }}">
                            <i class="fal fa-eye"></i>
                            {{ __('View') }}
                        </a>
                    </li>
                    @can('withdraw-methods-update')
                    <li>
                        <a href="{{ route('admin.withdraw_methods.edit', $withdrawMethod->id) }}"
                            class="category-edit-btn">
                            <i class="fal fa-edit"></i>
                            {{ __('Edit') }}
                        </a>
                    </li>
                    @endcan


                    @can('withdraw-methods-delete')
                    <li>
                        <a href="{{ route('admin.withdraw_methods.destroy', $withdrawMethod->id) }}"
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


