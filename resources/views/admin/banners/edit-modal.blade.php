<div class="modal fade" id="banners-edit-modal">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 fw-bold">{{ __('Add New Report Type') }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="personal-info">
                    <form action="" method="post"
                        enctype="multipart/form-data" class="add-brand-form pt-0 ajaxform_instant_reload bannersUpdateForm">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="mt-3 col-lg-12">
                                <label class="custom-top-label">{{ __('Title') }}</label>
                                <input type="text" name="title" id="banners_title" placeholder="{{ __('Enter Title') }}" class="form-control" />
                            </div>

                            <div class="mt-2 col-lg-12">
                                <label class="custom-top-label">{{ __('Status') }}</label>
                                <div class="gpt-up-down-arrow position-relative">
                                    <select class="form-control form-selected" name="status" id="banners_status">
                                        <option value="1">{{ __('Active') }}</option>
                                        <option value="0">{{ __('Deactive') }}</option>
                                    </select>
                                    <span></span>
                                </div>
                            </div>
                            <div class="col-lg-12 mt-2">
                                <label class="custom-top-label img">{{ __('Image') }}</label>
                                <div class="upload-img-v2">
                                    <label class="upload-v4 image-height">
                                        <div class="img-wrp">
                                            <img id="banners_image" src=""
                                                alt="" id="profile-img">
                                        </div>
                                        <input type="file"  name="image" class="d-none"
                                            onchange="document.getElementById('profile-img').src = window.URL.createObjectURL(this.files[0])"
                                            accept="image/*">
                                    </label>
                                </div>
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
