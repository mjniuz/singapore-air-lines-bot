@extends('admin.layouts.master')

@section('title')
@if (empty($chat))
    {{ $check_chat = 'Create' }}
@else
    {{ $check_chat = 'Update' }}
@endif
{{ $check_chat }} Chat
@stop

@section('content')
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<div class="col-md-12">
						<h3 align="center">{{ $check_chat }} Chat</h3>
					</div>
				</div>
				<div class="box-body">
					<div class="col-md-12">
						@include('admin._partials.notifications')
						<div class="table-responsive">
	                    @if($chat == null || empty($chat))
	                        {!! Form::open(['role' => 'form', 'files' => true, 'route' => ['admin.chat.store']]) !!}
	                    @else
	                        {!! Form::model($chat, ['role' => 'form', 'files' => true, 'route' => ['admin.chat.store', $chat->id]]) !!}
	                    @endif
	                        <div class="form-group required">
	                            <label>Format Chat</label>
	                            <label>
	                            	<i>
	                            		* please use '_' for different words, ex : SA_JAKARTA_SINGAPORE_2017-12-12
	                            	</i>
	                            </label>
	                            {!! Form::text('format_chat', isset($chat->format_chat) ? $chat->format_chat : null, ['class' => 'form-control', 'required']) !!}
	                        </div>
	                        <div class="form-group required">
	                            <label>Example Chat</label>
	                            {!! Form::text('example_chat', isset($chat->example_chat) ? $chat->example_chat : null, ['class' => 'form-control', 'required']) !!}
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
