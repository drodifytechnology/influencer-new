@foreach ($complains as $complain)
<tr>
    @can('complains-delete')
    <td class="w-60 checkbox">
        <label class="table-custom-checkbox">
            <input type="checkbox" name="ids[]" class="table-hidden-checkbox checkbox-item"
               value="{{ $complain->id }}"  data-url="{{ route('admin.complains.deleteAll') }}">
            <span class="table-custom-checkmark custom-checkmark td"></span>
        </label>
    </td>
    @endcan

    <td>{{ $loop->iteration}}</td>
    <td>{{ formatted_date($complain->created_at) }}</td>
    <td>{{ $complain->user->name }}</td>
    <td>{{ $complain->reported_user->name }}</td>
    <td>{{ Str::limit($complain->service->title, 25, '...') }}</td>
    <td>{{ $complain->reason->value['name'] ?? '' }}</td>
    <td>{{ $complain->notes }}</td>

    <td>
        <div class="dropdown table-action">
            <button type="button" data-bs-toggle="dropdown">
                <i class="far fa-ellipsis-v"></i>
            </button>
            <ul class="dropdown-menu">
                @can('complains-delete')
                <li>
                    <a href="{{ route('admin.complains.destroy', $complain->id) }}" class="confirm-action"
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
