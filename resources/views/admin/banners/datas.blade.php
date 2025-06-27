@foreach ($banners as $banner)
    <tr>
        @can('banners-delete')
            <td class="w-60 checkbox">
                <label class="table-custom-checkbox">
                    <input type="checkbox" name="ids[]" class="table-hidden-checkbox checkbox-item"
                       value="{{ $banner->id }}"  data-url="{{ route('admin.banners.deleteAll') }}">
                    <span class="table-custom-checkmark custom-checkmark td"></span>
                </label>
            </td>
        @endcan
        <td>{{ $loop->iteration }}</td>
        <td>
          <img height="50" width="50" class="rounded" src="{{ asset($banner->image ?? '')}}">
        </td>
        <td>{{ $banner->title }}</td>

        <td class="text-center w-150">
            <label class="switch">
                <input type="checkbox" {{ $banner->status == 1 ? 'checked' : '' }} class="status"
                    data-url="{{ route('admin.banners.status', $banner->id) }}">
                <span class="slider round"></span>
            </label>
        </td>
        <td>
            <div class="dropdown table-action">
                <button type="button" data-bs-toggle="dropdown">
                    <i class="far fa-ellipsis-v"></i>
                </button>
                <ul class="dropdown-menu">

                    @can('banners-update')
                        <li>
                            <a href="#banners-edit-modal" class="banners-edit-btn" data-bs-toggle="modal"
                                data-url="{{ route('admin.banners.update', $banner->id) }}"
                                data-banners-title="{{ $banner->title }}"
                                data-banners-image="{{ asset($banner->image) }}"
                                data-banners-status="{{ $banner->status }}">
                                <i class="fal fa-edit"></i>
                                {{ __('Edit') }}
                            </a>
                        </li>
                    @endcan
                    @can('banners-delete')
                        <li>
                            <a href="{{ route('admin.banners.destroy', $banner->id) }}" class="confirm-action"
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
