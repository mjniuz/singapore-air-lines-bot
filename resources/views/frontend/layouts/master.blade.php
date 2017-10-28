<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="https://cdn.worldvectorlogo.com/logos/facebook-4.svg"/>

    <title>Bot Facebook</title>

    <!-- Styles -->     
    <link rel="stylesheet" href="{{ asset('assets/css/app.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/site.min.css') }}">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ route('frontend.home') }}">
                        <img src="https://cdn.worldvectorlogo.com/logos/facebook-4.svg" class="img-responsive" style="width:100px; height:40px; ">
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (!Auth::check())
                            <a href="{{ route('frontend.login') }}">
                                <button class="btn btn-warning btn-outline-success" type="button">Login</button>
                            </a>
                        @else
                            <a href="{{ route('frontend.logout') }}">
                                <button class="btn btn-danger btn-outline-success" type="button">Logout</button>
                            </a>
                        @endif
                        <li><a href="{{ route('frontend.home') }}">Home</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <script src="{{asset('assets/js/app.min.js')}}"></script>
        <script src="{{asset('assets/js/sweetalert-dev.js') }}"></script>
        <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('js/app.min.js') }}"></script>
    @yield('script')
</body>
</html>