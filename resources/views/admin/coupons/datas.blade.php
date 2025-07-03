@foreach ($coupons as $coupon)
    <tr>
        @can('coupons-delete')
        <td class="w-60 checkbox">
            <label class="table-custom-checkbox">
                <input type="checkbox" name="ids[]" class="table-hidden-checkbox checkbox-item"
                   value="{{ $coupon->id }}"  data-url="{{ route('admin.coupons.deleteAll') }}">
                <span class="table-custom-checkmark custom-checkmark td"></span>
            </label>
        </td>
        @endcan

        <td>{{ $loop->iteration }}</td>
        <td>
            <img class="image-style" src="{{ asset($coupon->image ?? 'assets/images/icons/upload-icon.svg') }}" alt="img">
        </td>
        <td>{{ $coupon->title }}</td>
        <td>{{ $coupon->code }}</td>
        <td>{{ formatted_date($coupon->start_date) }}</td>
        <td>{{ formatted_date($coupon->end_date) }}</td>
        <td>{{ $coupon->discount_type == "percentage" ? $coupon->discount . "%" : currency_format($coupon->discount) }}</td>

        @if ($coupon->status == 1)
        <td class="text-success">{{ __('Active') }}</td>
        @else
        <td class="text-danger">{{ __('Deactive') }}</td>
        @endif

        <td>
            <div class="dropdown table-action">
                <button type="button" data-bs-toggle="dropdown">
                    <i class="far fa-ellipsis-v"></i>
                </button>
                <ul class="dropdown-menu">
                    <li><a href="" class="coupon-view-btn" data-bs-toggle="modal"
                            data-bs-target="#coupon-modal"
                            data-coupon-name="{{ $coupon->title }}"
                            data-coupon-start-date="{{ formatted_date($coupon->start_date) }}"
                            data-coupon-code="{{ $coupon->code }}"
                            data-coupon-end-date="{{ formatted_date($coupon->end_date) }}"
                            data-coupon-discount-type="{{ $coupon->discount_type }}"
                            data-coupon-discount-discount="{{ $coupon->discount }}"
                            data-coupon-description="{{ $coupon->description }}"
                            data-coupon-status="{{( $coupon->status == 1 ? 'Active' : 'Deactive')}}"
                            >
                            <i class="fal fa-eye"></i>
                            {{ __('View') }}
                        </a>
                    </li>
                    @can('coupons-update')
                    <li>
                        <a href="{{ route('admin.coupons.edit',$coupon->id) }}">
                            <i class="fal fa-edit"></i>
                            {{ __('Edit') }}
                        </a>
                    </li>
                    @endcan
                    @can('coupons-delete')
                    <li>
                        <a href="{{ route('admin.coupons.destroy', $coupon->id) }}" class="confirm-action"
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
