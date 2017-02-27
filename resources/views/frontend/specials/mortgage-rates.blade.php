@extends('layouts.frontend')

@section('content')
	<style type="text/css">
		.mortgage-rates-one {
		    background: #f1f1f1;
		    padding-bottom: 20px;
		}
		.mortgage-rates-one-content h2 {
		    font-size: 32px;
		    font-weight: bold;
		    padding: 10px 0;
		    text-align: center;
		    color: #fff;
		    background: #039be5;
		    margin: 40px 0;
		}
		.mortgage-rates-one-content h3 {
		    font-size: 21px;
		    font-weight: bold;
		    color: #232323;
		    margin: 0 0 20px 20px;
		    text-transform: uppercase;
		}
		.srp_AffordabilityCalcwidget {
		    margin-bottom: 20px;
		}
		.srp_table {
		    border-spacing: 0;
		    border-collapse: collapse;
		    border: 0;
		    width: 100%;
	        background-color: transparent;
		}
		.srp_table td, .srp_table tr {
		    border: 0;
		    line-height: normal;
		}
		.srp_table tr:nth-child(1), .srp_table tr:nth-child(2), .srp_table tr:nth-child(4), .srp_table tr:nth-child(3) {
		    display: block;
		    height: 70px;
		    width: 100%;
		}
		.srp_table tr {
		    border: 1px solid #d9d9d9;
		    background: #f8f8f8;
		    margin-bottom: 30px;
		}
		.srp_table tr td:nth-child(1) {
		    width: 40%;
		}
		.srp_table td {
		    display: inline-block;
		    color: #000;
		    text-transform: uppercase;
		    padding-left: 10px;
		    text-align: left;
		}
		.srp_table tr td:nth-child(2) {
		    position: relative;
		    top: 0;
		    left: 40px;
		    padding: 0;
		    text-align: center;
		    background: #0a368a;
		    width: 30px;
		    height: 30px;
		    border-radius: 50%;
		    color: #fff;
		    font-size: 20px;
		}
		.srp_table tr td:nth-child(3) {
		    width: 52%;
		    padding-left: 0;
		}
		.srp_table td input[type=text] {
		    border: 1px solid #6984b6;
		    margin: 8px 0;
		    width: 100%;
		    padding-left: 45px;
		    padding-right: 5px;
		    border-radius: 10px;
		    height: 52px;
	        background-color: transparent;
	        box-shadow: 0 1px 0 0 rgba(0,0,0,0.12);
		    color: rgba(0,0,0,0.7);
		    font-size: 16px;
		    line-height: 48px;
	        position: relative;
		    transition: box-shadow .12s linear;
		}
		sup {
		    top: -0.5em;
		    font-size: 75%;
		    line-height: 0;
		    position: relative;
		    vertical-align: baseline;
		}
		sup a {
			color: #337ab7;
		    transition: color .15s linear;
		}
		ol {
		    color: #616161;
		    list-style-position: inside;
		    padding: 0;
		    margin-top: 0;
		    margin-bottom: 10px;
		}
		ol li {
		    margin-bottom: 10px;
		}
		.srp_table tr:nth-child(5), .srp_table tr:nth-child(6) {
		    display: initial;
		    background: transparent;
		    border: 0;
		}
		.srp_additional-info {
		    background: #f3f6fb;
		    border: 1px solid #d2dfff;
		    padding: 5px;
		    margin: 5px 0;
		    line-height: normal;
		    display: block;
		    overflow: hidden;
		    position: relative;
		}
		.centered .shadow_bot2 {
		    margin-top: 40px;
		    position: relative;
		    z-index: 1;
		}
		.shadow_bot2:before, .shadow_bot2:after {
		    z-index: -1;
		    position: absolute;
		    content: "";
		    bottom: 15px;
		    left: 10px;
		    width: 50%;
		    top: 80%;
		    max-width: 300px;
		    background: #777;
		    -webkit-box-shadow: 0 15px 10px #777;
		    -moz-box-shadow: 0 15px 10px #777;
		    box-shadow: 0 15px 10px #777;
		    -webkit-transform: rotate(-3deg);
		    -moz-transform: rotate(-3deg);
		    -o-transform: rotate(-3deg);
		    -ms-transform: rotate(-3deg);
		    transform: rotate(-3deg);
		}
		.mortgage-rates-one .centered img {
		    width: 100%;
		    height: auto;
		}
		.mortgage-rates-one .centered img {
		    width: 100%;
		    height: auto;
		}
		.mortgage-rates-caculator {
			text-align: center;
		}
		.mortgage-rates-caculator span {
		    display: inline-block;
		    padding: 10px 30px;
		    font-size: 18px;
		    color: #fff;
		    font-weight: bold;
		    background: #039be5;
		    border-radius: 10px;
		    cursor: pointer;
		}
		.shadow_bottom {
		    position: relative;
		    z-index: 1;
		}
		.shadow_bottom:after, .shadow_bottom:before {
		    content: "";
		    position: absolute;
		    z-index: -1;
		    -webkit-box-shadow: 0 0 20px rgba(0,0,0,0.8);
		    -moz-box-shadow: 0 0 20px rgba(0,0,0,0.8);
		    box-shadow: 0 0 20px rgba(0,0,0,0.8);
		    top: 50%;
		    bottom: 0;
		    left: 10px;
		    right: 10px;
		    -moz-border-radius: 100px / 10px;
		    border-radius: 350px / 60px;
		}
		.mortgage-rates-two .shadow_bottom:after, .mortgage-rates-two .shadow_bottom:before {
		    bottom: 3px;
		    left: 15px;
		    right: 15px;
		}
		.mortgage-rates-two-content {
		    background-color: #fff;
		    border: 1px solid #c3e7f9;
		    margin: 20px 0;
		}
		.mortgage-rates-two-content h3 {
		    font-weight: bold;
		    color: #fff;
		    background: #039be5;
		    margin-top: 0;
		    padding: 10px 20px;
		    font-size: 18px;
		    text-transform: uppercase;
		}
		.mortgage-rates-two-content p {
		    padding: 0 20px;
		    margin-bottom: 20px;
		    color: #232323;
		    font-size: 16px;
		    line-height: 24px;
		}
		.mortgage-rates-two-content p a {
			color: #337ab7;
			transition: color .15s linear;
		}

	</style>

	<div class="mortgage-rates-page">
		<div class="mortgage-rates-one">
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<div class="mortgage-rates-one-content">
							<h2>MORTGAGE RATES</h2>
							<div class="row">
								<div class="col-sm-6">
									<h3>Affordability Calculator</h3>
									<div class="srp_AffordabilityCalcwidget">
										<table class="srp_table">
											<tbody>
												<tr>
													<td>Monthly Gross Income </td>
													<td>$</td>
													<td><input id="widget-srp_affordabilitycalc-579-mo_gross_income" name="widget-srp_affordabilitycalc[579][mo_gross_income]" type="text" size="8"></td>
										  		</tr>
										  		<tr>
													<td>Monthly Debt Expenses <sup><a href="#TB_inline?height=200&amp;width=300&amp;inlineId=widget-srp_affordabilitycalc-579-sac_help" class="thickbox" title="What are Monthly Debt and Obligations?">[?]</a></sup>
														<div id="widget-srp_affordabilitycalc-579-sac_help" style="display: none">
															<h3>Monthly Debt and Obligations Should Include:</h3>
															<ol>
																<li>Monthly Credit Card Payments</li>
																<li>Monthly Auto Payments</li>
																<li>Monthly Child Support</li>
																<li>Monthly Association Fees</li>
																<li>Other Monthly Obligations, but NOT utility bills.</li>
															</ol>
														</div>
													</td>
													<td>$</td>
													<td><input id="widget-srp_affordabilitycalc-579-mo_debt_expences" name="widget-srp_affordabilitycalc[579][mo_debt_expences]" type="text" size="8"></td>
										  		</tr>
										  		<tr>
													<td>Down Payment:</td>
													<td>$
												    </td>
													<td><input id="widget-srp_affordabilitycalc-579-down_payment" name="widget-srp_affordabilitycalc[579][down_payment]" type="text" size="8" value="0"></td>
										  		</tr>
										  		<tr>
													<td>Interest Rate:</td>
													<td>%</td>
													<td><input id="widget-srp_affordabilitycalc-579-interest_rate" name="widget-srp_affordabilitycalc[579][interest_rate]2" type="text" size="8" value="3">
													<input id="widget-srp_affordabilitycalc-579-property_tax" name="widget-srp_affordabilitycalc[579][property_tax]2" type="hidden" value="1">
													<input id="widget-srp_affordabilitycalc-579-home_insurance" name="widget-srp_affordabilitycalc[579][home_insurance]2" type="hidden" value="0.5">
													<input id="widget-srp_affordabilitycalc-579-pmi" name="widget-srp_affordabilitycalc[579][pmi]2" type="hidden" value="0.5">
													</td>
										  		</tr>
										  		<tr>
													<td colspan="3">
														<div id="widget-srp_affordabilitycalc-579-result" class="srp_additional-info" style="display: none"></div></td>
										  		</tr>
												<tr>
													<td colspan="3"></td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
								<div class="col-sm-6 centered">
									<div class="shadow_bot2">
										<img class="alignnone size-medium wp-image-742" src="/images/house-graph1-300x206.png" alt="Toronto Real Estate Graph " width="300" height="206" />
									</div>
									<div class="clr"></div>
								</div>
							</div>
						</div>
						<div class="mortgage-rates-caculator col-sm-12"><span>Caculator</span></div>
					</div>
				</div>
			</div>
		</div>
		<div class="mortgage-rates-two">
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<div class= "shadow_bottom">
							<div class="mortgage-rates-two-content">
								<h3>The ever changing mortgage rate – Mortgage Rate </h3>
								<p>At the turn of the century, it was predicted that around this time global oil prices would soar immeasurably. Now, oil prices are low and food prices are soaring. As </span><a href="/page/about-us" target="_blank"><strong>Toronto real estate</strong></a><span style="font-weight: 400;"><a href="/page/about-us" target="_blank"><strong> experts</strong></a> would agree, this is a very strange time that we live in. Volatile financial markets usually result in cheaper mortgage rates, but nowadays there are other problems. Investors are getting cold feet. Not even the Banks are immune. According to many experts,</span> <span style="font-weight: 400;">the Canadian Banks that fund most of the mortgage market are facing profit cuts left, right and centre. Although the general population will not have a fit over a drop in profits for banks, most can agree that the market is no longer as lender friendly. </p>
								<p>On top of that this is the season of discounting, which is, the beginning of March (Traditionally known as the most robust period in the housing market). Presently, the mortgage market looks to be favouring the consumer, as they will have an easier time purchasing </span><a href="/realestate-search/"><b>MLS listings </b></a><span style="font-weight: 400;">and paying a decent mortgage rate. According to a consensus from Canadian banks, the Bank of Canada will end 2016 with a 0.5% rate, while bumping up the percentage points from 0.25 to 0.5 in 2017. If their assumption is correct, the prime rate will not be higher than 3.26% over the course of the next few years. The Bank of Montreal has other ideas, they do not mind cutting rates to 0.25% in April as they expect miniscule economic growth for the year of 2016. They are expecting it to be as little as one percent. Recent assumptions have been dire and stories of negative interest rates have flooded the media since last December. The financial post stated at the beginning of the year that Canada may very well experience negative interest years over the next few years. All the talk of negative interest rates may just be all doom and gloom at the end of the year. The economy is in first gear at the moment and maybe it is just the financial sectors way of letting everyone remain aware that there might very well be a risk of the economy going in reverse. </p>
								<p>Traditionally changes in Canada's housing market and mortgage rates have closely mimicked each other. In the last couple of years, Canada has veered away from trends in the states. At the start of the year, many were concerned over the conversion rate of the Canadian Dollar to the US counterpart. The recent talk of banks bearing the brunt of the risks associated with a mortgage loan may make the economy even more fragile. Although the change in seasons is looking favourable to borrowers, is it really something that is favourable to the economy in the long run?</p>
								<p>Although there is plenty of chit chat coming from the federal reserves in the states about a rate hike, unless the five year Canadian yield closes over 1.2%, there will not be a universal chorus of rates being too low. In the foreseeable future it does not look like we are looking at an upcoming inflation. The modern world is so intertwined, which makes it difficult for some people to make accurate predictions of what is to come. In other words, you are safe in the hands of <a href="/agents">our real estate experts</a>.</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="hot_properties">
		<h2 class="title_hasline">HOT PROPERTIES</h2>
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div class="hot_properties_overflow">
						<div class="content_one_ads">
							<div id="owl-demo-home" class="owl-carousel owl-theme">
								@foreach ($properties as $post)
									<div class="item">
									    <div class="hot_properties_item">
									        <a href="/properties/{{$post->alias}}" target="_blank">
									            <div class="hot_properties_item_top">
									                <div class="item_img"><img width="480" height="320" src="{{URL::asset($post->thumbnail)}}" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="image-C3615220-9.jpg">										                </div>
									                <div class="visite_libre">
									                    <p>VISIT NOW</p>
									                </div>
									                <p class="tag_p">+</p>
									            </div>
									        </a>
									        <div class="hot_properties_item_bot">
									        	<b>{{$post->price}}</b>
									            <p class="main_p">{{$post->content}}</p>
									            <p><a href="/properties/{{$post->alias}}" target="_blank">{{$post->address}}</a>
									            </p>
									            <p class="min_p">{!!$post->location!!}</p>
									        </div>
									    </div>
									</div>	
								@endforeach	
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('script')
	<script type='text/javascript' src='/js/jquery-migrate.min.js'></script>
	<script type='text/javascript'>
		/* <![CDATA[ */
		var srp = {"srp_url":"http:\/\/realestate.homula.com\/wp-content\/plugins\/simple-real-estate-pack-4","srp_inc":"http:\/\/realestate.homula.com\/wp-content\/plugins\/simple-real-estate-pack-4\/includes","srp_wp_admin":"http:\/\/realestate.homula.com\/wp-admin","ajaxurl":"http:\/\/realestate.homula.com\/wp-admin\/admin-ajax.php","srp_gmap_key":""};
		/* ]]> */
	</script>
	<script type='text/javascript' src='/js/srp.min.js'></script>
	<script type="text/javascript" src="/js/srp-MortgageCalc.min.js"></script>
	<script type="text/javascript" src="/js/jquery.formatCurrency-1.0.0.min.js"></script>
@endsection