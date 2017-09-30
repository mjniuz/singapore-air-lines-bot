@extends('admin.layouts.master')

@section('title')
Detail Users
@stop

@section('style')
<link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />
<style type="text/css">
	.select2-container--default .select2-selection--multiple .select2-selection__choice {
		color : black;
	}
</style>
@stop

@section('content')
<section class="content">
	<div class="box box-danger">
		<div class="box-header">
			<h2 class="page-header">Detail Users {{ $users->id }}</h2>
		</div>
		<div class="box-body">
			@include('admin._partials.notifications')
				<div class="form-group">
					<label>Username</label>
					{!! Form::text('username', $users->username, ['class' => 'form-control', 'readonly' ]) !!}
				</div>
				<div class="form-group">
					<label>Mobile</label>
					{!! Form::text('mobile', $users->mobile, ['class' => 'form-control', 'readonly' ]) !!}
				</div>
				<div class="form-group">
					<label>Email</label>
					{!! Form::text('email', $users->email, ['class' => 'form-control', 'readonly' ]) !!}
				</div>
				<div class="form-group">
					<label>First Name</label>
					{!! Form::text('first_name', $users->first_name, ['class' => 'form-control', 'readonly' ]) !!}
				</div>
				<div class="form-group">
					<label>Last Name</label>
					{!! Form::text('last_name', $users->last_name, ['class' => 'form-control', 'readonly' ]) !!}
				</div>
				<div class="form-group">
					<label>Store</label>
					{!! Form::text('store_id', $users->store->name, ['class' => 'form-control', 'readonly' ]) !!}
				</div>
					<label></label>
					<a href="{{ route('admin.user') }}">
						<button class="btn btn-flat btn-default bg-maroon">Back</button>
					</a>
				</div>
		</div>
	</div>
</section>
@stop
