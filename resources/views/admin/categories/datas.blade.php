@foreach ($categories as $category)
    <tr>
        @can('categories-delete')
        <td class="w-60 checkbox">
            <label class="table-custom-checkbox">
                <input type="checkbox" name="ids[]" class="table-hidden-checkbox checkbox-item"
                value="{{ $category->id }}"  data-url="{{ route('admin.categories.deleteAll') }}">
                <span class="table-custom-checkmark custom-checkmark td"></span>
            </label>
        </td>
        @endcan
        <td class="text-start">{{ $loop->iteration }}</td>
        <td>
            <img class="table-img" src="{{ asset($category->icon ?? 'assets/images/icons/upload-icon.svg') }}" alt="img">
        </td>
        <td class="text-start">{{ $category->name }}</td>
        <td class="text-center w-150">
            <label class="switch">
                <input type="checkbox" {{ $category->status == 1 ? 'checked' : '' }} class="status"
                    data-url="{{ route('admin.categories.status', $category->id) }}">
                <span class="slider round"></span>
            </label>
        </td>
        <td>
            <div class="dropdown table-action">
                <button type="button" data-bs-toggle="dropdown">
                    <i class="far fa-ellipsis-v"></i>
                </button>
                <ul class="dropdown-menu">
                    @can('categories-update')
                    <li>
                        <a href="#category-edit-modal" class="category-edit-btn" data-bs-toggle="modal"
                            data-url="{{ route('admin.categories.update', $category->id) }}"
                            data-category-name="{{ $category->name }}"
                            data-category-icon="{{ asset($category->icon) ?? '' }}" data-category-status="{{ $category->status }}">
                            <i class="fal fa-edit"></i>
                            {{ __('Edit') }}
                        </a>
                    </li>
                    @endcan
                    @can('categories-delete')
                    <li>
                        <a href="{{ route('admin.categories.destroy', $category->id) }}" class="confirm-action"
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
