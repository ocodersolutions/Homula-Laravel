@extends('layouts.frontend')

@section("title","Best Mortgage Calculators")

@section('content')
	<style type="text/css">
		.best-mortgage-calculators-page {
			background: url(/images/best-mortgage-calculators-main-bg.jpg) no-repeat;
		    background-size: cover;
		    background-position: top;
		}
		.bmc_page_content {
			margin-top: 150px;
			margin-bottom: 50px;
		}
		.bmcp_form {
			background: #f2f3f6;
		    opacity: 0.9;
		}
		.mg-calculator-container {
		    border-radius: 0px;
		    color: #ffffff;
		    background-color: #FFF;
		    padding-bottom: 26px;
		    font-family: Calibri, Verdana, Ariel, sans-serif;
		    margin-bottom: 45px;
		}
		.mg-calculator-header {
		    font-size: 30px;
		    font-weight: bold;
		    text-shadow: none;
		    text-transform: uppercase;
		    padding: 10px;
		    background: #039be5;
		    color: #fff;
		    text-align: center;
		}
		.mg-calculator-item-container {
		    width: 33.33%;
		    padding: 0 15px 0 15px;
		    margin-top: 35px;
		    float: left;
		}
		.mg-calculator-item-container label {
		    font-size: 18px;
		    color: #041f4a;
		    font-weight: normal;
		    margin-bottom: 10px;
	        float: left;
		    padding-right: 10px;
		    cursor: pointer;
		    display: block;
	        line-height: 1;
		    text-transform: uppercase;
		}
		.mg-tip {
		    color: #f3f3f5;
		    background-color: #041f4a;
		    bottom: 3px;
		    position: relative;
		    display: inline-block;
		    border-radius: 100px;
		    padding: 0px 5px 0px 5px;
		    cursor: default;
		    font-size: 10px;
		    margin-bottom: 3px;
		    line-height: normal;
		}
		.mg-tip .mg-tiptext {
		    background-color: #3f6cc3;
		    color: #ffffff;
		    visibility: hidden;
		    position: absolute;
		    z-index: 1;
		    width: 160px;
		    bottom: 125%;
		    left: 50%;
		    margin-left: -85px;
		    padding: 5px;
		    font-size: 14px;
		    text-align: center;
		    border-radius: 6px;
		}
		.mg-tip .mg-tiptext::after {
		    border-color: #3f6cc3 transparent transparent transparent;
		    content: "";
		    position: absolute;
		    top: 100%;
		    left: 50%;
		    margin-left: -5px;
		    border-width: 5px;
		    border-style: solid;
		    border-color: #555 transparent transparent transparent;
		}
		.mg-calculator-item {
		    position: relative;
		}
		.mg-calculator-input {
		    border: 1px solid #6782b5;
		    border-radius: 5px;
		    font-weight: normal;
		    font-size: 17px;
		    color: #000;
		    background-color: #fafafb;
	        box-shadow: 0 1px 0 0 rgba(0,0,0,0.12);
	        line-height: 48px;
	        position: relative;
		    transition: box-shadow .12s linear;
		    height: 33px;
		    padding: 9px 10px 7px 57px;
		    outline: 0;
		    width: 100%;
		}
		.mg-input-label {
		    color: #FFF;
		    background-color: #0a368a;
		    margin-top: 8px;
		    width: 28px;
		    line-height: 28px;
		    text-align: center;
		    padding: 0;
		    border-radius: 50%;
		    margin-left: 7px;
		    border-right: 1px solid #444444;
		    font-size: 15px;
		    position: absolute;
		    top: 0;
		    left: 0;
		}
		.mg-calculator-item-container.my_item_container {
		    width: 35%;
		}
		.item_container_margin {
		    margin-left: 12%;
		    margin-right: 5%;
		}
		.mg-calculator-item-container.mg-buttons {
		    margin: 0 auto;
		    float: none;
		}
		.mg-calculator-submit, .mg-calculator-reset {
		    margin-top: 60px;
		    background: #039be5;
		    border-radius: 8px;
		    text-transform: capitalize;
		    font-weight: bold;
		    text-align: center;
	        width: 45%;
		    height: 51px;
		    line-height: 42px;
		    font-size: 22px;
		    margin-right: 11px;
		    display: inline-block;
		    padding: 5px 10px 5px 10px;
	        cursor: pointer;
		}
		.mg-error-display {
		    color: #ffeb3b;
		    width: 100%;
		    text-align: center;
		    padding: 10px;
		    font-weight: bold;
		}
		.mgCalculator, #mgResults, #mgPrintButton {
		    display: none;
		}
		.mg-print-button {
		    color: #ffffff;
		    background-color: #000;
		    border: 0;
		    border-bottom: 1px solid #ffffff;
		    padding: 5px 10px;
		    width: 50px;
		    font-family: Calibri, Verdana, Ariel, sans-serif;
		    border-top-left-radius: 10px;
		    border-top-right-radius: 10px;
		    text-align: center;
		    outline: 0;
		    font-size: 13px;
		    text-transform: uppercase;
		}
		.mg-calculator-results {
		    color: #cccccc;
		    background-color: #222222;
		    width: 100%;
		    font-family: Calibri, Verdana, Ariel, sans-serif;
	        padding: 10px;
		}
		.mg-calculator-results .mg-calculator-item-container {
		    display: inline-block;
		    min-width: 180px;
		}
		.mg-calculator-results .mg-calculator-value {
		    font-weight: bold;
		    font-size: 30px;
		}
		.mg-calculator-results .mg-calculator-item-container label {
		    color: #FFF;
		}
		.mg-amortization {
		    border: 1px solid #000000;
		    border-radius: 5px;
		}
		.mg-amortization table {
		    width: 100%;
		    border-spacing: 0;
		}
		.mg-amortization thead {
		    color: #cccccc;
		    background-color: #333333;
		}
		.mg-amortization th, .mg-amortization td {
		    padding: 10px 0;
		    text-align: center;
		    width: 20%;
		}
		.mg-amortization .mg-amortization-body {
		    max-height: 400px;
		    overflow: auto;
		}
		.mg-amortization tbody {
		    color: #cccccc;
		    background-color: #545454;
		}
		.mg-amortization tr:nth-child(even) {
		    background-color: #444444;
		}
		.mg-amortization .mg-amortization-body tr:hover, .mg-yearly-row td {
		    color: #ffffff;
		    background-color: #3f6cc3;
		}
		.mg-yearly-row td {
		    font-weight: bold;
		}
		.bmcp_chart {
			margin-bottom: 100px;
		}

	</style>

	<div class="best-mortgage-calculators-page">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div class="bmc_page_content">
						<div class="bmcp_form">
							<div id="mgNoScript" style="display: none;">Please enable JavaScript to run this calculator</div>
							<form name="mgCalculator" class="mgCalculator ng-pristine ng-valid" style="display: block;">
			                    <div class="mg-calculator-container js-mg-calculator">
			                        <div class="mg-calculator-header">Mortgage Calculator</div>
			                        <div class="mg-calculator-item-container">
			                            <label> Home value </label>
			                            <div class="mg-tip">? <span class="mg-tiptext">Home value/price</span></div>
			                            <div class="mg-calculator-item">
			                                <input type="text" id="homeValue" value="600000" class="mg-calculator-input">
			                                <span class="mg-input-label">$</span>
			                            </div>
			                        </div>
			                        <div class="mg-calculator-item-container">
			                            <label> Loan amount </label>
			                            <div class="mg-tip">? <span class="mg-tiptext">Amount of money to be borrowed</span></div>
			                            <div class="mg-calculator-item">
			                                <input type="text" id="loanAmount" value="0" class="mg-calculator-input">
			                                <span class="mg-input-label">$</span>
			                            </div>
			                        </div>
			                        <div class="mg-calculator-item-container">
			                            <label> Loan term </label>
			                            <div class="mg-tip">? <span class="mg-tiptext">Loan period</span></div>
			                            <div class="mg-calculator-item">
			                                <input type="text" id="loanTerm" value="20" class="mg-calculator-input">
			                                <span class="mg-input-label">Y</span>
			                            </div>
			                        </div>
			                        <div class="mg-calculator-item-container">
			                            <label> Interest rate </label>
			                            <div class="mg-tip">? <span class="mg-tiptext">Yearly interest percentage</span></div>
			                            <div class="mg-calculator-item">
			                                <input type="text" id="interest" value="3.5" class="mg-calculator-input">
			                                <span class="mg-input-label">%</span>
			                            </div>
			                        </div>
			                        <div class="mg-calculator-item-container">
			                            <label> Closing costs </label>
			                            <div class="mg-tip">? <span class="mg-tiptext">Closing costs percentage</span></div>
			                            <div class="mg-calculator-item">
			                                <input type="text" id="closingCosts" value="0" class="mg-calculator-input">
			                                <span class="mg-input-label">%</span>
			                            </div>
			                        </div>
			                        <div class="mg-calculator-item-container">
			                            <label> Mortgage Insurance </label>
			                            <div class="mg-tip">? <span class="mg-tiptext">Mortgage Insurance</span></div>
			                            <div class="mg-calculator-item">
			                                <input type="text" id="pmi" value="0" class="mg-calculator-input">
			                                <span class="mg-input-label">%</span>
			                            </div>
			                        </div>
			                        <div class="mg-calculator-item-container my_item_container  item_container_margin">
			                            <label> Property tax </label>
			                            <div class="mg-tip">? <span class="mg-tiptext">Yearly property tax percentage</span></div>
			                            <div class="mg-calculator-item">
			                                <input type="text" id="propertyTax" value="0" class="mg-calculator-input">
			                                <span class="mg-input-label">%</span>
			                            </div>
			                        </div>
			                        <div class="mg-calculator-item-container my_item_container responsive_label">
			                            <label> Send report by email (optional) </label>
			                            <div class="mg-tip">? 
			                                <span class="mg-tiptext">Enter your email address if you want the report to be emailed to you. If not, leave the field empty</span>
			                            </div>
			                            <div class="mg-calculator-item">
			                                <input type="text" id="mgEmail" value="" class="mg-calculator-input">
			                                <span class="mg-input-label"> @ </span>
			                            </div>
			                        </div>
			                        <div class="mg-calculator-item-container mg-buttons">
			                            <div class="mg-calculator-submit" onclick="mgCalculatorCalculate()">Calculate</div>
			                            <div class="mg-calculator-reset" onclick="mgCalculatorReset()">Reset</div>
			                        </div>
			                        <div class="mg-error-display" id="mgErrorDisplay">                               
			                        </div>    
			                        <div class="clr"></div>
			                    </div>
			                </form>
			                <button class="mg-print-button" onclick="mgPrint()" id="mgPrintButton">Print</button>
			                <div class="mg-calculator-results" id="mgResults">
			                    <div class="mg-calculator-item-container">
			                        <div class="mg-calculator-item mg-calculator-value" id="mgTotalPayment">-</div>
			                        <label> Total payment </label>
			                        <div class="mg-tip">? 
			                            <span class="mg-tiptext">Total payment, including property tax, closing costs and PMI</span>
			                        </div>
			                    </div>
			                    <div class="mg-calculator-item-container">
			                        <div class="mg-calculator-item mg-calculator-value" id="mgAnnualPayment">-</div>
			                        <label> Annual payment amount </label>
			                        <div class="mg-tip">? 
			                            <span class="mg-tiptext">Annual payment amount, excluding property tax, closing costs and PMI</span>
			                        </div>
			                    </div>
			                    <div class="mg-calculator-item-container">
			                        <div class="mg-calculator-item mg-calculator-value" id="mgMonthlyPayment">-</div>
			                        <label> Monthly payment </label>
			                        <div class="mg-tip">? 
			                            <span class="mg-tiptext">Monthly payment with property tax included</span>
			                        </div>
			                    </div>
			                    <div class="mg-calculator-item-container">
			                        <div class="mg-calculator-item mg-calculator-value" id="mgTotalInterest">-</div>
			                        <label> Total interest </label>
			                        <div class="mg-tip">? 
			                            <span class="mg-tiptext">Total interest paid</span>
			                        </div>
			                    </div>
			                    <div class="mg-calculator-item-container">
			                        <div class="mg-calculator-item mg-calculator-value" id="mgYearlyTax">-</div>
			                        <label> Yearly property tax paid </label>
			                        <div class="mg-tip">? 
			                            <span class="mg-tiptext">Yearly property tax paid</span>
			                        </div>
			                    </div>
			                    <div class="mg-calculator-item-container">
			                        <div class="mg-calculator-item mg-calculator-value" id="mgTotalPMI">-</div>
			                            <label> Total PMI </label>
			                        <div class="mg-tip">? 
			                            <span class="mg-tiptext">Total Private Mortgage Insurance paid</span>
			                        </div>
			                    </div>
			                    <div class="mg-calculator-item-container">
			                        <div class="mg-calculator-item mg-calculator-value" id="mgMonthlyPMI">-</div>
			                        <label> Monthly PMI </label>
			                        <div class="mg-tip">? 
			                            <span class="mg-tiptext">Monthly Private Mortgage Insurance paid</span>
			                        </div>
			                    </div>
			                    <div class="mg-calculator-item-container">
			                        <div class="mg-calculator-item mg-calculator-value" id="mgTaxPaid">-</div>
			                        <label> Total tax paid </label>
			                        <div class="mg-tip">? 
			                            <span class="mg-tiptext">Private Mortgage Insurance (PMI) + Closing costs + Property tax</span>
			                        </div>
			                    </div>
			                    <div class="mg-calculator-item-container">
			                        <div class="mg-calculator-item mg-calculator-value" id="mgLastPayment">-</div>
			                        <label> Last payment date </label>
			                        <div class="mg-tip">? 
			                            <span class="mg-tiptext">The date of the last payment</span>
			                        </div>
			                    </div>    
			                    <div id="mgAmortization"></div>    
			                    <div class="clr"></div>
			                </div>
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
	</div>
@endsection

@section('script')
	<script type="text/javascript" src="/js/canvas.min.js"></script>
	<script type="text/javascript" src="/js/mg-calculator.js"></script>
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