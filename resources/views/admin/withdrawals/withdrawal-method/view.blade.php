<div class="modal fade" id="withdraw-method-view-modal">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 fw-bold">{{ __('View Details') }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="personal-info">
                    <div class="row mt-3">
                        <div class="col-md-4">
                            <p>{{ __('Payment Method') }}</p>
                        </div>
                        <div class="col-md-8">: <span id="payment_method"></span> </div>

                        <div class="col-md-4">
                            <p>{{ __('Currency') }}</p>
                        </div>
                        <div class="col-md-8">: <span id="method_currency"></span> </div>

                        <div class="col-md-4">
                            <p>{{ __('Minimum Amount') }}</p>
                        </div>
                        <div class="col-md-8">: <span id="method_min_amount"></span> </div>

                        <div class="col-md-4">
                            <p>{{ __('Maximum Amount') }}</p>
                        </div>
                        <div class="col-md-8">: <span id="method_max_amount"></span> </div>

                        <div class="col-md-4">
                            <p>{{ __('Charge') }}</p>
                        </div>
                        <div class="col-md-8">: <span id="method_charge"></span> </div>

                        <div class="col-md-4">
                            <p>{{ __('Status') }}</p>
                        </div>
                        <div class="col-md-8">: <span id="method_status"></span> </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
