@extends('admin.layouts.master')

@section('title')
@if (empty($promotion))
    {{ $promo = 'Create' }}
@else
    {{ $promo = 'Update' }}
@endif
{{ $promo }} Promotion
@stop

@section('content')
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<div class="col-md-12">
						<h3 align="center">{{ $promo }} Promotion</h3>
					</div>
				</div>
				<div class="box-body">
					<div class="col-md-12">
						@include('admin._partials.notifications')
						<div class="table-responsive">
	                    @if($promotion == null || empty($promotion))
	                        {!! Form::open(['role' => 'form', 'files' => true, 'route' => ['admin.promotion.store']]) !!}
	                    @else
	                        {!! Form::model($promotion, ['role' => 'form', 'files' => true, 'route' => ['admin.promotion.store', $promotion->id]]) !!}
	                    @endif
	                        <div class="form-group required">
	                            <label>Title</label>
	                            {!! Form::text('title', isset($promotion->title) ? $promotion->title : null, ['class' => 'form-control', 'required']) !!}
	                        </div>
	                        <div class="form-group required">
	                            <label>Start At</label>
	                            {!! Form::text('start_at', isset($promotion->start_at) ? $promotion->start_at : null, ['class' => 'datepicker form-control', 'data-date-format' => 'yyyy-mm-dd', 'required']) !!}
	                        </div>
	                        <div class="form-group required">
	                            <label>Expired At</label>
	                            {!! Form::text('expired_at', isset($promotion->expired_at) ? $promotion->expired_at : null, ['class' => 'datepicker form-control', 'data-date-format' => 'yyyy-mm-dd', 'required']) !!}
	                        </div>
	                        <div class="form-group">
	                            <label>Image</label>
	                            @if (!empty($promotion))
	                                <p class="text-block">
	                                    @if (!empty($promotion->image))
	                                    <img src="{{ $promotion->image_path }}" class="img-responsive" style="width:100px;">
	                                    @endif
	                                </p>
	                            @endif
	                            {!! Form::file('image', ['class' => 'form-control', 'accept' => 'image/*']) !!}
	                        </div>
	                        <div class="form-group">
	                            <label>Descriptions</label>
	                            {!! Form::textarea('description', isset($promotion->description) ? $promotion->description : null, ['class' => 'form-control', 'required']) !!}
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
</script>
@stop
