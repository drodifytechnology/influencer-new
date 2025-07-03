@foreach ($withdraws as $withdraw)
<tr>
    <td class="w-60 checkbox">
        <label class="table-custom-checkbox">
            <input type="checkbox" name="ids[]" class="table-hidden-checkbox checkbox-item"
               value=""  data-url="">
            <span class="table-custom-checkmark custom-checkmark td"></span>
        </label>
    </td>
    <td>{{ $loop->iteration }}</td>
    <td>{{\Carbon\Carbon::parse($withdraw->created_at)->format('M d, Y')}}</td>
    <td>{{ $withdraw->user->name }}</td>
    <td>{{ $withdraw->withdraw_method->name}}</td>
    <td>{{ currency_format($withdraw->amount) }}</td>
    <td>{{ currency_format($withdraw->charge) }}</td>
    <td>{{ currency_format($withdraw->amount - $withdraw->charge) }}</td>

    @if ($withdraw->status == 'pending')
    <td class="text-warning">{{ __('Pending') }}</td>
    @elseif ($withdraw->status == 'rejected')
    <td class="text-danger">{{ __('Rejected') }}</td>
    @elseif ($withdraw->status == 'approve')
    <td class="text-success">{{ __('Approve') }}</td>
    @endif
    <td>
        <div class="dropdown table-action">
            <button type="button" data-bs-toggle="dropdown">
                <i class="far fa-ellipsis-v"></i>
            </button>
            <ul class="dropdown-menu">
                <li><a href="{{ route('admin.withdraw-request.show',$withdraw->id)}}">
                        <i class="fal fa-eye"></i>
                        {{ __('View') }}
                    </a>
                </li>
                @can('withdraw-request-update')
                <li>
                    <a href="" data-url="{{ route('admin.withdraw.reject',$withdraw->id)}}" class="reject-btn" data-bs-toggle="modal" data-bs-target="#withdraw-reject-modal">
                        <i class="fal fa-trash-alt"></i>
                        {{ __('Reject') }}
                    </a>
                </li>
                @endcan

                @can('withdraw-request-update')
                <li>
                    <a href="" data-url="{{ route('admin.withdraw.approve',$withdraw->id)}}" class="approve-btn" data-bs-toggle="modal" data-bs-target="#withdraw-approve-modal">
                        <i class="fas fa-check-square"></i>
                        {{ __('Approve') }}
                    </a>
                </li>
                @endcan
            </ul>
        </div>
    </td>
</tr>

@endforeach
