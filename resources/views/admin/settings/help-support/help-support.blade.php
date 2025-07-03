@extends('layouts.master')

@section('title')
    {{__('Help & Support Settings') }}
@endsection

@section('main_content')
    <div class="erp-table-section">
        <div class="container-fluid">
         <div class="cards">
          <div class="card-body">
            <div class="table-header">
                <h4>{{__('Help Support')}}</h4>
            </div>
            <div class="order-form-section p-16">
                <form action="{{ route('admin.help-supports.store') }}" method="post" enctype="multipart/form-data" class="ajaxform_instant_reload">
                    @csrf
                    <div class="add-suplier-modal-wrapper d-block">
                        <div class="row">
                            <div class="mt-3 col-lg-6">
                                <label>{{ __('Email') }}</label>
                                <input type="email" value="{{ $help_support->value['email'] ?? '' }}" name="email" placeholder="{{ __('Enter email') }}" class="form-control" />
                            </div>
                            <div class="mt-3 col-lg-6">
                                <label class="custom-top-label">{{ __('Number') }}</label>
                                <input type="number" value="{{ $help_support->value['number'] ?? '' }}" name="number" placeholder="{{ __('Enter number') }}" class="form-control" />
                            </div>
                            @can('help-supports-update')
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

@push('js')
<script src="{{ asset('assets/js/summernote-lite.js') }}"></script>
<script>
    $(document).ready(function(){
        $('.summernote').summernote({
            height: 300,
        });
    });
</script>
@endpush



