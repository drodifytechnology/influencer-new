<div class="table-header justify-content-end border-0 p-0">
    <div class="button-group nav">
        @can('users-read')
        <a href="{{ route('admin.users.index', ['users' => request('users')]) }}" class="add-report-btn {{ Route::is('admin.users.index') ? 'active' : '' }}"><i class="fas fa-list"></i> {{ __(ucfirst(request('users'))) }} {{ __('List') }}</a>
        @endcan
        @can('users-create')
        <a href="{{ route('admin.users.create', ['users' => request('users')]) }}" class="add-report-btn {{ Route::is('admin.users.create') ? 'active' : '' }}"><i class="fas fa-plus-circle"></i> {{ __('Add New') }} {{ __(ucfirst(request('users'))) }}</a>
        @endcan
    </div>
</div>
