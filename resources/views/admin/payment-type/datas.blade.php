@foreach($payment_types as $payment_type)

    <tr>
        @can('payment-type-delete')
            <td class="w-60 checkbox">
                <label class="table-custom-checkbox">
                    <input type="checkbox" name="ids[]" class="table-hidden-checkbox checkbox-item"
                       value="{{ $payment_type->id}}"  data-url="{{ route('admin.payment-type.deleteAll') }}">
                    <span class="table-custom-checkmark custom-checkmark td"></span>
                </label>
            </td>
        @endcan
        <td>{{ $loop->iteration }}</td>
        <td>{{ $payment_type->value['name'] ?? '' }}</td>
        <td>{{ $payment_type->value['description'] ?? '' }}</td>
        <td class="text-center w-150">
            <label class="switch">
                <input type="checkbox" {{ $payment_type->status == 1 ? 'checked' : '' }} class="status"
                    data-url="{{ route('admin.payment-type.status', $payment_type->id) }}">
                <span class="slider round"></span>
            </label>
        </td>
        <td>
            <div class="dropdown table-action">
                <button type="button" data-bs-toggle="dropdown">
                    <i class="far fa-ellipsis-v"></i>
                </button>
                <ul class="dropdown-menu">
                    @can('payment-type-update')
                        <li>
                            <a href="" class="payment-type-edit-btn" data-bs-toggle="modal"
                            data-bs-target="#payment-type-edit-modal"
                            data-url="{{ route('admin.payment-type.update', $payment_type->id) }}"
                            data-payment-type-name="{{$payment_type->value['name'] ?? '' }}"
                            data-payment-type-description="{{ $payment_type->value['description'] ?? '' }}">
                            <i class="fal fa-edit"></i>
                            {{ __('Edit') }}
                           </a>
                        </li>
                    @endcan
                    @can('payment-type-delete')
                        <li>
                            <a href="{{ route('admin.payment-type.destroy',$payment_type->id) }}" class="confirm-action" data-method="DELETE">
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
