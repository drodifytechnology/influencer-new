<div class="modal fade" id="expense-category-modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 fw-bold">{{ __('Expense Category View') }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="personal-info">
                    <div class="row">
                        <div class="col-md-5">
                            <p>{{ __('Name') }}</p>
                        </div>
                        <div class="col-md-7">: <span id="expenses_category_name"> </span></div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <p>{{ __('Description') }}</p>
                        </div>
                        <div class="col-md-7">: <span id="expenses_category_description"> </span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
