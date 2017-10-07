@extends('admin.layouts.master')

@section('title')
Check In
@stop

@section('content')
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<div class="col-md-12">
						<div class="col-md-6">
							<h3 align="center">Check In</h3>
						</div>
						<div class="col-md-6">
						<br/>
							<a href="{{ route('admin.checkin.form') }}">
								{!! Form::submit('checkin',['class'=>'btn btn-warning btn-block', 'width' => '1000px', 'height' => '1000px']) !!}
							</a>
						</div>
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
										<th>Name User</th>
										<th>Booking Number</th>
										<th>Ready At</th>
										<th>Flight Number</th>
										<th>Depature</th>
										<th>Arrival</th>
									</tr>
								</thead>
								<tbody>
									@foreach($checkins as $key => $checkin)
										<tr>
                                            <td align="center">
                                                {{ ($checkins->currentpage()-1) * $checkins->perpage() + $key + 1 }}
                                            </td>
											<td>{{ $checkin->user->full_name }}</td>
											<td>{{ $checkin->booking_number }}</td>
											<td>{{ $checkin->ready_at }}</td>
											<td>{{ $checkin->flight_number }}</td>
											<td>{{ $checkin->departure_city }}</td>
											<td>{{ $checkin->arrival_city }}</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					{!! $checkins->appends(Input::all())->render() !!}
					</div>
			</div>
		</div>
	</div>
</section>
@stop
@section('script')
<script src="{{ asset('assets/js/dataTable-boostrap.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap-switch.js') }}"></script>
<script type="text/javascript">
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

    $(function() {
        //Timepicker
        $(".timepicker").timepicker({
    		use24hours: true,
            showInputs: false
        });
	});
    $('.datepicker').datepicker({
    	format: 'yyyy-mm-dd'
    });
</script>
@stop

