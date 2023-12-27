@extends('layouts.master')

@section('title-page', __('app.create_department'))

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">{{ __('app.create_department') }}</h3>
                    <div class="card-tools">
                        @can('Position List')
                            <a href="{{ url('department') }}" class="btn btn-primary"> <i class=" fas fa-list"></i>
                                {{ __('app.label_list') }} </a>
                        @endcan
                    </div>
                </div>

                <div class="card-body">
                    <form id="quickForm" action="{{ url('department') }}" method="post">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label>{{ __('app.department_name') }} <small class="text-red">*</small></label>
                                <input type="text" name="department_name" class="form-control"
                                    placeholder="{{ __('app.label_required') }}{{ __('app.department_name') }}">
                                @if ($errors->has('department_name'))
                                    <div class="error text-danger text-sm mt-1">
                                        {{ $errors->first('department_name') }}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>{{ __('app.label_note') }}</label>
                                <input type="text" name="note" class="form-control"
                                    placeholder="{{ __('app.label_required') }}{{ __('app.label_note') }}">
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary"> <i class="far fa-save"></i>
                                    {{ __('app.btn_save') }}</button>
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
