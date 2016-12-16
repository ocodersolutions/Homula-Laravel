<!DOCTYPE html>
<html>
<head>
	<title>Toronto Real Estate - @yield('title')</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link href="{{ URL::asset('css/bootstrap.min.css') }}" media="all" rel="stylesheet" type="text/css" />
	<link href="{{ URL::asset('css/bootstrap-theme.min.css') }}" media="all" rel="stylesheet" type="text/css" />
	<link href="{{ URL::asset('css/style.css') }}" media="all" rel="stylesheet" type="text/css" />
	<link href="{{ URL::asset('css/font-awesome.min.css') }}" media="all" rel="stylesheet" type="text/css" />
	<link href="/css/app.css" rel="stylesheet">

	<script type="text/javascript" src="{{URL::asset('js/jquery-1.12.4.min.js')}}"></script>
	<script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>

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
										<a href=""><img src="{{ URL::asset('images/logo-sep.png') }}" class="img-responsive"></a>
									</div>
									<div class="col-sm-4 header_top_account">
									@if(Auth::guest())
										<span data-toggle="modal" data-target="#modal_signin">SIGN IN</span>
										<i class="fa fa-plus" aria-hidden="true"></i>
										<span data-toggle="modal" data-target="#modal_signup">SIGN UP</span>
									@else
										<span><a href="/profile">My profile</a></span>
										<i class="fa fa-plus" aria-hidden="true"></i>
										<span>
											<a href="{{ url('/logout') }}"
	                                            onclick="event.preventDefault();
	                                                     document.getElementById('logout-form').submit();">
	                                            Logout
	                                        </a>
	                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
	                                            {{ csrf_field() }}
	                                        </form>
										</span>
									@endif
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
				<!-- modal sign in -->
				
				<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="modal_signin">
					<div class="modal-dialog modal-lg" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title" id="myModalLabel">Modal Sign In</h4>
							</div>
							<div class="modal-body">
								<div class="panel panel-default">
					                <div class="panel-heading">Login</div>
					                <div class="panel-body">
					                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
					                        {{ csrf_field() }}

					                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
					                            <label for="username" class="col-md-4 control-label">Username</label>

					                            <div class="col-md-6">
					                                <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" required autofocus>

					                                 @if ($errors->has('username'))
					                                <span class="help-block">
					                                    <strong>{{ $errors->first('username') }}</strong>
					                                </span>
					                            @endif
					                            </div>
					                        </div>

					                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
					                            <label for="password" class="col-md-4 control-label">Password</label>

					                            <div class="col-md-6">
					                                <input id="password" type="password" class="form-control" name="password" required>

					                                @if ($errors->has('password'))
					                                    <span class="help-block">
					                                        <strong>{{ $errors->first('password') }}</strong>
					                                    </span>
					                                @endif
					                            </div>
					                        </div>

					                        <div class="form-group">
					                            <div class="col-md-6 col-md-offset-4">
					                                <div class="checkbox">
					                                    <label>
					                                        <input type="checkbox" name="remember"> Remember Me
					                                    </label>
					                                </div>
					                            </div>
					                        </div>

					                        <div class="form-group">
					                            <div class="col-md-8 col-md-offset-4">
					                                <button type="submit" class="btn btn-primary">
					                                    Login
					                                </button>

					                                <a class="btn btn-link" href="{{ url('/password/reset') }}">
					                                    Forgot Your Password?
					                                </a>
					                            </div>
					                        </div>
					                    </form>
					                </div>
					            </div>
							</div>
						</div>
					</div>
				</div>
				<!-- End modal sign in -->

				<!-- modal sign up -->
				
				<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="modal_signup">
					<div class="modal-dialog modal-lg" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title" id="myModalLabel">Modal Sign Up</h4>
							</div>
							<div class="modal-body">
								<div class="panel panel-default">
                					<div class="panel-heading">Register</div>
					                <div class="panel-body">
					                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
					                        {{ csrf_field() }}

					                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
					                            <label for="username" class="col-md-4 control-label">Username</label>

					                            <div class="col-md-6">
					                                <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" required autofocus>

					                                @if ($errors->has('username'))
					                                    <span class="help-block">
					                                        <strong>{{ $errors->first('username') }}</strong>
					                                    </span>
					                                @endif
					                            </div>
					                        </div>

					                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
					                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

					                            <div class="col-md-6">
					                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

					                                @if ($errors->has('email'))
					                                    <span class="help-block">
					                                        <strong>{{ $errors->first('email') }}</strong>
					                                    </span>
					                                @endif
					                            </div>
					                        </div>

					                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
					                            <label for="password" class="col-md-4 control-label">Password</label>

					                            <div class="col-md-6">
					                                <input id="password" type="password" class="form-control" name="password" required>

					                                @if ($errors->has('password'))
					                                    <span class="help-block">
					                                        <strong>{{ $errors->first('password') }}</strong>
					                                    </span>
					                                @endif
					                            </div>
					                        </div>

					                        <div class="form-group">
					                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

					                            <div class="col-md-6">
					                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
					                            </div>
					                        </div>

					                        <div class="form-group">
					                            <div class="col-md-6 col-md-offset-4">
					                                <button type="submit" class="btn btn-primary">
					                                    Register
					                                </button>
					                            </div>
					                        </div>
					                    </form>
					                </div>
					            </div>
							</div>
						</div>
					</div>
				</div>
				<!-- End modal sign up -->
				<div class="header_menu">
					<div class="container">
						<div class="row">
							<div class="col-sm-12 header_menu_content">
								<ul class="header_main_menu">
									<li><a href="">HOME</a></li>
									<li>
										<a href="">BUY</a>
										<ul class="header_sub_menu">
											<li>
												<a href=""><img src="{{url::asset('images/resales-home.png')}}" alt="">RESALES HOME</a>
											</li>
											<li>
												<a href=""><img src="{{url::asset('images/new-construction-home.png')}}" alt="">NEW CONSTRUCTION HOME</a>
											</li>
											<li>
												<a href=""><img src="{{url::asset('images/new-construction-condo.png')}}" alt="">NEW CONSTRUCTION CONDO</a>
											</li>
											<li>
												<a href=""><img src="{{url::asset('images/exclusive-home.png')}}" alt="">EXCLUSIVE HOMES</a>
											</li>
											<li>
												<a href=""><img src="{{url::asset('images/open-house.png')}}" alt="">OPEN HOUSE</a>
											</li>
											<li>
												<a href=""><img src="{{url::asset('images/coming-soon.png')}}" alt="">COMING SOON</a>
											</li>
											<li>
												<a href=""><img src="{{url::asset('images/business-homula.png')}}" alt="">BUSINESS</a>
											</li>
											<li class="clr"></li>
										</ul>
									</li>
									<li>
										<a href="">SELL</a>
										<ul class="header_sub_menu">
											<li>
												<a href=""><img src="{{url::asset('images/free-home-evluation-homula.png')}}" alt="">FREE HOME EVAVLUATION</a>
											</li>
											<li>
												<a href=""><img src="{{url::asset('images/free-home-report-homula.png')}}" alt="">FREE HOME REPORT</a>
											</li>
											<li>
												<a href=""><img src="{{url::asset('images/find-retailer-copy.png')}}" alt="">FIND A REALTOR</a>
											</li>
											<li>
												<a href=""><img src="{{url::asset('images/list-my-home-homula.png')}}" alt="">LIST MY HOUSE</a>
											</li>
											<li class="clr"></li>
										</ul>
									</li>
									<li>
										<a href="">LEASE</a>
										<ul class="header_sub_menu">
											<li>
												<a href=""><img src="{{url::asset('images/search-copy.png')}}" alt="">LEASE SEARCH</a>
											</li>
											<li>
												<a href=""><img src="{{url::asset('images/search-copy.png')}}" alt="">MAP SEARCH</a>
											</li>
											<li>
												<a href=""><img src="{{url::asset('images/search-copy.png')}}" alt="">COMMERCIAL SEARCH</a>
											</li>
											<li>
												<a href=""><img src="{{url::asset('images/business-copy.png')}}" alt="">BUSINESS</a>
											</li>
											<li>
												<a href=""><img src="{{url::asset('images/utility-copy.png')}}" alt="">UTILITY</a>
											</li>
											<li>
												<a href=""><img src="{{url::asset('images/search-copy.png')}}" alt="">SEARCH</a>
											</li>
											<li class="clr"></li>
										</ul>
									</li>
									<li>
										<a href="">COMMERCIAL</a>
										<ul class="header_sub_menu">
											<li>
												<a href=""><img src="{{url::asset('images/search-2.png')}}" alt="">SEARCH</a>
											</li>
											<li>
												<a href=""><img src="{{url::asset('images/ad-search2.png')}}" alt="">ADVANCED SEARCH</a>
											</li>
											<li>
												<a href=""><img src="{{url::asset('images/home-listing2.png')}}" alt="">LIST YOUR PROPERTY</a>
											</li>
											<li>
												<a href=""><img src="{{url::asset('images/find-retaile2.png')}}" alt="">FIND A COMMERCIAL REALTOR</a>
											</li>
											<li class="clr"></li>
										</ul>
									</li>
									<li>
										<a href="">PROFESSIONAL FINDER</a>
										<ul class="header_sub_menu">
											<li>
												<a href=""><img src="{{url::asset('images/real-estate-professiona-homula.png')}}" alt="">REAL ESTATE PROFESSIONAL</a>
											</li>
											<li>
												<a href=""><img src="{{url::asset('images/leasing-agent1-homula.png')}}" alt="">LEASING AGENT</a>
											</li>
											<li>
												<a href=""><img src="{{url::asset('images/Mortage-broker-copy.png')}}" alt="">MORTGAGE BROKER</a>
											</li>
											<li>
												<a href=""><img src="{{url::asset('images/homeinspector-homula.png')}}" alt="">HOME INSPECTOR</a>
											</li>
											<li>
												<a href=""><img src="{{url::asset('images/lawyer-homula.png')}}" alt="">REAL ESTATE LAWYER</a>
											</li>
											<li>
												<a href=""><img src="{{url::asset('images/appraiser-homula.png')}}" alt="">APPRAISER</a>
											</li>
											<li>
												<a href=""><img src="{{url::asset('images/property-management-homula.png')}}" alt="">PROPERTY MANAGEMENT</a>
											</li>
											<li>
												<a href=""><img src="{{url::asset('images/home-stagers-homula.png')}}" alt="">HOME STAGERS</a>
											</li>
											<li>
												<a href=""><img src="{{url::asset('images/insurance-broker-homula.png')}}" alt="">INSURANCE BROKERS</a>
											</li>
											<li>
												<a href=""><img src="{{url::asset('images/moving-company-homula.png')}}" alt="">MOVING COMPANY</a>
											</li>
											<li>
												<a href=""><img src="{{url::asset('images/photographers-reps-homula.png')}}" alt="">GRAPHIC DESIGNER</a>
											</li>
											<li>
												<a href=""><img src="{{url::asset('images/lawyer1-homula.png')}}" alt="">LAWYERS(FIRMS)</a>
											</li>
											<li>
												<a href=""><img src="{{url::asset('images/sign-supplir-copy.png')}}" alt="">SIGN SUPPLIERS</a>
											</li>
											<li>
												<a href=""><img src="{{url::asset('images/shape-homula.png')}}" alt="">SIGN INSTALLERS</a>
											</li>
											<li>
												<a href=""><img src="{{url::asset('images/printer-homula.png')}}" alt="">PRINTERS</a>
											</li>
											<li>
												<a href=""><img src="{{url::asset('images/photographer-homula.png')}}" alt="">PHOTOGRAPHERS (PROPERTIES)</a>
											</li>
											<li>
												<a href=""><img src="{{url::asset('images/photographers-reps-homula.png')}}" alt="">PHOTOGRAPHERS (REPS)</a>
											</li>
											<li class="clr"></li>
										</ul>
									</li>
									<li>
										<a href="">MORTGAGE</a>
										<ul class="header_sub_menu">
											<li>
												<a href=""><img src="{{url::asset('images/Mortage-broker-copy.png')}}" alt="">MORTGAGE BROKER</a>
											</li>
											<li>
												<a href=""><img src="{{url::asset('images/mortgage-insurance-calculator-copy.png')}}" alt="">MORTGAGE INSURANCE CALCULATOR</a>
											</li>
											<li>
												<a href=""><img src="{{url::asset('images/mortage-rates-copy.png')}}" alt="">MORTGAGE RATGES</a>
											</li>
											<li>
												<a href=""><img src="{{url::asset('images/mortage-calculater-copy.png')}}" alt="">NEW MORTGAGE CALCULATOR</a>
											</li>
											<li class="clr"></li>
										</ul>
									</li>
									<li>
										<a href="">CACULATORS</a>
										<ul class="header_sub_menu">
											<li>
												<a href=""><img src="{{url::asset('images/mortage-calculater-copy.png')}}" alt="">MORTGAGE CALCULATOR</a>
											</li>
											<li>
												<a href=""><img src="{{url::asset('images/mortgage-insurance-calculator-copy.png')}}" alt="">MORTGAGE INSURANCE CALCULATOR</a>
											</li>
											<li>
												<a href=""><img src="{{url::asset('images/land-transfer-tax-calculator-copy.png')}}" alt="">LAND TRANSFER TAX CALCULATOR</a>
											</li>
											<li>
												<a href=""><img src="{{url::asset('images/land-transfer-tax-calculator-copy.png')}}" alt="">ONTARIO MORTGAGE CALCULATOR</a>
											</li>
											<li class="clr"></li>
										</ul>
									</li>
									<li>
										<a href="">ADVICE</a>
										<ul class="header_sub_menu">
											<li>
												<a href=""><img src="{{url::asset('images/faq-1.png')}}" alt="">FAQ</a>
											</li>
											<li>
												<a href=""><img src="{{url::asset('images/Ask-a-question.png')}}" alt="">ASK A QUESTION</a>
											</li>
											<li>
												<a href=""><img src="{{url::asset('images/help-center-copy.png')}}" alt="">HELP CENTRE</a>
											</li>
											<li>
												<a href=""><img src="{{url::asset('images/contact.png')}}" alt="">CONTACT US</a>
											</li>
											<li class="clr"></li>
										</ul>
									</li>
									<li><a href="">ABOUT US</a></li>
									<li>
										<a href="">NEWS</a>
										<ul class="header_sub_menu">
											<li>
												<a href=""><img src="{{url::asset('images/news1.png')}}" alt="">REALESTATE MARKET</a>
											</li>
											<li>
												<a href=""><img src="{{url::asset('images/news2.png')}}" alt="">WEEKLY BLOG</a>
											</li>
											<li>
												<a href=""><img src="{{url::asset('images/toronto-realestate.png')}}" alt="">TORONTO REALESTATE</a>
											</li>
											<li>
												<a href=""><img src="{{url::asset('images/news1.png')}}" alt="">MLS LISTING</a>
											</li>
											<li class="clr"></li>
										</ul>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="header_bot">
					<div class="header_bot_video">
						<!-- <video id="cover-video" preload="metadata" autoplay="" muted="" loop="">
							<source src="http://preview.byaviators.com/theme/realsite/wp-content/uploads/2015/03/Houses_1-5_720p_h264_30rf_wo.mp4" type="video/mp4">
						</video> -->
						<h1>HOMULA IS THE REAL-ESTATE FOMULA</h1>
						<!-- <div class="header_search">
							<ul>
								<li>
									<p>GTA</p>
									<span>(LOGIN REQUIRED)</span>
								</li>
								<li>
									<p>Ontario</p>
									<span>(TREB)</span>
								</li>
								<li>
									<p>Canada</p>
								</li>
								<li>
									<p>International</p>
								</li>
								<li>
									<p>New House</p>
								</li>
								<li>
									<p>New Condo</p>
								</li>
							</ul>
							<form action="" method="get">
								<input type="text" placeholder="Enter your address or postal code">
								<input type="submit" value="SEARCH">
								<span>SEARCH OPTION</span>
							</form>
						</div> -->
					</div>
				</div>
			</div>
			<div id="main-content">
				@yield('content')
			</div>
			<div id="footer">
				<div class="footer_top">
					<div class="container">
						<div class="row">
							<div class="col-sm-6 col-md-3">
								<div class="footer_top_box">
									<h4>HOT PROPERTIES</h4>
									<ul>
										<li><a href="">Toronto</a></li>
										<li><a href="">Brampton</a></li>
										<li><a href="">Burlington</a></li>
										<li><a href="">Guelph</a></li>
										<li><a href="">Hamilton</a></li>
										<li><a href="">Richmond Hill</a></li>
										<li>More...</li>
									</ul>
								</div>
							</div>
							<div class="col-sm-6 col-md-3">
								<div class="footer_top_box">
									<h4>HOT RENTALS</h4>
									<ul>
										<li><a href="">Toronto</a></li>
										<li><a href="">Richmond Hill</a></li>
										<li><a href="">Mississauga</a></li>
										<li><a href="">Markham</a></li>
										<li><a href="">Barrie</a></li>
										<li><a href="">Brockville</a></li>
										<li>More...</li>
									</ul>
								</div>
							</div>
							<div class="col-sm-6 col-md-3">
								<div class="footer_top_box">
									<h4>MORTGAGE RATES</h4>
									<ul>
										<li><a href="">Mortgage Insurance Calculator</a></li>
										<li><a href="">Land Transfer Tax Calculator</a></li>
										<li><a href="">Mortgage Broker</a></li>
										<li><a href="">Mortgage Rates</a></li>
										<li><a href="">New Mortgage Calculators</a></li>
									</ul>
								</div>
							</div>
							<div class="col-sm-6 col-md-3">
								<div class="footer_top_box">
									<h4>BROWSE HOMES</h4>
									<ul>
										<li><a href="">Resale Homes</a></li>
										<li><a href="">New Construction Home</a></li>
										<li><a href="">Free Home Evaluation</a></li>
										<li><a href="">Canada Search</a></li>
										<li><a href="">All Ontario Properties</a></li>
										<li><a href="">Sitemap Index</a></li>
									</ul>
								</div>
							</div>
							<div class="col-sm-12 footer_divider">
								<img src="{{ url::asset('images/fdivider.png') }}" alt="">
							</div>
						</div>
					</div>
				</div>
				<div class="footer_bot">
					<div class="container">
						<div class="row">
							<div class="col-sm-12">
								<div class="fb_box_one">
									<span>ROYAL LEPAGE TERREQUITY REALTY BROKERAGE</span>
									<a href="">LEGAL</a>
									<a href="">PRIVACY POLICY</a>
								</div>
								<div class="fb_box_two">
									<span>Copyright <i class="fa fa-copyright" aria-hidden="true"></i> 2016 Homula Real Estate. All Rights Reserved.</span>
									<a href=""><i class="fa fa-twitter" aria-hidden="true"></i></a>
									<a href=""><i class="fa fa-facebook" aria-hidden="true"></i></a>
									<a href=""><i class="fa fa-google-plus" aria-hidden="true"></i></a>
									<a href=""><i class="fa fa-linkedin" aria-hidden="true"></i></a>
									<a href=""><i class="fa fa-instagram" aria-hidden="true"></i></a>
									<a href=""><i class="fa fa-youtube" aria-hidden="true"></i></a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	

	<script type="text/javascript" src="{{ URL::asset('js/custom.js') }}"></script>
	<script type="text/javascript" src="{{ URL::asset('js/jquery-1.12.4.min.js') }}"></script>
	<script type="text/javascript" src="{{ URL::asset('js/bootstrap.min.js') }}"></script>

</body>
</html>