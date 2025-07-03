@foreach ($users as $user)
    <tr>
        @can('users-delete')
        <td class="w-60 checkbox">
            <label class="table-custom-checkbox">
                <input type="checkbox" name="ids[]" class="table-hidden-checkbox checkbox-item" value="{{ $user->id }}"
                    data-url="{{ route('admin.users.delete-all') }}">
                <span class="table-custom-checkmark custom-checkmark td"></span>
            </label>
        </td>
        @endcan
        <td>{{ $loop->index + 1 }} <i class="{{ request('id') == $user->id ? 'fas fa-bell text-red' : '' }}"></i></td>
        <td>{{ $user->name }}</td>
        <td>{{ $user->phone }}</td>
        <td>{{ $user->email }}</td>
        <td class="print-d-none">
            <div class="dropdown table-action">
                <button type="button" data-bs-toggle="dropdown">
                    <i class="far fa-ellipsis-v"></i>
                </button>
                <ul class="dropdown-menu">

                    <li><a href="" class="user-view-btn" data-bs-toggle="modal" data-bs-target="#user-view"
                            data-name="{{ $user->name }}"
                            data-phone="{{ $user->phone }}"
                            data-email="{{ $user->email }}"
                            data-address="{{ $user->address }}"
                            data-country="{{ $user->country }}"
                            data-remarks="{{ $user->remarks }}" >
                            <i class="fal fa-eye"></i>
                            {{ __('View') }}
                        </a>
                    </li>

                    @can('users-update')
                        <li>
                            <a href="{{ route('admin.users.edit', [$user->id, 'users' => $user->role]) }}">
                                <i class="fal fa-pencil-alt"></i>
                                {{ __('Edit') }}
                            </a>
                        </li>
                    @endcan
                    @can('users-delete')
                        <li>
                            <a href="{{ route('admin.users.destroy', $user->id) }}" class="confirm-action"
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
