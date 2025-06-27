<div class="modal fade" id="coupon-create-modal">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header container">
                <h1 class="modal-title fs-5 fw-bold container-fluid">{{ __('Add New Coupon') }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="erp-table-section">

                    <div class="card-body">
                        <div class="">
                            {{-- form start --}}
                            <form action="{{ route('admin.coupons.store') }}" method="post"
                                enctype="multipart/form-data" class="add-brand-form ajaxform_instant_reload">
                                @csrf
                                <div class="add-suplier-modal-wrapper">
                                    <div class="row">
                                        <div class="col-lg-6 mt-2">
                                            <label class="custom-top-label">{{ __('Name') }}</label>
                                            <input type="text" name="title" id="name" required
                                                class="form-control" placeholder="{{ __('Enter Title') }}">
                                        </div>

                                        <div class="col-md-6 mt-2">
                                            <label class="custom-top-label">{{ __('Amount/Percent') }}</label>
                                            <div class="input-group">
                                                <input type="number" name="discount" class="form-control amount-percent-input"
                                                    placeholder="{{ __('EX:10%') }}" aria-label=""
                                                    aria-describedby="basic-addon2">
                                                <button class="btn btn-outline-secondary amout-percent-button" type="button"
                                                    id="basic-addon2" data-bs-toggle="dropdown"
                                                    aria-expanded="false">

                                                    <select name="discount_type" class="form-select">
                                                        <option value="fixed">{{ __('Fixed') }}</option>
                                                        <option value="percentage">{{ __('Percentage') }}</option>
                                                    </select>
                                                </button>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 mt-2">
                                            <label class="custom-top-label">{{ __('Start Date') }}</label>
                                            <input type="date" name="start_date" id="date" required
                                                class="form-control" placeholder="{{ __('Select Date') }}">
                                        </div>

                                        <div class="col-lg-6 mt-2">
                                            <label class="custom-top-label">{{ __('End Date') }}</label>
                                            <input type="date" name="end_date" id="date" required
                                                class="form-control" placeholder="{{ __('Select Date') }}">
                                        </div>

                                        <div class="mt-2 col-lg-6">
                                            <label class="custom-top-label">{{ __('Status') }}</label>
                                            <div class="gpt-up-down-arrow position-relative">
                                                <select class="form-control form-selected" name="status">
                                                    <option value="">{{ __('Select A Status') }}</option>
                                                    <option value="1">{{ __('Active') }}</option>
                                                    <option value="0">{{ __('Deactive') }}</option>
                                                </select>
                                                <span></span>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 mt-2">
                                            <label class="custom-top-label">{{ __('Coupon Code') }}</label>
                                            <input type="text" name="code" id="code" required class="form-control" placeholder="{{ __('Enter Code') }}">
                                        </div>

                                        <div class="col-lg-6 mt-2">
                                            <label class="custom-top-label custom-img-label">{{ __('Background Color') }}</label>
                                            <input type="color" name="bg_color" id="bg_color" required class="form-control m-h-48">
                                        </div>
                                        <div class="col-lg-6 mt-2">
                                            <label class="custom-top-label">{{ __('Description') }}</label>
                                            <textarea name="description" id="" class="form-control" placeholder="{{ __('Enter description') }}"></textarea>
                                        </div>
                                        <div class="col-lg-6 mt-2">
                                            <label class="custom-top-label custom-img-label">{{ __('Image') }}</label>
                                            <div class="upload-img-v2">
                                                <label class="upload-v4 image-height">
                                                    <div class="img-wrp">
                                                        <img src="{{ asset($employee->user->image ?? 'assets/images/icons/upload-icon.svg') }}"
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
</div>

