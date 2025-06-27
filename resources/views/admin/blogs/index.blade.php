@extends('layouts.master')

@section('title')
    {{ __('Blog') }}
@endsection

@section('main_content')
    <div class="erp-table-section">
        <div class="container-fluid">
            <div class="cards">
                <div class="card-body">
                    <div class="table-header">
                        <h4 class="mt-2">{{ __('Blog List') }}</h4>
                        @can('blogs-create')
                        <a href="{{ route('admin.blogs.create') }}" class="theme-btn print-btn text-light">
                            <i class="far fa-plus" aria-hidden="true"></i>
                            {{ __('Create New') }}
                        </a>
                        @endcan
                    </div>
                    <div class="table-top-form">
                        <form action="{{ route('admin.blogs.index') }}" method="post">
                            @csrf
                            <div class="table-search">
                                <input class="form-control searchInput" type="text" name="search" placeholder="{{ __('Search...') }}" value="{{ request('search') }}">
                            </div>
                        </form>
                    </div>

                    <div class="responsive-table">
                        <table class="table" id="datatable">
                            <thead>
                                <tr>
                                    @can('blogs-delete')


                                        <th>
                                            <div class="d-flex align-items-center gap-1">
                                                <label class="table-custom-checkbox">
                                                    <input type="checkbox" class="table-hidden-checkbox selectAllCheckbox">
                                                    <span class="table-custom-checkmark custom-checkmark"></span>
                                                </label>
                                                <i class="fal fa-trash-alt delete-selected"></i>
                                            </div>
                                        </th>
                                    @endcan
                                    <th>{{ __('SL') }}</th>
                                    <th>{{ __('Image') }}</th>
                                    <th>{{ __('Title') }}</th>
                                    <th>{{ __('Descriptions') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th class="print-d-none">{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody class="searchResults">
                                @include('admin.blogs.datas')
                            </tbody>
                        </table>
                    </div>
                    <nav>
                        <ul class="pagination">
                            <li class="page-item">{{ $blogs->links('pagination::bootstrap-5') }}</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('modal')
    @include('admin.components.multi-delete-modal')
@endpush

@push('js')
    <script src="{{ asset('assets/js/custom/custom.js') }}"></script>
@endpush

