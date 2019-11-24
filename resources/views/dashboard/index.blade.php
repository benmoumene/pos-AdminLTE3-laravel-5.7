@extends('layouts.main')

@section('content')

<div class="col-md-12">
    <div class="row">
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
                <span class="info-box-icon bg-info"><i class="nav-icon fas fa-list-alt"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">@lang('site.allcategory')</span>
                    <span class="info-box-number">{{ $categories->count() }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
                <span class="info-box-icon bg-info"><i class="nav-icon fas fa-archive"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">@lang('site.allproduct')</span>
                    <span class="info-box-number">{{ $products->count() }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
                <span class="info-box-icon bg-success"><i class="nav-icon fas fa-cart-plus"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">@lang('site.allsale')</span>
                    <span class="info-box-number">{{ $sales->count() }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
                <span class="info-box-icon bg-warning"><i class="nav-icon fas fa-cart-arrow-down"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">@lang('site.allpurchase')</span>
                    <span class="info-box-number">{{ $purchases->count() }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
    </div>
    <div class="row">
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
                <span class="info-box-icon bg-success"><i class="nav-icon fas fa-dollar-sign"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">@lang('site.allprofit')</span>
                    <span class="info-box-number">{{ $sumprofit }}</span>
                </div>
                <span class="info-box-icon"><i class="nav-icon fas fa-arrow-up" style="color: #38c172;"></i></span>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
                <span class="info-box-icon bg-success"><i class="nav-icon fas fa-cart-plus"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">@lang('site.saletoday')</span>
                    <span class="info-box-number">{{ $sales_today->count() }}</span>
                </div>
                <span class="info-box-icon"><i class="nav-icon fas fa-angle-double-up"
                        style="color: #38c172;"></i></span>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
                <span class="info-box-icon bg-danger"><i class="nav-icon fas fa-money-check-alt"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">@lang('site.spendingmoney')</span>
                    <span class="info-box-number">{{ $totalspendmoneys }}</span>
                </div>
                <span class="info-box-icon"><i class="nav-icon fas fa-arrow-down" style="color: #e3342f ;"></i></span>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
                <span class="info-box-icon bg-warning"><i class="nav-icon fas fa-cart-arrow-down"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">@lang('site.purchasetoday')</span>
                    <span class="info-box-number">{{ $purchases_today->count() }}</span>
                </div>
                <span class="info-box-icon"><i class="nav-icon fas fa-angle-double-down"
                        style="color: #ffed4a ;"></i></span>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">@lang('site.productsale')</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>@lang('site.productname')</th>
                                <th>@lang('site.quantitysale')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($salesproducts as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item->product_name }}</td>
                                <td>{{ $item->qty }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">@lang('site.stockalert')</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>@lang('site.productname')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($stock_alerts as $index => $stock_alert)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $stock_alert->product_name }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>

</div>

@stop
