@extends('layouts.frontend')

@section("title","Mortgage Insurance Calculators")

@section('styles')
	<link rel="stylesheet" type="text/css" href="/css/thickbox.css">
	<link rel="stylesheet" type="text/css" href="/css/itp-calc-jqueryui.css">
	<link rel="stylesheet" type="text/css" href="/css/itp-calc-style.css">
@endsection

@section('content')
	<style type="text/css">
		.mortgage-insurance-calculator-page {
			background: url(/images/best-mortgage-calculators-main-bg.jpg) no-repeat;
		    background-size: cover;
		    background-position: top;
		    padding-bottom: 50px;
		}
		.mic_page_content {
			margin-top: 150px;
			margin-bottom: 50px;
			background: #f3f4f8;
		}
		ul {
		    list-style-type: none;
		    margin-top: 0;
		    padding: 0;
		}
		ul li {
		    margin-bottom: 10px;
		}
		.mort-details-box h3 {
		    width: 100%;
		    text-align: center;
		    background: #039be6;
		    margin: 0 0 25px 0px;
		    padding: 20px 0;
		    font-size: 24px;
		    font-weight: bold;
		    color: white;
		    text-transform: uppercase;
		    line-height: 1.1;
		}
		#bodycopy .itp-calculator-body .itp-calculator .itp-calc-box {
		    background: #093689;
		    border-radius: 10px;
		    margin-bottom: 25px;
		    margin-left: 7px;
		}
		#bodycopy .itp-calculator-body .itp-calculator .col3-4 {
		    margin-bottom: 22px;
		}
		#bodycopy .itp-calculator-body .itp-calculator .slider-label {
		    color: #d6d8e5;
		    margin-bottom: 5px;
		    text-transform: uppercase;
		    font-weight: 500;
		}
		#bodycopy .itp-calculator-body #pro_price {
		    border-radius: 5px;
		    border: 0;
		    background: #fff;
		}
		#bodycopy .itp-calculator-body .itp-calculator .ui-slider-range {
		    border-radius: 30px;
		    background: rgb(3, 154, 227);
		}
		#bodycopy .itp-calculator-body .ui-slider .ui-slider-handle {
		    border: 0px;
		    border-radius: 50%;
		    width: 1.5em;
		    height: 1.5em;
		    top: -0.4em;
		    background: rgb(0, 119, 177);
		}
		#bodycopy .itp-calculator-body .itp-calculator .ui-slider-range {
		    border-radius: 30px;
		    background: rgb(3, 154, 227);
		}
		#bodycopy .itp-calculator-body .itp-calculator .col3-4-last {
		    margin-top: 20px;
		}
		#bodycopy .itp-calculator-body .mort-details-box #amt_pro_price {
		    background: #f2f3f5;
		    font-weight: 500;
		    border-radius: 7px;
		    text-align: center;
		    color: #08368b;
		}
		#bodycopy .itp-calculator-body .itp-calculator .mort-details-box #itp_mort_details {
		    background: none;
		    padding: 0;
		    border-radius: 10px;
		    overflow: hidden;
		    border: 1px solid #d1d1d3;
		    margin-left: 7px;
		    margin-bottom: 25px;
		}
		#bodycopy .itp-calculator-body #itp_mort_details tr {
		    border-bottom: solid 1px #d1d1d3;
		}
		#bodycopy .itp-calculator-body #itp_mort_details th {
		    color: #0298e4;
		}
		#bodycopy .itp-calculator-body #itp_mort_details th:first-child, #bodycopy #itp_mort_details td:first-child, 
		#bodycopy .itp-calculator-body #itp_mort_details th:nth-child(2), #bodycopy #itp_mort_details td:nth-child(2), 
		#bodycopy .itp-calculator-body #itp_mort_details th:nth-child(3), #bodycopy #itp_mort_details td:nth-child(3), 
		#bodycopy .itp-calculator-body #itp_mort_details th, #bodycopy #itp_mort_details td {
		    background: #fbfbfd;
		    border-right: 1px solid #d1d1d3;
		    text-align: center;
		}
		#bodycopy #itp_mort_details tr td:first-child {
		    text-align: left;
		    padding-left: 30px;
		}
		#bodycopy .itp-calculator-body .itp-calculator select {
		    border-radius: 7px;
		    background: #fdfdff;
		}
		img.wp-smiley, img.emoji {
		    display: inline;
		    border: none ;
		    box-shadow: none ;
		    height: 1em ;
		    width: 1em ;
		    margin: 0 .07em;
		    vertical-align: -0.1em;
		    background: none;
		    padding: 0;
		}
		.itp-calculator-body #itp_mort_details .ui-corner-all {
		    background: none;
		    border: 1px solid #cccccc;
		    border-radius: 10px;
		    height: 35px;
		}
		#bodycopy .itp-calculator-body #itp_mort_details .txt-percent-down-pay {
		    border-radius: 0;
		    border: 0;
		    box-shadow: none;
		    height: 26px;
		}
		#bodycopy .itp-calculator-body .ui-spinner a.ui-spinner-button {
		    border: 0;
		    background: none;
		}
		#bodycopy .itp-calculator-body .ui-state-default .ui-icon {
		    background: none;
		}
		#bodycopy .itp-calculator-body .ui-corner-all .span_css {
		    margin-left: -30px;
		    background: #c3c3c3;
		    width: 25px;
		    height: 25px;
		    display: inline-block;
		    border-radius: 50%;
		    font-weight: 900;
		}
		.itp-calculator-body .mort-details-box #itp_mort_details .alertbox {
		    display: block;
		    top: 50px;
		    height: auto;
		    left: 287px;
		    background: rgb(244, 245, 249);
		}
		.itp-calculator-body .itp-calculator {
		    width: 100% !important;
		}
		.itp-calculator-body > .ITP-payment-calculator {
			display: none;
		}

	</style>

	<div class="mortgage-insurance-calculator-page">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div class="mic_page_content">
						<div id="bodycopy" class="internal span-24">
							<div id="contentLeft" class="span-16 append-1 last" style="width:100%">								
								<div class="copy">				
									<!--copy-->	
									<div id="gcCal">
					                    <div id="CmhcCalculator1" class="itp-calculator-body">
					                    	<ul>
					                    		<li>
					                    			<div class="ITP-payment-calculator">
					                    				<div class="itp-calculator">
					                    					<div class="mort-details-box">
					                    						<h3>Payment Details</h3>
					                    						<div class="pro-price-box ui-corner-all itp-calc-box">
					                    							<div class="col3-4">
					                    								<div class="slider-label">Purchase Price:</div>
					                    								<div id="pro_price" class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" aria-disabled="false">
				                    										<div class="ui-slider-range ui-widget-header ui-corner-all ui-slider-range-min" style="width: 52.6316%;"></div>
				                    										<a class="ui-slider-handle ui-state-default ui-corner-all" href="http://www.canadaguaranty.ca/mortgage-calculators/insurance-premium-calculator/#" style="left: 52.6316%;"></a>
				                    									</div>
				                    								</div>
					                    							<div class="col3-4-last">
					                    								<input type="text" id="amt_pro_price" class="txt-box txt-price green ui-corner-all currency">
					                    							</div>
					                    						</div>
					                    						<div id="itp_mort_details" class="ui-corner-all itp-calc-box">
					                    							<table>
					                    								<tbody>
					                    									<tr>
					                    										<th></th>
					                    										<th>Scenario 1</th>
					                    										<th class="Scenario2">Scenario 2</th>
					                    										<th class="Scenario3">Scenario 3</th>
					                    									</tr>
					                    									<tr>
					                    										<td>Product:</td>
					                    										<td>
					                    											<select id="mort_prod0" name="mort_prod" tabindex="2">
					                    												<option value="">Select...</option>
					                    												<option value="STANDARD" selected="">Standard Products</option>
					                    												<option value="RENTAL">Rental Advantage</option>
					                    												<option value="LOWDOC">Low Doc Advantage</option>
					                    												<option value="FLEX95">Flex 95 Advantage</option>
					                    											</select>
					                    										</td>
					                    										<td class="Scenario2">
					                    											<select id="mort_prod1" name="mort_prod" tabindex="12">
					                    												<option value="">Select...</option>
					                    												<option value="STANDARD">Standard Products</option>
					                    												<option value="RENTAL">Rental Advantage</option>
					                    												<option value="LOWDOC" selected="">Low Doc Advantage</option>
					                    												<option value="FLEX95">Flex 95 Advantage</option>
					                    											</select>
					                    										</td>
					                    										<td class="Scenario3">
					                    											<select id="mort_prod2" name="mort_prod" tabindex="22">
					                    												<option value="">Select...</option>
					                    												<option value="STANDARD">Standard Products</option>
					                    												<option value="RENTAL" selected="">Rental Advantage</option>
					                    												<option value="LOWDOC">Low Doc Advantage</option>
					                    												<option value="FLEX95">Flex 95 Advantage</option>
					                    											</select>
					                    										</td>
					                    									</tr>
					                    									<tr>
					                    										<td>Down Payment:<span class="lbl-hint-italic">Minimum Down Payment <span id="min_dp_popup" class="icon-popup">⚠</span></span><span style="display:none" class="icon-popup-text"><h4>Minimum Down Payment Requirement</h4>As mandated by the Department of Finance, where the purchase price is &gt; $500,000 and &lt; $1,000,000, a minimum down payment of 5% is required on the first $500,000 of the purchase price, plus an additional 10% down payment on the portion of the purchase price above $500,000.<br>Some products may require a minimum down payment greater than 5%, regardless of the purchase price, and will be automatically adjusted. Please visit www.canadaguaranty.ca to view individual product guidelines.</span>
					                    										</td>
					                    										<td>
					                    											<span class="ui-spinner ui-widget ui-widget-content ui-corner-all">
					                    												<input type="text" value="5" id="percent_dp0" class="txt-percent-down-pay ui-spinner-input" tabindex="1" aria-valuemin="5" aria-valuemax="100" aria-valuenow="5" autocomplete="off" role="spinbutton">
					                    												<a class="ui-spinner-button ui-spinner-up ui-corner-tr ui-button ui-widget ui-state-default ui-button-text-only" tabindex="-1" role="button" aria-disabled="false">
					                    													<span class="ui-button-text">
					                    														<span class="ui-icon ui-icon-triangle-1-n">▲</span>
					                    													</span>
					                    												</a>
					                    												<a class="ui-spinner-button ui-spinner-down ui-corner-br ui-button ui-widget ui-state-default ui-button-text-only" tabindex="-1" role="button" aria-disabled="false">
					                    													<span class="ui-button-text">
					                    														<span class="ui-icon ui-icon-triangle-1-s">▼</span>
					                    													</span>
					                    												</a>
					                    											</span>
					                    											<span class="span_css">% </span>
					                    											<span class="lbl-amt-down-pay currency lbl-hint-italic">($38,824.50)</span>
					                    										</td>
					                    										<td class="Scenario2">
					                    											<span class="ui-spinner ui-widget ui-widget-content ui-corner-all">
					                    												<input type="text" value="10" id="percent_dp1" class="txt-percent-down-pay ui-spinner-input" tabindex="11" aria-valuemin="5" aria-valuemax="100" aria-valuenow="10" autocomplete="off" role="spinbutton">
					                    												<a class="ui-spinner-button ui-spinner-up ui-corner-tr ui-button ui-widget ui-state-default ui-button-text-only" tabindex="-1" role="button" aria-disabled="false">
					                    													<span class="ui-button-text">
					                    														<span class="ui-icon ui-icon-triangle-1-n">▲</span>
					                    													</span>
					                    												</a>
					                    												<a class="ui-spinner-button ui-spinner-down ui-corner-br ui-button ui-widget ui-state-default ui-button-text-only" tabindex="-1" role="button" aria-disabled="false">
					                    													<span class="ui-button-text">
					                    														<span class="ui-icon ui-icon-triangle-1-s">▼</span>
					                    													</span>
					                    												</a>
					                    											</span>
					                    											<span class="span_css">% </span>
					                    											<span class="lbl-amt-down-pay currency lbl-hint-italic">($55,000.00)</span>
					                    										</td>
					                    										<td class="Scenario3">
					                    											<span class="ui-spinner ui-widget ui-widget-content ui-corner-all">
					                    												<input type="text" value="20" id="percent_dp2" class="txt-percent-down-pay ui-spinner-input" tabindex="21" aria-valuemin="5" aria-valuemax="100" aria-valuenow="20" autocomplete="off" role="spinbutton">
					                    												<a class="ui-spinner-button ui-spinner-up ui-corner-tr ui-button ui-widget ui-state-default ui-button-text-only" tabindex="-1" role="button" aria-disabled="false">
					                    													<span class="ui-button-text">
					                    														<span class="ui-icon ui-icon-triangle-1-n">▲</span>
					                    													</span>
					                    												</a>
					                    												<a class="ui-spinner-button ui-spinner-down ui-corner-br ui-button ui-widget ui-state-default ui-button-text-only" tabindex="-1" role="button" aria-disabled="false">
					                    													<span class="ui-button-text">
					                    														<span class="ui-icon ui-icon-triangle-1-s">▼</span>
					                    													</span>
					                    												</a>
					                    											</span>
					                    											<span class="span_css">% </span>
					                    											<span class="lbl-amt-down-pay currency lbl-hint-italic">($110,000.00)</span>
					                    										</td>
					                    									</tr>
					                    									<tr>
					                    										<td>Amortization Period:</td>
					                    										<td>
					                    											<select id="amort_prd0" name="amort_prd" tabindex="3">
					                    												<option value="">Select...</option>
					                    												<option value="5">5 Years</option>
					                    												<option value="10">10 Years</option>
					                    												<option value="15">15 Years</option>
					                    												<option value="20">20 Years</option>
					                    												<option value="25" selected="">25 Years</option>
					                    											</select>
					                    										</td>
					                    										<td class="Scenario2">
					                    											<select id="amort_prd1" name="amort_prd" tabindex="13">
					                    												<option value="">Select...</option>
					                    												<option value="5">5 Years</option>
					                    												<option value="10">10 Years</option>
					                    												<option value="15">15 Years</option>
					                    												<option value="20" selected="">20 Years</option>
					                    												<option value="25">25 Years</option>
					                    											</select>
					                    										</td>
					                    										<td class="Scenario3">
					                    											<select id="amort_prd2" name="amort_prd" tabindex="23">
					                    												<option value="">Select...</option>
					                    												<option value="5">5 Years</option>
					                    												<option value="10">10 Years</option>
					                    												<option value="15" selected="">15 Years</option>
					                    												<option value="20">20 Years</option>
					                    												<option value="25">25 Years</option>
					                    											</select>
					                    										</td>
					                    									</tr>
					                    									<tr>
					                    										<td>Mortgage Insurance Amount:</td>
					                    										<td>
					                    											<span class="amt_mort_ins currency">$18,402.32</span>
					                    										</td>
						                    									<td class="Scenario2">
						                    										<span class="amt_mort_ins currency">$26,977.50</span>
						                    									</td>
						                    									<td class="Scenario3">
						                    										<span class="amt_mort_ins currency">$12,760.00</span>
						                    									</td>
						                    								</tr>
						                    								<tr>
						                    									<td>Total Mortgage Required:</td>
						                    									<td>
						                    										<span class="amt_mort_req currency">$529,577.82</span>
						                    									</td>
						                    									<td class="Scenario2">
						                    										<span class="amt_mort_req currency">$521,977.50</span>
						                    									</td>
						                    									<td class="Scenario3">
						                    										<span class="amt_mort_req currency">$452,760.00</span>
						                    									</td>
						                    								</tr>
					                    								</tbody>
						                    						</table>
					                    							<div id="descrp" class="ui-corner-all alertbox ui-state-highlight" style="display: none;">You have attempted to enter a down payment value below the required minimum. As mandated by the Department of Finance, where the purchase price is &gt; $500,000 and &lt; $1,000,000, a minimum down payment of 5% is required on the first $500,000 of the purchase price, plus an additional 10% down payment on the portion of the purchase price above $500,000. Some products may require a minimum down payment greater than 5%, regardless of the purchase price, and will be automatically adjusted.<span class="close">X</span></div>
						                    					</div>
						                    				</div>
						                    			</div>
						                    		</div>
						                    	</li>
						                    </ul>
					                    </div>
					                </div>
								</div>
							</div><!--Left Copy-->
						</div><!--end of #bodycopy-->
						<div class="clr"></div>
					</div>
					<div class="row bmcp_chart">
						<div class="chart-box-1 col-sm-4" style="padding-right:20px">
			                <div id="chartContainer" style="height: 300px; width: 100%">
			                </div>
			            </div>
			            <div class="chart-box-2 col-sm-4" style="padding:0 10px">
			                <div id="chartmidContainer" style="height: 300px; width: 100%">
			                </div>
			            </div>
			            <div class="chart-box-1 col-sm-4" style="padding-left:20px">
			                <div id="chartRightContainer" style="height: 300px; width: 100%">
			                </div>
			            </div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('script')
	<script type="text/javascript" src="/js/canvas.min.js"></script>
	<script type="text/javascript" src="/js/insurance-calculator-script.js"></script>
	<script type="text/javascript" src="/js/itp-mort-premium-calc.js"></script>
	<script type="text/javascript" src="/js/itp-calc-mort.js"></script>
	<script type="text/javascript" src="/js/jquery.formatCurrency-1.4.0.js"></script>
	<script type="text/javascript" src="/js/jquery-ui-1.10.3.custom.js"></script>
	<script type="text/javascript" src="/js/insurance-calculator.js"></script>
	
	<script type="text/javascript">
		window.onload = function () {
		    var chart = new CanvasJS.Chart("chartContainer",
		    {
		        theme: "theme2",
		        data: [
		        {
		            indexLabelFontSize: 12,
		            type: "pie",
		            showInLegend: false,
		            indexLabelMaxWidth: 50,
		            toolTipContent: "{y} - #percent %",
		            yValueFormatString: "#0.#,,. Million",
		            //legendText: "{indexLabel}",
		            dataPoints: [
		                {  y: 4181563, indexLabel: "PlayStation 3" },
		                {  y: 2175498, indexLabel: "Wii" },
		                {  y: 3125844, indexLabel: "Xbox 360" },
		                {  y: 1176121, indexLabel: "Nintendo DS"},
		                {  y: 1727161, indexLabel: "PSP" },
		                {  y: 4303364, indexLabel: "Nintendo 3DS"},
		                {  y: 1717786, indexLabel: "PS Vita"}
		            ]
		        }
		        ]
		    });
		    chart.render();

		    var chart2 = new CanvasJS.Chart("chartRightContainer",
		    {
		        theme: "theme2",
		        title:{
		          text: "Projected Tax Revenue",
		        },
		        axisX2: {
		            title: "(Fixcal year 2014)",
		          
		        },
		        data: [
		        {
		            indexLabelFontSize: 12,
		            type: "pie",
		            showInLegend: false,
		            indexLabelMaxWidth: 50,
		            toolTipContent: "{y} - #percent %",
		            yValueFormatString: "#0.#,,. Million",
		            //legendText: "{indexLabel}",
		            dataPoints: [
		                {  y: 4181563, indexLabel: "PlayStation 3" },
		                {  y: 2175498, indexLabel: "Wii" },
		                {  y: 3125844, indexLabel: "Xbox 360" },
		                {  y: 1176121, indexLabel: "Nintendo DS"},
		                {  y: 1727161, indexLabel: "PSP" },
		                {  y: 4303364, indexLabel: "Nintendo 3DS"},
		                {  y: 1717786, indexLabel: "PS Vita"}
		            ]
		        }
		        ]
		    });
		    chart2.render();

		    var chartmid = new CanvasJS.Chart("chartmidContainer", {
		        // title: {
		        //     text: "Spline Chart with Marker Customization"
		        // },
		        axisX:{
		            stripLines:[
		            {
		                value:1291141800000,
		                color: "red",
		                lineDashType: "dash",
		                label: "Forecast"
		            }
		            ]
		        },
		        data: [{
		            type: "spline",
		            markerSize: 10,
		            xValueType: "dateTime",
		            dataPoints: [
		              { x: 1088620200000, y :71},
		              { x: 1104517800000, y : 55 },
		              { x: 1112293800000, y:  50 },
		              { x: 1136053800000, y : 65 },
		              { x: 1157049000000, y : 95 },
		              { x: 1162319400000, y : 68 },
		              { x: 1180636200000, y : 28 },
		              { x: 1193855400000, y : 34 },
		              { x: 1209580200000, y : 14 },
		              { x: 1230748200000, y : 34 },
		              { x: 1241116200000, y : 44 },
		              { x: 1262284200000, y : 84 },
		              { x: 1272652200000, y : 4  },
		              { x: 1291141800000, y : 44 },
		              { x: 1304188200000, y : 11 }
		            ]
		        }]
		    });
		    chartmid.render();
		}
	</script>	
@endsection