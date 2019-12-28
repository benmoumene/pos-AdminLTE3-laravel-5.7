@extends('layouts.main')


@section('content')

<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header with-border">
            <div class="row no-gutters">
                <div class="col-12 col-sm-6 col-md-8">
                    <h3 class="card-title">@lang('site.providerpurchasesdetails')</h3>
                </div>
            </div>
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
                                        style="width: 359px;">@lang('site.numberpurchase')</th>
                                    <th class="sorting" tabindex="0" aria-controls="category_table" rowspan="1"
                                        colspan="1" aria-label="Platform(s): activate to sort column ascending"
                                        style="width: 320px;">@lang('site.total')</th>
                                    <th class="sorting" tabindex="0" aria-controls="category_table" rowspan="1"
                                        colspan="1" aria-label="Platform(s): activate to sort column ascending"
                                        style="width: 320px;">@lang('site.discount')</th>
                                    <th class="sorting" tabindex="0" aria-controls="category_table" rowspan="1"
                                        colspan="1" aria-label="Platform(s): activate to sort column ascending"
                                        style="width: 320px;">@lang('site.totalamount')</th>
                                    <th class="sorting" tabindex="0" aria-controls="category_table" rowspan="1"
                                        colspan="1" aria-label="Platform(s): activate to sort column ascending"
                                        style="width: 320px;">@lang('site.paid')</th>
                                    <th class="sorting" tabindex="0" aria-controls="category_table" rowspan="1"
                                        colspan="1" aria-label="Platform(s): activate to sort column ascending"
                                        style="width: 320px;">@lang('site.due')</th>
                                    <th class="sorting" tabindex="0" aria-controls="category_table" rowspan="1"
                                        colspan="1" aria-label="Engine version: activate to sort column ascending"
                                        style="width: 320px;">@lang('site.action')</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($provider->purchases as $index => $purchase)

                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $purchase->number_purchase }}</td>
                                    <td>{{ $purchase->total }}</td>
                                    <td>{{ $purchase->discount }}</td>
                                    @if ($purchase->status == "paid")
                                    <td><span class="badge bg-success">{{ $purchase->total_amount }}</span></td>
                                    @endif
                                    @if ($purchase->status == "nopaid")
                                    <td><span class="badge bg-danger">{{ $purchase->total_amount }}</span></td>
                                    @endif
                                    @if ($purchase->status == "debt")
                                    <td><span class="badge bg-warning">{{ $purchase->total_amount }}</span></td>
                                    @endif
                                    <td>{{ $purchase->paid }}</td>
                                    <td>{{ $purchase->due }}</td>
                                    <td>
                                        <a href="{{ route('purchase.show', $purchase->id) }}"
                                            class="btn btn-primary btn-sm"><i class="fas fa-print"></i></a>
                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th rowspan="1" colspan="1">No</th>
                                    <th rowspan="1" colspan="1">@lang('site.numberpurchase')</th>
                                    <th rowspan="1" colspan="1">@lang('site.total')</th>
                                    <th rowspan="1" colspan="1">@lang('site.discount')</th>
                                    <th rowspan="1" colspan="1">@lang('site.totalamount')</th>
                                    <th rowspan="1" colspan="1">@lang('site.paid')</th>
                                    <th rowspan="1" colspan="1">@lang('site.due')</th>
                                    <th rowspan="1" colspan="1">@lang('site.action')</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
