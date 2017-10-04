@extends('admin.layouts.master')

@section('title')
Check Flights
@stop

@section('content')
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<div class="col-md-12">
							<h3 align="center">Check Flights</h3>
						{!! Form::open(['role' => 'form', 'route' => 'admin.checkflights', 'method' => 'GET']) !!}
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
										<th>Location Form</th>
										<th>Location To</th>
										<th>Amount Found</th>
										<th>Travel Time</th>
									</tr>
								</thead>
								<tbody>
									@foreach($checkflights as $key => $user)
										<tr>
                                            <td align="center">
                                                {{ ($checkflights->currentpage()-1) * $checkflights->perpage() + $key + 1 }}
                                            </td>
											<td>{{ $user->from_location }}</td>
											<td>{{ $user->to_location }}</td>
											<td>{{ $user->amount_found }}</td>
											<td>{{ $user->travel_time }} Minute</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					{!! $checkflights->appends(Input::all())->render() !!}
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
