<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="/css/app.css">
    <!-- Compiled and minified CSS -->
    <title>Login</title>
    <style>
        .image {
            width: 100%;
            height: 100vh;
            margin: 0;
            padding: 0;
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            position: relative;
            z-index: 1;
        }

        .login {
            width: 100%;
            height: 100vh;
            margin: 0;
            padding: 0;
        }

        .login-body {
            width: 100%;
            margin: 0;
            padding: 0;
            position: absolute;
            top: 25%;
        }

    </style>
</head>

<body class="text-center">

    <div class="row no-gutters">
        <div class="col-md-6">
            <img class="image" src="{{ asset('/uploads/settings/informatique.jpg') }}" alt="">
        </div>
        <div class="col-md-6 login  mx-auto my-auto">
            <div class="login-body">
                <img src="{{ asset('/uploads/settings/login.png') }}" alt="magasin logo">
                <h2>Login to Your Store</h2>
                <br>
                @include('partials._errors')
                <form action="{{ route('login') }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('post') }}
                    <div class="form-group col-md-6 offset-md-3">
                        <input class="validate form-control" placeholder="Enter Your Email" type="email" name="email"
                            id="email">
                    </div>
                    <div class="form-group col-md-6 offset-md-3">
                        <input class="validate form-control" placeholder="Enter Your Password" type="password"
                            name="password" id="password">
                    </div>

                    <button type="submit" name="login" value="login" class="btn btn-primary">Sign
                        In</button>
                </form>
            </div>
        </div>

    </div>

    <script src="/js/app.js"></script>
    <!-- Compiled and minified JavaScript -->
    <script src="/js/materialize.min.js"></script>
</body>

</html>
