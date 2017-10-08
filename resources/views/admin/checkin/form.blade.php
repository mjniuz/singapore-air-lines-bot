@extends('admin.layouts.master')

@section('title')
Blash
@stop

@section('content')
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<div class="col-md-12">
						<h3 align="center">Blash</h3>
					</div>
				</div>
				<div class="box-body">
					<div class="col-md-12">
						@include('admin._partials.notifications')
						<div class="table-responsive">
	                        {!! Form::open(['role' => 'form', 'files' => true, 'route' => ['admin.checkin.store']]) !!}
	                        <div class="form-group required">
	                            <label>Blash</label>
	                            {!! Form::select('blash', $checkins, null, ['class' => 'form-control','required']) !!}
	                        </div>
	                        <div class="form-group required">
	                            <label>Status</label>
	                            {!! Form::select('status', [
	                            	1 => 'delay',
	                            ], null, ['class' => 'form-control','required']) !!}
	                        </div>
	                        <div class="form-group required">
	                            <label>Time</label>
								{{-- {!! Form::text('time', null, ['class' => 'form-control datepicker', 'data-date-format' => 'yyyy-mm-dd', 'placeholder' => 'Date', 'required']) !!} --}}
				                <div class='input-group date' id='datetimepicker1' style="width:250px;">
				                    <input type='text' class="form-control" value="{{ $check->ready_at }}" />
				                    <span class="input-group-addon">
				                        <span class="glyphicon glyphicon-calendar"></span>
				                    </span>
				                </div>
	                        </div>
							<div class="form-group">
								<label></label>
								<button class="btn btn-flat btn-default bg-maroon">Submit</button>
							</div>
                    	{!! Form::close() !!}
	                    </div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@stop

@section('script')
<link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap-datetimepicker.min.css') }}">
<script src="{{ asset('assets/bootstrap/js/bootstrap-datetimepicker.min.js') }}"></script>
<script type="text/javascript">
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
    $(function () {
        $('#datetimepicker1').datetimepicker({
    		use24hours: true,
            showInputs: false,
    		format: 'yyyy-mm-dd H:i:s'
        });
    });
</script>
@stop
