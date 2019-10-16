<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex">

    <title>Invoice</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <style>
        .text-right {
            text-align: right;
        }

    </style>

</head>

<body class="login-page" style="background: white">

    <div class="col-md-12 page" style="display: block;">
        .
        <table class="table table-borderless table-sm table-responsive-sm">
            <thead class="thead-dark">
                <tr>
                    <th>
                        <h1 class="text-center">{{ $store_name }}</h1>
                    </th>
                </tr>
            </thead>
        </table>

        <h1 class="thead-dark text-center">Facture : 0001</h1>
        <div class="row no-gutters" style="display: block;">
            <div class="col-md-6" style="display: block;">
                <table class="table table-borderless table-sm table-responsive-sm ftable" style="text-align:center">
                    <thead class="thead-dark">
                        <tr>
                            <th>Company information</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>
                                {{ $store_name }}
                            </th>
                        </tr>
                        <tr>
                            <th>
                                14 cite djnane mlou - Mila
                            </th>
                        </tr>
                        <tr>
                            <th>
                                0698100116
                            </th>
                        </tr>
                        <tr>
                            <th>
                                No ART : {{ $article }}
                            </th>
                        </tr>
                        <tr>
                            <th>
                                No RC : {{ $rc }}
                            </th>
                        </tr>
                        <tr>
                            <th>
                                No NIF : {{ $nif }}
                            </th>
                        </tr>
                        <tr>
                            <th>
                                No NIS : {{ $nis }}
                            </th>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-6" style="display: block;">
                <table class="table table-borderless table-sm table-responsive-sm ftable" style="text-align:center">
                    <thead class="thead-dark">
                        <tr>
                            <th>Client information</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>
                                lazhar Meghlaoui
                            </th>
                        </tr>
                        <tr>
                            <th>
                                14 cite kafoure - Mila
                            </th>
                        </tr>
                        <tr>
                            <th>
                                0674065641
                            </th>
                        </tr>
                        <tr>
                            <th>
                                No ART : {{ $article }}
                            </th>
                        </tr>
                        <tr>
                            <th>
                                No RC : {{ $rc }}
                            </th>
                        </tr>
                        <tr>
                            <th>
                                No NIF : {{ $nif }}
                            </th>
                        </tr>
                        <tr>
                            <th>
                                No NIS : {{ $nis }}
                            </th>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>

        <table class="table table-bordered table-sm table-responsive-sm">
            <thead class="thead-dark">
                <tr>
                    <th style="width: 50px;">No</th>
                    <th style="width: 500px;">Product</th>
                    <th style="width: 100px;">Price unitaire</th>
                    <th style="width: 100px;">Quntite</th>
                    <th style="width: 100px;text-align:center;">Price</th>
                </tr>
            </thead>

            <tbody>
                <input type="hidden" value="{{ $i=1 }}">
                @foreach ($product_sales as $key => $product_sale)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $product_sale->product_name }}</td>
                    <td>{{ number_format($product_sale->sale_price, 2) }}</td>
                    <td>{{ $product_sale->pivot->quantity }}</td>
                    <td style="text-align:center;">
                        {{ number_format($product_sale->pivot->quantity * $product_sale->sale_price, 2) }}</td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="4" style="text-align:right;"><strong>Subtotal</strong>
                    </td>
                    <td style="text-align:center;">$ {{ number_format($sales->total,2) }}</td>
                </tr>
                <tr>
                    <td colspan="4" style="text-align:right;">
                        <strong>Discount</strong>
                    </td>
                    <td style="text-align:center;">$ {{ number_format($sales->discount,2) }}</td>
                </tr>
                <tr>
                    <td colspan="4" style="text-align:right;">
                        <strong>Total amount</strong>
                    </td>
                    <td style="text-align:center;"><strong>$ {{ number_format($sales->total_amount,2) }}</strong></td>
                </tr>
                <tr>
                    <td colspan="4" style="text-align:right;">
                        <strong>Versment</strong>
                    </td>
                    <td style="text-align:center;">
                        <strong>$ {{ number_format($sales->paid,2) }}</strong>
                    </td>
                </tr>
                <tr>
                    <td colspan="4" style="text-align:right;">
                        <strong>Rest a payer</strong>
                    </td>
                    <td style="text-align:center;">
                        <strong>$ {{ number_format($sales->total_amount - $sales->paid,2) }}</strong>
                    </td>
                </tr>
            </tbody>
            <tfoot>

            </tfoot>

        </table>

    </div>
</body>

</html>
