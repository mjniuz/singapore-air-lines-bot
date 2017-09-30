@extends('admin.layouts.master')

@section('title')
Reset Password User User Store
@stop

@section('content')
<section class="content">
	<div class="box box-success">
		<div class="box-header">
			<h1 class="page-header">Reset Password User User Store</h1>
		</div>
		<div class="box-body">
			@include('admin._partials.notifications')
			{!! Form::model($user, ['route' => ['admin.update.user', $user->id]]) !!}		
				<div class="form-group">
					<label>New Password</label>
					{!! Form::password('password', ['class' => 'form-control', 'required']) !!}
				</div>
				<div class="form-group">
					<label>Passwod Confirmation</label>
					{!! Form::password('password_confirmation', ['class' => 'form-control', 'required']) !!}
				</div>
				<div class="form-group">
					<label></label>
					<button class="btn btn-md btn-flat btn-success">Save</button>
				</div>
			{!! Form::close() !!}
		</div>
	</div>
</section>
@stop
