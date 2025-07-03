<div class="modal fade" id="reject-modal">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 fw-bold">{{ __('Why are you reject Service?') }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="personal-info">
                    <form action="" method="post" enctype="multipart/form-data"
                        class="add-brand-form pt-0 ajaxform_instant_reload serviceRejectForm">
                        @csrf

                        <div class="row">
                            <div class="mt-3">
                                <label class="custom-top-label">{{ __('Enter Reason') }}</label>
                               <textarea rows="2" name="reason" class="form-control" placeholder="{{ __('Enter reason') }}" ></textarea>
                            </div>
                        </div>

                        <div class="offcanvas-footer mt-3 d-flex justify-content-center align-items-center gap-2">
                            <button type="button" data-bs-dismiss="modal" class="cancel-btn btn btn-outline-danger"
                                data-bs-dismiss="offcanvas" aria-label="Close">{{ __('Cancel') }}
                            </button>
                            <button class="submit-btn btn btn-primary text-white" type="submit">{{ __('Confirm') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="price-modal">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 fw-bold">Admin Price</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="personal-info">
                    <form action="" method="post" enctype="multipart/form-data"
                        class="add-brand-form pt-0 ajaxform_instant_reload servicePriceForm">
                        @csrf

                        <div class="row">
                            <div class="mt-3">
                                <label class="custom-top-label">{{ __('Enter Price') }}</label>
                               <input type="number"  name="price" class="form-control adminPrice" placeholder="{{ __('Enter price') }}" />
                            </div>
                        </div>

                        <div class="offcanvas-footer mt-3 d-flex justify-content-center align-items-center gap-2">
                            <button type="button" data-bs-dismiss="modal" class="cancel-btn btn btn-outline-danger"
                                data-bs-dismiss="offcanvas" aria-label="Close">{{ __('Cancel') }}
                            </button>
                            <button class="submit-btn btn btn-primary text-white" type="submit">{{ __('Confirm') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
