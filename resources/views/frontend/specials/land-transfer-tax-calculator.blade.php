@extends('layouts.frontend')

@section('content')
	<script type="text/javascript" src="/js/chart.js"></script>
<script type="text/javascript" src="/js/jquery.canvasjs.min.js"></script>
<link rel="stylesheet" type="text/css" href="/css/mg-main.css">
<link rel="stylesheet" type="text/css" href="/css/mg-dark-grey.css">


<style type="text/css">
	.mg-calculator-submit {
		background-color: #039be5!important;
		border-radius: 12px!important;
	    background-repeat: no-repeat;
	    border: none!important;
	    text-align: center;
	    font-size: 24px!important;
	    width: 167px;
	    box-shadow: none!important;
		line-height: 25px;
	}
	.page-id-11375 .homebg {
	    background-image: url(/images/ontario-mortgage-calculator-bg.png)!important;
	    background-size: cover;
	    background-position: center top;
	}
	.canvasjs-chart-credit { display:none!important; }
</style>
<script language="javascript">
		function numberFilter (s) {
		filteredValues = "1234567890.";	 // Characters stripped out
		var i;
		var returnString = "";
		for (i = 0; i < s.length; i++) {  // Search through string and append to unfiltered values to returnString.
		var c = s.charAt(i);
		if (filteredValues.indexOf(c) != -1) returnString += c;
		}
			return returnString;
		}

		function calculate(){
			price = numberFilter(document.calculator.price.value);
			leftt = price;
			total_tax = 0;
			toronto_tax = 0;

			if (price > 55000){
				tmp_tax = 55000 * 0.005;
				total_tax += tmp_tax;
				price -= 55000;
			} else {
				tmp_tax = price * 0.005;
				total_tax += tmp_tax;
				price = 0;
			}

			if (price > 195000){
				tmp_tax = 195000 * 0.01;
				total_tax += tmp_tax;
				price -= 195000;
			} else {
				tmp_tax = price * 0.01;
				total_tax += tmp_tax;
				price = 0;
			}

			if (price > 150000){
				tmp_tax = 150000 * 0.015;
				total_tax += tmp_tax;
				price -= 150000;
			} else {
				tmp_tax = price * 0.015;
				total_tax += tmp_tax;
				price = 0;
			}

			if (price > 0){
				tmp_tax = price * 0.02;
				total_tax += tmp_tax;
				price = 0;
			}

			if (document.calculator.firsttimehomebuyer.checked==true){
				if (total_tax > 2000)
					total_tax = total_tax - 2000;
				else
					total_tax = 0;
			}
			total_tax = Math.round(total_tax);
			if (document.calculator.torontopurchase.checked==true){
				if (leftt > 55000){
					toronto_tax = 275;
					leftt = leftt - 55000;
				} else {
					toronto_tax = leftt * .005;
					leftt = 0;
				}

				if (leftt > 345000){
					toronto_tax = toronto_tax + 3450;
					leftt = leftt - 345000;
				} else {
					toronto_tax = toronto_tax + (leftt * .01);
					leftt = 0;
				}

				if (document.calculator.firsttimehomebuyer.checked==true)
					toronto_tax = 0;

				if (leftt > 0){
					toronto_tax = toronto_tax + (leftt * .02);
				}
				toronto_tax = Math.round(toronto_tax);
				total_tax = total_tax + toronto_tax;
			}

			document.calculator.tax.value = total_tax;
			return false;
		}
