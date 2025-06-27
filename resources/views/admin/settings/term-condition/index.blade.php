@extends('layouts.master')

@section('title')
    {{__('Term & Condition Settings') }}
@endsection

@section('main_content')
    <div class="erp-table-section">
        <div class="container-fluid">
            <div class="cards">
                <div class="card-body">
            <div class="table-header">
                <h4>{{__('Term & Condition Settings')}}</h4>
            </div>
            <div class="order-form-section p-16">
                <form action="{{ route('admin.term-conditions.store') }}" method="post" enctype="multipart/form-data" class="ajaxform_instant_reload">
                    @csrf
                    <div class="add-suplier-modal-wrapper d-block">
                        <div class="row">
                            <div class="col-lg-12 mt-2">
                                <label>{{__('Term & Condition')}}</label>
                                <textarea name="description" class="form-control summernote">{{ $term_condition->value['description'] ?? '' }}</textarea>
                            </div>
                            @can('term-conditions-update')
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



