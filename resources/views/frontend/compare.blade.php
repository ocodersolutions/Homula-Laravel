@extends('layouts.frontend')

@section('title', 'Homepage')

@section('content')
<style type="text/css">
	ul {
	    padding: 0;
	}
	.container{
		padding-bottom: 55px;
	}
	.fa{
		color: #223c6e;
	}
	hr{
		border-top: 1px solid #cecece;
		margin-top: 10px;
		margin-bottom: 10px;
	}
	.share{
		float: right;
	}
	.share .fa{
		font-size: 15px;
		letter-spacing: 7px;
	}
	.title-property{
		color: #0a368a;
		font-weight: bold;
    	text-transform: uppercase;
    	font-size: 15px;
    	margin-bottom: 0px;
	}
	.slider{
		position: relative;
		height: 450px;
	}
	.slider span.virtual-tour{
		background: #039be5;
	    padding: 10px;
	    color: #fff;
	    text-transform: uppercase;
	    font-weight: bold;
	    position: absolute;
	    right: 0;
    	top: 0;
    	margin: 20px 22px 0px 0px;
	}
	.title-box h4{
		color: #0a368a;
	    text-transform: uppercase;
	    font-weight: bold;
	    font-size: 15px;
	    margin: 20px auto;
	}
	.wrap-box{
		border: 1px solid #7584a2;
		padding: 12px;
		background: #fff;
	}
	.thumb{
		width: 40%;
	    float: left;
	}
	.info{
		width: 60%;
		float: right;
	}
	.info span{
		font-weight: bold;
	}
	.nav-tabs {
    	border: 0px;
	}
	.nav-tabs>li.active>a, .nav-tabs>li.active>a:focus, .nav-tabs>li.active>a:hover{
		background-color: #0a368a;
		color: #fff;
		text-transform: uppercase;
	}
	.nav-tabs>li {
	    margin-right: 3px;
	    border: 1px solid #cacaca;
	}
	.nav-tabs>li>a{
		border-radius: 0;
		margin: 0;
		text-transform: uppercase;
		color: #0a368a;
	}
	.tab-content>.active {
	    border: 1px solid #6681b3;
	    padding: 20px;
	}
	.list-pane ul{
		padding: 0;
	}
	.list-pane ul li{
		line-height: 28px;
	}
	.list-pane span{
		font-weight: bold;
    	display: block;
    	float: left;
	}
	.list-pane.left{
		width: 50%;
    	float: left;
	}
	.list-pane.left span{
		width: 105px;
	}
	.list-pane.right{
		width: 50%;
    	float: right;
	}
	.list-pane.right span{
		width: 175px;
	}
	.features{
		margin-top: 40px;
	}
	.box-info{
		background: #fff;
	}
	.box-info.score{
		margin-top: 40px;
		margin-bottom: 80px;
	}
	.box-info.score h4{
		float: left;
	}
	.title-special{
		color: #0a368a;
	    text-transform: uppercase;
	    font-weight: bold;
	    font-size: 15px;
	}
	.title-special span{
		font-weight: normal;
	}
	.wrap-list{
		border: 1px solid #6681b3;
   	 	display: block;
	}
	.wrap-list .border-score{
    	border: 12px solid #ecf0f2;
	}
	.wrap-list .border-score ul{
		border:  1px solid #d0d3d5;
		padding: 10px;
		margin-bottom: 0;
	}
	.border-score span{
		font-weight: bold;
	}
	.border-score hr{
		margin: 0;
	}
	.border-score li{
		padding-left: 20px;
	}
	.fa.fa-angle-right{
		float: right;
    	font-size: 30px;
    	line-height: 5px;
	}
	.map{
		border: 1px solid;
    	margin-top: 10px;
	}
	.related{
		width: 48%;
	}
	.related.left{
		float: left;
	}
	.related.right{
		float: right;
	}
	.wrap-related{
		padding: 10px;
		border: 1px solid #7584a2;
		background: #fff;
	}
	.title-related{
		text-transform: uppercase;
	    font-weight: bold;
	    color: #000;
	    background: #fff;
	}
	.shadow{
		z-index: 0;
    	position: relative;
	}
	.shadow:before, .shadow:after{
		content: "";
	    position: absolute;
	    z-index: -1;
	    box-shadow: 0 0 15px rgba(0,0,0,0.8);
	    top: 96%;
	    bottom: 2px;
	    left: 12%;
	    right: 12%;
	    border-radius: 100% / 10px;
	}
