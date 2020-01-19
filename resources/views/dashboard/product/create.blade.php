@extends('layouts.main')


@section('content')

<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header with-border">
            <h3 class="card-title">@lang('site.createproduct')</h3>
        </div>

        <!-- /.card-header -->
        <div class="card-body">

            <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('post') }}
                @include('partials._errors')
                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>@lang('site.categories')</label>
                            <select name="category_id" class="form-control">
                                <option value="">@lang('site.categories')</option>
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id') == $category->id ? 'selected' : ''}}>{{
                                    $category->category_name }} {{
                                    $category->brand_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>@lang('site.codebar')</label>
                            <input type="text" name="codebar" id="" class="form-control" value="{{ $barcode_number }}">
                        </div>
                        <div class="form-group">
                            <label>@lang('site.productname')</label>
                            <input type="text" name="product_name" id="" class="form-control"
                                value="{{ old('product_name') }}">
                        </div>
                        <div class="form-group">
                            <label>@lang('site.description')</label>
                            <textarea type="text" name="description" id="" class="form-control"
                                value="{{ old('description') }}"></textarea>
                        </div>
                        <div class="form-group">
                            <label>@lang('site.purchaseprice')</label>
                            <input type="number" name="purchase_price" id="" class="form-control"
                                value="{{ old('purchase_price') }}">
                        </div>
                        <div class="form-group">
                            <label>@lang('site.saleprice')</label>
                            <input type="number" name="sale_price" id="" class="form-control"
                                value="{{ old('sale_price') }}">
                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>@lang('site.stock')</label>
                            <input type="number" name="stock" id="" class="form-control" value="{{ old('stock') }}">
                        </div>
                        <div class="form-group">
                            <label>@lang('site.minstock')</label>
                            <input type="number" name="min_stock" id="" class="form-control" value="1">
                        </div>
                        <div class="form-group">
                            <div class="custom-file">
                                <input type="file" name="image" class="form-control image custom-file-input"
                                    id="customFile">
                                <label class="custom-file-label" for="customFile">@lang('site.choosephoto')</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <img src="{{ asset('uploads/product_images/product.png') }}" style="width:200px;"
                                class="img-circle img-thumbnail img-preview" alt="" srcset="">
                        </div>
                    </div>
                </div>
                <div class="modal-footer form-group">
                    <button type="submit" class="btn btn-success" href="{{ route('product.store') }}"><i
                            class="fas fa-user-plus"></i>
                        @lang('site.createproduct')</button>
                </div>
            </form>

        </div>
        <!-- /.card-body -->

    </div>
</div>


@stop
