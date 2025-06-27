@extends('layouts.master')

@section('title')
    {{ __('Create Blog') }}
@endsection

@section('main_content')
    <div class="erp-table-section">
        <div class="container-fluid">
            <div class="cards">
                <div class="card-body">
                    <div class="table-header mb-4">
                        <h4>{{ __('Create Blog') }}</h4>
                        <a href="{{ route('admin.blogs.index') }}" class="theme-btn print-btn text-light">
                            <i class="fas fa-list me-1"></i>
                            {{ __('Blog List') }}
                        </a>
                    </div>

                    <div class="tab-content order-summary-tab">
                        <div class="tab-pane fade mt-1 show active" id="add-new-user">
                            <div class="order-form-section p-16">
                                <form action="{{ route('admin.blogs.store') }}" method="post" enctype="multipart/form-data"
                                    class="ajaxform_instant_reload">
                                    @csrf

                                    <div class="add-suplier-modal-wrapper">
                                        <div class="row">
                                            <div class="col-lg-12 mt-2">
                                                <label>{{ __('Title') }}</label>
                                                <input type="text" name="title" required class="form-control"
                                                    placeholder="{{ __('Enter Title') }}">
                                            </div>

                                            <div class="col-lg-6 mt-2">
                                                <label>{{ __('Status') }}</label>
                                                <div class="gpt-up-down-arrow position-relative">
                                                    <select name="status" required=""
                                                        class="form-control select-dropdown">
                                                        <option value="">{{ __('Select a status') }}</option>
                                                        <option value="1">{{ __('Active') }}</option>
                                                        <option value="0">{{ __('Deactive') }}</option>
                                                    </select>
                                                    <span></span>
                                                </div>
                                            </div>

                                            <div class="col-lg-5 mt-2">
                                                <div>
                                                    <label class="custom-img-label">{{ __('Image') }}</label>
                                                    <input type="file" accept="image/*" name="image"
                                                    onchange="document.getElementById('image').src = window.URL.createObjectURL(this.files[0])"
                                                    class="form-control" required>
                                                </div>
                                            </div>

                                            <div class="col-lg-1 mt-2 align-self-center">
                                                <div class="align-self-center mt-3">
                                                    <img src="{{ asset('assets/images/icons/upload.png') }}" id="image" class="table-img">
                                                </div>
                                            </div>

                                            <div class="col-lg-12 mt-2">
                                                <label>{{ __('Description') }}</label>
                                                <textarea type="text" name="descriptions" class="form-control" placeholder="{{ __('Enter Description') }}"></textarea>
                                            </div>

                                            <div class="col-lg-12">
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
    </div>
@endsection

@push('js')
    <script src="{{ asset('assets/js/custom/custom.js') }}"></script>
@endpush
