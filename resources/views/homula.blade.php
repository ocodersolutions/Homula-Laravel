<!DOCTYPE html>
<html>
<head>
	<title>Toronto Real Estate</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link href="{{ URL::asset('css/bootstrap.min.css') }}" media="all" rel="stylesheet" type="text/css" />
	<link href="{{ URL::asset('css/bootstrap-theme.min.css') }}" media="all" rel="stylesheet" type="text/css" />
	<link href="{{ URL::asset('css/style.css') }}" media="all" rel="stylesheet" type="text/css" />
	<link href="{{ URL::asset('css/font-awesome.min.css') }}" media="all" rel="stylesheet" type="text/css" />

	<script type="text/javascript" src="{{URL::asset('js/jquery-1.12.4.min.js')}}"></script>

</head>
<body>
	<div class="container-fluid">
		<div class="row">
			<div id="header">
				<div class="header_top">
					<div class="container">
						<div class="row">
							<div class="col-sm-12 header_top_content">
								<div class="row">
									<div class="col-sm-4 logo_header">
										<img src="{{ URL::asset('images/logo-sep.png') }}" class="img-responsive">
									</div>
									<div class="col-sm-4 header_top_account">
										<a href="">SIGN IN</a>
										<i class="fa fa-plus" aria-hidden="true"></i>
										<a href="">SIGN UP</a>
									</div>
									<div class="col-sm-4 header_top_favorites">
										<a>FAVORITES</a>
										<i class="fa fa-heart" aria-hidden="true"></i>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="header_menu">
					<div class="container">
						<div class="row">
							<div class="col-sm-12 header_menu_content">
								<ul>
									<li>HOME</li>
									<li>BUY</li>
									<li>SELL</li>
									<li>COMMERCIAL</li>
									<li>PROFESSIONAL FINDER</li>
									<li>MORTGAGE</li>
									<li>CACULATORS</li>
									<li>ADVICE</li>
									<li>ABOUT US</li>
									<li>NEWS</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div id="main-content">
				
			</div>
			<div id="footer">
				
			</div>
		</div>
	</div>
	

	<script type="text/javascript" src="{{ URL::asset('js/custom.js') }}"></script>
	<script type="text/javascript" src="{{ URL::asset('js/jquery-1.12.4.min.js') }}"></script>

</body>
</html>