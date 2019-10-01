<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="/css/app.css">
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="/css/materialize.min.css">



    <title>Login</title>
</head>

<body class="text-center">
    <style>
        .login {
        width: 100%;
        top: 50%;
        left: 50%;
        position: absolute;
        transform: translate(-50%,-50%);
        box-sizing: border-box;
        max-width: 600px;
        padding: 30px;
        padding-top: 80px;
        margin: 0 auto;
        }
        body {
        margin: 0;
        padding: 0;
        background: url('../uploads/settings/informatique.jpg')no-repeat center center fixed;
        background-size: cover;
        background-position: center;
        height: 100%;
        overflow: hidden;
        }
        .avatar{
        width: 100px;
        height: 100px;
        position: absolute;
        top: -50px;
        left:calc(50% - 50px);
        }
    </style>


    <div class="container">
        <div class="row">
            <div class="login">
                <div class="card ">
                    <div class="card-content">
                        <img class="avatar" src="{{ asset('uploads/settings/login.png') }}" alt="">

                        <center>
                            <h2>Login to Your Store</h2>
                            <br>
                            @include('partials._errors')
                            <form class="container" action="{{ route('login') }}" method="post">
                                {{ csrf_field() }}
                                {{ method_field('post') }}
                                <div class=" input-field col s12">
                                    <label for="email">Email address</label>
                                    <input class="validate" type="email" name="email" id="email">
                                </div>
                                <div class=" input-field col s12">
                                    <label for="password">Password</label>
                                    <input class="validate" type="password" name="password" id="password">
                                </div>

                                <button type="submit" name="login" value="login" class="btn btn-primary">Sign In</button>
                            </form>
                        </center>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="/js/app.js"></script>
    <!-- Compiled and minified JavaScript -->
    <script src="/js/materialize.min.js"></script>
</body>

</html>
