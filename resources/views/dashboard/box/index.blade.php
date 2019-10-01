@extends('layouts.main')

@section('page')
Money Box
@stop

@section('content')
@include('sweet::alert')
<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header with-border">
            <h2>Box Money</h2>
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
                                        style="width: 283px;">Action Name</th>
                                    <th class="sorting" tabindex="0" aria-controls="category_table" rowspan="1"
                                        colspan="1" aria-label="Browser: activate to sort column ascending"
                                        style="width: 359px;">Action
                                        Type</th>
                                    <th class="sorting" tabindex="0" aria-controls="category_table" rowspan="1"
                                        colspan="1" aria-label="Platform(s): activate to sort column ascending"
                                        style="width: 320px;">Money IN/OUT</th>
                                </tr>
                            </thead>
                            <tbody>


                                @foreach ($salemoneys as $index => $salemoney)
                                <tr>
                                    <td><span class="badge bg-success">{{ $index + 1 }}- sale</span></td>
                                    <td><span class="badge bg-success">{{ $salemoney->number_sale }}</span></td>
                                    <td><span class="badge bg-success">{{ $salemoney->total_amount }}</span></td>
                                </tr>
                                @endforeach
                                @foreach ($purchasemoneys as $index => $purchasemoney)
                                <tr>
                                    <td><span class="badge bg-warning">{{ $index + 1 }}- purchase</span></td>
                                    <td><span class="badge bg-warning">{{ $purchasemoney->number_purchase }}</span></td>
                                    <td><span class="badge bg-warning">{{ $purchasemoney->total_amount }}</span></td>
                                </tr>
                                @endforeach
                                @foreach ($spendmoneys as $index => $spendmoney)
                                <tr>
                                    <td><span class="badge bg-danger">{{ $index + 1 }}- Spending</span></td>
                                    <td><span
                                            class="badge bg-danger">{{ $spendmoney->CategorySpending->category_spending_name }}</span>
                                    </td>
                                    <td><span class="badge bg-danger">{{ $spendmoney->spending_price }}</span></td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th rowspan="1" colspan="1">Action Name</th>
                                    <th rowspan="1" colspan="1">Action Type</th>
                                    <th rowspan="1" colspan="1">Money IN/OUT</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <div class="card card-primary">
        <div class="card-header with-border">
            <div class="row">
                <div class="col-md-2 text-center">
                    <h4><span class="badge bg-success col-md-12">Total Sale Money : {{ $totalsalemoneys }}</span></h4>
                </div>
                <div class="col-md-2 text-center">
                    <h4><span class="badge bg-warning col-md-12">Total Purchase Money :
                            {{ $totalpurchasemoneys }}</span>
                    </h4>
                </div>
                <div class="col-md-2 text-center">
                    <h4><span class="badge bg-danger col-md-12">Total Credit Provider Money :
                            {{ $totalpurchaseduemoneys }}</span>
                    </h4>
                </div>
                <div class="col-md-2 text-center">
                    <h4><span class="badge bg-danger col-md-12">Total Credit Client Money :
                            {{ $totalsaleduemoneys }}</span>
                    </h4>
                </div>
                <div class="col-md-2 text-center">
                    <h4><span class="badge bg-danger col-md-12">Total Spending Money : {{ $totalspendmoneys }}</span>
                    </h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <h1><span class="badge bg-white col-md-6">Total Box Money : {{ $totalboxmoneys }}</span></h1>
                </div>

            </div>
        </div>
    </div>
</div>


@stop
