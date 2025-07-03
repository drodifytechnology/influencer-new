@foreach ($report_types as $report_type)
    <tr>
        @can('report-types-delete')
        <td class="w-60 checkbox">
            <label class="table-custom-checkbox">
                <input type="checkbox" name="ids[]" class="table-hidden-checkbox checkbox-item"
                   value="{{ $report_type->id }}"  data-url="{{ route('admin.report-types.deleteAll') }}">
                <span class="table-custom-checkmark custom-checkmark td"></span>
            </label>
        </td>
        @endcan
        <td>{{ $loop->iteration }}</td>
        <td>{{ $report_type->value['name'] }}</td>
        <td class="text-center w-150">
            <label class="switch">
                <input type="checkbox" {{ $report_type->status == 1 ? 'checked' : '' }} class="status"
                    data-url="{{ route('admin.report-types.status', $report_type->id) }}">
                <span class="slider round"></span>
            </label>
        </td>
        <td>
            <div class="dropdown table-action">
                <button type="button" data-bs-toggle="dropdown">
                    <i class="far fa-ellipsis-v"></i>
                </button>
                <ul class="dropdown-menu">
                    @can('report-types-update')
                    <li>
                        <a href="#report-types-edit-modal" class="report-types-edit-btn" data-bs-toggle="modal"
                            data-url="{{ route('admin.report-types.update', $report_type->id) }}"
                            data-report-types-name="{{ $report_type->value['name'] }}">
                            <i class="fal fa-edit"></i>
                            {{ __('Edit') }}
                        </a>
                    </li>
                    @endcan
                    @can('report-types-delete')
                    <li>
                        <a href="{{ route('admin.report-types.destroy', $report_type->id) }}"
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
