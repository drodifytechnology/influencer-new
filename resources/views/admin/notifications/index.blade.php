@extends('layouts.master')

@section('title')
    {{ __('Notifications List') }}
@endsection

@section('main_content')
{{-- @dd(auth()->user()->unreadNotifications) --}}

    <div class="erp-table-section">
        <div class="container-fluid mt-3">
            <div class="cards">
                    <div class="table-header">
                        <h4>{{ __('Notifications List') }}</h4>
                    </div>
                    <div class="table-top-form mb-3">
                        <form action="{{ route('admin.notifications.filter') }}" method="post" class="filter-form" table="#notification-data">
                            @csrf
                            <div class="grid-5">
                                <div class=" gpt-up-down-arrow position-relative custom-notifi">
                                <select name="days" class="table-select form-control m-0">
                                    <option value="daily">{{__('Today')}}</option>
                                    <option value="weekly">{{__('Last 7 Days')}}</option>
                                    <option value="15_days">{{__('Last 15 Days')}}</option>
                                    <option value="monthly">{{__('Last Month')}}</option>
                                    <option value="yearly">{{__('Last Year')}}</option>
                                </select>
                                <span></span>
                            </div>
                            </div>
                        </form>
                    </div>
                    <div class="responsive-table">
                        <table class="table" id="erp-table">
                            <thead>
                                <tr>
                                    <th>@lang('SL').</th>
                                    <th>@lang('Message')</th>
                                    <th>@lang('Created At')</th>
                                    <th>@lang('Read At')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody id="notification-data">
                            @include('admin.notifications.datas')
                            </tbody>
                        </table>
                    </div>
                </div>
        </div>
    </div>
@endsection


