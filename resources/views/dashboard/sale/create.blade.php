@extends('layouts.pos')

@section('page')
Point Of Sale Page
@stop

@section('content')

<div class="col-md-7  col-sm-12">
    <div class="card card-primary card-outline" style="height:80vh;">
        <div class="card-header">
            <h3 class="card-title">List Of Sales Products</h3>

        </div> <!-- /.card-body -->
        <div class="card-body" style="overflow-y:scroll;">
            <form action="{{ route('sale.store') }}" method="post">

                {{ csrf_field() }}
                {{ method_field('post') }}

                @include('partials._errors')
                <div class="row">
                    <div class="col-md-6">
                        <div id="client" class="form-group">
                            <label for="">Select Client</label>
                            <div class="row">
                                <div class="col-md-8">
                                    <select name="client_id" class="form-control">
                                        @foreach ($clients as $client)
                                        <option value="{{ $client->id }}"
                                            {{ old('category_id') == $client->id ? 'selected' : ''}}>{{
                                    $client->client_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">

                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target=".bd-example-modal-lg-client"><i class="fas fa-plus"> Add
                                            Client</i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label> Referance Sale Numder : </label>
                            <input type="text" name="number_sale" class="form-control text-center" readonly
                                value="{{ $sale_number }}">
                        </div>
                    </div>
                </div>
                <div class="col-md-12 table-responsive">

                    <table id="sale" class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Quntite</th>
                                <th>Price</th>
                                <th style="width: 25px;">Remove</th>
                            </tr>
                        </thead>

                        <tbody class="order-list">

                        </tbody>
                        <tfoot>

                        </tfoot>

                    </table>
                    <div class="row">
                        <div class="col-md-6 offset-md-4">
                            <div class="form-group row">
                                <label class="col-sm-6 col-form-label">Total : </label>
                                <input type="number" name="total" class="form-control  col-sm-6 total-price" min="0"
                                    readonly value="0">
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-6 col-form-label">Discount : </label>
                                <input type="number" id="discount" name="discount"
                                    class="form-control col-sm-6 discount" min="0" value="0">
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-6 col-form-label">Total Amount : </label>
                                <input type="number" id="total-amount" name="total_amount"
                                    class="form-control col-sm-6 total-amount" readonly min="0" value="0">
                            </div>
                            <div>
                                <div class="form-group row">
                                    <label class="col-sm-6 col-form-label">Payment Method : </label>
                                    <select id="select" class="form-control col-sm-6" name="status">
                                        <option value="paid">paid</option>
                                        <option value="nopaid">nopaid</option>
                                        <option value="debt">debt</option>
                                    </select>
                                </div>
                            </div>
                            <div>
                                <div class="form-group row">
                                    <label class="col-sm-6 col-form-label">Paid : </label>
                                    <input id="paid" type="number" name="paid" class="form-control col-sm-6 paid"
                                        value="0"></input>
                                </div>
                            </div>
                            <div>
                                <div class="form-group row">
                                    <label class="col-sm-6 col-form-label">Due(credit) : </label>
                                    <input id="credit" type="number" name="credit" class="form-control col-sm-6 credit"
                                        readonly value="0"></input>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer form-group">
                        <button type="submit" class="btn btn-success" href="{{ route('sale.store') }}"><i
                                class="fas fa-user-plus"></i>
                            Add new sale</button>
                    </div>
                </div>
            </form>
            <div class="modal fade bd-example-modal-lg-client" tabindex="-1" role="dialog"
                aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Create
                                new Client</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="new_client" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{ method_field('post') }}
                            @include('partials._errors')
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Client name</label>
                                            <input type="text" name="client_name" id="client_name" class="form-control"
                                                value="">
                                        </div>
                                        <div class="form-group">
                                            <label>phone</label>
                                            <input type="text" name="phone" id="phone" class="form-control" value="">
                                        </div>
                                        <div class="form-group">
                                            <label>Address</label>
                                            <textarea type="text" name="address" id="address"
                                                class="form-control"></textarea>

                                        </div>
                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea type="text" name="description" id="description"
                                                class="form-control"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /.card-body -->
</div>
<div class="col-md-5 col-sm-12">
    <div class="card card-primary card-outline" style="height:80vh;">
        <div class="card-header">
            <h3 class="card-title">List Of Sales Products</h3>
        </div> <!-- /.card-body -->
        <div class="card-body" style="overflow-y:scroll;">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">add product to sale with barcode</label>
                        <input id="addbarcode" class="form-control" type="text" name="addbarcode"
                            placeholder="Scan Barcode" autocomplete="off">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Search for Product by name or category</label>
                        <input id="searchsale" class="form-control" type="text" name="product"
                            placeholder="Search For Product" autocomplete="off">
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                @if ($products->count() > 0)
                <div id="pds" class="row text-center text-lg-left containerItems">

                    @foreach ($products as $product)

                    <div class="col-lg-3 col-md-4 col-6">
                        <a href="" data-toggle="tooltip" title="Price : {{ $product->sale_price }}" data-placement="top"
                            id="product-{{ $product->id }}" + data-name="{{ $product->product_name }}" +
                            data-id="{{ $product->id }}" + data-price="{{ $product->sale_price }}" +
                            data-stock="{{ $product->stock }}" class="con d-block mb-4
                                add-product-btn">
                            <img class="img-fluid img-product" src="{{ $product -> image_path }}" alt="">
                            <span class="mbr-gallery-title">{{ $product->product_name }}</span>
                        </a>

                    </div>
                    @endforeach

                </div>
                @else
                <div class="lam">
                    <div class="centered">
                        <h5>There is no product for sale</h5>
                    </div>
                </div>


                @endif
            </div>
        </div><!-- /.card-body -->
    </div>
</div>


@endsection

@section('script')
<script type="text/javascript">
    $(document).ready(function () {
        // add new client in sale page
        $('#new_client').on('submit', function (e) {
            e.preventDefault();
            var formData = new FormData($(this)[0]);
            $.ajax({
                type: "POST",
                url: "/newclient",
                data: formData,
                contentType: false,
                processData: false,
                success: function (reponse) {
                    console.log(reponse)
                    $('.bd-example-modal-lg-client').modal('hide')
                    $("#client").load(" #client");

                },
                error: function (error) {
                    const errors = error.responseJSON.errors
                    const firstitem = Object.keys(errors)[0]
                    const firstitemDOM = document.getElementById(firstitem)
                    const firstErrorMessage = errors[firstitem][0]
                    firstitemDOM.scrollIntoView({})

                    const errorMessages = document.querySelectorAll('.text-danger')
                    errorMessages.forEach((element) => element.textContent = '')

                    firstitemDOM.insertAdjacentHTML('afterend',
                        `<div class="text-danger">${firstErrorMessage}</div>`)

                    const formControls = document.querySelectorAll('.form-control')
                    formControls.forEach((element) => element.classList.remove('border',
                        'border-danger'))

                    firstitemDOM.classList.add('border', 'border-danger')
                }
            });
        });
        // Search for product to sale by product name
        let old_content = $('#pds').html();
        $("#searchsale").keyup(function () {
            var pro = $("#searchsale").val();
            if (pro != '') {
                $.ajax({
                    type: "GET",
                    url: "/searchsale",
                    data: 'pro=' + pro,
                    dataType: 'json',
                    success: function (data) {
                        $('#pds').html(data.row_result);
                        console.log(data)

                    }
                });
            } else {
                $('#pds').html(old_content);
            }
        });

        // Add product to sale by barcode
        $("#addbarcode").keypress(function () {
            var code = $("#addbarcode").val();
            if (code.length == 13) {
                $.ajax({
                    type: "GET",
                    url: "/addproduct",
                    data: 'code=' + code,
                    dataType: 'json',
                    success: function (data) {
                        $('.order-list').append(data.addproduct);
                        $("#addbarcode").val("");
                        calculateTotal();
                        calculateTotalAmount();
                        console.log(data.addproduct)

                    }
                });
            }
        });




    });

</script>


@endsection
