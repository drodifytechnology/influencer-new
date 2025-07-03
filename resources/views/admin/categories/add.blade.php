<div class="modal fade" id="category-add-modal">
    <div class="modal-dialog modal-dialog-centered modal-lg" >
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 fw-bold">{{ __('Add New Category') }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="personal-info">
                    <form action="{{ route('admin.categories.store') }}" method="post" enctype="multipart/form-data"
                        class="add-brand-form pt-0 ajaxform_instant_reload">
                        @csrf

                        <div class="row">
                          <div class="mt-3 col-lg-6">
                                <label class="custom-top-label">{{ __('Name') }}</label>
                                <input type="text" name="name" placeholder="{{ __('Enter Category Name') }}"
                                    class="form-control" />
                            </div>
                            <div class="mt-3 col-lg-6">
                                <label class="custom-top-label">{{ __('Status') }}</label>
                                <div class="gpt-up-down-arrow position-relative">
                                    <select class="form-control form-selected" name="status" >
                                        <option value="">{{ __('Select A Status') }}</option>
                                        <option value="1">{{ __('Active') }}</option>
                                        <option value="0">{{ __('Deactive') }}</option>
                                    </select>
                                    <span></span>
                                </div>
                            </div>
                            <div class="col-lg-6 mt-2">
                                <label class="custom-top-label img">{{ __('Icon') }}</label>
                                <input type="file" name="icon" accept="image/*" onchange="document.getElementById('icon').src = window.URL.createObjectURL(this.files[0])" class="form-control">
                            </div>

                            <div class="col-lg-2 mt-4 align-self-center">
                                <img src="{{ asset('assets/images/icons/upload.png') }}" id="icon" class="table-img">
                            </div>
                        </div>
                        <div class="offcanvas-footer mt-3 d-flex justify-content-center">
                            <button type="button" data-bs-dismiss="modal" class="cancel-btn btn btn-outline-danger" data-bs-dismiss="offcanvas"
                                aria-label="Close">{{ __('Cancel') }}
                            </button>
                            <button class="submit-btn btn btn-primary text-white ms-2" type="submit">{{ __('Save') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
