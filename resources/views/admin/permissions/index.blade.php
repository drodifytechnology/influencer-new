@extends('layouts.master')

@section('title')
    {{ __('Assigned Role') }}
@endsection

@section('main_content')
    <div class="erp-table-section">
        <div class="container-fluid">
            <div class="cards">
            <div class="table-header">
                <h4>{{__('Assigned Role')}}</h4>
            </div>
            <div class="row justify-content-center mt-4">
                <div class="col-md-6">
                    <div class="card shadow border-0">
                        <div class="card-body">
                            <div class="text-center mb-3">
                                <h3>{{ __("Assign Role To User") }}</h3>
                            </div>

                            <form action="{{ route('admin.permissions.store') }}" method="post" class="row ajaxform_instant_reload add-brand-form">
                                @csrf

                                <div class="col-12 form-group mb-3">
                                    <label for="user" class="required custom-top-label">{{ __("User") }}</label>
                                    <div class="gpt-up-down-arrow position-relative">
                                    <select name="user" id="user" class="form-control" required>
                                        <option>-{{ __('Select User') }}-</option>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}">{{ ucfirst($user->name) }}</option>
                                        @endforeach
                                    </select>
                                    <span></span>
                                    </div>

                                </div>

                                <div class="col-12 form-group mb-3">
                                    <label for="role" class="required custom-top-label">{{ __("Role") }}</label>
                                    <div class="gpt-up-down-arrow position-relative">
                                    <select name="roles" id="role" class="form-control" required>
                                        <option>-{{ __('Select Role') }}-</option>
                                        @foreach($roles as $role)
                                            <option value="{{ $role->id }}">{{ ucfirst($role->name) }}</option>
                                        @endforeach
                                    </select>
                                    <span></span>
                                    </div>
                                </div>

                                <div class="col-12 text-center mt-4">
                                    <div class="offcanvas-footer mt-3">
                                        <button type="reset" class="reset-btn" data-bs-dismiss="offcanvas"
                                            aria-label="Reset"> <i class="fas fa-undo-alt"></i> {{ __('Reset') }}
                                        </button>
                                        <button class="submit-btn" type="submit"> <i class="fas fa-save"></i> {{ __('Save') }}</button>
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

