


@extends('layouts.master')

@section('title-page', __('app.edit_item'))

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">{{ __('app.edit_item') }}</h3>
                    <div class="card-tools">
                        @can('Item List')
                        <a href="{{ url('/itemes') }}" class="btn btn-primary"> <i class=" fas fa-list"></i>
                            {{ __('app.label_list') }} </a>
                        @endcan
                    </div>
                </div>

                <div class="card-body">
                    <form id="quickForm" action="{{ url('itemes', $item->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="text-center mb-2 container">
                                        <img id="blah" src="{{ asset( $item->photo == "" ? 'images/product_image.png' : url('items/',$item->photo)) }}" width="150px"​
                                            height="150px" class="rounded-circle img-bordered" alt=""
                                            srcset="">
                                        <input type="file" name="photo" id="imgInp" accept="image/*"
                                            class="btn btn-sm btn-file mt-2 imgInp" style="display: none">
                                        @if ($errors->has('photo'))
                                            <div class="error text-danger text-sm mt-1">
                                                {{ $errors->first('photo') }}</div>
                                        @endif
                                        <button type="button"
                                            class="btn btn-sm btn-outline-primary mt-2 blah">{{ __('app.btn_browser') }}</button>
                                    </div>
                                </div>
                                <div class="col-sm-9">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>{{ __('app.item_group') }} <small class="text-red">*</small></label>
                                        <select name="item_group" id="item_group" class="select2 form-control">
                                            <option value="">{{__('app.table_choose')}}</option>
                                            @foreach ($itemGroups as $g)
                                                <option value="{{$g->id}}" {{ $g->id == $item->item_group_id ? 'selected' : '' }}>{{$g->item_group_name}}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('item_group'))
                                            <div class="error text-danger text-sm mt-1">
                                                {{ $errors->first('item_group') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>{{ __('app.item_sub_group') }} <small class="text-red">*</small></label>
                                        <select name="item_sub_group" id="item_sub_group" class="select2 form-control">
                                            <option value="">{{__('app.table_choose')}}</option>
                                            @foreach ($itemSubGroups as $isg)
                                                <option value="{{$isg->id}}" {{ $isg->id == $item->item_sub_group_id ? 'selected' : '' }}>{{$isg->item_sub_group_name}}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('item_group'))
                                            <div class="error text-danger text-sm mt-1">
                                                {{ $errors->first('item_group') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>{{ __('app.code') }} <small class="text-red">*</small></label>
                                        <input type="text" name="item_code" class="form-control"
                                            placeholder="{{ __('app.label_required') }}{{ __('app.code') }}" value="{{ $item->item_code }}">
                                        @if ($errors->has('item_code'))
                                            <div class="error text-danger text-sm mt-1">
                                                {{ $errors->first('item_code') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>{{ __('app.label_color_code') }} <small class="text-red">*</small></label>
                                            <input type="text" name="color" class="form-control"
                                                placeholder="{{ __('app.label_required') }}{{ __('app.label_color_code') }}" value="{{ $item->color_code }}">
                                            @if ($errors->has('color'))
                                                <div class="error text-danger text-sm mt-1">
                                                    {{ $errors->first('color') }}</div>
                                            @endif
                                        </div>
                                </div>
                                <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>{{ __('app.label_name') }} <small class="text-red">*</small></label>
                                            <input type="text" name="item_name" class="form-control"
                                                placeholder="{{ __('app.label_required') }}{{ __('app.label_name') }}" value="{{ $item->item_name }}">
                                            @if ($errors->has('item_name'))
                                                <div class="error text-danger text-sm mt-1">
                                                    {{ $errors->first('item_name') }}</div>
                                            @endif
                                        </div>
                                </div>
                                <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>{{ __('app.label_scale') }} <small class="text-red">*</small></label>
                                            <input type="text" name="scale" class="form-control"
                                                placeholder="{{ __('app.label_required') }}{{ __('app.label_scale') }}" value="{{ $item->scale }}">
                                            @if ($errors->has('scale'))
                                                <div class="error text-danger text-sm mt-1">
                                                    {{ $errors->first('scale') }}</div>
                                            @endif
                                        </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>{{ __('app.label_buying_price') }}</label>
                                        <input type="number" step="any" name="buying_price" class="form-control" value="{{ $item->buying_price }}">
                                        @if ($errors->has('buying_price'))
                                                <div class="error text-danger text-sm mt-1">
                                                    {{ $errors->first('buying_price') }}</div>
                                            @endif
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>{{ __('app.label_buying_date') }}</label>
                                        <input type="date" name="buying_date" class="form-control" value="{{ Carbon\Carbon::parse($item->buying_date)->format('Y-m-d') }}">
                                        @if ($errors->has('buying_date'))
                                                <div class="error text-danger text-sm mt-1">
                                                    {{ $errors->first('buying_date') }}</div>
                                            @endif
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>{{ __('app.label_qty') }}</label>
                                        <input type="number" name="qty" class="form-control" value="{{ $item->qty }}">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>{{ __('app.label_item_status') }}</label>
                                        <select name="condition" id="status" class="select2s form-control">
                                            <option value="0" {{ $item->condition == 0 ? 'selected' : '' }}>{{ __('app.label_old_item') }}</option>
                                            <option value="1" {{ $item->condition == 1 ? 'selected' : '' }}>{{ __('app.label_new_item') }}</option>
                                            <option value="2" {{ $item->condition == 2 ? 'selected' : '' }}>{{ __('app.label_second_hand_item') }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>{{ __('app.label_note') }}</label>
                                <input type="text" name="remark" class="form-control"
                                    placeholder="{{ __('app.label_required') }}{{ __('app.label_note') }}" value="{{ $item->remark }}">
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
            imgInp.onchange = evt => {
                const [file] = imgInp.files
                if (file) {
                    blah.src = URL.createObjectURL(file)
                }
            }

            $('.blah').on('click', function() {
                $('.imgInp').trigger('click');
            });
        });
    </script>
@endsection
