@foreach ($blogs as $blog)
    <tr>
        @can('blogs-delete')
        <td class="w-60 checkbox">
            <label class="table-custom-checkbox">
                <input type="checkbox" name="ids[]" class="table-hidden-checkbox checkbox-item"
                   value="{{$blog->id}}"  data-url="{{ route('admin.blogs.delete-all') }}">
                <span class="table-custom-checkmark custom-checkmark td"></span>
            </label>
        </td>
        @endcan
        <td>
            {{ $loop->index + 1 }} <i class="{{ request('id') == $blog->id ? 'fas fa-bell text-red' : '' }}"></i>
        </td>
        <td>
            <img class="image-style" src="{{ asset($blog->image ?? 'assets/images/profile/avatar.jpg') }}" alt="">
        </td>
        <td>{{ Str::limit($blog->title, 25, '...') }}</td>
        <td>{{ Str::limit($blog->descriptions, 25, '...') }}</td>
        <td class="text-center w-150">
            <label class="switch">
                <input type="checkbox" {{ $blog->status == 1 ? 'checked' : '' }} class="status"
                    data-url="{{ route('admin.blogs.status', $blog->id) }}">
                <span class="slider round"></span>
            </label>
        </td>
        <td class="print-d-none">
            <div class="dropdown table-action">
                <button type="button" data-bs-toggle="dropdown">
                    <i class="far fa-ellipsis-v"></i>
                </button>
                <ul class="dropdown-menu">
                    @can('blogs-update')
                    <li>
                        <a href="{{ route('admin.blogs.edit', $blog->id) }}">
                            <i class="fal fa-pencil-alt"></i>
                            {{ __('Edit') }}
                        </a>
                    </li>
                    @endcan
                    @can('blogs-delete')
                    <li>
                        <a href="{{ route('admin.blogs.destroy', $blog->id) }}" class="confirm-action"
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
