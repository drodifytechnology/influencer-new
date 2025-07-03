<div class="modal fade" id="report-types-edit-modal">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 fw-bold">{{ __('Edit Report Type') }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="personal-info">
                    <form action="" method="post"
                        enctype="multipart/form-data" class="add-brand-form pt-0 ajaxform_instant_reload updateReportTypesForm">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="mt-3 col-lg-12">
                                <label class="custom-top-label">{{ __('Name') }}</label>
                                <input type="text" name="name" id="report_types_name" placeholder="{{ __('Enter report type name') }}" class="form-control" />
                            </div>
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
