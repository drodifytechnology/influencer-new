 {{-- View modal --}}
 <div class="modal fade" id="service-modal">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 fw-bold">{{ __('Service Details') }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="personal-info">
                    <div class="row mt-3">

                        <div class="row col-lg-8">
                            <div class="col-md-3">
                                <p>{{ __('Title') }}</p>
                            </div>
                            <div class="col-md-9">: <span id="influencer_service_title"></span></div>
                            <div class="col-md-3">
                                <p>{{ __('Category') }}</p>
                            </div>
                            <div class="col-md-9">: <span id="influencer_service_category"></span></div>
                            <div class="col-md-3">
                                <p>{{ __('Price') }}</p>
                            </div>
                            <div class="col-md-9">: <span id="influencer_service_price"></span></div>
                            <div class="col-md-3">
                                <p>{{ __('Discount') }}</p>
                            </div>
                            <div class="col-md-9">: <span id="influencer_service_discount"></span>%</div>
                            <div class="col-md-3">
                                <p>{{ __('Status') }}</p>
                            </div>
                            <div class="col-md-9">: <span id="influencer_service_status"></span></div>
                        </div>

                        <div class="col-lg-4">
                           <img class="avatar-style" id="influencer_service_image" src="" alt="">
                        </div>

                    </div>

                    <h5 class="fw-bold">{{ __('Services Package') }}</h5>
                    <div id="influencer-service-features-container">

                    </div>
                    <h5 class="fw-bold">{{ __('Description') }}</h5>
                    <div id="influencer_service_description">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
