@extends('admin.layouts.master')

@section('title')
DATA NOT FOUND
@stop

@section('style')
<link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />
<style type="text/css">
	.select2-container--default .select2-selection--multiple .select2-selection__choice {
		color : black;
	}
</style>
@stop

@section('content')
<section class="content">
	<div class="box box-danger">
		<div class="box-header">
			<h2 class="page-header" align="center">DATA NOT FOUND</h2>
		</div>
		<div class="box-body" align="center">
			<img src="{{ url('assets/img/nodata.jpg') }}" class="img-responsive" style="width:700px; height:400px; ">
			</br></br></br>
		</div>
	</div>
</section>
@stop
