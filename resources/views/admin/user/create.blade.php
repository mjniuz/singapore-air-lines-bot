@extends('admin.layouts.master')

@section('title')
Create User Store
@stop

@section('content')
<section class="content">
	<div class="box box-success">
		<div class="box-header">
			<h1 class="page-header">Create User Store</h1>
		</div>
		<div class="box-body">
			@include('admin._partials.notifications')
			{!! Form::open(['role' => 'form']) !!}
				<div class="form-group">
					<label>Select Store</label>
					<select name="store" class="form-control">
						<option value="">None</option>
						@foreach($stores as $store)
							<option value="{{ $store->id }}">{{ $store->name }}</option>
						@endforeach
					</select>
				</div>
				<div class="form-group">
					<label>Username</label>
					{!! Form::text('username', null, ['class' => 'form-control']) !!}
				</div>
				<div class="form-group">
					<label>Password</label>
					{!! Form::password('password', ['class' => 'form-control']) !!}
				</div>
				<div class="form-group">
					<label>Passwod Confirmation</label>
					{!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
				</div>
				<div class="form-group">
					<label>Email</label>
					{!! Form::email('email', null, ['class' => 'form-control']) !!}
				</div>
				<div class="form-group">
					<label>First Name</label>
					{!! Form::text('first_name', null, ['class' => 'form-control']) !!}
				</div>
				<div class="form-group">
					<label>Last Name</label>
					{!! Form::text('last_name', null, ['class' => 'form-control']) !!}
				</div>
				<div class="form-group">
					<label>Mobile Phone</label>
					{!! Form::text('mobile', null, ['class' => 'form-control']) !!}
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
