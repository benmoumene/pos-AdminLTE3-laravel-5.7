@extends('layouts.main')

@section('page')
List Of Sales
@stop

@section('content')

@include('sweet::alert')
<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header with-border">

            <form action="{{ route('sale.index') }}" method="get">

                <div class="row no-gutters">
                    <div class="col-12 col-sm-6 col-md-8">
                        <h3 class="card-title">List Sales</h3>
                    </div>
                    <div class="col-6 col-md-4">
                        @if (auth()->user()->hasPermission('create_sales'))
                        <a type="" class="btn btn-success btn float-right" style="" href="{{ route('sale.create') }}"><i
                                class="fas fa-user-plus"></i>
                            Make new Sale</a>
                        @else
                        <a type="" class="btn btn-success disabled btn float-right" href="#"><i
                                class="fas fa-user-plus"></i>
                            Make new Sale
                        </a>
                        @endif
                    </div>
                </div>
            </form>
        </div>

        <!-- /.card-header -->
        <div class="card-body">
            <div id="category_table_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <div class="row">
                    <div class="col-sm-12">
                        <table id="category_table" class="table table-bordered table-striped table-hover  dataTable"
                            role="grid" aria-describedby="category_table_info">
                            <thead>
                                <tr role="row">
                                    <th class="sorting_asc" tabindex="0" aria-controls="category_table" rowspan="1"
                                        colspan="1" aria-sort="ascending"
                                        aria-label="Rendering engine: activate to sort column descending"
                                        style="width: 283px;">No</th>
                                    <th class="sorting" tabindex="0" aria-controls="category_table" rowspan="1"
                                        colspan="1" aria-label="Browser: activate to sort column ascending"
                                        style="width: 359px;">Number Sale</th>
                                    <th class="sorting" tabindex="0" aria-controls="category_table" rowspan="1"
                                        colspan="1" aria-label="Platform(s): activate to sort column ascending"
                                        style="width: 320px;">Total</th>
                                    <th class="sorting" tabindex="0" aria-controls="category_table" rowspan="1"
                                        colspan="1" aria-label="Platform(s): activate to sort column ascending"
                                        style="width: 320px;">Discount</th>
                                    <th class="sorting" tabindex="0" aria-controls="category_table" rowspan="1"
                                        colspan="1" aria-label="Platform(s): activate to sort column ascending"
                                        style="width: 320px;">Total Amount</th>
                                    <th class="sorting" tabindex="0" aria-controls="category_table" rowspan="1"
                                        colspan="1" aria-label="Platform(s): activate to sort column ascending"
                                        style="width: 320px;">Paid</th>
                                    <th class="sorting" tabindex="0" aria-controls="category_table" rowspan="1"
                                        colspan="1" aria-label="Platform(s): activate to sort column ascending"
                                        style="width: 320px;">due(credit)</th>
                                    <th class="sorting" tabindex="0" aria-controls="category_table" rowspan="1"
                                        colspan="1" aria-label="Engine version: activate to sort column ascending"
                                        style="width: 320px;">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($sales as $index => $sale)

                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $sale->number_sale }}</td>
                                    <td>{{ $sale->total }}</td>
                                    <td>{{ $sale->discount }}</td>
                                    @if ($sale->status == "paid")
                                    <td><span class="badge bg-success">{{ $sale->total_amount }}</span></td>
                                    @endif
                                    @if ($sale->status == "nopaid")
                                    <td><span class="badge bg-danger">{{ $sale->total_amount }}</span></td>
                                    @endif
                                    @if ($sale->status == "debt")
                                    <td><span class="badge bg-warning">{{ $sale->total_amount }}</span></td>
                                    @endif
                                    <td>{{ $sale->paid }}</td>
                                    <td>{{ $sale->due }}</td>
                                    <td>
                                        @if (auth()->user()->hasPermission('update_sales'))
                                        @if ($sale->due != 0)
                                        <button class="btn btn-warning btn-sm pcredit">Payment of dues</button>
                                        @endif
                                        @endif
                                        @if (auth()->user()->hasPermission('delete_categories'))
                                        <button id="delete" onclick="deletemoderator({{ $sale->id }})"
                                            class="btn btn-danger btn-sm"><i class="fas fa-trash"></i>
                                            delete</button>
                                        <form id="form-delete-{{ $sale->id }}"
                                            action="{{ route('sale.destroy', $sale->id) }}" method="post"
                                            style="display:inline-block;">
                                            {{ csrf_field() }}
                                            {{ method_field('delete') }}
                                        </form>
                                        @else
                                        <button type="submit" class="btn btn-danger btn-sm disabled"><i
                                                class="fas fa-trash"></i>
                                            delete</button>
                                        @endif

                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th rowspan="1" colspan="1">No</th>
                                    <th rowspan="1" colspan="1">Number Sale</th>
                                    <th rowspan="1" colspan="1">Total</th>
                                    <th rowspan="1" colspan="1">Discount</th>
                                    <th rowspan="1" colspan="1">Total Amount</th>
                                    <th rowspan="1" colspan="1">Paid</th>
                                    <th rowspan="1" colspan="1">due(credit)</th>
                                    <th rowspan="1" colspan="1">Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
        <div class="modal fade" id="payment_credit" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Payment of dues</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="paymentcredit">
                        {{ csrf_field() }}
                        {{ method_field('post') }}
                        @include('partials._errors')
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="hidden" id="id" name="id">
                                    <div class="form-group row">
                                        <label class="col-sm-5 col-form-label">Referance Sale Numder : </label>
                                        <input type="text" id="number_sale" name="number_sale"
                                            class="form-control col-sm-6 text-center" readonly>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-5 col-form-label">Total Amount : </label>
                                        <input type="number" id="paid" name="paid"
                                            class="form-control col-sm-6 text-center" readonly>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-5 col-form-label">Total Due(credit) : </label>
                                        <input id="credit" type="number" name="credit"
                                            class="form-control col-sm-6 text-center" readonly></input>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-5 col-form-label">Paid credit : </label>
                                        <input id="paidcredit" type="number" name="paidcredit"
                                            class="form-control col-sm-6 text-center" value="0"></input>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save Payment of dues</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

@stop

@section('script')
<script type="text/javascript">
    $(document).ready(function () {
        jQuery.noConflict();
        $('.pcredit').on('click', function () {
            $('#payment_credit').modal('show');

            $tr = $(this).closest('tr');
            var data = $tr.children("td").map(function () {
                return $(this).text();
            }).get();
            console.log(data);
            $('#id').val(data[0]);
            $('#number_sale').val(data[1]);
            $('#paid').val(data[5]);
            $('#credit').val(data[6]);
            $('#paidcredit').val(data[6]);
            console.log(data[6]);
            $("#paidcredit").attr({
                "max": data[6], // substitute your own
            });
        });

        $('#paymentcredit').on('submit', function (e) {
            e.preventDefault();

            var id = $('#id').val();

            $.ajax({
                type: 'PUT',
                url: "/paymentdue/" + id,
                data: $('#paymentcredit').serialize(),
                success: function (data) {
                    console.log(data);
                    $('#payment_credit').modal('hide');
                    location.reload();
                },
                error: function (error) {
                    const errors = error.responseJSON.errors
                    console.log(errors);
                }
            });
        });
    });

</script>


@endsection
