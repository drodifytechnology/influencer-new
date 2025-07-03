<div class="modal fade" id="client-send-email-modal">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">{{ __('Send email to client') }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="personal-info">
                    <form action="" method="post" enctype="multipart/form-data"
                        class="add-brand-form pt-0 ajaxform_instant_reload clientSendEmailForm">
                        @csrf
                        <div class="row">
                            <div class="mt-3">
                                <label class="custom-top-label">{{ __('Mail To') }}</label>
                               <input type="email" id="client_email" name="email" rows="2" class="form-control" placeholder="{{ __('Enter email') }}">
                            </div>
                            <div class="mt-3">
                                <label class="custom-top-label">{{ __('Subject') }}</label>
                               <input type="text" name="subject" rows="2" class="form-control" placeholder="{{ __('Enter subject') }}">
                            </div>
                            <div class="mt-3">
                                <label class="custom-top-label">{{ __('Body') }}</label>
                               <textarea name="message" rows="2" class="form-control summernote" placeholder="{{ __('Enter message') }}"></textarea>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-center mt-4 modal-custom-design">
                            <div class="button-group">
                                <button type="button" class="btn cancel-btn" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                                <button type="submit" class="btn save-btn submit-btn">{{ __('Send') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@push('js')
<script src="{{ asset('assets/js/summernote-lite.js') }}"></script>
<script>
    $(document).ready(function(){
        $('.summernote').summernote({
            height: 100,
        });
    });
</script>
@endpush
