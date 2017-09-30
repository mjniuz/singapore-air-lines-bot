<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Bot Singapore Airlines</title>
        <link rel="icon" href="https://lunardream.files.wordpress.com/2012/01/singapore-airlines-mobile.png"/>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="stylesheet" href="{{asset('assets/css/app.min.css')}}">
    </head>
    <body class="login-page">
        <div class="login-box">
            @include('admin._partials.notifications')
            <div class="login-box-body" style="border-radius:15px;">
                <div class="login-logo">
                    <b>S</b>INGAPORE <b>A</b>IRLINES
                </div>
                @include('admin._partials.notifications')
                {!! Form::open(['route' => 'admin.login']) !!}
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group has-feedback">
                        {!! Form::text('username', null, ['class' => 'form-control', 'placeholder' => 'Username', 'required']) !!}
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password', 'required']) !!}
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <div class="row">
                        <div class="col-xs-8"></div>
                        <div class="col-xs-4">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
        <script src="{{asset('assets/js/app.min.js')}}"></script>
    </body>
</html>
