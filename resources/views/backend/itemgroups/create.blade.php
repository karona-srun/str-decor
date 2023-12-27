
@extends('layouts.master')

@section('title-page', __('app.create_item_group'))

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">{{ __('app.create_item_group') }}</h3>
                    <div class="card-tools">
                        @can('Item Group List')
                        <a href="{{ url('/item-group') }}" class="btn btn-primary"> <i class=" fas fa-list"></i>
                            {{ __('app.label_list') }} </a>
                        @endcan
                    </div>
                </div>

                <div class="card-body">
                    <form id="quickForm" action="{{ url('item-group') }}" method="post">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>{{ __('app.code') }} <small class="text-red">*</small></label>
                                        <input type="text" name="code" class="form-control"
                                            placeholder="{{ __('app.label_required') }}{{ __('app.code') }}">
                                        @if ($errors->has('code'))
                                            <div class="error text-danger text-sm mt-1">
                                                {{ $errors->first('code') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>{{ __('app.label_name') }} <small class="text-red">*</small></label>
                                        <input type="text" name="name" class="form-control"
                                            placeholder="{{ __('app.label_required') }}{{ __('app.label_name') }}">
                                        @if ($errors->has('name'))
                                            <div class="error text-danger text-sm mt-1">
                                                {{ $errors->first('name') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>{{ __('app.label_note') }}</label>
                                <input type="text" name="remark" class="form-control"
                                    placeholder="{{ __('app.label_required') }}{{ __('app.label_note') }}">
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary"><i class="far fa-save"></i> {{ __('app.btn_save') }}</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        $(function() {
            
        });
    </script>
@endsection
