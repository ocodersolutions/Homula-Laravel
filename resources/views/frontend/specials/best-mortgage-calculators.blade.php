@extends('layouts.frontend')

@section('content')
	<style type="text/css">
		
	</style>
	<div class="best-mortgage-calculators-page">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div class="bmcp_form">
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
		                    </div>
		                </form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection