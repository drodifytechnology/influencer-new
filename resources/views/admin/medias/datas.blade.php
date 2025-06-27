@foreach ($social_medias as $social_media)
    <tr>
        @can('social-medias-delete')
        <td class="w-60 checkbox">
            <label class="table-custom-checkbox">
                <input type="checkbox" name="ids[]" class="table-hidden-checkbox checkbox-item"
                   value="{{ $social_media->id }}"   data-url="{{ route('admin.social-medias.deleteAll') }}">
                <span class="table-custom-checkmark custom-checkmark td"></span>
            </label>
        </td>
        @endcan
        <td>{{ $loop->iteration }}</td>
        <td>
            <img src="{{ asset($social_media->value['icon'] ?? '') }}" height="50" width="50" class="rounded-3" alt="social-icon">
        </td>
        <td>{{ $social_media->value['title'] }}</td>
        <td>{{ $social_media->value['url'] }}</td>
        <td class="text-center w-150">
            <label class="switch">
                <input type="checkbox" {{ $social_media->status == 1 ? 'checked' : '' }} class="status"
                    data-url="{{ route('admin.social-medias.status', $social_media->id) }}">
                <span class="slider round"></span>
            </label>
        </td>
        <td>
            <div class="dropdown table-action">
                <button type="button" data-bs-toggle="dropdown">
                    <i class="far fa-ellipsis-v"></i>
                </button>
                <ul class="dropdown-menu">
                    @can('social-medias-update')
                    <li>
                        <a href="#social-media-edit-modal" class="social-media-edit-btn" data-bs-toggle="modal"
                            data-url="{{ route('admin.social-medias.update', $social_media->id) }}"
                            data-media-title="{{ $social_media->value['title'] ?? '' }}"
                            data-media-url="{{ $social_media->value['url'] ?? '' }}"
                            data-media-icon="{{ asset($social_media->value['icon']) ?? '' }}"
                            data-media-status="{{ $social_media->status }}"
                            >
                            <i class="fal fa-edit"></i>
                            {{ __('Edit') }}
                        </a>
                    </li>
                    @endcan
                    @can('social-medias-delete')
                    <li>
                        <a href="{{ route('admin.social-medias.destroy', $social_media->id) }}"
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
