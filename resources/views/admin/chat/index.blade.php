@extends('admin.layouts.master')

@section('title')
Chat
@stop

@section('content')
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<div class="col-md-12">
							<h3 align="center">Chat</h3>
						{!! Form::open(['role' => 'form', 'route' => 'admin.chats', 'method' => 'GET']) !!}
							<div class="col-md-4">
							<hr>
								{!! Form::text('searchtitle', Input::get('searchtitle')?: null, ['class' => 'form-control', 'placeholder' => 'Searching By Title ']) !!}
							</div>
							<div class="col-md-4">
							<hr>
								{!! Form::text('searchstartat', Input::get('searchstartat')?: null, ['class' => 'form-control datepicker', 'data-date-format' => 'yyyy-mm-dd', 'placeholder' => 'Searching By Start At']) !!}
							</div>
							<div class="col-md-4">
							<hr>
								{!! Form::text('searchexpiredat', Input::get('searchexpiredat')?: null, ['class' => 'form-control datepicker', 'data-date-format' => 'yyyy-mm-dd', 'placeholder' => 'Searching By Expired At']) !!}
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
										<th>Chat Format</th>
										<th>Chat Example</th>
										<th>
							                <a href="{{ URL::route('admin.promotion.form') }}" class="btn btn-default btn-primary">
							                    <i class="fa fa-plus"></i> Create Chat
							                </a>
										</th>
									</tr>
								</thead>
								<tbody>
									@foreach($chats as $key => $chat)
										<tr>
                                            <td align="center">
                                                {{ ($chats->currentpage()-1) * $chats->perpage() + $key + 1 }}
                                            </td>
											<td>{{ $chat->format_chat }}</td>
											<td>{{ $chat->example_chat }}</td>
											<td>
								                <a href="{{ URL::route('admin.promotion.form',$chat->id) }}" class="btn btn-default btn-warning">
								                    <i class="glyphicon glyphicon-pencil"></i>  &nbsp;Edit
								                </a>
	                        						{!! Form::model($chat, ['role' => 'form', 'method' => 'DELETE', 'route' => ['admin.promotion.delete', $chat->id]]) !!}
	                                    				<button class="btn btn-default btn-danger" onclick="return confirm('Are You Sure?');">
	                                    					<i class="glyphicon glyphicon-trash"></i>  &nbsp;Delete
	                                    				</button>
                    								{!! Form::close() !!}
											</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					{!! $chats->appends(Input::all())->render() !!}
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
