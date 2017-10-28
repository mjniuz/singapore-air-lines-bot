<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<link rel="icon" href="https://cdn.worldvectorlogo.com/logos/facebook-4.svg"/>
		<title>Bot - @yield('title')</title>
		<link rel="stylesheet" href="{{ asset('assets/css/app.min.css') }}">
		<link rel="stylesheet" href="{{ asset('assets/css/sweetalert.css') }}">
		<link rel="stylesheet" href="{{ asset('assets/css/bootstrap-timepicker.min.css') }}">
		@yield('style')
	</head>
	<body class="hold-transition skin-blue sidebar-mini">
		<div class="wrapper">
			@include('admin._partials.navbar')
			@include('admin._partials.sidebar')
			<div class="content-wrapper">
				@yield('content')
			</div>
		</div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
		<script src="{{asset('assets/js/app.min.js')}}"></script>
		<script src="{{asset('assets/js/sweetalert-dev.js') }}"></script>
		<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
		<script src="{{asset('assets/js/bootstrap-timepicker.min.js')}}"></script>
		@yield('script')
		<script>
			function slugify(text)
			{
			  return text.toString().toLowerCase()
			    .replace(/\s+/g, '-')           // Replace spaces with -
			    .replace(/[^\w\-]+/g, '')       // Remove all non-word chars
			    .replace(/\-\-+/g, '-')         // Replace multiple - with single -
			    .replace(/^-+/, '')             // Trim - from start of text
			    .replace(/-+$/, '');            // Trim - from end of text
			}
					
			$.widget.bridge('uibutton', $.ui.button);
		</script>
	</body>
</html>
