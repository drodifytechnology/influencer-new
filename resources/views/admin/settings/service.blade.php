@extends('layouts.master')

@section('title')
    {{ __('Service Charge') }}
@endsection

@section('main_content')
    <div class="erp-table-section">
        <div class="container-fluid">
            <div class="cards">
                <div class="card-body">
                    <div class="table-header">
                        <h4 class="fw-bold">{{ __('Service Charge') }}</h4>
                    </div>
                    <div class="order-form-section p-16">
                        <form action="{{ route('admin.service-settings.store') }}" method="post" enctype="multipart/form-data" class="ajaxform_instant_reload">
                            @csrf
                            <div class="">
                                <div class="row">
                                    <div class="col-lg-6 mt-2">
                                        <label>{{__('Charge')}}</label>
                                        <input type="text" name="charge" value="{{ $service_charge['value']['charge'] ?? '' }}" required class="form-control" placeholder="{{ __('Enter charge') }}">
                                    </div>
                                    <div class="col-lg-6 mt-2">
                                        <label>{{__('Charge Type')}}</label>
                                        <select name="charge_type" required class="form-control" required>
                                            <option value="">{{ __('Select One') }}</option>
                                            <option @selected(isset($service_charge['value']['charge_type']) && $service_charge['value']['charge_type'] == 'fixed') value="fixed">{{__('Fixed')}}</option>
                                            <option @selected(isset($service_charge['value']['charge_type']) && $service_charge['value']['charge_type'] == 'percentage') value="percentage">{{__('Percentage')}}</option>
                                        </select>
                                    </div>
                                    @can('settings-update')

                                    @endcan
                                    <div class="col-lg-12">
                                        <div class="text-center mt-5">
                                            <button type="submit" class="theme-btn m-2 submit-btn">{{__('Update')}}</button>
                                        </div>
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





