@extends('layouts.master')

@section('title-page', __('app.product'))

@section('content')
    <div class="row">
        <div class="col-sm-12">
            @if (count($errors) > 0)
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <p><i class="icon fa fa-ban"></i> កុំហុស!</p>
                    @foreach ($errors->all() as $error)
                        {{ $error }} <br>
                    @endforeach
                </div>
            @endif

            @if (Session::has('status'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <p><i class="icon fa fa-info"></i> ជូនដំណឹង!</p>
                    <p>{!! Session::get('status') !!}</p>
                </div>
            @endif
        </div>
        <div class="col-md-6">

            <div class="mb-3">
                <p class="mb-2">
                    ជ្រើសរើសឯកសារ CSV ដែលបាននាំចូលប្រភេទផលិតផលរបស់អ្នក។
                </p>
                <form action="{{ url('import-product') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-2" style="max-width: 500px; margin: 0 auto;">
                        <div class="custom-file text-left">
                            <input type="file" name="file"
                                accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                        </div>
                    </div>
                    <button class="btn btn-primary"><i class="far fa-check-circle"></i>
                        {{ __('app.btn_accepted') }}</button>
                </form>
            </div>

            <span class="text-red">ទម្រង់ឯកសារ</span><br>
            <span>ចំណាំ៖ ទម្រង់ឯកសារ CSV ត្រូវតែបំបែកដោយសញ្ញា ',' ហើយបំពេញក្នុងខ្សែអក្សរទទេ (គ្មានចន្លោះ)</span>

            <table class="mt-2 table table-sm table-bordered table-hover">
                <tr>
                    <th>ឈ្មោះ</th>
                    <th>ជួរឈរ</th>
                </tr>
                <tr>
                    <th>Product Code</th>
                    <th>1</th>
                </tr>
                <tr>
                    <th>Color Code</th>
                    <th>2</th>
                </tr>
                <tr>
                    <th>Product Name</th>
                    <th>3</th>
                </tr>
                <tr>
                    <th>Scale</th>
                    <th>4</th>
                </tr>
                <tr>
                    <th>Buying Price</th>
                    <th>5</th>
                </tr>
                <tr>
                    <th>Salling Price</th>
                    <th>6</th>
                </tr>
                <tr>
                    <th>Buying Date <span class="text-red text-sm">[yyyy-mm-dd]</span></th>
                    <th>7</th>
                </tr>
                <tr>
                    <th>Store Stock</th>
                    <th>8</th>
                </tr>
                <tr>
                    <th>Warehouse</th>
                    <th>9</th>
                </tr>
                <tr>
                    <th>Sold Out</th>
                    <th>10</th>
                </tr>
                <tr>
                    <th>Description</th>
                    <th>11</th>
                </tr>
                <tr>
                    <th>Note</th>
                    <th>12</th>
                </tr>
            </table>
        </div>
        <div class="col-md-6">
            <table class="table table-sm table-bordered">
                <tr>
                    <th>ឈ្មោះ</th>
                </tr>
                @foreach (Storage::files('public/importproductfiles') as $item)
                    <tr>
                        <th>
                            <div class=" form-inline">
                            <a href="#" class="text-muted">
                                @foreach(explode('/',$item) as $i => $row)
                                   @if($i == 2) <li>{{ $row }}</li>@endif
                                @endforeach
                            </a>
                            <form action="{{ url('download-file') }}" method="get">
                                <input type="hidden" name="path" value="{{ urlencode($item) }}">
                                <button type="submit" class="btn btn-link ml-1"><i class="fas fa-file-download"></i></button>
                            </form>
                            <form action="{{ url('delete-file') }}" method="get">
                                <input type="hidden" name="path" value="{{ urlencode($item) }}">
                                    <button type="submit" class="btn btn-link"><i
                                        class="far fa-trash-alt text-red"></i></button>
                                </form>
                            </div>
                        </th>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>

@endsection

@section('js')
    <script type="text/javascript">
        $(function() {

        });
    </script>
@endsection
