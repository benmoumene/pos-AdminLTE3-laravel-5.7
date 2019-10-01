@extends('layouts.main')

@section('page')
Create Products
@stop

@section('content')

<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header with-border">
            <h3 class="card-title">Create a new Product</h3>
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
                            <label>Categories</label>
                            <select name="category_id" class="form-control">
                                <option value="">All Categorie</option>
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id') == $category->id ? 'selected' : ''}}>{{
                                    $category->category_name }} {{
                                    $category->brand_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">

                            <label>Codebar</label>
                            <div class="row">
                                <div class="col-md-8">
                                    <input type="text" name="codebar" id="bar" class="form-control bar" value="{{ old('codebar') }}">
                                </div>
                                <div class="col-md-4">
                                    <button type="button" id="button_barcode" class="btn btn-primary float-right">Generate
                                        a codebar</button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Product name</label>
                            <input type="text" name="product_name" id="" class="form-control" value="{{ old('product_name') }}">
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea type="text" name="description" id="" class="form-control" value="{{ old('description') }}"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Purchase Price</label>
                            <input type="number" name="purchase_price" id="" class="form-control" value="{{ old('purchase_price') }}">
                        </div>
                        <div class="form-group">
                            <label>Sale Price</label>
                            <input type="number" name="sale_price" id="" class="form-control" value="{{ old('sale_price') }}">
                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Stock</label>
                            <input type="number" name="stock" id="" class="form-control" value="{{ old('stock') }}">
                        </div>
                        <div class="form-group">
                            <label>Min on Stock</label>
                            <input type="number" name="min_stock" id="" class="form-control" value="{{ old('min_stock') }}">
                        </div>
                        <div class="form-group">
                            <div class="custom-file">
                                <input type="file" name="image" class="form-control image custom-file-input" id="customFile">
                                <label class="custom-file-label" for="customFile">Choose product Photo</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <img src="{{ asset('uploads/product_images/product.png') }}" style="width:200px;" class="img-circle img-thumbnail img-preview"
                                alt="" srcset="">
                        </div>
                    </div>
                </div>
                <div class="modal-footer form-group">
                    <button type="submit" class="btn btn-success" href="{{ route('product.store') }}"><i class="fas fa-user-plus"></i>
                        Add new product</button>
                </div>
            </form>

        </div>
        <!-- /.card-body -->

    </div>
</div>


@stop
