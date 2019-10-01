@extends('layouts.pos')

@section('page')
Point Of Sale Page
@stop

@section('content')

<div class="col-md-7  col-sm-12 ">
    <div class="card card-primary card-outline scroll" style="height:80vh;">
        <div class="card-header">
            <h3 class="card-title">List Of Sales Products</h3>
        </div> <!-- /.card-body -->
        <div class="card-body" style="overflow-y:scroll;">
            <div class="row no-gutters">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Select Client </label>
                        <div class="row  no-gutters">
                            <div class="col-md-9">
                                <select class="form-control">
                                    <option>Anonymous</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <button class="btn btn btn-primary"><i class="fas fa-plus"> Add Client</i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Select Product </label>
                        <div class="row  no-gutters">
                            <div class="col-md-9">
                                <select class="form-control">
                                    <option>Anonymous</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <button class="btn btn btn-primary"><i class="fas fa-plus"> Add Product</i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 table-responsive">
                <form action="{{ route('sale.store') }}" method="post">

                    {{ csrf_field() }}
                    {{ method_field('post') }}

                    @include('partials._errors')
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Index</th>
                                <th>Product</th>
                                <th>Quntite</th>
                                <th>Price</th>
                                <th>Remove</th>
                            </tr>
                        </thead>

                        <tbody class="order-list">

                        </tbody>
                        <tfoot>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th>Total : </th>
                                <th><input type="number" name="total" class="form-control input-sm total-price"
                                        disabled min="0" value="0"></th>
                            </tr>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th>Discount : </th>
                                <th><input type="number" id="discount" name="discount" class="form-control input-sm discount"
                                        min="0" value="0"></th>
                            </tr>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th>Total Amount : </th>
                                <th><input type="number" id="total-amount" name="total_amount" class="form-control input-sm total-amount"
                                        disabled min="0" value="0"></th>
                            </tr>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th>Select Payment Status : </th>
                                <th>
                                    <div class="form-group">
                                        <select class="form-control" name="status">
                                            <option>paid</option>
                                            <option>notpaid</option>
                                            <option>dept</option>
                                        </select>
                                    </div>
                                </th>
                            </tr>

                        </tfoot>

                    </table>

                    <a href="{{ route('sale.store') }}" type="submit" class="btn btn-primary float-right"><i class="fa fa-plus"></i>
                        Add new
                        sale</a>
                </form>
            </div>


        </div><!-- /.card-body -->
    </div>
</div>
<div class="col-md-5 col-sm-12">
    <div class="card card-primary card-outline" style="height:80vh;">
        <div class="card-header">
            <h3 class="card-title">List Of Sales Products</h3>
        </div> <!-- /.card-body -->
        <div class="card-body" style="overflow-y:scroll;">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Select Category</label>
                        <select class="form-control">
                            <option>All Categories</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Select Brand</label>
                        <select class="form-control">
                            <option>All Brands</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="col-md-12 text-center">
                <div class="row">
                    <ul class="users-list clearfix">
                        @foreach ($products as $product)
                        <li>
                            <a href="" id="product-{{ $product->id }}" + data-name="{{ $product->product_name }}" +
                                data-id="{{ $product->id }}" + data-price="{{ $product->sale_price }}" class="btn btn-success btn-sm add-product-btn">
                                <img src="{{ $product -> image_path }}" style="width: 200px;" class="img-circle img-thumbnail"
                                    alt="">
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div><!-- /.card-body -->
    </div>
</div>





@stop
