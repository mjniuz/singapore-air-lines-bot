<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html lang="en">
<head>
<title>Work Ability a Corporate Business Category  Bootstrap responsive Website Template | Home :: w3layouts</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="utf-8">
<meta name="keywords" content="Work Ability Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- bootstrap-css -->
<link href="{{ asset('paralax/css/bootstrap.css') }}" rel="stylesheet" type="text/css" media="all" />
<!--// bootstrap-css -->
<!-- css -->
<link rel="stylesheet" href="{{ asset('paralax/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('paralax/css/custom.css') }}">

<!--// css -->
<!-- font-awesome icons -->
<link rel="stylesheet" href="{{ asset('paralax/css/font-awesome.css') }}">
<!-- //font-awesome icons -->
<link rel="stylesheet" href="{{ asset('paralax/css/flexslider.css') }}" type="text/css" media="all" property="" /> 
<!-- font -->
<link href="//fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
<link href="//fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">
<!-- //font -->
<script src="{{ asset('paralax/js/jquery-1.11.1.min.js') }}"></script>
<script src="{{ asset('paralax/js/bootstrap.js') }}"></script>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$(".scroll").click(function(event){		
			event.preventDefault();
			$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
		});
	});
</script> 
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<![endif]-->
</head>
<body>
	<!-- banner -->
	<div class="banner">
		<div class="header-top-grids">
			<div class="header">
					<div class="header-left">
						<div class="agileinfo-social-grids">
							<ul>
								<li> <img src="{{ URL('paralax/images/logo.png') }}" style="width: 30%"> </li>
							</ul>
						</div>
						<div class="w3layouts-logo">
							<h1>
								<a href="{{ URL('/') }}">Singa <span> Boot</span></a>
							</h1>
						</div>
						<div class="address-info-text">
							<p><i class="fa fa-map-marker" aria-hidden="true"></i> Jakarta,Indonesia</p>
						</div>
						<div class="clearfix"> </div>
					</div>
			</div>
			<div class="top-nav">
				<div class="top-nav-info">
						<nav class="navbar navbar-default">
								<div class="navbar-header">
									<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
										<span class="sr-only">Toggle navigation</span>
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
									</button>
								</div>
							<!-- Collect the nav links, forms, and other content for toggling -->
							<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
								<ul class="nav navbar-nav">
									<li><a class="active" href="index.html">Home</a></li>
									<li><a href="#about">About</a></li>
									<li><a href="#services">Services</a></li>
									<li><a href="#team">Team</a></li>
									<li><a href="#testi">Testimonial</a></li>
									<li><a href="#contact">Contact</a></li>
								</ul>	
								<div class="clearfix"> </div>
							</div>	
						</nav>		
				</div>
			</div>
		</div>
		<div class="header-bottom">
				<!-- w3layouts-slider -->
				<div class="w3layouts-slider">
					<div class="container">
						<div class="slider">
							<div class="callbacks_container">
								<ul class="rslides callbacks callbacks1" id="slider4">
									<li>	
										<div class="wthree-banner-grids">
											<div class="col-md-5 agileinfo-banner-right">
												<h5>Singapore Airlines</h5>
												<p>Easy booking, easy fly, and enjoy your journey</p>
											</div>
											<div class="col-md-7 agileits-banner-left">
												<h3>Singapore airlines</h3>
												<h4>we will help you</h4>
											</div>
											<div class="clearfix"> </div>
										</div>
										<div class="banner-border"> </div>
									</li>
									<li>	
										<div class="wthree-banner-grids">
											<div class="col-md-5 agileinfo-banner-right">
												<h5>Chat bot</h5>
												<p>You need holiday, but low budget?lets talk, we will help you</p>
											</div>
											<div class="col-md-7 agileits-banner-left">
												<h3>Singapore airlines</h3>
												<h4>we will help you</h4>
											</div>
											<div class="clearfix"> </div>
										</div>
										<div class="banner-border"> </div>
									</li>
								</ul>
							</div>
							<script src="{{ asset('paralax/js/responsiveslides.min.js') }}"></script>
							<script>
								// You can also use "$(window).load(function() {"
								$(function () {
								  // Slideshow 4
								  $("#slider4").responsiveSlides({
									auto: true,
									pager:true,
									nav:true,
									speed: 500,
									namespace: "callbacks",
									before: function () {
									  $('.events').append("<li>before event fired.</li>");
									},
									after: function () {
									  $('.events').append("<li>after event fired.</li>");
									}
								  });
							
								});
							 </script>
							<!--banner Slider starts Here-->
						</div>
					</div>
				</div>
				<!-- //w3layouts-slider -->
		</div>
	</div>
	<!-- //banner -->
	<!-- about us --> 
	<div class="about-w3layouts">
		<div class="container">	
				<div class="agileits-heading">
					<h3 class="colororange"> What Is Singa-Bot? 
					<img src="{{ URL('paralax/images/logo.png') }}" alt="" /></h3>
				</div>
					<div class="about-top-grids mt0 hidden-xs hidden-sm">
						<div class="col-md-4 mt100">
							<img src="{{ URL('paralax/images/singabootis.png') }}" class="left">
						</div>
						<div class="col-md-4 text-center mtmin40">
							<img src="{{ URL('paralax/images/testphone.png') }}" alt=" " />
						</div>
						<div class="col-md-4 mt100">
							<h2 class="colororange text-center">Say, Hi To Me!</h2>
							<div class="row">
								<div class="col-md-4">
									<a href="http://m.me/866408300180289" target="_blank">
										<img src="{{ URL('paralax/images/messangerlogo.png') }}">
									</a>
								</div>
								<div class="col-md-4">
									<a href="t.me/TestSingaBot9" target="_blank">
										<img src="{{ URL('paralax/images/telegramlogo.png') }}">
									</a>
								</div>
								<div class="col-md-4">
									<img src="{{ URL('paralax/images/linelogo.png') }}">
								</div>
							</div>
						</div>
					</div>
						<div class="visible-xs visible-sm text-center">
							<div class="col-md-4 mb20">
								<img src="{{ URL('paralax/images/singabootis.png') }}" class="left">
							</div>
							<div class="col-md-4 text-center">
								<img src="{{ URL('paralax/images/testphone.png') }}" alt=" " />
							</div>
							<div class="col-md-4 mb20">
								<h2 class="colororange text-center">Say, Hi To Me!</h2>
								<div class="row">
										<a href="http://m.me/866408300180289" target="_blank">
												<img src="{{ URL('paralax/images/messangerlogo.png') }}">
										</a>
										<a href="t.me/TestSingaBot" target="_blank">
											<img src="{{ URL('paralax/images/telegramlogo.png') }}">
										</a>
										<img src="{{ URL('paralax/images/linelogo.png') }}">
								</div>
							</div>
						</div>
						<div class="clearfix"> </div>
					</div>
				</div>

	<!-- //about us --> 
	<!-- services -->
		<div class="services jarallax" id="services">
		<div class="container">
			<div class="agileits-heading">
				<h3>Our Services</h3>
			</div>
			<div class="services-grids">
				<div class="col-md-3 wthree-services-grid">
					<div class="wthree-services-icon">
						<i class="fa fa-comments" aria-hidden="true"></i>
					</div>
					<div class="wthree-services-info">
						<h5>Marketing Campaign in messanger</h5>
						<p>Customer can chat with our officer via messenger. </p>
					</div>
				</div>
				<div class="col-md-3 wthree-services-grid">
					<div class="wthree-services-icon">
						<i class="fa fa-credit-card" aria-hidden="true"></i>
					</div>
					<div class="wthree-services-info">
						<h5>Price Reminder</h5>
						<p>Singa Bot will send you a notification when find the ticket that suitable
						with your budget</p>
					</div>
				</div>
				<div class="col-md-3 wthree-services-grid">
					<div class="wthree-services-icon">
						<i class="fa fa-plane" aria-hidden="true"></i>
					</div>
					<div class="wthree-services-info">
						<h5>Flight Booking</h5>
						<p>You can book your ticket 24 Hours</p>
					</div>
				</div>
				<div class="col-md-3 wthree-services-grid">
					<div class="wthree-services-icon">
						<i class="fa fa-calendar-check-o" aria-hidden="true"></i>
					</div>
					<div class="wthree-services-info">
						<h5>Check in, Select Seat</h5>
						<p>You can check in and choose your seat by chatting Singa Bot </p>
					</div>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>
	<!-- //services -->
	<div class="services-bottom">
		<div class="container">
			<div class="agileits-heading">
				<h3>Our Team</h3>
			</div>
			<div class="wthree-services-bottom-grids">
				<div class="row">
					<div class="col-sm-3 mb20">
						<div class="card">
						  <img src="{{ URL('paralax/images/ary.jpg') }}" alt="Avatar" style="width:100%">
						  <div class="containercard">
						    <h4><b>Ary Widiantara</b></h4> 
						  </div>
						</div>
					</div>
					<div class="col-sm-3 mb20">
						<div class="card">
						  <img src="{{ URL('paralax/images/alan.jpg') }}" alt="Avatar" style="width:100%">
						  <div class="containercard">
						    <h4><b>Muhammad Yulianto</b></h4> 
						  </div>
						</div>
					</div>
					<div class="col-sm-3 mb20">
						<div class="card">
						  <img src="{{ URL('paralax/images/aris.jpg') }}" alt="Avatar" style="width:100%">
						  <div class="containercard">
						    <h4><b>Aris Susanti</b></h4> 
						  </div>
						</div>
					</div>

					<div class="col-sm-3 mb20">
						<div class="card">
						  <img src="{{ URL('paralax/images/aulia.jpg') }}" alt="Avatar" style="width:100%">
						  <div class="containercard">
						    <h4><b>Aulia Anisa Septiana</b></h4> 
						  </div>
						</div>
					</div> 
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>
	{{--
	<!-- testimonials -->
	<div class="testimonials">
		<div class="container">
			<div class="agileits-heading testimonials-heading">
				<h3>Testimonial Their Marketing</h3>
			</div>
			<div class="wthree_testimonial_grids">
				<div class="col-md-6 wthree_testimonial_grid_left">
					<div class="w3ls_testimonial_grid_left_grid">
						<div class="col-xs-4 agileinfo_testimonials_left">
							<img src="images/f2.jpeg" alt=" " class="img-responsive" />
							<h4>Matthew Sueoka</h4>
							<p>American Express</p>
						</div>
						<div class="col-xs-8 agileinfo_testimonials_right">
							<div class="agileits_testimonials_right_grid">
								<p>"We're trying to serve the customer in this more conversational way," Matthew Sueoka, VP of digital partnerships and development at American Express,</p>
							</div>
						</div>
						<div class="clearfix"> </div>
					</div>
					<div class="w3ls_testimonial_grid_left_grid w3l_testimonial_grid_left_grid">	
						<div class="col-xs-8 agileinfo_testimonials_right agileits_w3layouts_farm_man">
							<div class="agileits_testimonials_right_grid w3_testimonials_right_grid">
								<p>Our audience and fans are deeply into messaging apps, so if you can have a conversation with Trolli, that kind of engagement is so much more valuable than just an impression," said Rob Peichel, vp/group creative director at Trolli’s agency, Periscope.</p>
							</div>
						</div>
						<div class="col-xs-4 agileinfo_testimonials_left">
							<img src="{{ URL('paralax/images/f1.jpg') }}" alt=" " class="img-responsive" />
							<h4>Rob Peichel</h4>
							<p>Trolli’s agency</p>
						</div>
						<div class="clearfix"> </div>
					</div>
				</div>
				<div class="col-md-6 wthree_testimonial_grid_right">
					<h3>BENEFITS OF USING CHATBOTS FOR YOUR BUSINESS </h3>
					<p>The exploding popularity of messaging apps is hard to deny. The GlobalWebIndex Statistics says that 75% of Internet users are adopters of one or few messengers, The rise of artificial intelligence technologies brings chatbots to the new level. Together with natural language processing AI brings up to 90% to an accuracy of machine parsing and understanding of requests. Another significant factor here is sophistication notifications that take into account context of the situation and are always on across devices.</p>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>
	<!-- //testimonials -->
	--}}
	<!-- footer -->
	<footer class="jarallax">
		<div class="container">
			<div class="agile-footer-grids">
				<div class="col-md-4 agile-footer-grid">
					<h4>About</h4>
					<div class="agile-footer-info">
						<p>We will help you to chat with singa-bot, lets subscribe you can know
						the benefits you get, lets start your journey in here!</p>
						<h5>Subscribe Here</h5>
						<form action="#" method="post">
							<input type="email" name="Email" placeholder="Email" required="">
							<input type="submit" value="Subscribe">
						</form>
					</div>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
	</footer>
	<!-- //footer -->
	<!-- copyright -->
	<div class="agileits-w3layouts">
		<div class="container">
			<p>© 2017 Work Ability. All rights reserved</p>
		</div>
	</div>
	<!-- //copyright -->

	<script src="{{ asset('paralax/js/responsiveslides.js') }}"></script>
	<script src="{{ asset('paralax/js/jarallax.js') }}"></script>
	<script src="{{ asset('paralax/js/SmoothScroll.js') }}"></script>
	<script type="text/javascript">
		/* init Jarallax */
		$('.jarallax').jarallax({
			speed: 0.5,
			imgWidth: 1366,
			imgHeight: 768
		})
	</script>
	<script src="{{ asset('paralax/js/move-top.js') }}"></script>
	<script src="{{ asset('paralax/js/easing.js') }}"></script>
	<!-- here stars scrolling icon -->
	<script type="text/javascript">
		$(document).ready(function() {
			/*
				var defaults = {
				containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear' 
				};
			*/
								
			$().UItoTop({ easingType: 'easeOutQuart' });
								
			});
	</script>
	<!-- //here ends scrolling icon -->
	 <script type="text/javascript">
							$(window).load(function() {
								$("#flexiselDemo1").flexisel({
									visibleItems:3,
									animationSpeed: 1000,
									autoPlay: true,
									autoPlaySpeed: 3000,    		
									pauseOnHover: true,
									enableResponsiveBreakpoints: true,
									responsiveBreakpoints: { 
										portrait: { 
											changePoint:480,
											visibleItems: 1
										}, 
										landscape: { 
											changePoint:640,
											visibleItems:2
										},
										tablet: { 
											changePoint:768,
											visibleItems: 3
										}
									}
								});
								
							});
					</script>
	<script src="{{ asset('paralax/js/jquery.flexisel.js') }}"></script>
</body>	
</html>