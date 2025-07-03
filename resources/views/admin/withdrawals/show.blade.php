@extends('layouts.master')

@section('main_content')
    <div class="erp-table-section">
        <div class="container-fluid">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="table-header">
                        <h4 class="fw-bold">{{ __('Withdraw Request View') }}</h4>
                    </div>
                </div>

                <div class="container-fluid pb-5">
                    <div class="row">
                        <div class="col-6">
                            <div class="card shadow">
                                <div class="card-body">
                                    <h4 class="fw-bold">{{ __('View Details') }}</h4>
                                    <div class="personal-info mt-2">
                                        <div class="row">
                                            <div class="col-md-3 mb-2">
                                                <p>{{ __('Date') }}</p>
                                            </div>
                                            <div class="col-md-9">: {{\Carbon\Carbon::parse($withdraw->created_at)->format('M d, Y')}}<span id="expenses_category_name"> </span></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3 mb-2">
                                                <p>{{ __('Influencer') }}</p>
                                            </div>
                                            <div class="col-md-9">: {{ $withdraw->user->name }}<span id="expenses_category_description"> </span></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3 mb-2">
                                                <p>{{ __('Payment Method') }}</p>
                                            </div>
                                            <div class="col-md-9">: {{ $withdraw->withdraw_method->name}}<span id="expenses_category_description"> </span></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3 mb-2">
                                                <p>{{ __('Total Amount') }}</p>
                                            </div>
                                            <div class="col-md-9 mb-2">: {{ currency_format($withdraw->amount) }}<span id="expenses_category_description"> </span></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3 mb-2">
                                                <p>{{ __('Charge') }}</p>
                                            </div>
                                            <div class="col-md-9">: {{ currency_format($withdraw->charge) }}<span id="expenses_category_description"> </span></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3 mb-2">
                                                <p>{{ __('Withdraw Amount') }}</p>
                                            </div>
                                            <div class="col-md-9">: {{ currency_format($withdraw->amount - $withdraw->charge) }}<span id="expenses_category_description"> </span></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3 mb-2">
                                                <p>{{ __('Status') }}</p>
                                            </div>
                                            <div class="col-md-9">:
                                                @if ($withdraw->status == 'pending')
                                                <td class="text-warning">{{ __('Pending') }}</td>
                                                @elseif ($withdraw->status == 'rejected')
                                                <td class="text-danger">{{ __('Rejected') }}</td>
                                                @elseif ($withdraw->status == 'approve')
                                                <td class="text-success">{{ __('Approve') }}</td>
                                                @endif<span id="expenses_category_description"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                       <div class="col-6">
                        <div class="card shadow">
                            <div class="card-body">
                                <h4 class="fw-bold">{{ __('Account Information') }}</h4>
                                <div class="personal-info mt-2">
                                    @foreach ($withdraw['account_info']['infos'] as $key => $value )
                                    <div class="row">
                                        <div class="col-md-3 mb-2">
                                            <p>{{ (str_replace('_', ' ', $key)) }}</p>
                                        </div>
                                        <div class="col-md-9">: {{ $value }}<span id="expenses_category_name"> </span></div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                       </div>
                    </div>
                </div>
                <div class="offcanvas-footer mb-4">
                    <button data-url="{{ route('admin.withdraw.reject',$withdraw->id)}}"  class="reject-btn"  data-bs-toggle="modal" data-bs-target="#withdraw-reject-modal" > <i class="fas fa-ban"></i> {{ __('Reject') }}</button>
                    <button data-url="{{ route('admin.withdraw.approve',$withdraw->id)}}" class="approve-btn submit-btn" data-bs-toggle="modal" data-bs-target="#withdraw-approve-modal" > <i class="far fa-check-circle"></i> {{ __('Approve') }}</button>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@push('modal')
    @include('admin.withdrawals.reject')
    @include('admin.withdrawals.approve')
@endpush
