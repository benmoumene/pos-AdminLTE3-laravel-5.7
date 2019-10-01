<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Store LTE</title>
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/skins/all.css" />
    <style>
        /* Custom ScrollBar design*/

        /* width */
        ::-webkit-scrollbar {
            width: 5px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
            border-radius: 5px;
            box-shadow: inset 0 0 5px rgba(0, 0, 0, 0.25) !important;
        }


        /* Handle */
        ::-webkit-scrollbar-thumb {
            border-radius: 5px;
            background: #009578;
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: #04daaf;
        }

    </style>
    {{--
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.css">
    --}}

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Navbar -->
        @include('layouts.navbar')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @include('layouts.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">@yield('page')</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Starter Page</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->


            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        @yield('content')
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
            <div class="p-3">
                <h5>Title</h5>
                <p>Sidebar content</p>
            </div>
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        @include('layouts.footer')
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <script src="/js/app.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="/js/moment.js"></script>
    <script src="/js/sale.js"></script>
    <script src="/js/img-preview.js"></script>
    <script src="/js/jquery.nicescroll.min.js"></script>
    <script src="/js/select2.min.js"></script>
    <script src="/js/JsBarcode.all.min.js"></script>
    <script src="/js/printThis.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/icheck.min.js"></script>

    @include('sweetalert::alert')
    <script type="text/javascript">
        function deletemoderator(id) {
            Swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'error',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!'
            }).then((result) => {
                if (result.value) {
                    event.preventDefault();
                    document.getElementById('form-delete-' + id).submit();
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelled',
                        'Your imaginary file is safe :)',
                        'error'
                    )
                }
            });
        }

    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#category_table').DataTable({
                "aLengthMenu": [
                    [5, 10, 20, -1],
                    [5, 10, 20, "All"]
                ],
                "iDisplayLength": 5
            });
            $('#product_table').DataTable({
                "aLengthMenu": [
                    [5, 10, 20, -1],
                    [5, 10, 20, "All"]
                ],
                "iDisplayLength": 5
            });
            $('#client_table').DataTable({
                "aLengthMenu": [
                    [5, 10, 20, -1],
                    [5, 10, 20, "All"]
                ],
                "iDisplayLength": 5
            });
            $('#provider_table').DataTable({
                "aLengthMenu": [
                    [5, 10, 20, -1],
                    [5, 10, 20, "All"]
                ],
                "iDisplayLength": 5
            });
            $('#moderator_table').DataTable({
                "aLengthMenu": [
                    [5, 10, 20, -1],
                    [5, 10, 20, "All"]
                ],
                "iDisplayLength": 5
            });
            $('#spending_table').DataTable({
                "aLengthMenu": [
                    [5, 10, 20, -1],
                    [5, 10, 20, "All"]
                ],
                "iDisplayLength": 5
            });

            $('#cat_spending_table').DataTable({
                "aLengthMenu": [
                    [5, 10, 20, -1],
                    [5, 10, 20, "All"]
                ],
                "iDisplayLength": 5
            });

        });

    </script>


    <script>
        $(document).ready(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-red',

            });
        });

    </script>
    <script>
        var barcode = 6130000000000;
        $('#button_barcode').click(function () {
            //var rnd = Math.floor(6130000000000 + Math.random() * 900000000);
            barcode++;
            document.getElementById('bar').value = barcode;
        });

    </script>
    <script>
        $(document).ready(function () {
            var interval = setInterval(function () {
                var momentNow = moment();
                $('#date-part').html(momentNow.format('dddd') + ' ' + momentNow.format('DD MMMM YYYY'));
                $('#time-part').html(momentNow.format('kk:mm:ss'));
            }, 100);
        });

    </script>
    @yield('script')
</body>

</html>