</script>
<style type="text/css">
	label {
	    color: #757575;
	    cursor: pointer;
	    display: block;
	    font-size: 11px;
	    font-weight: 600;
	    line-height: 1;
	    text-transform: uppercase;
	}
	.clear {
	    clear: both;
	}
	input[type=checkbox] {
	    border: 0;
	    cursor: pointer;
	    height: 20px;
	    margin: 0 10px 0 0;
	    position: relative;
	    overflow: hidden;
	    vertical-align: -5px;
	    width: 20px;
	}
	input[type=checkbox]:before {
	    background-color: #fff;
	    border: 2px solid #e0e0e0;
	    content: '';
	    display: block;
	    height: 20px;
	    left: 0;
	    opacity: 1;
	    position: absolute;
	    transition: opacity .15s linear;
	    top: 0;
	    width: 20px;
	}
	input[type=checkbox]:after {
	    border: 2px solid #ec407a;
	    content: '';
	    display: block;
	    height: 23px;
	    left: -5px;
	    opacity: 0;
	    position: absolute;
	    top: -9px;
	    transform: rotate(-45deg);
	    -webkit-transform: rotate(-45deg);
	    transition: opacity .15s linear;
	    width: 27px;
	    background: #fff;
	}
	input[type=checkbox]:checked:before {
	    border-color: #fff;
	}
	input[type=checkbox]:checked:after {
	    opacity: 1;
	}
	.main-cal-cls{
		border: 0;
		margin-top: 115px;
		margin-bottom: 180px;
	}
	.mg-calculator-container{
		background-color: #eeeeee;
		    margin-bottom: 0px;
	}
	.mg-calculator-header{
		background: #039be5;
		font-size: 28px;
		padding: 2% 0px;
		text-transform: uppercase;
		font-weight: bold;
		color: #fff;
	}
	.input-group{
		width: 60%;
    	float: right;
    	padding: 4px;
    	border: 1px solid #6a84b7;
    	background: #fff;
    	border-radius: 10px;
	}
	.form-group{
		margin-bottom: 0;
	    line-height: 47px;
	    border: 1px solid #e9eaea;
	    padding: 5px;
	    background: #f9fafb;
	}
	.form-control {
	    box-shadow: none !important;
	}
	.form-group label{
		display: initial;
	    padding-left: 14px;
	    font-size: 14px;
    	font-weight: normal;
	}
	.input-group.input-group-lg span{
		min-width: auto;
	    padding: 0px;
	    background: #0a368a;
	    width: 37px;
	    border-radius: 50%;
        height: auto;
        color: #fff;
	}
	form input[type=submit]{
		background-image: none;    
		padding: 0 34px;
	    width: 210px;
	    font-weight: bold;
	    font-size: 17px!important;
	    box-shadow: 1px 2px 2px #000!important;
	}
	.input-group.input-group-lg input{
		border: 0;
		height: 37px;
		background: #fff;
	}
	.canvasjs-chart-canvas{
		border: 1px solid #000;
	}
	.well{
		background-color: #dff5ff;
		margin-bottom: 0px;
		background-image: none;
	}
	.well .box-well{
		width: 50%;
    	float: left;
    	margin-bottom: 0px;
	}
	.well .box-well h3{
	    text-transform: uppercase;
		color: #fff;
		font-size: 19px;
		float: left;
		padding: 10px;
		background: #223c6e;
	}
	#chartContainer{
		height: 300px; 
		width: 100%;
	}
	.checkbox label{
		line-height: 22px;
		font-size: 14px;
	}
	ul.list-unstyled{
		color: #616161;
		clear: both;
		text-transform: uppercase;
	}
	ul.list-unstyled li{
		font: normal normal normal 14px/1 FontAwesome;
		line-height: 20px;
	}
	ul.list-unstyled li:before{
		content: "\f105";
		margin-right: 6px;
	}
	#chartContainer {
		background:#FFF;		
	  	position: relative;
	}
	#chartContainer:before, #chartContainer:after	{
	    z-index: 0;
	    position: absolute;
	    content: "";
	    bottom: 15px;
	    left: 26px;
	    width: 50%;
	    top: 80%;
	    max-width: 300px;
	    background: #777;
	    box-shadow: 0 15px 20px #777;
	    transform: rotate(-5deg);
	}
	.canvasjs-chart-container {
		z-index: 9;
	}
	#chartContainer:after	{
	  transform: rotate(5deg);
	  right: 26px;
	  left: auto;
	}
	.effect6 {
		z-index: 0;	
	    position:relative; 
	}
	.effect6:before, .effect6:after {
	  	content: "";
	    position: absolute;
	    z-index: -1;
	    box-shadow: 0 0 8px rgba(0,0,0,0.8);
	    top: 50%;
	    bottom: 2px;
	    left: 50px;
	    right: 50px;
	    border-radius: 100px / 10px;
	}
	.main {
		margin: 0;
	}
	@media (min-width: 380px) and (max-width: 767px) {
		.main-cal-cls {
			margin-top: 50px;
			margin-bottom: 50px;
		}
		.input-group {
			float: none;
			width: 100%;
		}
		.rlgn-col-flush {
			padding: 0;
		}
		.well {
			padding: 5px;
		}
		.well .box-well {
			width: 100%;
			float: none;
		}
		#desc-right-main {
			margin-bottom: 30px;
		}
	}

</style>

