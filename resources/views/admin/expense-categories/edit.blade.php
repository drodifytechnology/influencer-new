<div class="modal fade" id="expense-category-edit-modal">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 fw-bold">{{ __('Edit Expense Category') }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="personal-info">
                    <form action="" method="post" enctype="multipart/form-data"
                        class="add-brand-form pt-0 ajaxform_instant_reload updateExpenseCategoryForm">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="mt-3 col-lg-6">
                                <label class="custom-top-label">{{ __('Name') }}</label>
                                <input type="text" name="name" id="expense_category_name"
                                    placeholder="{{ __('Enter Expense Category Name') }}" class="form-control" />
                            </div>
                            <div class="mt-3 col-lg-6">
                                <label class="custom-top-label">{{ __('Status') }}</label>
                                <div class="gpt-up-down-arrow position-relative">
                                    <select class="form-control form-selected" name="status"
                                        id="expense_category_status">
                                        <option value="">{{ __('Select A Status') }}</option>
                                        <option value="1">{{ __('Active') }}</option>
                                        <option value="0">{{ __('Deactive') }}</option>
                                    </select>
                                    <span></span>
                                </div>
                            </div>
                            <div class="mt-3 col-lg-12">
                                <label class="custom-top-label">{{ __('Description') }}</label>
                                <textarea name="description" id="expense_category_description" placeholder="{{ __('Enter Description') }}" cols="30"
                                    class="form-control"></textarea>
                            </div>
                        </div>

                        <div class="offcanvas-footer mt-3 d-flex justify-content-center">
                            <button type="button" data-bs-dismiss="modal"
                                class="cancel-btn btn btn-outline-danger px-4 me-3" data-bs-dismiss="offcanvas"
                                aria-label="Close">{{ __('Cancel') }}
                            </button>
                            <button class="submit-btn btn btn-primary text-white px-4"
                                type="submit">{{ __('Update') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
