<div class="modal fade" id="payment-type-create-modal">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 fw-bold">{{ __('Create Payment Type') }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="personal-info">
                    <form action="{{ route('admin.payment-type.store') }}" method="post"
                        enctype="multipart/form-data" class="add-brand-form pt-0 ajaxform_instant_reload">
                        @csrf

                        <div class="mt-3 col-lg-12">
                            <label class="custom-top-label">{{ __('Name') }}</label>
                            <input type="text" name="name" placeholder="{{ __('Enter Name') }}" class="form-control" />
                        </div>
                        <div class="mt-3 col-lg-12">
                            <label class="custom-top-label">{{ __('Description') }}</label>
                            <textarea name="description" placeholder="{{ __('Enter Description') }}" cols="30" class="form-control" rows="2"></textarea>
                        </div>

                        <div class="offcanvas-footer mt-3 d-flex justify-content-center">
                            <button type="button" data-bs-dismiss="modal"
                                class="cancel-btn btn btn-outline-danger px-4 me-3" data-bs-dismiss="offcanvas"
                                aria-label="Close">{{ __('Cancel') }}
                            </button>
                            <button class="submit-btn btn btn-primary text-white px-4"
                                type="submit">{{ __('Save') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
