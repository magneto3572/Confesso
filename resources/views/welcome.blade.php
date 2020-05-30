<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Confesso</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
          integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN"
          crossorigin="anonymous">
    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }

        .cust {
            width: 80px;
        }

        .colr {
            background-color: #002752;
        }

        #loading{
            position: fixed;
            margin: auto;
            width: 100%;
            height: 100vh;
            z-index: 99999;
        }
    </style>
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
</head>
<body onload="myFunction()">
<div id="loading">
    <div class="flex-center position-ref full-height colr">
        <div class="content">
    <lottie-player
        src="https://assets2.lottiefiles.com/datafiles/QeC7XD39x4C1CIj/data.json"  background="transparent"  speed="1"  style="width: 300px; height: 300px;"  loop  autoplay >
    </lottie-player>
        </div>
    </div>
</div>
<div class="flex-center position-ref full-height colr">
    <div class="content">
        <div class="title m-b-md">
            <img src="{{asset('img/titt.png')}}" height="100" width="250" alt="">
        </div>

        <div class="btn-group">
            @if (Route::has('login'))
                <div class="mb-1">
                    @auth
                        <a href="{{ route('home') }}" class="btn btn-primary btn-rounded cust">Home</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-primary btn-rounded cust">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('login') }}" class="btn btn-primary btn-rounded cust">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>
    </div>
</div>
<script>
    var preloader= document.getElementById('loading');
    setTimeout(function myfunction(){
        preloader.style.display='none';
    }, 1000);
</script>
</body>
</html>
