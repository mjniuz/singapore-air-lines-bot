@extends('frontend.layouts.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                    @include('frontend._partials.notifications')
                <div class="panel-body">
                          <h1>
                            <b>L</b>OGIN
                          </h1>
                        {!! Form::open(['route' => 'frontend.login.submit']) !!}
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
                                <div class="col-xs-8">Don't have an account? Sign up</div>
                                <div class="col-xs-4">
                                    <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection