

@extends('layouts.master')

@section('title-page', __('app.create_item_adjustment'))

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">{{ __('app.create_item_adjustment') }}</h3>
                    <div class="card-tools">
                        @can('Item List')
                        <a href="{{ url('/adjustment') }}" class="btn btn-primary"> <i class=" fas fa-list"></i>
                            {{ __('app.label_list') }} </a>
                        @endcan
                    </div>
                </div>

                <div class="card-body">
                    <form id="quickForm" action="{{ url('adjustment') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">

                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="text-center mb-2 container">
                                        <img id="blah" src="{{ asset('images/product_image.png') }}" width="150px"​
                                            height="150px" class="photo rounded-circle img-bordered" alt=""
                                            srcset="">
                                        <input type="file" name="photo" id="imgInp" accept="image/*"
                                            class="btn btn-sm btn-file mt-2 imgInp" style="display: none">
                                    </div>
                                </div>
                                <div class="col-sm-9">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>{{ __('app.item') }} <small class="text-red">*</small></label>
                                                <select name="item" id="item" class="item_name select2 form-control">
                                                    <option value=" ">{{__('app.table_choose')}}</option>
                                                    @foreach ($items as $i)
                                                        <option value="{{$i->id}}" data-photo="{{ url('items/'.$i->photo) }}" data-code="{{$i->item_code}}" data-color="{{$i->color_code}}" data-name="{{$i->item_name}}" >
                                                            {{$i->item_name}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('item'))
                                                    <div class="error text-danger text-sm mt-1">
                                                        {{ $errors->first('item') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>{{ __('app.code') }} <small class="text-red">*</small></label>
                                                <input type="text" name="item_code" class="code form-control"
                                                    placeholder="{{ __('app.label_required') }}{{ __('app.code') }}">
                                                @if ($errors->has('item_code'))
                                                    <div class="error text-danger text-sm mt-1">
                                                        {{ $errors->first('item_code') }}</div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>{{ __('app.label_color_code') }} <small class="text-red">*</small></label>
                                                <input type="text" name="color" class="color form-control"
                                                    placeholder="{{ __('app.label_required') }}{{ __('app.label_color_code') }}">
                                                @if ($errors->has('color'))
                                                    <div class="error text-danger text-sm mt-1">
                                                        {{ $errors->first('color') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label>{{ __('app.label_name') }} <small class="text-red">*</small></label>
                                                    <input type="text" name="item_name" class="name form-control"
                                                        placeholder="{{ __('app.label_required') }}{{ __('app.label_name') }}">
                                                    @if ($errors->has('item_name'))
                                                        <div class="error text-danger text-sm mt-1">
                                                            {{ $errors->first('item_name') }}</div>
                                                    @endif
                                                </div>
                                        </div>
                                        <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label>{{ __('app.label_qty') }} <small class="text-red">*</small></label>
                                                    <input type="text" name="qty" class="qty form-control"
                                                        placeholder="{{ __('app.label_required') }}{{ __('app.label_qty') }}">
                                                    @if ($errors->has('qty'))
                                                        <div class="error text-danger text-sm mt-1">
                                                            {{ $errors->first('qty') }}</div>
                                                    @endif
                                                </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>{{ __('app.label_item_status') }}</label>
                                                <select name="condition" id="status" class="select2s form-control">
                                                    <option value="0">{{ __('app.label_fix_item') }}</option>
                                                    <option value="1">{{ __('app.label_adjustment_item') }}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>{{ __('app.label_note') }}</label>
                                        <input type="text" name="remark" class="form-control"
                                            placeholder="{{ __('app.label_required') }}{{ __('app.label_note') }}">
                                    </div>
                                </div>
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
            $('.item_name').change(function(event) {
                var photo = $('option:selected', this).attr('data-photo');
                var code = $('option:selected', this).attr('data-code');
                var color = $('option:selected', this).attr('data-color');
                var name = $('option:selected', this).attr('data-name');
                console.log("You have Selected  :: " + $(this).val() + " option:selected attr :: " +
                    code);
                $('.code').val(code);
                $('.color').val(color);
                $('.name').val(name);
                $('.photo').attr('src', photo)
            });
        });
    </script>
@endsection
