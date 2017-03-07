<!DOCTYPE html>
<html>
<head>
	<title>Toronto Real Estate - @yield('title')</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="keywords" content="@yield('meta_keywords')">
	<meta name="description" content="@yield('meta_description')">

	<link href="{{ URL::asset('css/bootstrap.min.css') }}" media="all" rel="stylesheet" type="text/css" />
	<link href="{{ URL::asset('css/bootstrap-theme.min.css') }}" media="all" rel="stylesheet" type="text/css" />
	<link href="{{ URL::asset('css/style.css') }}" media="all" rel="stylesheet" type="text/css" />
	<link href="{{ URL::asset('css/font-awesome.min.css') }}" media="all" rel="stylesheet" type="text/css" />
	<link href="{{ URL::asset('css/owl.carousel.css') }}" media="all" rel="stylesheet" type="text/css" />
	<link href="{{ URL::asset('css/owl.carousel.min.css') }}" media="all" rel="stylesheet" type="text/css" />
	<link href="{{ URL::asset('css/owl.theme.default.min.css') }}" media="all" rel="stylesheet" type="text/css" />
	<link href="/css/app.css" rel="stylesheet">

	@yield('styles')

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
					<div class="modal-dialog modal-size-cs modal-login" role="document">
						<div class="modal-content">
							<div class="modal-header">
								{{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> --}}
								<h4 class="modal-title" id="myModalLabel">Modal Sign In</h4>
								<ul>
									<li><a href="" class="login_icon active"><i class="fa fa-sign-in" aria-hidden="true"></i></a></li>
									<li><a href="" class="register_icon"><i class="fa fa-plus" aria-hidden="true"></i></a></li>
									{{-- <li><a href="" class="recover_icon"><i class="fa fa-key" aria-hidden="true"></i></a></li>
									<li><a href="" class="mail_icon"><i class="fa fa-envelope-o" aria-hidden="true"></i></a></li> --}}
								</ul>
							</div>
							<div class="modal-body">
								<div class="modal-body-logo"><img src="{{ URL::asset('images/logo-sep.png') }}" class="img-responsive"></div>
								<p class="modal-name">Login Member</p>
			                    <form class="form-horizontal form-style" role="form" method="POST" action="{{ url('/login') }}">
			                        {{ csrf_field() }}
									
			                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
			                            <label for="username" class="control-label glyphicon glyphicon-user"></label>
		                                <input id="username" type="text" class="form-control style_input" name="username" value="{{ old('username') }}" required autofocus/>

		                                 @if ($errors->has('username'))
		                                <span class="help-block">
		                                    <strong>{{ $errors->first('username') }}</strong>
		                                </span>
		                            	@endif
			                            
			                        </div>

			                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
			                            <label for="password" class="control-label glyphicon glyphicon-lock"></label>
		                                <input id="password" type="password" class="form-control style_input" name="password" required>

		                                @if ($errors->has('password'))
		                                    <span class="help-block">
		                                        <strong>{{ $errors->first('password') }}</strong>
		                                    </span>
		                                @endif
			                            
			                        </div>

			                        {{-- <div class="form-group">
			                            <div class="col-md-6 col-md-offset-4">
			                                <div class="checkbox">
			                                    <label>
			                                        <input type="checkbox" name="remember"> Remember Me
			                                    </label>
			                                </div>
			                            </div>
			                        </div> --}}

			                        <div class="form-group">
			                            
		                                <button type="submit" class="btn btn-primary">
		                                    Sign In
		                                </button>

		                                {{-- <a class="btn btn-link" href="{{ url('/password/reset') }}">
		                                    Forgot Your Password?
		                                </a> --}}
			                            <div class="login_w_social">
			                            	<a href="" class="social_f"><i class="fa fa-facebook-square" aria-hidden="true"></i></a>
			                            	<a href="" class="social_t"><i class="fa fa-google-plus-square" aria-hidden="true"></i></a>
			                            </div>
			                        </div>
			                       
			                    </form>
					                
							</div>
						</div>
					</div>
				</div>
				<!-- End modal sign in -->

				<!-- modal sign up -->
				
				<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="modal_signup">
					<div class="modal-dialog modal-size-cs modal-sign-up" role="document">
						<div class="modal-content">
							<div class="modal-header">
								{{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> --}}
								<h4 class="modal-title" id="myModalLabel">Modal Sign Up</h4>
								<ul>
									<li><a href="" class="login_icon"><i class="fa fa-sign-in" aria-hidden="true"></i></a></li>
									<li><a href="" class="register_icon active"><i class="fa fa-plus" aria-hidden="true"></i></a></li>
									{{-- <li><a href="" class="recover_icon"><i class="fa fa-key" aria-hidden="true"></i></a></li>
									<li><a href="" class="mail_icon"><i class="fa fa-envelope-o" aria-hidden="true"></i></a></li> --}}
								</ul>
							</div>
							<div class="modal-body">
								
								<p class="modal-name">Register</p>
			                    <form class="form-horizontal form-style" role="form" method="POST" action="{{ url('/register') }}">
			                        {{ csrf_field() }}

			                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
			                            <label for="username" class="control-label"><i class="fa fa-user-o" aria-hidden="true"></i></label>

			                            
			                                <input id="username" type="text" class="form-control style_input" name="username" value="{{ old('username') }}" required autofocus>

			                                @if ($errors->has('username'))
			                                    <span class="help-block">
			                                        <strong>{{ $errors->first('username') }}</strong>
			                                    </span>
			                                @endif
			                            
			                        </div>

			                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
			                            <label for="email" class="control-label"><i class="fa fa-envelope-o" aria-hidden="true"></i></label>

			                            
			                                <input id="email" type="email" class="form-control style_input" name="email" value="{{ old('email') }}" required>

			                                @if ($errors->has('email'))
			                                    <span class="help-block">
			                                        <strong>{{ $errors->first('email') }}</strong>
			                                    </span>
			                                @endif
			                            
			                        </div>

			                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
			                            <label for="password" class="control-label"><i class="fa fa-lock" aria-hidden="true"></i></label>
		                                <input id="password" type="password" class="form-control style_input" name="password" required>

		                                @if ($errors->has('password'))
		                                    <span class="help-block">
		                                        <strong>{{ $errors->first('password') }}</strong>
		                                    </span>
		                                @endif
			                            
			                        </div>

			                        <div class="form-group">
			                            <label for="password-confirm" class="control-label"><i class="fa fa-lock" aria-hidden="true"></i></label>
		                                <input id="password-confirm" type="password" class="form-control style_input" name="password_confirmation" required>
			                            
			                        </div>

			                        <div class="form-group">
			                            
		                                <button type="submit" class="btn btn-primary">
		                                    Sign up
		                                </button>
			                            
			                        </div>
			                    </form>
					                
							</div>
						</div>
					</div>
				</div>

				<!-- End modal sign up -->

				@php
					if(!isset($menus) || !isset($menus_bot)) {
						$menus = App\Models\Menus::where(['parent_id' => 0, 'published' => 1, 'type' =>'top'])->get();
						$menus_bot = App\Models\Menus::where(['published' => 1, 'type' =>'bottom'])->get();
					}
				@endphp
				<div class="header_menu">
					<div class="container">
						<div class="row">
							<div class="col-sm-12 header_menu_content">
								<div class="hmc_show_menu">
									<i class="fa fa-bars" aria-hidden="true"></i>
								</div>
								<ul class="header_main_menu">
									@foreach ($menus as $menu)
										@php
											$sub_menu = App\Models\Menus::where(['parent_id' => $menu['id'], 'published' => 1, 'type' =>'top'])->get();
										@endphp
										@if(count($sub_menu) == 0)
											<li class="no_after"><a href="{{$menu['link']}}" target="{{$menu['target']}}">{{$menu['name']}}</a></li>
										@else
											<li>
												<a href="{{$menu['link']}}">{{$menu['name']}}</a>
												<ul class="header_sub_menu">
													@foreach ($sub_menu as $value)
														<li>
															<a href="{{$value['link']}}" target="{{$value['target']}}"><img src="{!!$value['icon']!!}" alt=""> {{$value['name']}}</a>
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
				@yield('banner')
			</div>
			<div id="main-content">
				@yield('content')
			</div>
			<div id="footer">
				<div class="footer_top">
					<div class="container">
						<div class="row">
							@foreach ($menus_bot as $m_bottom)
								@if($m_bottom->parent_id == 0)
									<div class="col-sm-6 col-md-3">
										<div class="footer_top_box">
											<h4>{{$m_bottom->name}}</h4>											
											<ul>
												@foreach($menus_bot as $value)
													@if($value->parent_id == $m_bottom->id)
														<li><a href="">{{$value->name}}</a></li>
														<!-- <li>
															<ul>
																<li><a href="">Barrie</a></li>
																<li><a href="">Blenheim</a></li>
																<li><a href="">Blenheim</a></li>
																<li><a href="">Cloyne</a></li>
															</ul>
															<span class="hp_show_link">More...</span>
														</li> -->
													@endif												
												@endforeach
											</ul>
										</div>
									</div>
								@endif
							@endforeach
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

			<div class="customizer">
				<div class="customizer-header">
					<img src="/images/contact-icon-17.png" alt="">
				</div>
				<div class="move_page_top"><i class="fa fa-angle-up"></i></div>
				<div class="customizer-content  closed">
					<h2>Connect with one of our professionals in your area</h2>
					<form action="sender" method="post">
					{{ csrf_field() }}
						<p>
							<label for="">YOUR NAME (REQUIRED)</label>
							<input name="name" type="text">
						</p>
						<p>
							<label for="">YOUR EMAIL (REQUIRED)</label>
							<input name="email" type="text">
						</p>
						<p>
							<label for="">YOUR PHONE (REQUIRED)</label>
							<input name="phone" type="text">
						</p>
						<p>
							<button>CONTACT US</button>
						</p>
					</form>
				</div>
			</div>

			<div class="select-search-options" id="select-search-options">
				<form class="ng-pristine ng-valid">
				    <div class="form-group">
				        <select class="form-control" id="sel1">
			        	  <option value="Sale">Available For Sale</option>
				          <option value="Rent">Available for Rent</option>
				        </select>
						
						<select class="form-control" name="salutation" id="salutation">
					      <option value="Residential">Residential</option>
				          <option value="Commercial">Commercial</option>
					    </select>
					    	
				    	<select class="form-control" name="bedroom" id="bedroom">
					        <option value="Any">Bedroom</option>
		                    <option value="1">1 Bedroom+</option>
				            <option value="2">2 Bedroom+</option>
				            <option value="3">3 Bedroom+</option>
				            <option value="4">4 Bedroom+</option>
				            <option value="5">5 Bedroom+</option>
					    </select>

					    <select class="form-control" name="bathroom" id="bathroom">
					      	<option value="Any">Bathroom</option>
		                    <option value="1">1 Bathroom</option>
				            <option value="1.5">1.5 Bathroom</option>
				            <option value="2">2 Bathroom</option>
				            <option value="2.5">2.5 Bathroom</option>
				            <option value="3">3 Bathroom</option>
				            <option value="3.5">3.5 Bathroom</option>
				            <option value="4">4 Bathroom</option>
				            <option value="4.5">4.5 Bathroom</option>
				            <option value="5">5 Bathroom</option>
				            <option value="5.5">5.5 Bathroom</option>
				            <option value="6">&gt; 6 Bathroom</option>
					    </select>

					    <select class="form-control" name="price" id="price">
					      	<option value="Any">Price</option>
		                    <optgroup id="rentprice" label="Rent/Lease">
		            			<option class="rent_options" value="0-400">$0 - $400</option>
								<option class="rent_options" value="400-800">$400 - $800</option>
								<option class="rent_options" value="800-1000">$800 - $1000</option>
								<option class="rent_options" value="1000-1200">$1000 - $1200</option>
								<option class="rent_options" value="1200-1500">$1200 - $1500</option>
								<option class="rent_options" value="1500-2000">$1500 - $2000</option>
								<option class="rent_options" value="2000-2500">$2000 - $2500</option>
								<option class="rent_options" value="2500-Above">$2500 - Above</option>
			            	</optgroup>
							<optgroup id="sellprice" label="Sale">
						        <option value="0-50K">$0 - $50K</option>
						        <option value="50K-100K">$50K - $100K</option>
						        <option value="100K-250K">$100K - $250K</option>
						        <option value="250K-500K">$250K - $500K</option>
						        <option value="500K-750K">$500K - $750K</option>
						        <option value="750K-1M">$750K - $1M</option>
						        <option value="1M-Above">$1M - Above</option>
						    </optgroup>
					    </select>
		                
		                <select class="form-control" name="pricen" id="rePricen" style="display:none">
					      	<option value="Any">Price</option>
		                    <optgroup id="rentpricen" label="Rent/Lease">
		            			<option class="rent_options" value="0-500">$0 - $500</option>
								<option class="rent_options" value="500-1000">$500 - $1000</option>
								<option class="rent_options" value="1000-1500">$1000 - $1500</option>
								<option class="rent_options" value="1500-2000">$1500 - $2000</option>
								<option class="rent_options" value="2000-1500">$2000 - $2500</option>
								<option class="rent_options" value="2500-3000">$2500 - $3000</option>
								<option class="rent_options" value="3000-3500">$3000 - $3500</option>
								<option class="rent_options" value="4000-Above">$4000 - Above</option>
			            	</optgroup>
							<optgroup id="sellpricen" label="Sale">
						        <option value="0-50K">$0 - $50K</option>
						        <option value="50K-100K">$50K - $100K</option>
						        <option value="100K-250K">$100K - $250K</option>
						        <option value="250K-500K">$250K - $500K</option>
						        <option value="500K-750K">$500K - $750K</option>
						        <option value="750K-1M">$750K - $1M</option>
						        <option value="1M-Above">$1M - Above</option>
						    </optgroup>
					    </select>
		                <input type="button" class="moresrc" value="Search" onclick="javascript:jQuery('#home-search-frm').submit()">
				    </div>
			  	</form>

			</div>
		</div>
	</div>
	

	<script type="text/javascript" src="{{ URL::asset('js/custom.js') }}"></script>
	<script type="text/javascript" src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
	<script type="text/javascript" src="{{ URL::asset('js/owl.carousel.min-org.js') }}"></script>
	<script type="text/javascript" src="{{ URL::asset('js/owl.carousel.min.js') }}"></script>
	<script type="text/javascript" src="{{ URL::asset('js/typed.js') }}"></script>
	<script type="text/javascript" src="{{ URL::asset('js/jssor.slider-21.1.6.mini.js') }}"></script>
	@yield('script')

</body>
</html>