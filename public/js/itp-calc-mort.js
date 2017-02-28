function getDownpayPercent(mort_amt, down_pay) {
	return (100 / Math.abs(mort_amt / down_pay));
}

function getDownpayAmount(mort_amt, down_pay_percent) {
    var amt_limit = 500000,
        min_downpay = getMinimumDownpayRequired(mort_amt);

    if (mort_amt > min_downpay) {
	    return (Math.abs(mort_amt * down_pay_percent) / 100);
	}
	else {
	    return min_downpay;
	}
}

function getMinimumDownpayRequired(mort_amt) {
    var amt_limit = 500000,
        min_down_pay_percent = 5;
    if (mort_amt <= amt_limit) {
        return (Math.abs(mort_amt * min_down_pay_percent) / 100);
    }
    else {
        var amt_over_limit = mort_amt - amt_limit;
        var amt1 = (Math.abs(amt_limit * min_down_pay_percent) / 100);
        var amt2 = (Math.abs(amt_over_limit * 10) / 100);
        //alert(mort_amt + ' min_down_pay_percent: ' + min_down_pay_percent + ' amt_over_limit: ' + amt_over_limit + ' amt1: ' + amt1 + ' amt2: ' + amt2);
        return amt1 + amt2;
    }
}

function getMinimumDownpayPercent(mort_amt) {
    var down_pay = getMinimumDownpayRequired(mort_amt);
    return (100 / Math.abs(mort_amt / down_pay));
}

function getLoan2Value(percent_down_pay, mort_prod) {
	//return 1 - (percent_down_pay * .01);
	var ltv = 1 - (percent_down_pay * .01);
	
	if(mort_prod === 'RENTAL' && ltv > 0.80)
		ltv = 0.80; //Rental Advantage: Max. 80% LTV
	else if(mort_prod === 'LOWDOC' && ltv > 0.90)
		ltv = 0.90; //Low Doc Advantage: Max. 90% LTV
	else if(mort_prod === 'FLEX95' && ltv > 0.95)
		ltv = 0.95; //Flex 95 Advantage: Max 95% LTV
	else if(mort_prod === 'STANDARD' && ltv > 0.95)
		ltv = 0.95; //Standard Products: Max. 95% LTV
	//alert(ltv);
	return ltv;
}

function getProdMinDownPayment(mort_prod) {
	var mdp = 5;	//minimum down payment (mdp) %
	
	if(mort_prod === 'RENTAL')
		mdp = 20; //Rental Advantage: Min. 20%
	else if(mort_prod === 'LOWDOC')
		mdp = 10; //Low Doc Advantage: Min. 10%
	else if(mort_prod === 'FLEX95')
		mdp = 5; //Flex 95 Advantage: Min 5%
	else if(mort_prod === 'STANDARD')
		mdp = 5; //Standard Products: Min. 5%
	return mdp;
}

function annuityPayment(principal, annual_rate, periods_per_year, num_years) {
   var total_payments = periods_per_year * num_years;
   var periodic_rate = annual_rate / periods_per_year;
   var periodic_payment = principal * (periodic_rate + (periodic_rate / (Math.pow(1 + periodic_rate, total_payments) - 1)));
   //alert('principal: ' + principal + '; monthly payment: ' + periodic_payment + '; periodic_rate: ' + periodic_rate);
   return periodic_payment;
}

function nominal2Effective(nominal_rate, periods_per_year) {
	var effective_rate = Math.pow(1 + nominal_rate / periods_per_year, periods_per_year) - 1;	
	return effective_rate;
}

function effective2Nominal(effective_rate, periods_per_year) {
	var nominal_rate = periods_per_year * (Math.pow(effective_rate + 1, 1 / periods_per_year) - 1);	
	return nominal_rate;
}

function mortgagePayment(principal, annual_rate, num_years, periods_per_year, divisor) {
	var effective_rate = nominal2Effective(annual_rate, 2);
	var nominal_rate = effective2Nominal(effective_rate, periods_per_year);
	
	var payment = annuityPayment(principal, nominal_rate, periods_per_year, num_years) / divisor;
	//alert('principal: ' + principal + '; payment: ' + payment + '; nominal_rate: ' + nominal_rate);
	return payment;
}

