@extends('admin.layouts.master')

@section('title')
Store Users
@stop

@section('content')
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<div class="col-md-12">
							<h3 align="center">STORE USERS</h3>
						<div class="col-md-2">
						<hr>
							<a href="{{ route('admin.create.user') }}" class="btn bg-navy"><i class="fa fa-plus"></i> Create New</a>
						</div>
						{!! Form::open(['role' => 'form', 'route' => 'admin.search.user', 'method' =>'get']) !!}
							<div class="col-md-3">
							<hr>
								{!! Form::text('searchname', Input::get('searchname')?: null, ['class' => 'form-control', 'placeholder' => 'Searching By Name ']) !!}
							</div>
							<div class="col-md-4">
							<hr>
								{!! Form::text('searchnamestore', Input::get('searchnamestore')?: null, ['class' => 'form-control', 'placeholder' => 'Searching By Name Store']) !!}
							</div>
							<div class="col-md-3">
							<hr>
								{!! Form::text('searchusername', Input::get('searchusername')?: null, ['class' => 'form-control', 'placeholder' => 'Searching By Username']) !!}
							</div>

							<div class="col-md-12">
							<br/>
								{!! Form::submit('Search',['class'=>'btn btn-default btn-lg btn-block', 'width' => '1000px', 'height' => '1000px']) !!}
							</div>
						{!! Form::close() !!}
					</div>
				</div>
				<div class="box-body">
					<div class="col-md-12">
						@include('admin._partials.notifications')
						<div class="table-responsive">
							<table class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>Full Name</th>
										<th>Store Name</th>
										<th>Username</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@foreach($users as $key => $user)
										<tr>
											<td>{{ $user->first_name . " " . $user->last_name }}</td>
											<td>
												{{ isset($user->store->name) ? $user->store->name : '' }}
											</td>
											<td>{{ $user->username }}</td>
											<td class="text-center">
												<div class="btn-group">
													<a href="{{ route('admin.detail.user', $user->id) }}">
						                      		<button class="btn btn-warning btn-sm"> 
						                      			<span class="glyphicon glyphicon-eye-open"></span> &nbsp; View	
						                      		</button>
							                      	</a>
							                    </div>
												<div class="btn-group">
													<a href="{{ route('admin.reset.user', $user->id) }}">
						                      		<button class="btn btn-info btn-sm"> 
						                      			<span class="glyphicon glyphicon-refresh"></span> &nbsp; Reset Password	
						                      		</button>
							                      	</a>
							                    </div>
							                 </td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					{!! $users->appends(Input::all())->render() !!}
					</div>
			</div>
		</div>
	</div>
</section>
@stop
@section('script')
<script src="{{ asset('assets/js/dataTable-boostrap.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap-switch.js') }}"></script>
<script>
	$(function () {
		$("#example1").DataTable();
		$('#example2').DataTable({
          "paging": true,
          "lengthChange": true,
          "searching": false,
          "ordering": true,
          "info": false,
          "autoWidth": true
        });
        $("[type='checkbox']").bootstrapSwitch();
	});
</script>
@stop
