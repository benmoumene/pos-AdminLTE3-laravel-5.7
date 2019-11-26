@extends('layouts.pos')


@section('content')

<div class="col-md-5">
    <div class="card card-primary card-outline" style="height:80vh;">
        <div class="card-header">
            <h3 class="card-title">@lang('site.productssale')</h3>

        </div> <!-- /.card-body -->
        <div class="card-body" style="overflow-y:scroll;">
            <form action="{{ route('sale.store') }}" method="post">

                {{ csrf_field() }}
                {{ method_field('post') }}

                @include('partials._errors')
                <div class="row">
                    <div class="col-md-6">
                        <div id="client" class="form-group">
                            <label for="">@lang('site.selectclient')</label>
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

                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                        data-target=".bd-example-modal-lg-client">@lang('site.addclient')</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>@lang('site.numbersale') : </label>
                            <input type="text" name="number_sale" class="form-control text-center" readonly
                                value="{{ $sale_number }}">
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <table id="sale" class="table table-sm table-bordered">
                        <thead>
                            <tr>
                                <th>@lang('site.productname')</th>
                                <th>@lang('site.quantitysale')</th>
                                <th>@lang('site.saleprice')</th>
                                <th style="width: 25px;">@lang('site.delete')</th>
                            </tr>
                        </thead>

                        <tbody class="order-list">

                        </tbody>
                        <tfoot>

                        </tfoot>

                    </table>
                    <div class="row">
                        <div class="col-md-5 offset-md-6">
                            <div class="form-group row">
                                <label class="col-sm-6 col-form-label">@lang('site.total') : </label>
                                <input type="number" name="total" class="form-control  col-sm-6 total-price" min="0"
                                    readonly value="0">
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-6 col-form-label">@lang('site.discount') : </label>
                                <input type="number" id="discount" name="discount"
                                    class="form-control col-sm-6 discount" min="0" value="0">
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-6 col-form-label">@lang('site.totalamount') : </label>
                                <input type="number" id="total-amount" name="total_amount"
                                    class="form-control col-sm-6 total-amount" readonly min="0" value="0">
                            </div>
                            <div>
                                <div class="form-group row">
                                    <label class="col-sm-6 col-form-label">@lang('site.paymenttype') : </label>
                                    <select id="select" class="form-control col-sm-6" name="status">
                                        <option value="paid">@lang('site.paid')</option>
                                        <option value="nopaid">@lang('site.nopaid')</option>
                                        <option value="debt">@lang('site.due')</option>
                                    </select>
                                </div>
                            </div>
                            <div>
                                <div class="form-group row">
                                    <label class="col-sm-6 col-form-label">@lang('site.paid') : </label>
                                    <input id="paid" type="number" name="paid" class="form-control col-sm-6 paid"
                                        value="0"></input>
                                </div>
                            </div>
                            <div>
                                <div class="form-group row">
                                    <label class="col-sm-6 col-form-label">@lang('site.due') : </label>
                                    <input id="credit" type="number" name="credit" class="form-control col-sm-6 credit"
                                        readonly value="0"></input>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer form-group">
                        <button type="submit" class="btn btn-success" href="{{ route('sale.store') }}"><i
                                class="fas fa-user-plus"></i>
                            @lang('site.save')</button>
                    </div>
                </div>
            </form>
            <div class="modal fade bd-example-modal-lg-client" tabindex="-1" role="dialog"
                aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">@lang('site.createclient')</h5>
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
                                            <label>@lang('site.clientname')</label>
                                            <input type="text" name="client_name" id="client_name" class="form-control"
                                                value="">
                                        </div>
                                        <div class="form-group">
                                            <label>@lang('site.phone')</label>
                                            <input type="text" name="phone" id="phone" class="form-control" value="">
                                        </div>
                                        <div class="form-group">
                                            <label>@lang('site.address')</label>
                                            <textarea type="text" name="address" id="address"
                                                class="form-control"></textarea>

                                        </div>
                                        <div class="form-group">
                                            <label>@lang('site.description')</label>
                                            <textarea type="text" name="description" id="description"
                                                class="form-control"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    data-dismiss="modal">@lang('site.close')</button>
                                <button type="submit" class="btn btn-primary">@lang('site.save')</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /.card-body -->
</div>
<div class="col-md-7">
    <div class="card card-primary card-outline" style="height:80vh;">
        <div class="card-header">
            <h3 class="card-title">@lang('site.allproduct')</h3>
        </div> <!-- /.card-body -->
        <div class="card-body" style="overflow-y:scroll;">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">@lang('site.addproducttosalewithbarcode')</label>
                        <input id="addbarcode" class="form-control" type="text" name="addbarcode"
                            placeholder="@lang('site.scanbarcode')" autocomplete="off">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">@lang('site.searchforproductbynameorcategory')</label>
                        <input id="searchsale" class="form-control" type="text" name="product"
                            placeholder="@lang('site.searchforproduct')" autocomplete="off">
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
                        <h5>@lang('site.thereisnoproductforsale')</h5>
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
