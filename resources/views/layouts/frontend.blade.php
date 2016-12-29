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
										<a href="/"><img src="{{ URL::asset('images/logo-sep.png') }}" class="img-responsive"></a>
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
									@php 
										$menus = App\Models\Menus::where(['parent_id' => 0, 'published' => 1])->get();
									@endphp
									@foreach ($menus as $menu)
										@php
											$sub_menu = App\Models\Menus::where(['parent_id' => $menu['id'], 'published' => 1])->get();
										@endphp
										@if(count($sub_menu) == 0)
											<li class="no_after"><a href="{{$menu['link']}}" target="{{$menu['target']}}">{{$menu['name']}}</a></li>
										@else
											<li>
												<a href="{{$menu['link']}}">{{$menu['name']}}</a>
												<ul class="header_sub_menu">
													@foreach ($sub_menu as $value)
														<li>
															<a href="{{$value['link']}}">{!!$value['icon']!!} {{$value['name']}}</a>
														</li>
													@endforeach
													<li class="clr"></li>
												</ul>
											</li>
										@endif
									@endforeach									
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="header_bot">
					<div class="header_bot_video">
						<h1>HOMULA IS THE REAL-ESTATE FOMULA</h1>
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