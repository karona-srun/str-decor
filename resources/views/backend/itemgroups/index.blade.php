@extends('layouts.master')

@section('title-page', __('app.item_group'))

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">{{ __('app.list_item_group') }}</h3>
                    <div class="card-tools">
                        {{-- <a href="{{ url('/import-product-category') }}" class="btn btn-sm btn-outline-primary"> <i class="fas fa-file-import"></i>
                            {{ __('app.btn_import_product')}}</a>
                        <a href="{{ url('/product-category-exportexcel') }}" class="btn btn-sm btn-outline-primary"> <i class=" fas fa-download"></i>
                            {{ __('app.btn_download') }}</a> --}}
                        @can('Item Group Create')
                            <a href="{{ url('item-group/create') }}" class="btn btn-primary"> <i class=" fas fa-plus"></i>
                                {{ __('app.btn_add') }}</a>
                        @endcan
                    </div>
                </div>
                <div class="card-body">
                    <table id="datatable" class="table table-bordered table-striped" width="100%">
                        <thead>
                            <tr>
                                <th>{{ __('app.table_no') }}</th>
                                <th>{{ __('app.code') }}</th>
                                <th>{{ __('app.label_name') }}</th>
                                <th>{{ __('app.table_action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($itemGroups as $i => $item)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $item->item_group_code }}</td>
                                    <td>{{ $item->item_group_name }}</td>
                                    <td>
                                        @can('Item Group Edit')
                                            <a href="{{ route('item-group.edit', $item->id) }}"
                                                class="btn btn-sm btn-warning"><i class="far fa-edit"></i></a>
                                        @endcan
                                        @can('Item Group Delete')
                                            <button type="button" class="btn btn-sm btn-danger deleteProductCategory" data-toggle="modal"
                                                data-target="#modal-default" data-id="{{ $item->id }}"><i
                                                    class="far fa-trash-alt"></i></button>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-default">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form class="formDelete" action="foo" method="post">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <div class="modal-header">
                        <h5 class="modal-title text-bold">ផ្ទៀងផ្ទាត់</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>{{ __('app.label_confirm_delete') }}</p>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-danger"
                            data-dismiss="modal"> <i class="far fa-window-close"></i> {{ __('app.btn_close') }}</button>
                        <button type="submit" class="btn btn-primary"> <i class="far fa-check-square"></i> {{ __('app.btn_delete') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(".deleteProductCategory").click(function() {
                var id = $(this).data("id");
                $('.formDelete').attr('action', 'item-group/' + id);
            });

        });
    </script>
@endsection
