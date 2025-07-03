@extends('layouts.master')

@section('title')
    {{ __('Edit Blog') }}
@endsection

@section('main_content')
    <div class="erp-table-section">
        <div class="container-fluid">
            <div class="cards">
                <div class="card-body">
                    <div class="table-header mb-4">
                        <h4>{{ __('Edit Blog') }}</h4>
                        <a href="{{ route('admin.blogs.index') }}" class="theme-btn print-btn text-light"> <i class="fas fa-list me-1"></i> {{ __('Blog List') }} </a>
                    </div>
                    <div class="tab-content order-summary-tab">
                        <div class="tab-pane fade mt-1 show active" id="add-new-user">
                            <div class="order-form-section p-16">
                                <form action="{{ route('admin.blogs.update',$blog->id) }}" method="post" enctype="multipart/form-data" class="ajaxform_instant_reload">
                                    @csrf
                                    @method('PUT')

                                    <div class="add-suplier-modal-wrapper">
                                        <div class="row">
                                            <div class="col-lg-12 mt-2">
                                                <label>{{ __('Title') }}</label>
                                                <input type="text" name="title" value="{{ $blog->title }}" required class="form-control" placeholder="{{ __('Enter Title') }}">
                                            </div>

                                            <div class="col-lg-6 mt-2">
                                                <label>{{ __('Status') }}</label>
                                                <div class="gpt-up-down-arrow position-relative">
                                                    <select name="status" required=""
                                                        class="form-control select-dropdown">
                                                        <option value="1" @selected($blog->status == 1 ? 'active' : '')>{{__('Active')}}</option>
                                                        <option value="0" @selected($blog->status == 0 ? 'active' : '')>{{__('Deactive')}}</option>
                                                    </select>
                                                    <span></span>
                                                </div>
                                            </div>

                                            <div class="col-lg-5 mt-2">
                                                <div>
                                                    <label class="custom-img-label">{{ __('Image') }}</label>
                                                    <input type="file" accept="image/*" name="image" onchange="document.getElementById('image').src = window.URL.createObjectURL(this.files[0])" class="form-control" required>
                                                </div>
                                            </div>

                                            <div class="col-lg-1 mt-2 align-self-center">
                                                <div class="align-self-center mt-3">
                                                    <img src="{{ asset($blog->image ?? 'assets/images/icons/upload.png') }}" id="image" class="table-img" >
                                                </div>
                                            </div>

                                            <div class="col-lg-12 mt-2">
                                                <label>{{__('Description')}}</label>
                                                <textarea name="descriptions" class="form-control" placeholder="{{ __('Enter Description') }}">{{ $blog->descriptions }}</textarea>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="button-group text-center mt-5">
                                                    <a href=""
                                                        class="theme-btn border-btn m-2">{{ __('Cancel') }}</a>
                                                    <button class="theme-btn m-2 submit-btn">{{ __('Update') }}</button>
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
