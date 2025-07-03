 {{-- View modal --}}
 <div class="modal fade" id="coupon-modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 fw-bold">{{ __('Coupon View') }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="personal-info">
                    <div class="row mt-3">
                        <div class="col-md-5">
                            <p>{{ __('Name') }}</p>
                        </div>
                        <div class="col-md-7">: <span id="coupon_name"> </span></div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-5">
                            <p>{{ __('Code') }}</p>
                        </div>
                        <div class="col-md-7">: <span id="coupon_code"> </span></div>
                    </div>

                    <div class="row">
                        <div class="col-md-5">
                            <p>{{ __('Start Date') }}</p>
                        </div>
                        <div class="col-md-7">: <span id="coupon_start_date"> </span></div>
                    </div>

                    <div class="row">
                        <div class="col-md-5">
                            <p>{{ __('End Date') }}</p>
                        </div>
                        <div class="col-md-7">: <span id="coupon_end_date"> </span></div>
                    </div>

                    <div class="row">
                        <div class="col-md-5">
                            <p>{{ __('Amount/Percent') }}</p>
                        </div>
                        <div class="col-md-7">: <span id="coupon_discount_type"> </span> (<span id="coupon_discount_discount"></span>) </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <p>{{ __('Status') }}</p>
                        </div>
                        <div class="col-md-7">: <span id="coupon_status"> </span></div>
                    </div>

                    <div class="row">
                        <div class="col-md-5">
                            <p>{{ __('Description') }}</p>
                        </div>
                        <div class="col-md-7">: <span id="coupon_description"> </span></div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
