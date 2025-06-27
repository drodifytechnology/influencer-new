@extends('layouts.master')

@section('title')
    {{ __('Withdrawal Method') }}
@endsection

@section('main_content')
    <div class="erp-table-section">
        <div class="container-fluid">
            <div class="cards">
                <div class="card-body">
                    <div class="table-header">
                        <h4>{{ __('Edit Payment Method') }}</h4>
                        <div>
                            <a href="{{ route('admin.withdraw_methods.index') }}"
                                class="theme-btn print-btn text-light active">
                                <i class="fas fa-list me-1"></i>
                                {{ __('Method List') }}
                            </a>
                        </div>
                    </div>

                    <div class="order-form-section p-16">
                        {{-- form start --}}
                        <form action="{{ route('admin.withdraw_methods.update', $withdrawMethod->id) }}" method="post"
                            enctype="multipart/form-data" class="ajaxform_instant_reload">
                            @csrf
                            @method('PUT')
                            <div class="add-suplier-modal-wrapper">
                                <div class="row">
                                    <div class="col-lg-6 mt-2">
                                        <label>{{ __('Payment Method Name') }}</label>
                                        <input type="text" name="name" required class="form-control"
                                            placeholder="{{ __('Enter Name') }}" value="{{ $withdrawMethod->name }}">
                                    </div>


                                    <div class="col-lg-6 mt-2">
                                        <label>{{ __('Currency') }}</label>
                                        <select class="form-control form-selected" name="currency_id">
                                            @foreach ($currencies as $currency)
                                                <option value="{{ $currency->id }}"
                                                    {{ $currency->id == $withdrawMethod->currency_id ? 'selected' : '' }}>
                                                    {{ $currency->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-lg-6 mt-2">
                                        <label>{{ __('Minimum Amount') }}</label>
                                        <input type="number" name="min_amount" class="form-control"
                                            placeholder="{{ __('Enter Amount') }}" value="{{ $withdrawMethod->min_amount }}">
                                    </div>

                                    <div class="col-lg-6 mt-2">
                                        <label>{{ __('Maximum Amount') }}</label>
                                        <input type="number" name="max_amount" class="form-control"
                                            placeholder="{{ __('Enter Amount') }}" value="{{ $withdrawMethod->max_amount }}">
                                    </div>

                                    <div class="col-md-6 mt-2">
                                        <label>{{ __('Withdraw Charge') }}</label>
                                        <div class="input-group">
                                            <input type="number" name="charge" value="{{ $withdrawMethod->charge }}" class="form-control border-0 bg-transparent" placeholder="{{ __('EX:Enter Amount') }}" aria-label="" aria-describedby="basic-addon2">
                                            <button class="btn border-0" type="button" id="basic-addon2" data-bs-toggle="dropdown" aria-expanded="false">
                                                <select name="charge_type" class="form-select py-1">
                                                    <option @selected($withdrawMethod->charge_type == 'fixed') value="fixed">{{ __('Fixed') }}</option>
                                                    <option @selected($withdrawMethod->charge_type == 'percentage') value="percentage">{{ __('Percentage') }}</option>
                                                </select>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 mt-2">
                                        <label>{{ __('Instructions') }}</label>
                                        <input type="text" name="instructions" class="form-control"
                                            placeholder="{{ __('Enter Instructions') }}" value="{{ $withdrawMethod->instructions }}">
                                    </div>

                                    <div class="col-12 mb-2">
                                        <div class="manual-rows" id="dynamic-input-fields">
                                            @foreach ($withdrawMethod->meta['label'] ?? [] as $key => $row)

                                                <div class="row row-items">
                                                    <div class="col-sm-6">
                                                        <label for="">{{ __('Label') }}</label>
                                                        <input type="text" name="meta[label][]"
                                                            value="{{ $row ?? ''}}" class="form-control" required
                                                            placeholder="{{ __('Enter label name') }}">
                                                    </div>
                                                    <div class="col-sm-5">
                                                        <label for="">{{ __('Input') }}</label>
                                                        <input type="text" name="meta[input][]"
                                                            value="{{ $withdrawMethod->meta['input'][$key] ?? '' }}" class="form-control" required
                                                            placeholder="{{ __('Enter input name') }}">
                                                    </div>

                                                    <div class="col-sm-1 align-self-center mt-3">
                                                        <button type="button" class="btn text-danger trash remove-btn-features"><i class="fas fa-trash"></i></button>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="row">
                                            <div class="col-12 mt-2">
                                                <a href="javascript:void(0)" class="fw-bold text-primary add-new-item">
                                                    <i class="fas fa-plus-circle"></i> {{ __('Add new row') }}
                                                </a>
                                            </div>
                                        </div>
                                    </div>


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

@push('js')
    <script src="{{ asset('assets/js/custom/custom.js') }}"></script>
@endpush
