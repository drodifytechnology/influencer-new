@extends('layouts.master')

@section('title')
    {{ __('View Details') }}
@endsection

@section('main_content')
    <div class="erp-table-section">
        <!-- view details start -->
        <div class="container-fluid">
            <div class="card shadow-sm p-3">
                <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                    <h3 class="fw-bold">{{ __('View Details') }}</h3>
                    <form action="{{route('admin.support.closed')}}" class="ajaxform_instant_reload" method="post">
                        <input type="hidden" name="support_id" value="{{ $messages->first()->id ?? '' }}">
                        <button class="support-cancel-btn submit-btn" type="submit">
                            <img src="{{asset('assets/img/icon/cross-red.svg')}}" alt="cross-icon">
                            <span>{{ __('Closed') }}</span>
                           </button>
                    </form>
                </div>
            </div>
        </div>
        <!-- view details end -->

        <!-- info-message start -->
        <div class="container-fluid mt-3">
            <div class="row">
                <!-- info start -->
                 <div class="col-lg-4 mb-3">
                    <div class="card border-0 info-card">
                        <div class="personal-info ps-3 my-3">
                            <h5 class="fw-bold">{{ __('Ticket Information') }}</h5>
                            <div class="row">
                                <div class="col-md-4">
                                    <p>{{ __('Created') }}</p>
                                </div>
                                <div class="col-md-8">:
                                    {{ \Carbon\Carbon::parse($support->created_at ?? '')->format('d/m/y - H:i:s') }}</div>

                                <div class="col-md-4">
                                    <p>{{ __('Ticket ID') }}</p>
                                </div>
                                <div class="col-md-8">: {{ $support->ticket_no ?? '' }}</div>

                                <div class="col-md-4">
                                    <p>{{ __('Subject') }}</p>
                                </div>
                                <div class="col-md-8">: {{ $support->subject ?? '' }}</div>

                                <div class="col-md-4">
                                    <p>{{ __('Priority') }}</p>
                                </div>
                                <div class="col-md-8">: {{ $support->priority ?? '' }}</div>

                                <div class="col-md-4">
                                    <p>{{ __('Status') }}</p>
                                </div>
                                <div class="col-md-8">: {{ $support->status ?? '' }}</div>
                            </div>


                            <h5 class="fw-bold">{{ __('User Information') }}</h5>
                            <div class="row">
                                <div class="col-md-4">
                                    <p>{{ __('Name') }}</p>
                                </div>
                                <div class="col-md-8">: {{ $support->user->name ?? '' }}</div>

                                <div class="col-md-4">
                                    <p>{{ __('User Type') }}</p>
                                </div>
                                <div class="col-md-8">: {{ $support->user->role ?? '' }}</div>

                                <div class="col-md-4">
                                    <p>{{ __('Email') }}</p>
                                </div>
                                <div class="col-md-8">: {{ $support->user->email ?? '' }}</div>

                                <div class="col-md-4">
                                    <p>{{ __('Phone') }}</p>
                                </div>
                                <div class="col-md-8">: {{ $support->user->phone ?? '' }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- info end  -->

                <!-- message start -->
                <div class="col-lg-8">
                    <div class="app">
                        <h4 class="message-title">{{ __('Replay Ticket') }}</h4>
                        <div class="wrapper">
                            <div class="chat-area">
                                <div class="chat-area-main" id="message-container">
                                   @include('admin.tickets.message-data')
                                </div>
                                <form action="{{ route('admin.supports.store') }}" method="post" class="chatFormSubmit" data-route="{{ route('admin.supports.get-message', $id) }}" enctype="multipart/form-data">
                                    @csrf

                                    <div class="chat-area-footer">
                                        <img src="{{ asset('assets/images/chat-box/link.svg') }}" alt="">
                                        <input type="text" class="ps-3" name="message" id="restore-message" placeholder="Username">
                                        <input type="hidden" name="support_id" value="{{ $messages->first()->id ?? '' }}">
                                        <button class="submit-btn">{{ __('submit') }} <img src="{{ asset('assets/images/chat-box/send.svg') }}" alt=""></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
           </div>
           <!-- info end  -->

        </div>
        <!-- info-message end -->
    </div>
@endsection
