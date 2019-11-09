<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 3 | Invoice</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Theme style -->
    <link rel="stylesheet" href="/css/app.css">
    <style>
        body {
            background-color: #ff
        }

        .padding {
            padding: 2rem !important
        }

        .card {
            margin-bottom: 30px;
            border: none;
            -webkit-box-shadow: 0px 1px 2px 1px rgba(154, 154, 204, 0.22);
            -moz-box-shadow: 0px 1px 2px 1px rgba(154, 154, 204, 0.22);
            box-shadow: 0px 1px 2px 1px rgba(154, 154, 204, 0.22)
        }

        .card-header {
            background-color: #fff;
            border-bottom: 1px solid #e6e6f2
        }

        h3 {
            font-size: 20px
        }

        h5 {
            font-size: 15px;
            line-height: 26px;
            color: #3d405c;
            margin: 0px 0px 15px 0px;
            font-family: 'Circular Std Medium'
        }

        .text-dark {
            color: #3d405c !important
        }

        .fix-footer {
            position: fixed;
            left: 0px;
            bottom: 0px;
            height: 35px;
            width: 100%;
            background: #1abc9c;
        }

        .head-dark {
            color: #fff;
            background-color: #343a40;
            border-color: #454d55;
        }

    </style>

    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body>
    <div class="offset-xl-2 col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12 padding">
        <div class="card">
            <div class="card-header p-4" style="border: 1px solid #dee2e6;">
                <img src="{{ asset('/uploads/settings/'.$logo) }}" style="width:200px;" alt="" srcset="">
                <div class="float-right">
                    <h3 class="mb-0">{{ $activity }}</h3>
                    Date: {{ date_format($sales->created_at,"d/m/Y") }}
                </div>
            </div>
            <div class="card-body" style="padding: 0;">
                <table class="table table-bordered">
                    <thead>
                        <tr class="text-center">
                            <th>Facture : {{ $sales->number_sale }}</th>
                        </tr>
                    </thead>
                </table>
                <div class="table-responsive-sm">
                    <table class="table table-bordered" style="margin-bottom: 0;">
                        <thead>
                            <tr>
                                <th style="width:50%">Owner</th>
                                <th style="width:50%">Client</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>Client Name :
                                    {{ $store_name }}<br>Address : {{ $address }} <br>Phone : {{ $phone }} <br> N°
                                    Registre Commerce
                                    : {{ $rc }}<br>N°Article : {{ $article }}<br>NIF : {{ $nif }}<br>NIS :
                                    {{ $nis }}
                                </th>

                                <th>Client Name : {{ $sales->client->client_name }}<br>Address : {{ $address }}
                                    <br>Phone : {{ $phone }} <br> N° Registre Commerce :
                                    {{ $sales->client->rc }}<br>N°Article : {{ $sales->client->article }}<br>NIF :
                                    {{ $sales->client->nif }}<br>NIS : {{ $sales->client->nis }}
                                </th>



                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="table-responsive-sm">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 50px;">N°</th>
                                <th style="width: 500px;">Product</th>
                                <th style="width: 100px;text-align:center;">Price unitaire</th>
                                <th style="width: 100px;text-align:right;">Quntite</th>
                                <th style="width: 100px;text-align:center;">Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($product_sales as $product_sale )
                            <tr>
                                <td>{{ $i+1 }}</td>
                                <td>{{ $product_sale->product_name }}</td>
                                <td style="text-align:center;">${{ number_format($product_sale->sale_price, 2) }}
                                </td>
                                <td style="text-align:right;">{{ $product_sale->pivot->quantity }}</td>
                                <td style="text-align:center;">
                                    ${{ number_format($product_sale->pivot->quantity * $product_sale->sale_price, 2) }}
                                </td>
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
                                <td style="text-align:center;"><strong>$
                                        {{ number_format($sales->total_amount,2) }}</strong></td>
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
                    </table>
                </div>
            </div>
            <div class="card-footer fix-footer bg-white">
                <p class="mb-0">BBBootstrap.com, Sounth Block, New delhi, 110034</p>
            </div>
        </div>

    </div>

    {{--  <script type="text/javascript">
        window.addEventListener("load", window.print());

    </script>  --}}
</body>

</html>
