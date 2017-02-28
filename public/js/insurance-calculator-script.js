(function($) {

    function CmhcCalculator(o) {
        this._options = {
            Scenario3hide: 800,
            Scenario2hide: 600
        };
        this._options = $.extend({}, this._options, o);
    }


    CmhcCalculator.prototype = {
        pupulateCalculatorData: function(controls) {
            if (controls == null || controls == "undefined") {
                for (var i = 0; i < 3; i++) {
                    this.validateCalcControls(i);
                }
            } else {
                var indx = controls.substr(controls.length - 1);
                this.validateCalcControls(indx);
            }

            //format currency
            this.Self.find(".currency").formatCurrency();
        },
        validateCalcControls: function(indx) {
            var askingPrice = this.Self.find("#amt_pro_price").asNumber();
            var arrPercentDownPay = this.Self.find("#itp_mort_details .txt-percent-down-pay");
            var arrAmtDownPay = this.Self.find("#itp_mort_details .lbl-amt-down-pay");
			var mortProd = this.Self.find("#mort_prod" + indx).val();

            //global variable
			percentDownPay = $(arrPercentDownPay[indx]).asNumber();

			if (percentDownPay < 5) {
                $(arrPercentDownPay[indx]).val('5');
                percentDownPay = 5;
                this.showAlertBox("error", "Down payment cannot be less than " + percentDownPay + "%. Down payment adjusted accordingly.");
            }
            if (percentDownPay > 100) {
                $(arrPercentDownPay[indx]).val("100");
                percentDownPay = 100;
                this.showAlertBox("error", "Down payment cannot exceed " + percentDownPay + "% of the purchase price. Down payment value adjusted accordingly.");
            }

            this.adjustMortRateForProduct(this.Self.find("#percent_dp" + indx).val(), indx);	//use this now
            var down_pay_amt_for_label = getDownpayAmount(askingPrice, percentDownPay);

            //update down pay label
            $(arrAmtDownPay[indx]).text('(' + down_pay_amt_for_label + ')');
            //##############

            var loan2Value = getLoan2Value(percentDownPay, mortProd);

            var amtMortgage = askingPrice - Math.abs($(arrAmtDownPay[indx]).asNumber());
            this.populateCells(loan2Value, indx, amtMortgage, $("#amort_prd" + indx).val(), mortProd);
        },

        //main function all things done here
        populateCells: function(loan2Value, index, amtMortgage, amortPrd, mort_prod) {
            var cellMortIns = this.Self.find("#itp_mort_details .amt_mort_ins");
            var cellMortReq = this.Self.find("#itp_mort_details .amt_mort_req");

            var cgPrm = cgPremium(loan2Value, mort_prod);
            var cgSurc = cgSurcharge(loan2Value, parseInt(amortPrd, 10));
            var amtIns = amtMortgage * (cgPrm + cgSurc);
            var amtMortReq = amtMortgage + amtIns;
			console.log('populateCells:: cgPrm:' + cgPrm + ', cgSurc: ' + cgSurc + '; amtIns: ' + amtIns  + '; amtMortReq: ' + amtMortReq);

            $(cellMortIns[index]).text(amtIns);
            $(cellMortReq[index]).text(amtMortReq);

        },

        populateAmortPeriod: function(downPayPercent, indx) {
            var amortPrd = this.Self.find("#amort_prd" + indx);
            if (downPayPercent < 20) {
                if (amortPrd.val() > 25) {
                    amortPrd.val(25);
                    this.showAlertBox("error", "For down payment of " + downPayPercent + "% amortization period cannot exceed more than 25 years. Down payment adjusted accordingly.");
                }
            }
        },		

        populateMortProduct: function(downPayPercent, indx) {
            var mortProd = this.Self.find("#mort_prod" + indx);
			var selprod = mortProd.val();
			mortProd.find('option[value=FLEX95], option[value=LOWDOC], option[value=RENTAL]').attr('disabled', false);//enable all options first
			
			if (downPayPercent === 5) 
                mortProd.find('option[value=LOWDOC], option[value=RENTAL]').attr('disabled', true);
			else if (downPayPercent === 100) 
                mortProd.find('option[value=LOWDOC], option[value=FLEX95]').attr('disabled', true);
			else 
                mortProd.find('option[value=FLEX95]').attr('disabled', true);
			
			if (downPayPercent < 20 || downPayPercent > 85)
                mortProd.find('option[value=RENTAL]').attr('disabled', true);
			
			var hasProd = mortProd.find('option:not(:disabled)[value='+ selprod +']').val();
			var curProd = mortProd.find('option:not(:disabled)').last().val();
			//console.log(selprod +'==curProd= '+ curProd + ':hasProd=' + hasProd);
			if(hasProd === undefined)
				mortProd.val(curProd);
        },
		
		///////////////////////////////this new logic to use
		adjustMortRateForProduct: function(percent_downpay, indx) {
		    var elm_mort_prod = this.Self.find("#mort_prod" + indx),
				mort_prod = elm_mort_prod.val(),
				elm_downpay = this.Self.find("#percent_dp" + indx),
                prev_rate = elm_downpay.defaultValue,
				percent_min_downpay = getProdMinDownPayment(mort_prod);

		    var askingPrice = this.Self.find("#amt_pro_price").asNumber();
		    min_req_downpay_percent = getMinimumDownpayPercent(askingPrice);

		    percent_min_downpay = percent_min_downpay < min_req_downpay_percent ? min_req_downpay_percent : percent_min_downpay;

            //check if user entered higher rate
		    percent_min_downpay = percent_min_downpay < percent_downpay ? percent_downpay : percent_min_downpay;


                        percent_downpay = parseFloat(percent_downpay);
                        percent_min_downpay = parseFloat(percent_min_downpay);
                        var percent_min_downpay_without_fixed = percent_min_downpay;


                        var min_req_downpay_percent_without_fixed = min_req_downpay_percent;
                        min_req_downpay_percent = parseFloat(min_req_downpay_percent.toFixed(3));

			//debugger;
			if (mort_prod === 'FLEX95' && percent_downpay > 9.99) {
                            if(min_req_downpay_percent <= 5.833){
                                elm_downpay.val(5.833);
	                        percentDownPay = 5.833333333333334;

                                this.showAlertBox("error", "For this product, the maximum down payment is 9.99%. Down payment adjusted accordingly."); 
                            }else{

                                elm_downpay.val(min_req_downpay_percent);
	                        percentDownPay = min_req_downpay_percent_without_fixed;

                                this.showAlertBox("error", "For this product, the maximum down payment is 9.99%. Down payment adjusted accordingly.");
                            }
			}
 
                        percent_min_downpay = parseFloat(percent_min_downpay);
                        var percent_min_downpay_org = percent_min_downpay;

 
                        percent_min_downpay = parseFloat(percent_min_downpay.toFixed(3));



			if (percent_downpay < min_req_downpay_percent) {
			    elm_downpay.val(percent_min_downpay );
			    this.showAlertBox("info", "You have attempted to enter a down payment value below the required minimum. As mandated by the Department of Finance, where the purchase price is > $500,000 and < $1,000,000, a minimum down payment of 5% is required on the first $500,000 of the purchase price, plus an additional 10% down payment on the portion of the purchase price above $500,000. Some products may require a minimum down payment greater than 5%, regardless of the purchase price, and will be automatically adjusted.");
			    percentDownPay = percent_min_downpay_without_fixed;
			}
			else if (percent_downpay < percent_min_downpay){
                elm_downpay.val(percent_min_downpay );
				this.showAlertBox("error", "For this product, a minimum " + percent_min_downpay_org + "% down payment must be entered. Down payment adjusted accordingly.");
			    percentDownPay = percent_min_downpay_without_fixed;
			}

        },

		showAlertBox: function (msgType, msgText) {
		    var elm = this.Self.find("#descrp");
		        elm.css("display", "block").addClass("ui-corner-all alertbox");
		        elm.addClass(msgType == "error" ? "ui-state-error" : "ui-state-highlight");

		        if (msgType == "error"){
		            //elm.text(msgText).delay(5000).slideUp(1000);

                            elm.text(msgText).append('<span class="close">X</span>');
                            this.Self.find(".close").click(function(){ $("#descrp").slideUp(1000); });
                        }
		        else{
		            elm.text(msgText).append('<span class="close">X</span>');		    
                        }

	    
        },
        Self: null,
        bShowScenario3: true,
        bShowScenario2: true,
        Scenario3Hide: function () {
            this.Self.find('.Scenario3').hide();
            this.Self.find('.scenarios').empty();
            this.Self.find('.scenarios').append("<option value=\"0\">Scenario 1</option>");
            this.Self.find('.scenarios').append("<option value=\"1\">Scenario 2</option>");
        },
        Scenario2Hide: function () {
            this.Self.find('.Scenario2').hide();
            this.Self.find('.scenarios').empty();
            this.Self.find('.scenarios').append("<option value=\"0\">Scenario 1</option>");
        },
        Scenario3Show: function () {
            this.Self.find('.Scenario3').show();
            this.Self.find('.scenarios').empty();
            this.Self.find('.scenarios').append("<option value=\"0\">Scenario 1</option>");
            this.Self.find('.scenarios').append("<option value=\"1\">Scenario 2</option>");
            this.Self.find('.scenarios').append("<option value=\"2\">Scenario 3</option>");

        },
        Scenario2Show: function () {
            this.Self.find('.Scenario2').show();
            this.Self.find('.scenarios').empty();
            this.Self.find('.scenarios').append("<option value=\"0\">Scenario 1</option>");
            this.Self.find('.scenarios').append("<option value=\"1\">Scenario 2</option>");
            this.Self.find('.scenarios').append("<option value=\"2\">Scenario 3</option>");

        },
        BodyDiv:null,
        Create: function(parent) {
            var mySelf = this;

            $(window).resize(function() {
                
                if ((mySelf.BodyDiv.width() < mySelf._options.Scenario3hide) && (mySelf.bShowScenario3)) {
                    mySelf.Scenario3Hide();
                    mySelf.bShowScenario3 = false;
                } else if ((mySelf.BodyDiv.width() >= mySelf._options.Scenario3hide) && (!mySelf.bShowScenario3)) {

                    mySelf.Scenario3Show();
                    mySelf.bShowScenario3 = true;
                }

                if ((mySelf.BodyDiv.width() < mySelf._options.Scenario2hide) && (mySelf.bShowScenario2)) {
                    mySelf.Scenario2Hide();
                    mySelf.bShowScenario2 = false;
                } else if ((mySelf.BodyDiv.width() >= mySelf._options.Scenario2hide) && (!mySelf.bShowScenario2)) {

                    mySelf.Scenario2Show();
                    mySelf.bShowScenario2 = true;
                }
            });

            this.Self = parent;
            this.BodyDiv = $("<div class='ITP-payment-calculator'>").appendTo(parent);
            $("<p>Use the Insurance Premium Calculator to help you determine the applicable premium rate on an insured mortgage. The premium amount depends on a number of factors, including the product type, amount of down payment and amortization of the loan. To learn more about available Canada Guaranty products and their applicable premium rates, please visit the <a target='_blank' href='http://www.canadaguaranty.ca/insurance-products/'>Complete Product Suite</a> page.</p>").appendTo(this.BodyDiv);
            var itpCalculator = $("<div class=\"itp-calculator\">").appendTo(this.BodyDiv);
            var mortdetailsbox = $("<div class=\"mort-details-box\">").appendTo(itpCalculator);

            $("<h3>Payment Details</h3>").appendTo(mortdetailsbox);
            var propricebox = $("<div class=\"pro-price-box ui-corner-all itp-calc-box\">").appendTo(mortdetailsbox);
            var div = $("<div class=\"col3-4\">").appendTo(propricebox);
            $("<div class=\"slider-label\">Purchase Price:</div>").appendTo(div);
            $("<div id=\"pro_price\"></div>").appendTo(div);

            div = $("<div class=\"col3-4-last\">").appendTo(propricebox);
            $("<input type=\"text\" id=\"amt_pro_price\" class=\"txt-box txt-price green ui-corner-all currency\" />").appendTo(div);

            var itpmortdetails = $("<div id=\"itp_mort_details\" class=\"ui-corner-all itp-calc-box\">").appendTo(mortdetailsbox);
            var table = $("<table/>").appendTo(itpmortdetails);
            var tr = $("<tr/>").appendTo(table);

            $("<th/>").appendTo(tr);
            $("<th>Scenario 1</th>").appendTo(tr);
            $("<th class='Scenario2'>Scenario 2</th>").appendTo(tr);
            $("<th class='Scenario3'>Scenario 3</th>").appendTo(tr);

            //product
            tr = $("<tr/>").appendTo(table);

            $("<td>Product:</td>").appendTo(tr);
            var td = $("<td/>").appendTo(tr);
            var mortPrd0 = $("<select id=\"mort_prod0\" name=\"mort_prod\" tabindex=\"2\">").appendTo(td);
            mortPrd0.append("<option value=\"\">Select...</option>");
            mortPrd0.append("<option value=\"STANDARD\" selected>Standard Products</option>");
            mortPrd0.append("<option value=\"RENTAL\">Rental Advantage</option>");
            mortPrd0.append("<option value=\"LOWDOC\">Low Doc Advantage</option>");
            mortPrd0.append("<option value=\"FLEX95\" >Flex 95 Advantage</option>");

            td = $("<td  class='Scenario2'/>").appendTo(tr);
            var mortPrd1 = $("<select id=\"mort_prod1\" name=\"mort_prod\" tabindex=\"12\">").appendTo(td);
            mortPrd1.append("<option value=\"\">Select...</option>");
            mortPrd1.append("<option value=\"STANDARD\">Standard Products</option>");
            mortPrd1.append("<option value=\"RENTAL\">Rental Advantage</option>");
            mortPrd1.append("<option value=\"LOWDOC\" selected>Low Doc Advantage</option>");
            mortPrd1.append("<option value=\"FLEX95\">Flex 95 Advantage</option>");

            td = $("<td class='Scenario3'/>").appendTo(tr);
            var mortPrd2 = $("<select id=\"mort_prod2\" name=\"mort_prod\" tabindex=\"22\">").appendTo(td);
            mortPrd2.append("<option value=\"\">Select...</option>");
            mortPrd2.append("<option value=\"STANDARD\">Standard Products</option>");
            mortPrd2.append("<option value=\"RENTAL\" selected>Rental Advantage</option>");
            mortPrd2.append("<option value=\"LOWDOC\">Low Doc Advantage</option>");
            mortPrd2.append("<option value=\"FLEX95\">Flex 95 Advantage</option>");
			
			//down payment
            tr = $("<tr/>").appendTo(table);
            $("<td>Down Payment:<span class=\"lbl-hint-italic\">Minimum Down Payment <span id=\"min_dp_popup\" class=\"icon-popup\" >&#x26a0;</span></span><span style=\"display:none\" class=\"icon-popup-text\"><h4>Minimum Down Payment Requirement</h4>As mandated by the Department of Finance, where the purchase price is > $500,000 and < $1,000,000, a minimum down payment of 5% is required on the first $500,000 of the purchase price, plus an additional 10% down payment on the portion of the purchase price above $500,000.<br>Some products may require a minimum down payment greater than 5%, regardless of the purchase price, and will be automatically adjusted. Please visit www.canadaguaranty.ca to view individual product guidelines.</span></td>").appendTo(tr);

            //$("<td>Down Payment:<span class=\"lbl-hint-italic\">Minimum Down Payment <span id=\"min_dp_popup\" class=\"icon-popup\" title=\"<h2>Minimum Down Payment Requirement</h2>As mandated by the Department of Finance, where the purchase price is > $500,000 and < $1,000,000, a minimum down payment of 5% is required on the first $500,000 of the purchase price, plus an additional 10% down payment on the portion of the purchase price above $500,000.<br>Some products may require a minimum down payment greater than 5%, regardless of the purchase price, and will be automatically adjusted. Please visit www.canadaguaranty.ca to view individual product guidelines.\">&#x26a0;</span></span></td>").appendTo(tr);

            var td = $("<td/>").appendTo(tr);
            $("<input type=\"text\" value=\"5\" id=\"percent_dp0\" class=\"txt-percent-down-pay\" tabindex=\"1\" />").appendTo(td);
            $("<span>% </span>").appendTo(td);
            $("<span class=\"lbl-amt-down-pay currency lbl-hint-italic\"/>").appendTo(td);

            td = $("<td class='Scenario2'/>").appendTo(tr);
            $("<input type=\"text\" value=\"10\" id=\"percent_dp1\" class=\"txt-percent-down-pay\" tabindex=\"11\" />").appendTo(td);
            $("<span>% </span>").appendTo(td);
            $("<span class=\"lbl-amt-down-pay currency lbl-hint-italic\"/>").appendTo(td);

            td = $("<td class='Scenario3'/>").appendTo(tr);
            $("<input type=\"text\" value=\"20\" id=\"percent_dp2\" class=\"txt-percent-down-pay\" tabindex=\"21\" />").appendTo(td);
            $("<span>% </span>").appendTo(td);
            $("<span class=\"lbl-amt-down-pay currency lbl-hint-italic\"/>").appendTo(td);

			//amortization
            tr = $("<tr/>").appendTo(table);
            td = $("<td>Amortization Period:</td>").appendTo(tr);
            td = $("<td/>").appendTo(tr);

            var amortPrd0 = $("<select id=\"amort_prd0\" name=\"amort_prd\" tabindex=\"3\">").appendTo(td);
            amortPrd0.append("<option value=\"\">Select...</option>");
            amortPrd0.append("<option value=\"5\">5 Years</option>");
            amortPrd0.append("<option value=\"10\">10 Years</option>");
            amortPrd0.append("<option value=\"15\">15 Years</option>");
            amortPrd0.append("<option value=\"20\">20 Years</option>");
            amortPrd0.append("<option value=\"25\" selected>25 Years</option>");

            td = $("<td class='Scenario2'/>").appendTo(tr);

            var amortPrd1 = $("<select id=\"amort_prd1\" name=\"amort_prd\" tabindex=\"13\">").appendTo(td);
            amortPrd1.append("<option value=\"\">Select...</option>");
            amortPrd1.append("<option value=\"5\">5 Years</option>");
            amortPrd1.append("<option value=\"10\">10 Years</option>");
            amortPrd1.append("<option value=\"15\">15 Years</option>");
            amortPrd1.append("<option value=\"20\" selected>20 Years</option>");
            amortPrd1.append("<option value=\"25\">25 Years</option>");


            td = $("<td class='Scenario3' />").appendTo(tr);

            var amortPrd2 = $("<select id=\"amort_prd2\" name=\"amort_prd\" tabindex=\"23\">").appendTo(td);
            amortPrd2.append("<option value=\"\">Select...</option>");
            amortPrd2.append("<option value=\"5\">5 Years</option>");
            amortPrd2.append("<option value=\"10\">10 Years</option>");
            amortPrd2.append("<option value=\"15\" selected>15 Years</option>");
            amortPrd2.append("<option value=\"20\">20 Years</option>");
            amortPrd2.append("<option value=\"25\">25 Years</option>");

            tr = $("<tr/>").appendTo(table);
            $("<td>Mortgage Insurance Amount:</td>").appendTo(tr);
            td = $("<td/>").appendTo(tr);
            td.append("<span class=\"amt_mort_ins currency\"></span>");
            td = $("<td class='Scenario2'/>").appendTo(tr);
            td.append("<span class=\"amt_mort_ins currency\"></span>");
            td = $("<td class='Scenario3'/>").appendTo(tr);
            td.append("<span class=\"amt_mort_ins currency\"></span>");
            $("<div id=\"descrp\"></div>").appendTo(itpmortdetails);


            tr = $("<tr/>").appendTo(table);
            
            $("<td>Total Mortgage Required:</td>").appendTo(tr);
            $("<td><span class=\"amt_mort_req currency\"></span></td>").appendTo(tr);
            $("<td class='Scenario2'><span class=\"amt_mort_req currency\"></span></td>").appendTo(tr);
            $("<td class='Scenario3'><span class=\"amt_mort_req currency\"></span></td>").appendTo(tr);

            //property price slider
            this.Self.find("#pro_price").slider({
                value: 400000,
                min: 50000,
                max: 1000000,
                step: 50000,
                range: 'min',
                slide: function(event, ui) {
                    mySelf.Self.find("#amt_pro_price").val(ui.value);
                    mySelf.pupulateCalculatorData(null);
                }
            });

            this.Self.find("#amt_pro_price").val($("#pro_price").slider("value"));

            this.Self.find("#amt_pro_price").change(function() {
                mySelf.Self.find("#pro_price").slider("value", mySelf.Self.find("#amt_pro_price").asNumber());
                mySelf.pupulateCalculatorData();
            });

            this.Self.find("#itp_mort_details select[name='amort_prd'], #itp_mort_details select[name='mort_prod']").change(function() {
                mySelf.pupulateCalculatorData($(this).attr("id"));
            });

            $(".icon-popup").click(function(){
                $(this).parent().parent().find(".icon-popup-text").slideToggle();
            });
            //call on page load
            this.pupulateCalculatorData();

            ////$(".itp-calculator").accordion();
            this.Self.find("#itp_mort_details .txt-percent-down-pay").spinner({ step: 1, min: 5, max: 100 });
            this.Self.find(".ui-spinner-button").click(function() { $(this).siblings('input').change(); }); //very important, otherwise spinner change event will not work
            this.Self.find("#itp_mort_details .txt-percent-down-pay").spinner().change(function() {
                mySelf.pupulateCalculatorData($(this).attr("id"));
            });

            mySelf.bShowScenario3 = mySelf.BodyDiv.width() >= mySelf._options.Scenario3hide;
            mySelf.bShowScenario2 = mySelf.BodyDiv.width() >= mySelf._options.Scenario2hide;
            if (!mySelf.bShowScenario3)
                this.Scenario3Hide();
            if (!mySelf.bShowScenario2)
                this.Scenario2Hide();
        }
    };

    $.fn.cmhccalculator = function(options) {
        var $$ = $(this);
        var pay = $.extend(true, [], new CmhcCalculator(options));
        pay.Create($$);
    };

    $(document).ready(function() {
        for (var index1 = 1; index1 <= indexCmhcCalculator; index1++) {
            var idPaymentCalculator = $("#CmhcCalculator" + index1);
            idPaymentCalculator.cmhccalculator({});
        }

        $(document).on('click', '#descrp span.close', function () { $(this).parent().hide(); });

    });
})($);
