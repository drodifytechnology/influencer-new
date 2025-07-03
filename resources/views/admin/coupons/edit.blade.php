@extends('layouts.master')

@section('main_content')
    <div class="erp-table-section">
        <div class="container-fluid">
            <div class="cards">
                <div class="card-body">
                    <div class="table-header">
                        <h4>{{ __('Edit Coupon') }}</h4>
                        <div>
                            <a href="{{ route('admin.coupons.index') }}" class="theme-btn print-btn text-light active">
                                <i class="fas fa-list me-1"></i>
                                {{ __('Coupon List') }}
                            </a>
                        </div>
                    </div>

                    <div class="order-form-section p-16">
                        {{-- form start --}}
                        <form action="{{ route('admin.coupons.update', $coupon->id) }}" method="post"
                            enctype="multipart/form-data" class="ajaxform_instant_reload">
                            @csrf
                            @method('PUT')
                            <div class="add-suplier-modal-wrapper">
                                <div class="row">
                                    <div class="col-lg-6 mt-2">
                                        <label>{{ __('Name') }}</label>
                                        <input type="text" name="title" id="name" required class="form-control"
                                            placeholder="{{ __('Enter Title') }}" value="{{ $coupon->title }}">
                                    </div>

                                    <div class="col-md-6 mt-2">
                                        <label>{{ __('Amount/Percent') }}</label>
                                        <div class="input-group">
                                            <input type="number" name="discount" class="form-control" placeholder="{{ __('EX:10%') }}"
                                                value="{{ $coupon->discount }}" aria-label=""
                                                aria-describedby="basic-addon2">
                                            <button class="btn btn-outline-secondary" type="button" id="basic-addon2"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <select name="discount_type">
                                                    <option @selected($coupon->discount_type == 'fixed') value="fixed">{{ __('Fixed') }}</option>
                                                    <option @selected($coupon->discount_type == 'percentage') value="percentage">{{ __('Percentage') }}</option>
                                                </select>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 mt-2">
                                        <label>{{ __('Start Date') }}</label>
                                        <input type="date" name="start_date" id="date" required class="form-control"
                                            placeholder="{{ __('Select Date') }}" value="{{ $coupon->start_date }}">
                                    </div>

                                    <div class="col-lg-6 mt-2">
                                        <label>{{ __('End Date') }}</label>
                                        <input type="date" name="end_date" id="date" required class="form-control"
                                            placeholder="{{ __('Select Date') }}" value="{{ $coupon->end_date }}">
                                    </div>

                                    <div class="mt-2 col-lg-6">
                                        <label>{{ __('Status') }}</label>
                                        <div class="gpt-up-down-arrow position-relative">
                                            <select name="status" required="" class="form-control select-dropdown">
                                                <option value="">{{ __('Select a status') }}</option>
                                                <option @selected($coupon->status == '1') value="1">{{ __('Active') }}</option>
                                                <option @selected($coupon->status == '0') value="0">{{ __('Deactive') }}</option>
                                            </select>
                                            <span></span>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 mt-2">
                                        <label>{{ __('Coupon Code') }}</label>
                                        <input type="text" name="code" id="code" required class="form-control"
                                            placeholder="{{ __('Enter Code') }}" value="{{ $coupon->code }}">
                                    </div>
                                    <div class="col-lg-6 mt-2">
                                        <label class="custom-top-label">{{ __('Background Color') }}</label>
                                        <input type="color" value="{{ $coupon->bg_color }}" name="bg_color" id="bg_color" required class="form-control m-h-48">
                                    </div>
                                    <div class="col-lg-6 mt-2">
                                        <label>{{ __('Description') }}</label>
                                        <textarea name="description" id="" class="form-control" placeholder="{{ __('Enter description') }}">{{ $coupon->description }}</textarea>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="upload-img-v2">
                                            <label class="upload-v4 image-height">
                                                <div class="img-wrp">
                                                    <img src="{{ asset($coupon->image ?? 'assets/images/icons/upload-icon.svg') }}"
                                                        alt="" id="profile-img">
                                                </div>
                                                <input type="file" name="image" class="d-none"
                                                    onchange="document.getElementById('profile-img').src = window.URL.createObjectURL(this.files[0])"
                                                    accept="image/*">
                                            </label>
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
