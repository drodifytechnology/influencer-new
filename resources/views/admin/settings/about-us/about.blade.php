@extends('layouts.master')

@section('title')
    {{__('About Us Settings') }}
@endsection

@section('main_content')
    <div class="erp-table-section">
        <div class="container-fluid">
            <div class="cards">
                <div class="card-body">
            <div class="table-header">
                <h4>{{__('About Us Settings')}}</h4>
            </div>
            <div class="order-form-section p-16">
                <form action="{{ route('admin.about-us.store') }}" method="post" enctype="multipart/form-data" class="ajaxform_instant_reload">
                    @csrf
                    <div class="add-suplier-modal-wrapper d-block">
                        <div class="row">
                           <div class="col-lg-12 mt-2">
                                <label>{{__('About Us')}}</label>
                                <textarea name="description" class="form-control summernote">
                                    {{ $about_us->value['description'] ?? '' }}
                                </textarea>
                            </div>
                            @can('about-us-update')
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



