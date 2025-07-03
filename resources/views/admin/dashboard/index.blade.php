@extends('layouts.master')

@section('title')
    {{__('Dashboard') }}
@endsection

@section('main_content')
    <div class="container-fluid">
        @if (!file_exists(public_path('uploads/service-account-credentials.json')))
        <div class="alert alert-warning mt-4" role="alert">
            <strong>{{ __('Warning!') }}:</strong> {{ __("You haven’t set up the Google Firebase JSON file for push notifications. Please refer to the documentation.") }}
        </div>
        @endif
        <div class="gpt-dashboard-card admin-dashboard-card grid-4 mt-30 mb-30">
            <div class="dashboard-couter-box ">
                <div class="dashboard-icons">
                    <img src="{{ asset('assets/images/icons/total_user.svg') }}" alt="">
                </div>
                <div class="dashboard-content-side">
                    <h5 id="dashboard_app_user" ></h5>
                    <p>{{ __('Total User') }}</p>
                </div>
            </div>

            <div class="dashboard-couter-box ">
                <div class="dashboard-icons">
                    <img src="{{ asset('assets/images/icons/total_client.svg') }}" alt="">
                </div>
                <div class="dashboard-content-side">
                    <h5 id="dashboard_total_client"></h5>
                    <p>{{ __('Total Clients') }}</p>
                </div>
            </div>
            <div class="dashboard-couter-box ">
                <div class="dashboard-icons">
                    <img src="{{ asset('assets/images/icons/active_client.svg') }}" alt="">
                </div>
                <div class="dashboard-content-side">
                    <h5 id="dashboard_active_client"></h5>
                    <p>{{ __('Active Clients') }}</p>
                </div>
            </div>
            <div class="dashboard-couter-box ">
                <div class="dashboard-icons">
                    <img src="{{ asset('assets/images/icons/total_influencer .svg') }}" alt="">
                </div>
                <div class="dashboard-content-side">
                    <h5 id="dashboard_total_influencer"></h5>
                    <p>{{ __('Total Influencer') }}</p>
                </div>
            </div>
            <div class="dashboard-couter-box ">
                <div class="dashboard-icons">
                    <img src="{{ asset('assets/images/icons/active_influe.svg') }}" alt="">
                </div>
                <div class="dashboard-content-side">
                    <h5 id="dashboard_active_influencer"></h5>
                    <p>{{ __('Active Influencer') }}</p>
                </div>
            </div>
            <div class="dashboard-couter-box ">
                <div class="dashboard-icons">
                    <img src="{{ asset('assets/images/icons/total_service.svg') }}" alt="">
                </div>
                <div class="dashboard-content-side">
                    <h5 id="dashboard_total_service"></h5>
                    <p>{{ __('Total Services') }}</p>
                </div>
            </div>
            <div class="dashboard-couter-box ">
                <div class="dashboard-icons">
                    <img src="{{ asset('assets/images/icons/total_income.svg') }}" alt="">
                </div>
                <div class="dashboard-content-side">
                    <h5 id="dashboard_total_income"></h5>
                    <p>{{ __('Total Income') }}</p>
                </div>
            </div>
            <div class="dashboard-couter-box ">
                <div class="dashboard-icons">
                    <img src="{{ asset('assets/images/icons/total_expense.svg') }}" alt="">
                </div>
                <div class="dashboard-content-side">
                    <h5 id="dashboard_total_expense"></h5>
                    <p>{{ __('Total Expense') }}</p>
                </div>
            </div>
        </div>


            <div class="row gpt-dashboard-chart dashboard">

                <div class="col-xl-7  mb-30">
                    <div class="card new-card">
                        <div class="card-header users-header">
                            <h4>{{ __('Recent Registered Client') }}</h4>
                            <p>{{ __('Showing') }} {{ $users->count() }} {{ __('of 5') }} | <a href="{{ route('admin.clients.index') }}" class="view-all"> {{ __('View All') }} <i class="fas fa-arrow-right ms-1"></i></a></p>
                        </div>
                        <div class="card-bodys">
                            <div class="table-responsive border-1  rounded-image">
                                <table class="table table-bordered ">
                                    <thead>
                                    <tr>
                                <th>{{ __('SL') }}</th>

                                <th>{{ __('Join Date') }}</th>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Email') }}</th>
                                <th>{{ __('Country') }}</th>
                                <th class="text-center">{{ __('Order Done') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($users as $user)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>

                                            <td>{{ formatted_date($user->created_at) }}</td>
                                            <td>{{ ucwords($user->name) }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->country }}</td>
                                            <td class="text-center">{{ $user->orders_count }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class=" col-xl-5  mb-30">
                    <div class="card new-card">
                        <div class="card-header overview-header">
                            <h4>{{__('Income Report')}}</h4>
                            <div class="gpt-up-down-arrow position-relative">
                                <select class="form-control yearly-income">
                                    @for ($i = date('Y'); $i >= 2022; $i--)
                                        <option @selected($i == date('Y')) value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                                <span></span>
                            </div>
                        </div>
                        <div class="card-body ShareProfit-body">
                            <canvas id="income-statistics" width="400" height="200" class="chart-css"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-xl-7  mb-30">
                    <div class="card new-card">
                        <div class="card-header users-header">
                            <h4>{{ __('Recent Registered Influencer') }}</h4>
                            <p>{{ __('Showing') }} {{ $influencers->count() }} {{ __('of 5') }} | <a href="{{ route('admin.influencers.index') }}" class="view-all"> {{ __('View All') }} <i class="fas fa-arrow-right ms-1"></i></a></p>
                        </div>
                        <div class="card-bodys">
                            <div class="table-responsive border-1  rounded-image">
                                <table class="table table-bordered ">
                                    <thead>
                                    <tr>
                                        <th>{{ __('SL') }}</th>
                                        <th>{{ __('Join Date') }}</th>
                                        <th>{{ __('Name') }}</th>
                                        <th>{{ __('Email') }}</th>
                                        <th class="text-center">{{ __('Service') }}</th>
                                        <th class="text-center">{{ __('Balance') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($influencers as $influencer)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ formatted_date($influencer->created_at) }}</td>
                                            <td>{{ ucwords($influencer->name) }}</td>
                                            <td>{{ $influencer->email }}</td>
                                            <td class="text-center">{{ $influencer->services_count}}</td>
                                            <td class="text-center">{{ currency_format($influencer->balance) }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-5  mb-30">
                    <div class="card new-card">
                        <div class="card-header subscription-header">
                            <h4>{{__('Withdraw Report')}}</h4>
                            <div class="gpt-up-down-arrow position-relative">
                                <select class="form-control generates-statistics">
                                    @for ($i = date('Y'); $i >= 2022; $i--)
                                        <option @selected($i == date('Y')) value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                                <span></span>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <canvas id="monthly-statistics" class="chart-css"></canvas>
                        </div>
                    </div>
                </div>
            </div>

    </div>

    <input type="hidden" value="{{ route('admin.dashboard.data') }}" id="get-dashboard">
    <input type="hidden" value="{{ route('admin.dashboard.total-income') }}" id="get-yearly-income">
    <input type="hidden" value="{{ route('admin.dashboard.generates') }}" id="yearly-generates-url">

@endsection

@push('js')
    <script src="{{ asset('assets/js/chart.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/dashboard.js') }}"></script>
@endpush
