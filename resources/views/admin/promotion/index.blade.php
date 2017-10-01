@extends('admin.layouts.master')

@section('title')
Promotions
@stop

@section('content')
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<div class="col-md-12">
							<h3 align="center">Promotions</h3>
						{!! Form::open(['role' => 'form', 'route' => 'admin.promotions', 'method' => 'GET']) !!}
							<div class="col-md-4">
							<hr>
								{!! Form::text('searchtitle', Input::get('searchtitle')?: null, ['class' => 'form-control', 'placeholder' => 'Searching By Title ']) !!}
							</div>
							<div class="col-md-4">
							<hr>
								{!! Form::text('searchstartat', Input::get('searchstartat')?: null, ['class' => 'form-control', 'placeholder' => 'Searching By Start At']) !!}
							</div>
							<div class="col-md-4">
							<hr>
								{!! Form::text('searchexpiredat', Input::get('searchexpiredat')?: null, ['class' => 'form-control', 'placeholder' => 'Searching By Expired At']) !!}
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
										<th>Title</th>
										<th>Image</th>
										<th>Start At</th>
										<th>Expired At</th>
										<th>
							                <a href="{{ URL::route('admin.promotion.form') }}" class="btn btn-default btn-primary">
							                    <i class="fa fa-plus"></i> Create Promotions
							                </a>
										</th>
									</tr>
								</thead>
								<tbody>
									@foreach($promotions as $key => $promotion)
										<tr>
                                            <td align="center">
                                                {{ ($promotions->currentpage()-1) * $promotions->perpage() + $key + 1 }}
                                            </td>
											<td>{{ $promotion->title }}</td>
											<td align="center">
												<img src="{{ $promotion->image_file }}" width="100px">
											</td>
											<td>{{ $promotion->start_at }}</td>
											<td>{{ $promotion->expired_at }}</td>
											<td>
								                <a href="{{ URL::route('admin.promotion.form',$promotion->id) }}" class="btn btn-default btn-warning">
								                    <i class="glyphicon glyphicon-pencil"></i>  &nbsp;Edit
								                </a>
	                        						{!! Form::model($promotion, ['role' => 'form', 'method' => 'DELETE', 'route' => ['admin.promotion.delete', $promotion->id]]) !!}
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
					{!! $promotions->appends(Input::all())->render() !!}
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
