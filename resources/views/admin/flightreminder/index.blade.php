@extends('admin.layouts.master')

@section('title')
Flights Reminder
@stop

@section('content')
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<div class="col-md-12">
						<h3 align="center">Flights Reminder</h3>
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
										<th>Date</th>
										<th>Travel Time</th>
									</tr>
								</thead>
								<tbody>
									@foreach($flights as $key => $flight)
										<tr>
                                            <td align="center">
                                                {{ ($flights->currentpage()-1) * $flights->perpage() + $key + 1 }}
                                            </td>
											<td>{{ $flight->from }}</td>
											<td>{{ $flight->to }}</td>
											<td>{{ $flight->amount_found }}</td>
											<td>{{ $flight->date_flight }}</td>
											<td>{{ $flight->travel_time }} Minute</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					{!! $flights->appends(Input::all())->render() !!}
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