<div style="background-image: url(/images/background-land-transfer.jpg); background-size: cover;">
   <div class="container">        
        <div class="row main-cal-cls">
            <div class="col-md-12" style="float:none; margin:0 auto; ">
                <div class="hutlrb" style="float:none; margin:0 auto; padding-top:0px;">
                    <!--          <article id="page-590" class="">-->
                    <div>
    					<div class="mg-calculator-container js-mg-calculator">
    						<div class="mg-calculator-header">Land Transfer Tax Calculator</div>
    						<div id="rlgn-zone-content" class="rlgn-zone clearfix">
								<div class="rlgn-zone-inner clearfix">
									<div class="container-fluid">
										<div class="row">
											<div class="col-xs-12 rlgn-col-flush">
												<div id="rlgn-module-id-32" class="rlgn-module rlgn-module-type-SyndicatedContent">
													<!-- webcode #648  start -->
													<!-- real-estate-calculators/Land Transfer Tax -->
													<div class="rlgn-widget ">
														<div class="container-fluid">
															<div class="row" style="margin-bottom: 40px;">
																<div class="col-md-7 col-xs-12">
																	<form name="calculator">
																		<h2 style="color:#000; margin-bottom: 32px; text-transform: uppercase; font-size: 20px;">Purchase Information</h2>
																		<div class="effect6">
																			<div class="form-group">
																				<label id="rb_purchasePrice" class="control-label">Purchase Price</label>
																				<div class="input-group input-group-lg">
																					<span class="input-group-addon" style="padding: 0;height: auto;">$</span>
																					<input style="height: 37px;" class="input form-control" type="text" value="600,000" name="price">
																				</div>
																			</div>
																		</div>
																		<div class="checkbox">
																			<label for="firsttimehomebuyer">
																				<input style="background: #fff;" data-toggle="checkbox" type="checkbox" value="1" name="firsttimehomebuyer" id="firsttimehomebuyer">&nbsp;&nbsp;&nbsp;I am a first time home buyer
																			</label> 
																		</div>
																		<div class="checkbox">
																			<label for="torontopurchase">
																				<input style="background: #fff;" data-toggle="checkbox" type="checkbox" vvalue="1" name="torontopurchase" id="torontopurchase">&nbsp;&nbsp;&nbsp;I am purchasing a property located in Toronto
																			</label>
																		</div>
																		<p><input type="submit" class="mg-calculator-submit" value="Calculate" onClick="return calculate();"></p>
																		<h2 style="color:#000; margin-top: 40px;">Results</h2>
																		<div class="effect6">
																			<div class="form-group">
																				<label id="rb_totalLandTax" class="control-label">Total Land Transfer Tax</label>
																					<div class="input-group input-group-lg">
																						<span class="input-group-addon">$</span>
																						<input class="input form-control" value=""  disabled="" name="tax">
																					</div>
																			</div><!--end .form-group-->
																		</div>
																	</form>
																</div><!-- end .col-md-6-->
																<div class="col-md-5 col-xs-12" style="padding-top: 75px;">
 																	<script type="text/javascript">
																		window.onload = function () {
																			var chart = new CanvasJS.Chart("chartContainer",
																			{
																				zoomEnabled: true,      
																				title:{
																					//text: "X Axis Labels adapt automatically on Zooming" 
																				},
																				axisX :{
																					labelAngle: -30
																				},
																				axisY :{
																					includeZero: false
																				},
																				legend: {
																					horizontalAlign: "right",
																					verticalAlign: "center"        
																				},
																				data: data,  // random generator below
																			});
																			chart.render();
																		}

																		var limit = 10000;    //increase number of dataPoints by increasing this

																		var y = 0;
																		var data = []; var dataSeries = { type: "line" };
																		var dataPoints = [];
																		for (var i = -limit/4; i <= limit/4; i++) {

																			y += (Math.random() * 10 - 5);
																			dateTime = new Date(2006, 08, 15);

																			//dateTime.setMilliseconds(dateTime.getMilliseconds() + i);
																			//dateTime.setSeconds(dateTime.getSeconds() + i);
																			//dateTime.setMinutes(dateTime.getMinutes() + i);
																			//dateTime.setHours(dateTime.getHours() + i);
																			dateTime.setDate(dateTime.getDate() + i);
																			//dateTime.setMonth(dateTime.getMonth() + i);
																			//dateTime.setFullYear(dateTime.getFullYear() + i);

																			dataPoints.push({         
																				x: dateTime,
																				y: y
																			});
																		}

																		dataSeries.dataPoints = dataPoints;
																		data.push(dataSeries);               

																	</script>

																	<div id="chartContainer">
																	<div style="background: #fff;
																	    height: 100%;
																	    z-index: 99;
																	    position: absolute;
																	    width: 100%;"></div>
																	</div>
																</div><!-- end .col-md-6-->
															</div><!-- end .row-->
   															<div id="desc-right-main">
													        	<div class="well well-lg">
													        		<div class="box-well">
																		<h3>Ontario Land Transfer Tax Explained</h3>
																		<ul class="list-unstyled">
																			<li>0.5% - on the first $55,000</li>
																			<li>1.0% - on portion between $55,000 - $250,000</li>
																			<li>1.5% - on balance over $250,000</li>
																			<li>2.0% - on anything over $400,000</li>
																			<li><i>Qualifying first time buyers receive up to a $2000 credit</i></li>
																		</ul>
																	</div>

																	<div class="box-well">
																		<h3>Toronto Land Transfer Tax Explained</h3>
																		<ul class="list-unstyled">
																			<li>0.5% - on the first $55,000</li>
																			<li>1.0% - on portion between $55,000 - $400,000</li>
																			<li>2.0% - on anything over $400,000</li>
																			<li><i>First time buyers are exempt on the first $400,000</i></li>
																		</ul>
																	</div>
																	<div class="clear"></div>
																</div>
													        </div>
														</div>
													</div>
													<!-- webcode #648 -->

												</div>
											</div>	
										</div>
									</div>
								</div>
							</div>
    					</div><!-- end calculator container -->
    				</div>
                    
                    <br>
                    <br>
                    
                    <!--          </article>-->
                    <div class="clearfix"></div>    
                </div><!--Col 11 End Hut-->
            </div><!--Col 12 End Hut-->
        </div><!--row End Hut-->
        
   </div>
</div>
	
@endsection

{{-- @section('script')
	<script type="text/javascript" src="/js/canvas.min.js"></script>
	<script type="text/javascript" src="/js/mg-calculator.js"></script>
	
@endsection --}}