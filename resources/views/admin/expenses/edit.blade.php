@extends('layouts.master')

@section('main_content')
    <div class="erp-table-section">
        <div class="container-fluid">
            <div class="cards">
                <div class="card-body">
                    <div class="table-header">
                        <h4>{{ __('Edit Expense') }}</h4>
                        <div>
                            <a href="{{ route('admin.expenses.index') }}" class="theme-btn print-btn text-light active">
                                <i class="fas fa-list me-1"></i>
                                {{__("Expenses List")}}
                            </a>
                        </div>
                    </div>

                    <div class="order-form-section p-16">
                        {{-- form start --}}
                        <form action="{{ route('admin.expenses.update', $expense->id) }}" method="post" enctype="multipart/form-data"
                            class="ajaxform_instant_reload">
                            @csrf
                            @method('put')
                            <div class="add-suplier-modal-wrapper">
                                <div class="row">
                                    <div class="col-lg-6 mt-2">
                                        <label>{{ __('Expense Category') }}</label>
                                        <div class="gpt-up-down-arrow position-relative">
                                            <select class="form-control form-select" id="category_id" name="category_id"
                                                required>
                                                <option value="">{{ __('Select a one') }}</option>
                                                @foreach ($expense_categories as $expense_category)
                                                    <option @selected($expense->category_id == $expense_category->id) value="{{ $expense_category->id }}">{{ $expense_category->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <span></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mt-2">
                                        <label>{{ __('Amount') }}</label>
                                        <input type="number" value="{{ $expense->amount }}" name="amount" id="amount" required class="form-control"
                                            placeholder="{{ __('Enter Amount') }}">
                                    </div>
                                    <div class="col-lg-6 mt-2">
                                        <label>{{ __('Payment Type') }}</label>
                                        <div class="gpt-up-down-arrow position-relative">
                                            <select class="form-control form-select" id="type_id"
                                                name="type_id" required>
                                                <option value="">{{ __('Select a one') }}</option>
                                                @foreach ($payment_types as $payment_type)
                                                    <option @selected($expense->type_id == $payment_type->id) value="{{ $payment_type['id'] }}">{{ $payment_type->value['name'] }}</option>
                                                @endforeach
                                            </select>
                                            <span></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mt-2">
                                        <label>{{ __('Pay To') }}</label>
                                        <div class="gpt-up-down-arrow position-relative">
                                            <select class="form-control form-select" id=""
                                                name="paid_to" required>
                                                <option value="">{{ __('Select a one') }}</option>
                                                @foreach ($users as $user)
                                                    <option @selected($expense->paid_to == $user->id) value="{{ $user->id }}">{{ $user->name }}</option>
                                                @endforeach
                                            </select>
                                            <span></span>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 mt-2">
                                        <label>{{ __('Date') }}</label>
                                        <input type="date" value="{{ $expense->date }}" name="date" id="date" required class="form-control"
                                            placeholder="{{ __('Select Date') }}">
                                    </div>

                                    <div class="col-lg-6 mt-2">
                                        <label>{{ __('Note') }}</label>
                                        <textarea name="notes" id="" class="form-control" placeholder="{{ __('Enter notes') }}">{{ $expense->notes }}</textarea>
                                    </div>


                                    <div class="offcanvas-footer mt-3 d-flex justify-content-center">
                                        <button type="reset" data-bs-dismiss="modal" class="cancel-btn btn btn-outline-danger" data-bs-dismiss="offcanvas"
                                            aria-label="Reset">{{ __('Cancel') }}
                                        </button>
                                        <button class="submit-btn btn btn-primary text-white ms-2" type="submit">{{ __('Save') }}</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('assets/js/custom/custom.js') }}"></script>
@endpush
