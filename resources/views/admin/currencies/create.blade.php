@extends('layouts.master')

@section('title')
    {{__ ('Create Currency') }}
@endsection

@section('main_content')
    <div class="order-form-section">
        <div class="erp-table-section">
            <div class="container-fluid">
                <div class="cards">
                    <div class="card-body">
                        <div class="table-header">
                            <h4>{{__('Create Currency')}}</h4>
                            @can('currencies-create')
                                <a href="{{ route('admin.currencies.index') }}" class="add-order-btn rounded-2">
                                    <i class="fas fa-list me-1"></i>
                                    {{ __('View List') }}
                                </a>
                            @endcan
                        </div>
                        <form action="{{ route('admin.currencies.store') }}" method="post" enctype="multipart/form-data" class="ajaxform_instant_reload">
                            @csrf
                            <div class="row p-16">
                                <div class="col-lg-6 mt-2">
                                    <label>{{__('Name')}}</label>
                                    <input type="text" name="name" required class="form-control" placeholder="{{ __('Enter Name') }}">
                                </div>

                                <div class="col-lg-6 mt-2">
                                    <label>{{__('Code')}}</label>
                                    <input type="text" name="code" required class="form-control" placeholder="{{ __('Enter Code') }}">
                                </div>

                                <div class="col-lg-6 mt-2">
                                    <label>{{__('Symbol')}}</label>
                                    <input type="text" name="symbol" class="form-control" placeholder="{{ __('Enter Symbol') }}">
                                </div>

                                <div class="col-lg-6 mt-2">
                                    <label>{{__('Position')}}</label>
                                    <select name="position" class="form-control table-select w-100">
                                        <option value="">{{__('Select a position')}}</option>
                                        <option value="left">{{__('left')}}</option>
                                        <option value="right">{{__('right')}}</option>
                                    </select>
                                </div>

                                <div class="col-lg-6 mt-2">
                                    <label>{{__('Status')}}</label>
                                    <select name="status" required class="form-control table-select w-100">
                                        <option value="1">{{__('Active')}}</option>
                                        <option value="0">{{__('Inactive')}}</option>
                                    </select>
                                </div>

                                <div class="col-lg-12">

                                    <div class="offcanvas-footer mt-3 d-flex justify-content-center">
                                        <button type="reset" data-bs-dismiss="modal" class="cancel-btn btn btn-outline-danger" data-bs-dismiss="offcanvas"
                                            aria-label="Reset">{{ __('Cancel') }}
                                        </button>
                                        <button class="submit-btn btn btn-primary text-white ms-2" type="submit">{{ __('Save') }}</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