function mortgagePrincipal(payment, annual_rate, num_years, periods_per_year, divisor) {
	var effective_rate = nominal2Effective(annual_rate, 2);
	var nominal_rate = effective2Nominal(effective_rate, periods_per_year);
	//alert("effective_rate: " + effective_rate + '; nominal_rate: ' + nominal_rate);
	var principal = annuityPresentValue(payment * divisor, nominal_rate, periods_per_year, num_years);
	return principal;
}

function annuityPresentValue(payment, annual_rate, periods_per_year, num_years) {
   var total_payments = periods_per_year * num_years;
   var periodic_rate = annual_rate / periods_per_year;
   var present_value = payment * ((1 - (1 / Math.pow(1 + periodic_rate, total_payments))) / periodic_rate);
   return present_value;
}

function amortizationTable(principal, annual_rate, num_years, periods_per_year, divisor) {
	if (isNaN(principal) || annual_rate == null || isNaN(num_years) || periods_per_year == null || divisor == null)
		return;

	var periodic_payment = mortgagePayment(principal, annual_rate, num_years, periods_per_year, divisor);
	// accelerated
	if (divisor == 2 && periods_per_year == 12) {
		periods_per_year = 26;
	}
	if (divisor == 2 && periods_per_year == 24) {
		periods_per_year = 52;
	}

	var effective_rate = nominal2Effective(annual_rate, 2);
	var nominal_rate = effective2Nominal(effective_rate, periods_per_year);
	var periodic_rate = nominal_rate / periods_per_year;

	var total_periods = num_years * periods_per_year;

	var table = [];

	var balance = principal;
	var annual_payment = 0;
	var annual_interest = 0;
	var annual_principal = 0;

	var done = false;
	for (var i = 1; i <= total_periods && !done; ++i) {
		var interest = balance * periodic_rate;
		var principal = periodic_payment - interest;
		var payment = periodic_payment;
		if (principal > balance) {
			payment -= (principal - balance);
			principal = balance;
			done = true;
		}

		balance -= principal;
		annual_payment += payment;
		annual_interest += interest;
		annual_principal += principal;

		if (i % periods_per_year == 0 || done) {

			if (i == total_periods && balance < 1)
				balance = 0;

			table.push({ 'payment': annual_payment, 'principal': annual_principal, 'interest': annual_interest, 'balance': balance });

			annual_payment = 0;
			annual_interest = 0;
			annual_principal = 0;
		}
	}

	return table;
}

function mortgageAffordability(downpayment_percent, annual_rate, num_years, downpayment, monthly_income, monthly_living, cc_loans_etc) {

	var gds = 0.39 * monthly_income - monthly_living;
	var tds = 0.44 * monthly_income - (monthly_living + cc_loans_etc);
	var monthly_payment = Math.min(gds, tds);

	var max_from_income = mortgagePrincipal(monthly_payment, annual_rate, num_years, 12, 1);    //based on income
	var max_from_downpay = downpayment * (100 / downpayment_percent * .01) - downpayment;       //based on down payment
	var amt_actual_mort = Math.min(max_from_income, max_from_downpay);                          //whichever is lower is the mortgage allowed
	var amt_total_home_value = amt_actual_mort + downpayment;

	var cg_premium = cgPremium(1 - downpayment_percent);
	var cg_surcharge = cgSurcharge((1 - downpayment_percent), parseInt(num_years, 10));
	var amt_cg = amt_actual_mort * (cg_premium + cg_surcharge);

	var amt_total_mort = amt_actual_mort + amt_cg;
	monthly_payment = mortgagePayment(amt_total_mort, annual_rate, num_years, 12, 1);

	return {
	    'monthly_payment': monthly_payment, 'home_value': amt_total_home_value, 'max_from_income': max_from_income,
	    'downpayment': [downpayment_percent, downpayment], 'amt_actual_mort': amt_actual_mort,
	    'cg-ins': amt_cg, 'amt_total_mort': amt_total_mort, 'max_from_downpay': max_from_downpay
	};


}


    
//    newJQuery('.icon-popup').tooltip();
//    newJQuery.widget("ui.tooltip", newJQuery.ui.tooltip, {
//          options: {
//              content: function () {
//                  return newJQuery(this).prop('title');
//              },
//              tooltipClass: "custom-tooltip-styling",
              
//          }
//      });
      
//    newJQuery(document).tooltip();
