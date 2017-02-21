@extends('layouts.frontend')

@section('content')
	<div class="properties-page">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div class="properties_page_header">
						<h1>109 HOLMES AVE, TORONTO, M2N4M3, ONTARIO</h1>
						<div class="properties_page_header_action">
							<div class="properties_header_virtual_tour">
								<i class="fa fa-eye" aria-hidden="true"></i>VIRTUAL TOUR
							</div>
							<div class="properties_header_share_action">
								<span>Share this: </span>
								<a href=""><i class="fa fa-facebook-square" aria-hidden="true"></i></a>
								<a href=""><i class="fa fa-twitter-square" aria-hidden="true"></i></a>
								<a href=""><i class="fa fa-google-plus-square" aria-hidden="true"></i></a>
								<a href=""><i class="fa fa-linkedin-square" aria-hidden="true"></i></a>
								<a href=""><i class="fa fa-pinterest-square" aria-hidden="true"></i></a>
								<a href=""><i class="fa fa-reddit-square" aria-hidden="true"></i></a>
								<a href=""><i class="fa fa-delicious" aria-hidden="true"></i></a>
								<a href=""><i class="fa fa-digg" aria-hidden="true"></i></a>
								<a href=""><i class="fa fa-stumbleupon" aria-hidden="true"></i></a>
								<a href=""><i class="fa fa-tumblr-square" aria-hidden="true"></i></a>
							</div>
							<div class="clr"></div>
						</div>
					</div>
					<div class="properties_page_slider">
						<div id="jssor_properties" style="position: relative; margin: 0 auto; top: 0px; left: 0px; width: 850px; height: 660px; overflow: visible; visibility: hidden;">
					        <!-- Loading Screen -->
					        <div data-u="loading" style="position: absolute; top: 0px; left: 0px;">
					            <div style="filter: alpha(opacity=70); opacity: 0.7; position: absolute; display: block; top: 0px; left: 0px; width: 100%; height: 100%;"></div>
					            <div style="position:absolute;display:block;background:url('/images/loading.gif') no-repeat center center;top:0px;left:0px;width:100%;height:100%;"></div>
					        </div>
					        <div data-u="slides" style="cursor: default; position: relative; top: 0px; left: 0px; width: 852px; height: 480px; overflow: hidden;">
					            <div data-p="144.50">
					            	<a href=""><img data-u="image" src="/sl/img/002.jpg" /></a>					                
					                <img data-u="thumb" src="/sl/img/002.jpg" />
					            </div>
					            <div data-p="144.50" style="display:none;">
					                <a href=""><img data-u="image" src="/sl/img/003.jpg" /></a>
					                <img data-u="thumb" src="/sl/img/003.jpg" />
					            </div>
					            <div data-p="144.50" style="display:none;">
					                <a href=""><img data-u="image" src="/sl/img/004.jpg" /></a>
					                <img data-u="thumb" src="/sl/img/004.jpg" />
					            </div>
					            <div data-p="144.50" style="display:none;">
					                <a href=""><img data-u="image" src="/sl/img/005.jpg" /></a>
					                <img data-u="thumb" src="/sl/img/005.jpg" />
					            </div>
					            <div data-p="144.50" style="display:none;">
					                <a href=""><img data-u="image" src="/sl/img/006.jpg" /></a>
					                <img data-u="thumb" src="/sl/img/006.jpg" />
					            </div>
					            <div data-p="144.50" style="display:none;">
					                <a href=""><img data-u="image" src="/sl/img/007.jpg" /></a>
					                <img data-u="thumb" src="/sl/img/007.jpg" />
					            </div>
					            <div data-p="144.50" style="display:none;">
					                <a href=""><img data-u="image" src="/sl/img/008.jpg" /></a>
					                <img data-u="thumb" src="/sl/img/008.jpg" />
					            </div>
					            <div data-p="144.50" style="display:none;">
					                <a href=""><img data-u="image" src="/sl/img/009.jpg" /></a>
					                <img data-u="thumb" src="/sl/img/009.jpg" />
					            </div>
					            <div data-p="144.50" style="display:none;">
					                <a href=""><img data-u="image" src="/sl/img/010.jpg" /></a>
					                <img data-u="thumb" src="/sl/img/010.jpg" />
					            </div>
					            <div data-p="144.50" style="display:none;">
					                <a href=""><img data-u="image" src="/sl/img/011.jpg" /></a>
					                <img data-u="thumb" src="/sl/img/011.jpg" />
					            </div>
					        </div>
					        <!-- Thumbnail Navigator -->
					        <div data-u="thumbnavigator" class="jssort_properties" style="position:absolute;left:0px;bottom:0;width:600px;height:135px;" data-autocenter="1">
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
					        <span data-u="arrowleft" class="jssoraProl" style="left:0;" data-autocenter="2"><i class="fa fa-angle-left" aria-hidden="true"></i></span>
					        <span data-u="arrowright" class="jssoraPror" style="right:0;" data-autocenter="2"><i class="fa fa-angle-right" aria-hidden="true"></i></span>

						</div>
					</div>
					<div class="properties_page_overview">
						<div class="property_title_left">
							<h3><i class="fa fa-check-square" aria-hidden="true"></i>Property overview</h3>
						</div>
						<div class="properties_shadow_bottom">
							<div class="property_content_right">
								<div class="post_thumbnail_post">
									<img src="http://realestate.homula.com/wp-content/uploads/2016/10/image-C3615220-9.jpg" alt="">
								</div>
								<dl>
				                	<dt>Price: </dt><dd>{!!$properties->price != '' ? $properties->price : '&nbsp;'!!}</dd>			            	
				                	<dt>Location: </dt><dd>{!!$properties->location != '' ? $properties->location : '&nbsp;'!!}</dd>
				                	<dt>Bedrooms: </dt><dd>{{$properties->bedrooms}}</dd>
				                	<dt>Total Baths: </dt><dd>{{$properties->bathrooms}}</dd>
				                	<dt>Extra: </dt>
				                	<dd>Hunter Douglas Blinds. Stainless Steel Side/Side Fridge, Stove, B/I Dishwasher, Funnel Exhaust Hood. Cac, Cvac, Gdo, Alarm Sys, Insulated Garage Dr, Approx.21'X12' Sun-Deck W Bbq Gas Line. Designer Interlocking.</dd>
			                	</dl>
			                	<div class="clr"></div>
							</div>
						</div>
					</div>
					<div class="properties_page_description">
						<div class="property_title_left">
							<h3><i class="fa fa-check-square" aria-hidden="true"></i>DESCRIPTION</h3>
						</div>
						<div class="properties_shadow_bottom">
							<div class="property_content_right">
								<div class="properties_page_description_content">
									<p>Modern Contemporary Style, Open Concept, 10-Ft Ceiling Main Flr, 3/4′ Hdwd Flrs On Main & 2nd Floors, Granite Modern Kitchen W/2-Sided Gas Frpl Adjoining Spacious Fam Rm, Marble/Gas Fp W Intricate Wood Mantle In Comb Lr/Dr Rooms, B/I Sound/Speaker Sys On Both Levels, Master Bedrm Coffered Ceiling, 2nd Flr Laundry Room, Lavishly Landscaped & Fully Fenced Backyard, Earl Haig District, Close To Yonge Subway.</p>
								</div>
							</div>
						</div>
					</div>
					<div class="properties_page_menu">
						<ul>
							<li class="properties_basic_features active"><span>Basic Features</span></li>
							<li class="properties_advanced_features"><span>Advanced Features</span></li>
							<li class="properties_amenities"><span>Amenities</span></li>
							<li class="properties_calculator"><span>Calculator</span></li>
							<li class="properties_live_polls"><span>Live Polls</span></li>
						</ul>
						<div class="properties_content_of_select">
							<div id="properties_basic_features" class="properties_select_hide">
								<div class="properties_shadow_bottom">
									<div class="property_content_right">
										<div class="properties_basic_features_detail">
											<div class="pbfd_fieldLeft">
												<div class="pbfd_fieldStatus">
													<strong>Status: </strong><span>A</span>
												</div>
												<div class="pbfd_fieldState">
													<strong>State: </strong><span>Ontario</span>
												</div>
												<div class="pbfd_fieldAddress">
													<strong>Address: </strong><span>109 Holmes Ave</span>
												</div>
												<div class="pbfd_fieldArea">
													<strong>Area: </strong><span>Toronto</span>
												</div>
												<div class="pbfd_fieldBedrooms">
													<strong>Bedrooms: </strong><span>4</span>
												</div>
												<div class="pbfd_fieldCommunity">
													<strong>Community: </strong><span>Willowdale East</span>
												</div>
												<div class="pbfd_fieldGarage">
													<strong>Garage Type: </strong><span>Attached</span>
												</div>
											</div>
											<div class="pbfd_fieldRight">
												<div class="pbfd_fieldMunicipality">
													<strong>Municipality District: </strong><span>Toronto C14</span>
												</div>
												<div class="pbfd_fieldRent">
													<strong>Rent/Lease Off Season: </strong><span>$2388000.00</span>
												</div>
												<div class="pbfd_fieldRentPrice">
													<strong>Rent/Lease Price: </strong><span>$2388000.00</span>
												</div>
												<div class="pbfd_fieldStyle">
													<strong>Style: </strong><span>2-Storey</span>
												</div>
												<div class="pbfd_fieldTotalBath">
													<strong>Total Baths: </strong><span>4</span>
												</div>
												<div class="pbfd_fieldType">
													<strong>Type: </strong><span>Detached</span>
												</div>
												<div class="pbfd_pbfd_fieldZoning">
													<strong>Zoning: </strong><span>Residential</span>
												</div>
											</div>
											<div class="clr"></div>
										</div>
									</div>
								</div>
							</div>
							<div id="properties_advanced_features" class="properties_select_hide">
								<div class="properties_shadow_bottom">
									<div class="property_content_right">
										<div class="properties_basic_features_detail">
											<div class="pbfd_fieldLeft">
												<div class="pbfd_fieldZoning">
													<strong>Air Conditioning:</strong> 
													<span>Central Air</span>
												</div>
												<div class="pbfd_fieldZoning">
													<strong>Basement1:</strong> 
													<span>Finished</span>
												</div>
												<div class="pbfd_fieldZoning">
													<strong>Central Vac:</strong> 
													<span>Y</span>
												</div>
												<div class="pbfd_fieldZoning"><strong>Community Code:</strong> <span>01.C14.0580</span></div><div class="pbfd_fieldZoning"><strong>Drive:</strong> <span>Private</span></div><div class="pbfd_fieldZoning"><strong>Extras:</strong> <span>Hunter Douglas Blinds. Stainless Steel Side/Side Fridge, Stove, B/I Dishwasher, Funnel Exhaust Hood. Cac, Cvac, Gdo, Alarm Sys, Insulated Garage Dr, Approx.21'X12' Sun-Deck W Bbq Gas Line. Designer Interlocking.</span></div><div class="pbfd_fieldZoning"><strong>Den:</strong> <span>Y</span></div><div class="pbfd_fieldZoning"><strong>Fireplace/Stove:</strong> <span>Y</span></div><div class="pbfd_fieldZoning"><strong>Garage Spaces:</strong> <span>2.0</span></div><div class="pbfd_fieldZoning"><strong>Heat Source:</strong> <span>Gas</span></div><div class="pbfd_fieldZoning"><strong>Heat Type:</strong> <span>Forced Air</span></div><div class="pbfd_fieldZoning"><strong>Kitchens:</strong> <span>1</span></div><div class="pbfd_fieldZoning"><strong>level 1:</strong> <span>Main</span></div><div class="pbfd_fieldZoning"><strong>level 2:</strong> <span>Main</span></div><div class="pbfd_fieldZoning"><strong>level 3:</strong> <span>Main</span></div><div class="pbfd_fieldZoning"><strong>level 4:</strong> <span>Main</span></div><div class="pbfd_fieldZoning"><strong>level 5:</strong> <span>Main</span></div><div class="pbfd_fieldZoning"><strong>level 6:</strong> <span>Main</span></div><div class="pbfd_fieldZoning"><strong>level 7:</strong> <span>2nd</span></div><div class="pbfd_fieldZoning"><strong>level 8:</strong> <span>2nd</span></div><div class="pbfd_fieldZoning"><strong>level 9:</strong> <span>2nd</span></div><div class="pbfd_fieldZoning"><strong>level 10:</strong> <span>2nd</span></div><div class="pbfd_fieldZoning"><strong>Lot Depth:</strong> <span>160.00</span></div><div class="pbfd_fieldZoning"><strong>Lot Front:</strong> <span>50.00</span></div><div class="pbfd_fieldZoning"><strong>Lot Size Code:</strong> <span>Feet</span></div><div class="pbfd_fieldZoning"><strong>Municipality Code:</strong> <span>01.C14</span></div><div class="pbfd_fieldZoning"><strong>Parking Spaces:</strong> <span>4</span></div><div class="pbfd_fieldZoning"><strong>Pool:</strong> <span>None</span></div><div class="pbfd_fieldZoning"><strong>Property Features1:</strong> <span>Park</span></div><div class="pbfd_fieldZoning"><strong>Property Features2:</strong> <span>Public Transit</span></div><div class="pbfd_fieldZoning"><strong>Property Features3:</strong> <span>School</span></div><div class="pbfd_fieldZoning"><strong>Room 1:</strong> <span>Living</span></div><div class="pbfd_fieldZoning"><strong>Room 1 Length:</strong> <span>7.51</span></div><div class="pbfd_fieldZoning"><strong>Room 1 Desc 1:</strong> <span>Gas Fireplace</span></div><div class="pbfd_fieldZoning"><strong>Room 1 Desc 2:</strong> <span>Hardwood Floor</span></div><div class="pbfd_fieldZoning"><strong>Room 1 Desc 3:</strong> <span>Combined W/Dining</span></div><div class="pbfd_fieldZoning"><strong>Room 2:</strong> <span>Dining</span></div><div class="pbfd_fieldZoning"><strong>Room 2 Length:</strong> <span>7.51</span></div><div class="pbfd_fieldZoning"><strong>Room 2 Desc 1:</strong> <span>Combined W/Living</span></div><div class="pbfd_fieldZoning"><strong>Room 2 Desc 2:</strong> <span>Hardwood Floor</span></div><div class="pbfd_fieldZoning"><strong>Room 2 Desc 3:</strong> <span>Pot Lights</span></div><div class="pbfd_fieldZoning"><strong>Room 3:</strong> <span>Kitchen</span></div><div class="pbfd_fieldZoning"><strong>Room 3 Length:</strong> <span>6.19</span></div><div class="pbfd_fieldZoning"><strong>Room 3 Desc 1:</strong> <span>Granite Counter</span></div><div class="pbfd_fieldZoning"><strong>Room 3 Desc 2:</strong> <span>Tile Floor</span></div><div class="pbfd_fieldZoning"><strong>Room 3 Desc 3:</strong> <span>Gas Fireplace</span></div>
												<div class="pbfd_fieldZoning">
													<strong>Room 4:</strong> 
													<span>Family</span>
												</div>
											</div>
											<div class="pbfd_fieldRight">
												<div class="pbfd_fieldZoning">
													<strong>Room 4 Length:</strong> 
													<span>4.74</span>
												</div>
												<div class="pbfd_fieldZoning"><strong>Room 4 Desc 1:</strong> <span>Gas Fireplace</span></div><div class="pbfd_fieldZoning"><strong>Room 4 Desc 2:</strong> <span>Hardwood Floor</span></div><div class="pbfd_fieldZoning"><strong>Room 4 Desc 3:</strong> <span>Open Concept</span></div><div class="pbfd_fieldZoning"><strong>Room 5:</strong> <span>Den</span></div><div class="pbfd_fieldZoning"><strong>Room 5 Length:</strong> <span>3.68</span></div><div class="pbfd_fieldZoning"><strong>Room 5 Desc 1:</strong> <span>Pocket Doors</span></div><div class="pbfd_fieldZoning"><strong>Room 5 Desc 2:</strong> <span>Hardwood Floor</span></div><div class="pbfd_fieldZoning"><strong>Room 5 Desc 3:</strong> <span>O/Looks Backyard</span></div><div class="pbfd_fieldZoning"><strong>Room 6:</strong> <span>Foyer</span></div><div class="pbfd_fieldZoning"><strong>Room 6 Length:</strong> <span>2.02</span></div><div class="pbfd_fieldZoning"><strong>Room 6 Desc 1:</strong> <span>Cathedral Ceiling</span></div><div class="pbfd_fieldZoning"><strong>Room 6 Desc 2:</strong> <span>Tile Floor</span></div><div class="pbfd_fieldZoning"><strong>Room 6 Desc 3:</strong> <span>Double Closet</span></div><div class="pbfd_fieldZoning"><strong>Room 7:</strong> <span>Master</span></div><div class="pbfd_fieldZoning"><strong>Room 7 Length:</strong> <span>6.24</span></div><div class="pbfd_fieldZoning"><strong>Room 7 Desc 1:</strong> <span>5 Pc Ensuite</span></div><div class="pbfd_fieldZoning"><strong>Room 7 Desc 2:</strong> <span>Hardwood Floor</span></div><div class="pbfd_fieldZoning"><strong>Room 7 Desc 3:</strong> <span>W/I Closet</span></div><div class="pbfd_fieldZoning"><strong>Room 8:</strong> <span>2nd Br</span></div><div class="pbfd_fieldZoning"><strong>Room 8 Length:</strong> <span>4.11</span></div><div class="pbfd_fieldZoning"><strong>Room 8 Desc 1:</strong> <span>4 Pc Bath</span></div><div class="pbfd_fieldZoning"><strong>Room 8 Desc 2:</strong> <span>Hardwood Floor</span></div><div class="pbfd_fieldZoning"><strong>Room 8 Desc 3:</strong> <span>Double Closet</span></div><div class="pbfd_fieldZoning"><strong>Room 9:</strong> <span>3rd Br</span></div><div class="pbfd_fieldZoning"><strong>Room 9 Length:</strong> <span>5.21</span></div><div class="pbfd_fieldZoning"><strong>Room 9 Desc 1:</strong> <span>Window</span></div><div class="pbfd_fieldZoning"><strong>Room 9 Desc 2:</strong> <span>Hardwood Floor</span></div><div class="pbfd_fieldZoning"><strong>Room 9 Desc 3:</strong> <span>Double Closet</span></div><div class="pbfd_fieldZoning"><strong>Room 10:</strong> <span>4th Br</span></div><div class="pbfd_fieldZoning"><strong>Room 10 Length:</strong> <span>5.24</span></div><div class="pbfd_fieldZoning"><strong>Room 10 Desc 1:</strong> <span>Window</span></div><div class="pbfd_fieldZoning"><strong>Room 10 Desc 2:</strong> <span>Hardwood Floor</span></div><div class="pbfd_fieldZoning"><strong>Room 10 Desc 3:</strong> <span>Double Closet</span></div><div class="pbfd_fieldZoning"><strong>Room 11:</strong> <span>Rec</span></div><div class="pbfd_fieldZoning"><strong>Room 11 Length:</strong> <span>10.67</span></div><div class="pbfd_fieldZoning"><strong>Room 11 Desc 1:</strong> <span>4 Pc Bath</span></div><div class="pbfd_fieldZoning"><strong>Room 11 Desc 2:</strong> <span>Laminate</span></div><div class="pbfd_fieldZoning"><strong>Room 11 Desc 3:</strong> <span>Above Grade Window</span></div><div class="pbfd_fieldZoning"><strong>Room 12:</strong> <span>Games</span></div><div class="pbfd_fieldZoning"><strong>Room 12 Length:</strong> <span>5.02</span></div><div class="pbfd_fieldZoning"><strong>Room 12 Desc 1:</strong> <span>Above Grade Window</span></div><div class="pbfd_fieldZoning"><strong>Room 12 Desc 2:</strong> <span>Laminate</span></div><div class="pbfd_fieldZoning"><strong>Room 12 Desc 3:</strong> <span>Pot Lights</span></div><div class="pbfd_fieldZoning"><strong>Total Rooms:</strong> <span>9</span></div><div class="pbfd_fieldZoning"><strong>Sale/Lease:</strong> <span>Sale</span></div><div class="pbfd_fieldZoning"><strong>Sewers:</strong> <span>Sewers</span></div><div class="pbfd_fieldZoning"><strong>Taxes:</strong> <span>9450.00</span></div>
												<div class="pbfd_fieldZoning">
													<strong>Water:</strong> 
													<span>Municipal</span>
												</div>
											</div>
											<div class="clr"></div>
										</div>
									</div>
								</div>
							</div>
							<div id="properties_amenities" class="properties_select_hide">
								<div class="properties_shadow_bottom">
									<div class="property_content_right">
										<div class="properties_amenities_content">
											<ul>
												<li>Air conditioning</li>
												<li>Heating</li>
												<div class="clr"></div>
											</ul>
										</div>
									</div>
								</div>
							</div>
							<div id="properties_calculator" class="properties_select_hide">
								<div class="properties_shadow_bottom">
									<div class="property_content_right">
										<div>properties_calculator</div>
									</div>
								</div>
							</div>
							<div id="properties_live_polls" class="properties_select_hide">
								<div class="properties_shadow_bottom">
									<div class="property_content_right">
										<div>properties_live_polls</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="properties_page_walk_score">
						<iframe style="margin: 0px; outline: medium none; text-align: left; text-decoration: none; padding: 0px; font-size-adjust: none; font-stretch: normal; font-style: normal; font-variant: normal; letter-spacing: normal; word-spacing: normal; text-transform: none; vertical-align: baseline; text-indent: 0px; text-shadow: none; white-space: normal; background-image: none; background-color: transparent; border: 0px none;" marginheight="0" marginwidth="0" scrolling="no" src="http://www.walkscore.com/serve-walkscore-tile.php?wsid=b698f03ac6a12c7ccdef834f95313370&amp;s=109 Holmes Ave, Toronto, M2N4M3, Ontario&amp;lat=43.779331&amp;lng=-79.4067922&amp;o=h&amp;ts=t&amp;c=f&amp;map_provider=mapquest&amp;mm=all&amp;base_map=google_map&amp;h=442&amp;fh=18&amp;w=800" width="800px" height="442px" frameborder="0"></iframe>
					</div>
					<div class="properties_page_position">
						<div class="property_title_left">
							<h3><i class="fa fa-check-square" aria-hidden="true"></i>POSITION</h3>
						</div>
						<div class="properties_shadow_bottom">
							<div class="property_content_right">
								<div><img src="/images/properties_position_map.jpg" alt=""></div>
							</div>
						</div>
					</div>
					<div class="properties_page_similar">
						<div class="property_title_left">
							<h3><i class="fa fa-check-square" aria-hidden="true"></i>SIMILAR PROPERTIES</h3>
						</div>
						<div class="row">
							<div class="col-sm-4 properties_similar_item">
								<div class="property-box-simple">
									<div class="property-box-image">
										<a href="" class="property-box-simple-image-inner">
											<img src="http://realestate.homula.com/wp-content/uploads/2016/08/image-W3495860-9.jpg" alt="">
										</a>
										<div class="property-box-simple-actions">
											<span>Actions</span>
											<span><a href=""><i class="fa fa-exchange"></i></a></span>
											<span><a href=""><i class="fa fa-heart-o"></i></a></span>
										</div>
									</div>
									<div class="property-box-simple-header">
										<h2><a href="">153 Dunn Ave, Toronto, M6K2R8, Ontario</a></h2>
										<h3>2200000.00</h3>
									</div>
									<div class="property-box-simple-meta">
										<ul>
	        	        					<li>
												<span>Area</span>
												<strong>Ontario, M6K2R8</strong>
											</li>        
										</ul>
									</div>
								</div>
							</div>
							<div class="col-sm-4 properties_similar_item">
								<div class="property-box-simple">
									<div class="property-box-image">
										<a href="" class="property-box-simple-image-inner">
											<img src="http://realestate.homula.com/wp-content/uploads/2016/03/5.png" alt="">
										</a>
										<div class="property-box-simple-actions">
											<span>Actions</span>
											<span><a href=""><i class="fa fa-exchange"></i></a></span>
											<span><a href=""><i class="fa fa-heart-o"></i></a></span>
										</div>
									</div>
									<div class="property-box-simple-header">
										<h2><a href="">Riverview Condominiums</a></h2>
									</div>
								</div>
							</div>
							<div class="col-sm-4 properties_similar_item">
								<div class="property-box-simple">
									<div class="property-box-image">
										<a href="" class="property-box-simple-image-inner">
											<img src="http://realestate.homula.com/wp-content/uploads/2016/10/image-W3405787-9.jpg" alt="">
										</a>
										<div class="property-box-simple-actions">
											<span>Actions</span>
											<span><a href=""><i class="fa fa-exchange"></i></a></span>
											<span><a href=""><i class="fa fa-heart-o"></i></a></span>
										</div>
									</div>
									<div class="property-box-simple-header">
										<h2><a href="">95 Valecrest Dr, Toronto, M9A4P5, Ontario</a></h2>
										<h3>4398000.00</h3>
									</div>
									<div class="property-box-simple-meta">
										<ul>
	        	        					<li>
												<span>Area</span>
												<strong>Ontario, M9A4P5</strong>
											</li>        
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('script')
	<script type="text/javascript">
		$(document).ready(function(){
		    // slider
		    var jssor_properties_option = {
		      $AutoPlay: true,
		      $ArrowNavigatorOptions: {
		        $Class: $JssorArrowNavigator$
		      },
		      $ThumbnailNavigatorOptions: {
		        $Class: $JssorThumbnailNavigator$,
		        $Cols: 5,
		        $SpacingX: 3,
		        $SpacingY: 3,
		        $Align: 260
		      }
		    };

		    var jssor_properties_slider = new $JssorSlider$("jssor_properties", jssor_properties_option);

		    function ScaleSlider() {
		        var refSize = jssor_properties_slider.$Elmt.parentNode.clientWidth;
		        if (refSize) {
		            refSize = Math.min(refSize, 852);
		            jssor_properties_slider.$ScaleWidth(refSize);
		        }
		        else {
		            window.setTimeout(ScaleSlider, 130);
		        }
		    }
		    ScaleSlider();
		    $(window).bind("load", ScaleSlider);
		    $(window).bind("resize", ScaleSlider);
		    $(window).bind("orientationchange", ScaleSlider);
		});
	</script>
@endsection