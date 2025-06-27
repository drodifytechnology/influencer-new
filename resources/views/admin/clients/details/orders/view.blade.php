@extends('layouts.master')

@section('title')
    {{ __('Order Details') }}
@endsection

@section('main_content')
    <div class="erp-table-section">
        <div class="container-fluid">
            <div class="card shadow-sm p-3">
                <div class="row">
                    <div class="col-lg-3 d-flex align-items-center">
                        <h3 class="fw-bold">{{ __('Order Details') }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid mt-3">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card shadow-sm">
                        <div class="personal-info ps-3">
                            <h5 class="fw-bold my-3">{{ __('Order Information') }}</h5>
                            <div class="row">
                                <div class="col-md-4">
                                    <p>{{ __('Order Id') }}</p>
                                </div>
                                <div class="col-md-8">: #{{$order->id}}</div>

                                <div class="col-md-4">
                                    <p>{{ __('Schedule Date') }}</p>
                                </div>
                                <div class="col-md-8">: {{ formatted_date($order->end_date) }}</div>

                                <div class="col-md-4">
                                    <p>{{ __('Schedule Time') }}</p>
                                </div>
                                <div class="col-md-8">: {{ $order->end_time }}</div>

                                <div class="col-md-4">
                                    <p>{{ __('Status') }}</p>
                                </div>
                                <div class="col-md-8">:
                                    @if ($order->status == 'delivered')
                                    <td class="text-success">{{ __('Delivered') }}</td>
                                    @elseif ($order->status == 'canceled')
                                    <td class="text-danger">{{ __('Canceled') }}</td>
                                    @elseif ($order->status == 'pending')
                                    <td class="text-warning">{{ __('Pending') }}</td>
                                    @endif
                                </div>

                                <div class="col-md-4">
                                    <p>{{ __('Influencer') }}</p>
                                </div>
                                <div class="col-md-8">: {{ $order->service->user->name }}</div>

                                <div class="col-md-4">
                                    <p>{{ __('Client') }}</p>
                                </div>
                                <div class="col-md-8">: {{ $order->user->name }}</div>

                                <div class="col-md-4">
                                    <p>{{ __('Service') }}</p>
                                </div>
                                <div class="col-md-8">: {{ $order->service->title }}</div>

                            </div>
                            <h5 class="fw-bold my-3">{{ __('Script/Document') }}</h5>
                            <div class="row">
                                <div class="col-md-4">
                                    <p>{{ __('Script') }}</p>
                                </div>
                                <div class="col-md-8">: {{ $order->description ?? '' }}</div>

                                <div class="col-md-4">
                                    <p>{{ __('File') }}</p>
                                </div>
                                <div class="col-md-8">: {{ $order->file ?? '' }}</div>
                            </div>

                            <h5 class="fw-bold my-3">{{ __('Payment Information') }}</h5>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <p>{{ __('Payment Status') }}</p>
                                </div>
                                <div class="col-md-8">: <span class="text-success">{{ $order->payment_status ?? '' }}</span> </div>

                                <div class="col-md-4">
                                    <p>{{ __('Payment method') }}</p>
                                </div>
                                <div class="col-md-8">: Success</div>

                                <div class="col-md-4">
                                    <p>{{ __('Transaction') }}</p>
                                </div>
                                <div class="col-md-8">: Success</div>

                                <div class="col-md-4">
                                    <p>{{ __('Sub Total') }}</p>
                                </div>
                                <div class="col-md-8">: Success</div>

                                <div class="col-md-4">
                                    <p>{{ __('Discount') }}</p>
                                </div>
                                <div class="col-md-8">: {{ $order->discount_amount ?? '' }} %</div>

                                <div class="col-md-4">
                                    <p>{{ __('Service Fee') }}</p>
                                </div>
                                <div class="col-md-8">: {{ currency_format($order->charge ?? '') }}</div>

                                <div class="col-md-4">
                                    <p>{{ __('Total') }}</p>
                                </div>
                                <div class="col-md-8">: {{ currency_format($order->total_amount ?? '') }} </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="app">
                        <h4 class="message-title">{{ __('Replay Ticket') }}</h4>
                        <div class="wrapper">
                            <div class="chat-area">
                                <div class="chat-area-main" id="message-container">
                                   @include('admin.clients.details.orders.message-data')
                                </div>
                                <form action="{{ route('admin.clients.store') }}" method="post" class="chatFormSubmit" data-route="{{ route('admin.supports.get-message', $id) }}" enctype="multipart/form-data">
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
    </div>
@endsection