</style>

	<div class="container">
	<div class="row" style="text-align: center;"><a href="/compare/remove-all"><button>Remove all sesson</button></a> </div>
		<div class="row">
			<div class="col-md-6">
				<div class="top-compare">
					<h2 class="title-property">170 Owen BLVD, Toronto, M2P1G7, Ontario</h2>
					<p>Jacksonville, Florida 
					<span class="share">Share this: <i class="fa fa-facebook-square" aria-hidden="true"></i><i class="fa fa-twitter-square" aria-hidden="true"></i><i class="fa fa-google-plus-square" aria-hidden="true"></i></span></p>
					<button>Remove this properties</button>
					<hr>
				</div>
				<div class="slider">
			    <link href="/sl/css/slider.css" rel="stylesheet">
				<script src="/sl/js/jquery-1.11.3.min.js" type="text/javascript" data-library="jquery" data-version="1.11.3"></script>
			    <script src="/sl/js/jssor.slider-22.0.15.mini.js" type="text/javascript" data-library="jssor.slider.mini" data-version="22.0.15"></script>
			    <script src="/sl/js/custom.js" type="text/javascript" ></script>
				<div id="jssor_1" style="position: relative; margin: 0 auto; top: 0px; left: 0px; width: 600px; height: 300px; overflow: visible; visibility: hidden;">
				        <!-- Loading Screen -->
				        <div data-u="loading" style="position: absolute; top: 0px; left: 0px;">
				            <div style="filter: alpha(opacity=70); opacity: 0.7; position: absolute; display: block; top: 0px; left: 0px; width: 100%; height: 100%;"></div>
				            <div style="position:absolute;display:block;background:url('sl/img/loading.gif') no-repeat center center;top:0px;left:0px;width:100%;height:100%;"></div>
				        </div>
				        <div data-u="slides" style="cursor: default; position: relative; top: 0px; left: 0px; width: 600px; height: 335px; overflow: hidden;">
				            <div data-p="112.50">
				                <img data-u="image" src="/sl/img/002.jpg" />
				                <img data-u="thumb" src="/sl/img/002.jpg" />
				            </div>
				            <div data-p="112.50" style="display:none;">
				                <img data-u="image" src="/sl/img/003.jpg" />
				                <img data-u="thumb" src="/sl/img/003.jpg" />
				            </div>
				            <div data-p="112.50" style="display:none;">
				                <img data-u="image" src="/sl/img/004.jpg" />
				                <img data-u="thumb" src="/sl/img/004.jpg" />
				            </div>
				            <div data-p="112.50" style="display:none;">
				                <img data-u="image" src="/sl/img/005.jpg" />
				                <img data-u="thumb" src="/sl/img/005.jpg" />
				            </div>
				            <div data-p="112.50" style="display:none;">
				                <img data-u="image" src="/sl/img/006.jpg" />
				                <img data-u="thumb" src="/sl/img/006.jpg" />
				            </div>
				            <div data-p="112.50" style="display:none;">
				                <img data-u="image" src="/sl/img/007.jpg" />
				                <img data-u="thumb" src="/sl/img/007.jpg" />
				            </div>
				            <div data-p="112.50" style="display:none;">
				                <img data-u="image" src="/sl/img/008.jpg" />
				                <img data-u="thumb" src="/sl/img/008.jpg" />
				            </div>
				            <div data-p="112.50" style="display:none;">
				                <img data-u="image" src="/sl/img/009.jpg" />
				                <img data-u="thumb" src="/sl/img/009.jpg" />
				            </div>
				            <div data-p="112.50" style="display:none;">
				                <img data-u="image" src="/sl/img/010.jpg" />
				                <img data-u="thumb" src="/sl/img/010.jpg" />
				            </div>
				            <div data-p="112.50" style="display:none;">
				                <img data-u="image" src="/sl/img/011.jpg" />
				                <img data-u="thumb" src="/sl/img/011.jpg" />
				            </div>
				            <a data-u="any" href="http://www.jssor.com" style="display:none">Image Slider 2</a>
				        </div>
				        <!-- Thumbnail Navigator -->
				        <div data-u="thumbnavigator" class="jssort03" style="position:absolute;left:0px;bottom:-175px;width:600px;height:135px;" data-autocenter="1">
				            <div style="position: absolute; top: 0; left: 0; width: 100%; height:100%; filter:alpha(opacity=30.0); opacity:0.3;"></div>
				            <!-- Thumbnail Item Skin Begin -->
				            <div data-u="slides" style="cursor: default;height: 142px!important;">
				                <div data-u="prototype" class="p">
				                    <div class="w">
				                        <div data-u="thumbnailtemplate" class="t"></div>
				                    </div>
				                    <div class="c"></div>
				                </div>
				            </div>
				            <!-- Thumbnail Item Skin End -->
				        </div>
				        <!-- Arrow Navigator -->
				        <span data-u="arrowleft" class="jssora02l" style="top:355px;left:0;width:55px;height:55px;" data-autocenter="2"><i class="fa fa-angle-left" aria-hidden="true"></i></span>
				        <span data-u="arrowright" class="jssora02r" style="top:355px;right:0;width:55px;height:55px;" data-autocenter="2"><i class="fa fa-angle-right" aria-hidden="true"></i></span>
				    </div>

				</div>
				<div class="shadow">
					<div class="box-info">
						<div class="title-box">
							<h4><i class="fa fa-check-square" aria-hidden="true"></i> Property Overview</h4> <hr>
							<div class="wrap-box">
								<div class="thumb">
									<img class="img-responsive" src="/images/thumb.png">
								</div>
								<div class="info">
									<ul>
										<li><i class="fa fa-usd" aria-hidden="true"></i><span> Price: </span> 500000.00</li>
										<li><i class="fa fa-map-marker" aria-hidden="true"></i><span> Location: </span> Ontario, M2P1G7</li>
										<li><i class="fa fa-bed" aria-hidden="true"></i><span> Bedrooms: </span> 4</li>
										<li><i class="fa fa-bath" aria-hidden="true"></i><span> Total Baths: </span> 6</li>
										<li><span>Extra: </span> Subzero F/F, Dacor Oven, 4 Burner Gas Ctop, Miele Dw, Kenmore W&D. 2Gb+E. Cac. CvacSubzero F/F, Dacor Oven, 4 Burner Gas Ctop, Miele Dw, Kenmore W&D. 2Gb+E. </li>
									</ul>
								</div>
								<div class="clearfix"></div>
							</div>
						</div>
					</div>
				</div>
				<div class="shadow">
					<div class="box-info">
						<div class="title-box">
							<h4><i class="fa fa-check-square" aria-hidden="true"></i> Description</h4> <hr>
							<div class="wrap-box">
								Custom Built Residence By Acclaimed Hovan Homes On One Of St. Andrew’s Most Desired Streets! Situated On An Exceptionally Deep Lot W/Lush Greenery, This Fabulous Family Home Features Graciously Proportioned Rms. Chef’s Kitch W/Stn.Stl Appls, Island, Granite Counters, & Huge Brkfst Area. Lrg Private Library. Mstr Suite W/Sitting Area, Fp, W/I Clsts & 6Pc Ens. Lwr Lvl W/Gar Access, Mud Rm, Nanny Suite, Rec Rm, Wet Bar & Games Rm. Steps To Schools, Ttc & Shops.
								<div class="clearfix"></div>
							</div>
						</div>
					</div>
				</div>
				<div class="shadow">
					<div class="box-info features">
					  <ul class="nav nav-tabs">
					    <li class="active"><a data-toggle="tab" href="#left1">Basic features</a></li>
					    <li><a data-toggle="tab" href="#left2">Advanced features</a></li>
					    <li><a data-toggle="tab" href="#left3">Amenities</a></li>
					  </ul><hr>
					  <div class="tab-content">
					    <div id="left1" class="tab-pane fade in active">
					      <div class="list-pane left">
					      	<ul>
					      		<li><span> Status: </span> A</li>
					      		<li><span>State: </span>Ontario</li>
					      		<li><span>Address: </span>170 Owen blvd</li>
					      		<li><span>Area: </span>Toronto</li>
					      		<li><span>Bedrooms: </span>4</li>
					      		<li><span>Community: </span>st. Andrew-Windfields</li>
					      		<li><span>Garage Type: </span>Buil-in</li>
					      	</ul>
					      </div>
					      <div class="list-pane right">
					      	<ul>
					      		<li><span> Municipality District: </span> Toronto C12</li>
					      		<li><span>Rent/Lease Off Seasion: </span>$420000.00</li>
					      		<li><span>Rent/Lease Off Price: </span>$420000.00</li>
					      		<li><span>Style: </span>2-storey</li>
					      		<li><span>Total Baths: </span>4</li>
					      		<li><span>Type: </span>patch</li>
					      	</ul>
					      </div>
					      <div class="clearfix"></div>
					    </div>
					    <div id="left2" class="tab-pane fade">
					       <div class="list-pane left">
					      	<ul>
					      		<li><span> Status: </span> A</li>
					      		<li><span>State: </span>Ontario</li>
					      		<li><span>Address: </span>170 Owen blvd</li>
					      		<li><span>Area: </span>Toronto</li>
					      		<li><span>Bedrooms: </span>4</li>
					      		<li><span>Community: </span>st. Andrew-Windfields</li>
					      		<li><span>Garage Type: </span>Buil-in</li>
					      	</ul>
					      </div>
					      <div class="list-pane right">
					      	<ul>
					      		<li><span> Municipality District: </span> Toronto C12</li>
					      		<li><span>Rent/Lease Off Seasion: </span>$420000.00</li>
					      		<li><span>Rent/Lease Off Price: </span>$420000.00</li>
					      		<li><span>Style: </span>2-storey</li>
					      		<li><span>Total Baths: </span>4</li>
					      		<li><span>Type: </span>patch</li>
					      	</ul>
					      </div>
					      <div class="clearfix"></div>
					    </div>
					    <div id="left3" class="tab-pane fade">
					       <div class="list-pane left">
					      	<ul>
					      		<li><span> Status: </span> A</li>
					      		<li><span>State: </span>Ontario</li>
					      		<li><span>Address: </span>170 Owen blvd</li>
					      		<li><span>Area: </span>Toronto</li>
					      		<li><span>Bedrooms: </span>4</li>
					      		<li><span>Community: </span>st. Andrew-Windfields</li>
					      		<li><span>Garage Type: </span>Buil-in</li>
					      	</ul>
					      </div>
					      <div class="list-pane right">
					      	<ul>
					      		<li><span> Municipality District: </span> Toronto C12</li>
					      		<li><span>Rent/Lease Off Seasion: </span>$420000.00</li>
					      		<li><span>Rent/Lease Off Price: </span>$420000.00</li>
					      		<li><span>Style: </span>2-storey</li>
					      		<li><span>Total Baths: </span>4</li>
					      		<li><span>Type: </span>patch</li>
					      	</ul>
					      </div>
					      <div class="clearfix"></div>
					    </div>
					  </div>
					</div>
				</div>
				<div class="box-info score">
					<div class="title-box">
						<div class="title-special"><i class="fa fa-heart" aria-hidden="true"></i> Walk score : <span> 1 Out of 100 </span> <i class="fa fa-question-circle" aria-hidden="true"></i></div><hr>
						<div class="tab-content">
						    <div class="wrap-list">
						    	<div class="border-score">
							      	<ul>
							      		<li><span>Car-Dependent </span></li><hr>
							      		<li><span>Restaurants</span><br> Red Onion Caledon 2.9km <i class="fa fa-angle-right" aria-hidden="true"></i></li><hr>
							      		<li><span>Coffee</span><br> Red Onion Caledon 2.9km <i class="fa fa-angle-right" aria-hidden="true"></i></li><hr>
							      		<li><span>Bars</span><br> Red Onion Caledon 2.9km <i class="fa fa-angle-right" aria-hidden="true"></i></li><hr>
							      		<li><span>Parks</span><br> Red Onion Caledon 2.9km <i class="fa fa-angle-right" aria-hidden="true"></i></li><hr>
							      		<li><span>Restaurants</span><br> Red Onion Caledon 2.9km <i class="fa fa-angle-right" aria-hidden="true"></i></li><hr>
							      		<li><span>Coffee</span><br> Red Onion Caledon 2.9km <i class="fa fa-angle-right" aria-hidden="true"></i></li><hr>
							      		<li><span>Bars</span><br> Red Onion Caledon 2.9km <i class="fa fa-angle-right" aria-hidden="true"></i></li><hr>
							      		<li><span>Parks</span><br> Red Onion Caledon 2.9km <i class="fa fa-angle-right" aria-hidden="true"></i></li><hr>
							      		<li><span>Restaurants</span><br> Red Onion Caledon 2.9km <i class="fa fa-angle-right" aria-hidden="true"></i></li><hr>
							      		<li><span>Coffee</span><br> Red Onion Caledon 2.9km <i class="fa fa-angle-right" aria-hidden="true"></i></li><hr>
							      		<li><span>Bars</span><br> Red Onion Caledon 2.9km <i class="fa fa-angle-right" aria-hidden="true"></i></li><hr>
							      		<li><span>Parks</span><br> Red Onion Caledon 2.9km <i class="fa fa-angle-right" aria-hidden="true"></i></li>
							      	</ul>
							      	<div class="map">
							      		<img class="img-responsive" src="/images/map.png">
							      	</div>
						      	</div>
						      <div class="clearfix"></div>
						    </div>
						  </div>
					</div>
				</div>
				<div class="box-info">
					<div class="title-box">
						<h4><i class="fa fa-check-square" aria-hidden="true"></i> Similar Properties</h4> <hr>
					</div>
						<div class="related left">
							<div class="shadow">
								<div class="wrap-related">
									<img class="img-responsive" src="/images/related.png">
									<div class="title-related">220 Donland ave, toronto, m4j3r2, ontario</div>
									<div class="price-related">1800.00</div>
								</div>
							</div>
						</div>
						<div class="related right">
							<div class="shadow">
								<div class="wrap-related">
									<img class="img-responsive" src="/images/related.png">
									<div class="title-related">220 Donland ave, toronto, m4j3r2, ontario</div>
									<div class="price-related">1800.00</div>
								</div>
							</div>
						</div>
					<div class="clearfix"></div>
				</div>
				<div class="shadow">
					<div class="box-info">
						<div class="title-box">
							<h4><i class="fa fa-check-square" aria-hidden="true"></i> Position</h4> <hr>
							<div class="wrap-box">
								<img class="img-responsive" src="/images/position.png">
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-6">
				<div class="top-compare">
					<h2 class="title-property">170 Owen BLVD, Toronto, M2P1G7, Ontario</h2>
					<p>Jacksonville, Florida 
					<span class="share">Share this: <i class="fa fa-facebook-square" aria-hidden="true"></i><i class="fa fa-twitter-square" aria-hidden="true"></i><i class="fa fa-google-plus-square" aria-hidden="true"></i></span></p>
					<button>Remove this properties</button>
					<hr>
				</div>
				<div class="slider">


					<div id="jssor_2" style="position: relative; margin: 0 auto; top: 0px; left: 0px; width: 600px; height: 300px; overflow: visible; visibility: hidden;">
				        <!-- Loading Screen -->
				        <div data-u="loading" style="position: absolute; top: 0px; left: 0px;">
				            <div style="filter: alpha(opacity=70); opacity: 0.7; position: absolute; display: block; top: 0px; left: 0px; width: 100%; height: 100%;"></div>
				            <div style="position:absolute;display:block;background:url('sl/img/loading.gif') no-repeat center center;top:0px;left:0px;width:100%;height:100%;"></div>
				        </div>
				        <div data-u="slides" style="cursor: default; position: relative; top: 0px; left: 0px; width: 600px; height: 335px; overflow: hidden;">
				            <div data-p="112.50">
				                <img data-u="image" src="/sl/img/002.jpg" />
				                <img data-u="thumb" src="/sl/img/002.jpg" />
				            </div>
				            <div data-p="112.50" style="display:none;">
				                <img data-u="image" src="/sl/img/003.jpg" />
				                <img data-u="thumb" src="/sl/img/003.jpg" />
				            </div>
				            <div data-p="112.50" style="display:none;">
				                <img data-u="image" src="/sl/img/004.jpg" />
				                <img data-u="thumb" src="/sl/img/004.jpg" />
				            </div>
				            <div data-p="112.50" style="display:none;">
				                <img data-u="image" src="/sl/img/005.jpg" />
				                <img data-u="thumb" src="/sl/img/005.jpg" />
				            </div>
				            <div data-p="112.50" style="display:none;">
				                <img data-u="image" src="/sl/img/006.jpg" />
				                <img data-u="thumb" src="/sl/img/006.jpg" />
				            </div>
				            <div data-p="112.50" style="display:none;">
				                <img data-u="image" src="/sl/img/007.jpg" />
				                <img data-u="thumb" src="/sl/img/007.jpg" />
				            </div>
				            <div data-p="112.50" style="display:none;">
				                <img data-u="image" src="/sl/img/008.jpg" />
				                <img data-u="thumb" src="/sl/img/008.jpg" />
				            </div>
				            <div data-p="112.50" style="display:none;">
				                <img data-u="image" src="/sl/img/009.jpg" />
				                <img data-u="thumb" src="/sl/img/009.jpg" />
				            </div>
				            <div data-p="112.50" style="display:none;">
				                <img data-u="image" src="/sl/img/010.jpg" />
				                <img data-u="thumb" src="/sl/img/010.jpg" />
				            </div>
				            <div data-p="112.50" style="display:none;">
				                <img data-u="image" src="/sl/img/011.jpg" />
				                <img data-u="thumb" src="/sl/img/011.jpg" />
				            </div>
				            <a data-u="any" href="http://www.jssor.com" style="display:none">Image Slider 2</a>
				        </div>
				        <!-- Thumbnail Navigator -->
				        <div data-u="thumbnavigator" class="jssort03" style="position:absolute;left:0px;bottom:-175px;width:600px;height:135px;" data-autocenter="1">
				            <div style="position: absolute; top: 0; left: 0; width: 100%; height:100%; filter:alpha(opacity=30.0); opacity:0.3;"></div>
				            <!-- Thumbnail Item Skin Begin -->
				            <div data-u="slides" style="cursor: default;height: 142px!important;">
				                <div data-u="prototype" class="p">
				                    <div class="w">
				                        <div data-u="thumbnailtemplate" class="t"></div>
				                    </div>
				                    <div class="c"></div>
				                </div>
				            </div>
				            <!-- Thumbnail Item Skin End -->
				        </div>
				        <!-- Arrow Navigator -->
				        <span data-u="arrowleft" class="jssora02l" style="top:355px;left:0;width:55px;height:55px;" data-autocenter="2"><i class="fa fa-angle-left" aria-hidden="true"></i></span>
				        <span data-u="arrowright" class="jssora02r" style="top:355px;right:0;width:55px;height:55px;" data-autocenter="2"><i class="fa fa-angle-right" aria-hidden="true"></i></span>
				    </div>

				</div>
				<div class="shadow">
					<div class="box-info">
						<div class="title-box">
							<h4><i class="fa fa-check-square" aria-hidden="true"></i> Property Overview</h4> <hr>
							<div class="wrap-box">
								<div class="thumb">
									<img class="img-responsive" src="/images/thumb.png">
								</div>
								<div class="info">
									<ul>
										<li><i class="fa fa-usd" aria-hidden="true"></i><span> Price: </span> 500000.00</li>
										<li><i class="fa fa-map-marker" aria-hidden="true"></i><span> Location: </span> Ontario, M2P1G7</li>
										<li><i class="fa fa-bed" aria-hidden="true"></i><span> Bedrooms: </span> 4</li>
										<li><i class="fa fa-bath" aria-hidden="true"></i><span> Total Baths: </span> 6</li>
										<li><span>Extra: </span> Subzero F/F, Dacor Oven, 4 Burner Gas Ctop, Miele Dw, Kenmore W&D. 2Gb+E. Cac. CvacSubzero F/F, Dacor Oven, 4 Burner Gas Ctop, Miele Dw, Kenmore W&D. 2Gb+E. </li>
									</ul>
								</div>
								<div class="clearfix"></div>
							</div>
						</div>
					</div>
				</div>
				<div class="shadow">
					<div class="box-info">
						<div class="title-box">
							<h4><i class="fa fa-check-square" aria-hidden="true"></i> Description</h4> <hr>
							<div class="wrap-box">
								Custom Built Residence By Acclaimed Hovan Homes On One Of St. Andrew’s Most Desired Streets! Situated On An Exceptionally Deep Lot W/Lush Greenery, This Fabulous Family Home Features Graciously Proportioned Rms. Chef’s Kitch W/Stn.Stl Appls, Island, Granite Counters, & Huge Brkfst Area. Lrg Private Library. Mstr Suite W/Sitting Area, Fp, W/I Clsts & 6Pc Ens. Lwr Lvl W/Gar Access, Mud Rm, Nanny Suite, Rec Rm, Wet Bar & Games Rm. Steps To Schools, Ttc & Shops.
								<div class="clearfix"></div>
							</div>
						</div>
					</div>
				</div>
				<div class="shadow">
					<div class="box-info features">
					  <ul class="nav nav-tabs">
					    <li class="active"><a data-toggle="tab" href="#right1">Basic features</a></li>
					    <li><a data-toggle="tab" href="#right2">Advanced features</a></li>
					    <li><a data-toggle="tab" href="#right3">Amenities</a></li>
					  </ul><hr>
					  <div class="tab-content">
					    <div id="right1" class="tab-pane fade in active">
					      <div class="list-pane left">
					      	<ul>
					      		<li><span> Status: </span> A</li>
					      		<li><span>State: </span>Ontario</li>
					      		<li><span>Address: </span>170 Owen blvd</li>
					      		<li><span>Area: </span>Toronto</li>
					      		<li><span>Bedrooms: </span>4</li>
					      		<li><span>Community: </span>st. Andrew-Windfields</li>
					      		<li><span>Garage Type: </span>Buil-in</li>
					      	</ul>
					      </div>
					      <div class="list-pane right">
					      	<ul>
					      		<li><span> Municipality District: </span> Toronto C12</li>
					      		<li><span>Rent/Lease Off Seasion: </span>$420000.00</li>
					      		<li><span>Rent/Lease Off Price: </span>$420000.00</li>
					      		<li><span>Style: </span>2-storey</li>
					      		<li><span>Total Baths: </span>4</li>
					      		<li><span>Type: </span>patch</li>
					      	</ul>
					      </div>
					      <div class="clearfix"></div>
					    </div>
					    <div id="right2" class="tab-pane fade">
					       <div class="list-pane left">
					      	<ul>
					      		<li><span> Status: </span> A</li>
					      		<li><span>State: </span>Ontario</li>
					      		<li><span>Address: </span>170 Owen blvd</li>
					      		<li><span>Area: </span>Toronto</li>
					      		<li><span>Bedrooms: </span>4</li>
					      		<li><span>Community: </span>st. Andrew-Windfields</li>
					      		<li><span>Garage Type: </span>Buil-in</li>
					      	</ul>
					      </div>
					      <div class="list-pane right">
					      	<ul>
					      		<li><span> Municipality District: </span> Toronto C12</li>
					      		<li><span>Rent/Lease Off Seasion: </span>$420000.00</li>
					      		<li><span>Rent/Lease Off Price: </span>$420000.00</li>
					      		<li><span>Style: </span>2-storey</li>
					      		<li><span>Total Baths: </span>4</li>
					      		<li><span>Type: </span>patch</li>
					      	</ul>
					      </div>
					      <div class="clearfix"></div>
					    </div>
					    <div id="right3" class="tab-pane fade">
					       <div class="list-pane left">
					      	<ul>
					      		<li><span> Status: </span> A</li>
					      		<li><span>State: </span>Ontario</li>
					      		<li><span>Address: </span>170 Owen blvd</li>
					      		<li><span>Area: </span>Toronto</li>
					      		<li><span>Bedrooms: </span>4</li>
					      		<li><span>Community: </span>st. Andrew-Windfields</li>
					      		<li><span>Garage Type: </span>Buil-in</li>
					      	</ul>
					      </div>
					      <div class="list-pane right">
					      	<ul>
					      		<li><span> Municipality District: </span> Toronto C12</li>
					      		<li><span>Rent/Lease Off Seasion: </span>$420000.00</li>
					      		<li><span>Rent/Lease Off Price: </span>$420000.00</li>
					      		<li><span>Style: </span>2-storey</li>
					      		<li><span>Total Baths: </span>4</li>
					      		<li><span>Type: </span>patch</li>
					      	</ul>
					      </div>
					      <div class="clearfix"></div>
					    </div>
					  </div>
					</div>
				</div>
				<div class="box-info score">
					<div class="title-box">
						<div class="title-special"><i class="fa fa-heart" aria-hidden="true"></i> Walk score : <span> 1 Out of 100 </span> <i class="fa fa-question-circle" aria-hidden="true"></i></div><hr>
						<div class="tab-content">
						    <div class="wrap-list">
						    	<div class="border-score">
							      	<ul>
							      		<li><span>Car-Dependent </span></li><hr>
							      		<li><span>Restaurants</span><br> Red Onion Caledon 2.9km <i class="fa fa-angle-right" aria-hidden="true"></i></li><hr>
							      		<li><span>Coffee</span><br> Red Onion Caledon 2.9km <i class="fa fa-angle-right" aria-hidden="true"></i></li><hr>
							      		<li><span>Bars</span><br> Red Onion Caledon 2.9km <i class="fa fa-angle-right" aria-hidden="true"></i></li><hr>
							      		<li><span>Parks</span><br> Red Onion Caledon 2.9km <i class="fa fa-angle-right" aria-hidden="true"></i></li><hr>
							      		<li><span>Restaurants</span><br> Red Onion Caledon 2.9km <i class="fa fa-angle-right" aria-hidden="true"></i></li><hr>
							      		<li><span>Coffee</span><br> Red Onion Caledon 2.9km <i class="fa fa-angle-right" aria-hidden="true"></i></li><hr>
							      		<li><span>Bars</span><br> Red Onion Caledon 2.9km <i class="fa fa-angle-right" aria-hidden="true"></i></li><hr>
							      		<li><span>Parks</span><br> Red Onion Caledon 2.9km <i class="fa fa-angle-right" aria-hidden="true"></i></li><hr>
							      		<li><span>Restaurants</span><br> Red Onion Caledon 2.9km <i class="fa fa-angle-right" aria-hidden="true"></i></li><hr>
							      		<li><span>Coffee</span><br> Red Onion Caledon 2.9km <i class="fa fa-angle-right" aria-hidden="true"></i></li><hr>
							      		<li><span>Bars</span><br> Red Onion Caledon 2.9km <i class="fa fa-angle-right" aria-hidden="true"></i></li><hr>
							      		<li><span>Parks</span><br> Red Onion Caledon 2.9km <i class="fa fa-angle-right" aria-hidden="true"></i></li>
							      	</ul>
							      	<div class="map">
							      		<img class="img-responsive" src="/images/map.png">
							      	</div>
						      	</div>
						      <div class="clearfix"></div>
						    </div>
						  </div>
					</div>
				</div>
				<div class="box-info">
					<div class="title-box">
						<h4><i class="fa fa-check-square" aria-hidden="true"></i> Similar Properties</h4> <hr>
					</div>
						<div class="related left">
							<div class="shadow">
								<div class="wrap-related">
									<img class="img-responsive" src="/images/related.png">
									<div class="title-related">220 Donland ave, toronto, m4j3r2, ontario</div>
									<div class="price-related">1800.00</div>
								</div>
							</div>
						</div>
						<div class="related right">
							<div class="shadow">
								<div class="wrap-related">
									<img class="img-responsive" src="/images/related.png">
									<div class="title-related">220 Donland ave, toronto, m4j3r2, ontario</div>
									<div class="price-related">1800.00</div>
								</div>
							</div>
						</div>
					<div class="clearfix"></div>
				</div>
				<div class="shadow">
					<div class="box-info">
						<div class="title-box">
							<h4><i class="fa fa-check-square" aria-hidden="true"></i> Position</h4> <hr>
							<div class="wrap-box">
								<img class="img-responsive" src="/images/position.png">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection