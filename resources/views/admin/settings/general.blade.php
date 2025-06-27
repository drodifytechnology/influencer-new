@extends('layouts.master')

@section('title')
    {{__('General Settings') }}
@endsection

@section('main_content')
    <div class="erp-table-section">
        <div class="container-fluid">
            <div class="cards">
                <div class="card-body">
            <div class="table-header">
                <h4>{{__('General Settings')}}</h4>
            </div>
            <div class="order-form-section p-16">
                <form action="{{ route('admin.settings.update', $general->id) }}" method="post" enctype="multipart/form-data" class="ajaxform_instant_reload">
                    @csrf
                    @method('put')
                    <div class="add-suplier-modal-wrapper d-block">
                        <div class="row">
                            <div class="col-lg-12 mt-2">
                                <label>{{__('Title')}}</label>
                                <input type="text" name="title" value="{{ $general->value['title'] ?? '' }}"  required class="form-control" placeholder="{{ __('Enter Title') }}">
                            </div>
                            <div class="col-lg-6 settings-image-upload">
                                <label class="title">{{__('Logo')}}</label>
                                <div class="upload-img-v2">
                                    <label class="upload-v4 settings-upload-v4">
                                        <div class="img-wrp">
                                            <img class="bg-secondary p-2" src="{{ asset($general->value['logo'] ?? 'assets/images/icons/upload-icon.svg') }}" alt="user" id="admin_logo">
                                        </div>
                                        <input type="file" name="logo" class="d-none" accept="image/*" onchange="document.getElementById('admin_logo').src = window.URL.createObjectURL(this.files[0])" class="form-control">
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-6 settings-image-upload">
                                <label class="title">{{__('Favicon')}}</label>
                                <div class="upload-img-v2">
                                    <label class="upload-v4 settings-upload-v4">
                                        <div class="img-wrp">
                                            <img c src="{{ asset($general->value['favicon'] ?? 'assets/images/icons/upload-icon.svg') }}" alt="user" id="favicon">
                                        </div>
                                        <input type="file" name="favicon" class="d-none" accept="image/*" onchange="document.getElementById('favicon').src = window.URL.createObjectURL(this.files[0])" class="form-control">
                                    </label>
                                </div>
                            </div>

                            <div class="col-lg-6 settings-image-upload">
                                <label class="title">{{__('Login Page Image')}}</label>
                                <div class="upload-img-v2">
                                    <label class="upload-v4 settings-upload-v4">
                                        <div class="img-wrp">
                                            <img src="{{ asset($general->value['login_page_image'] ?? 'assets/images/icons/upload-icon.svg') }}" alt="user" id="login_page_image">
                                        </div>
                                        <input type="file" name="login_page_image" class="d-none" accept="image/*" onchange="document.getElementById('login_page_image').src = window.URL.createObjectURL(this.files[0])" class="form-control">
                                    </label>
                                </div>
                            </div>

                            @can('settings-update')
                            <div class="col-lg-12">
                                <div class="text-center mt-5">
                                    <button type="submit" class="theme-btn m-2 submit-btn">{{__('Update')}}</button>
                                </div>
                            </div>
                            @endcan
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
        </div>
    </div>
@endsection


