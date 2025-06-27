@extends('layouts.master')

@section('main_content')
    <div class="erp-table-section">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
            @include('admin.users.buttons')
            <div class="tab-content order-summary-tab">
                <div class="tab-pane fade show active" id="add-new-user">
                    <div class="table-header">
                        <h4>{{__('Add')}} {{ ucfirst(request('users') ?? request('type')) }}</h4>
                    </div>
                    <div class="order-form-section custom p-16">
                        {{-- form start --}}
                        <form action="{{ route('admin.users.store') }}" method="post" enctype="multipart/form-data" class="ajaxform_instant_reload">
                            @csrf
                            <div class="add-suplier-modal-wrapper">
                                <div class="row">
                                    <div class="col-lg-6 mt-2">
                                        <label>{{__('Full Name')}}</label>
                                        <input type="text" name="name" required class="form-control" placeholder="{{ __('Enter Name') }}" >
                                    </div>
                                    <div class="col-lg-6 mt-2">
                                        <label>{{__('Phone')}}</label>
                                        <input type="text" name="phone" class="form-control" placeholder="{{ __('Enter Phone Number') }}" >
                                    </div>
                                    @if (request('admin') == 'admin')
                                    <div class="col-lg-6 mt-2">
                                        <label>{{__('Role')}}</label>
                                        <div class="gpt-up-down-arrow position-relative">
                                            <select name="role" required class="select-2 form-control w-100" >
                                                <option value=""> {{__('Select a role')}}</option>
                                                @foreach ($roles as $role)
                                                <option value="{{ $role->name }}" @selected(request('users') == $role->name)> {{ ucfirst($role->name) }} </option>
                                                @endforeach
                                            </select>
                                            <span></span>
                                        </div>
                                    </div>
                                    @else
                                        <input type="hidden" name="role" value="{{ request('users') }}">
                                    @endif
                                    <div class="col-lg-6 mt-2">
                                        <label>{{__('User Email')}}</label>
                                        <input type="text" name="email" required class="form-control" placeholder="{{ __('Enter Email Address') }}" >
                                    </div>
                                    <div class="col-lg-6 mt-2">
                                        <label>{{__('Password')}}</label>
                                        <input type="password" name="password" required class="form-control" placeholder="{{ __('Enter Password') }}">
                                    </div>
                                    <div class="col-lg-6 mt-2">
                                        <label>{{__('Confirm password')}}</label>
                                        <input type="password" name="password_confirmation" required class="form-control" placeholder="{{ __('Enter Confirm password') }}">
                                    </div>

                                    <div class="offcanvas-footer mt-3 d-flex justify-content-center">
                                        <button type="reset" data-bs-dismiss="modal" class="cancel-btn btn btn-outline-danger" data-bs-dismiss="offcanvas"
                                            aria-label="Reset">{{ __('Cancel') }}
                                        </button>
                                        <button class="submit-btn btn btn-primary text-white ms-2" type="submit">{{ __('Save') }}</button>
                                    </div>
                            </div>
                        </form>
                        {{-- form end --}}
                    </div>
                </div>
            </div>
          </div>
         </div>
        </div>
    </div>
@endsection
