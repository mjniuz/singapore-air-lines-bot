@extends('admin.layouts.master')

@section('title')
Users
@stop

@section('content')
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<div class="col-md-12">
							<h3 align="center">Users</h3>
						{!! Form::open(['role' => 'form', 'route' => 'admin.users', 'method' => 'GET']) !!}
							<div class="col-md-4">
							<hr>
								{!! Form::text('searchname', Input::get('searchname')?: null, ['class' => 'form-control', 'placeholder' => 'Searching By Name ']) !!}
							</div>
							<div class="col-md-4">
							<hr>
							    {!! Form::select('searchaccess', [
							    		1 => 'Access Admin',
							    		2 => 'Access Member',
							    	], Input::get('searchaccess')?: null, ['class' => 'form-control select2 to-select',
							        'placeholder' => 'Searching By Access' ]) !!}
							</div>
							<div class="col-md-4">
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
										<th>No.</th>
										<th>Full Name</th>
										<th>Image</th>
										<th>Username</th>
										<th>Access</th>
									</tr>
								</thead>
								<tbody>
									@foreach($users as $key => $user)
										<tr>
                                            <td align="center">
                                                {{ ($users->currentpage()-1) * $users->perpage() + $key + 1 }}
                                            </td>
											<td>{{ $user->full_name }}</td>
											<td align="center">
												<img src="{{ $user->image_path }}" width="100px">
											</td>
											<td>{{ $user->username }}</td>
											<td>
												@if ($user->access != \App\Models\User::ADMIN)
													Member
												@else
													Admin
												@endif
											</td>
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
