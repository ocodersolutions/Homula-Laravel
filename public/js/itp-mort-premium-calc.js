function cgPremium(loan2Value, mort_prod)
{
	console.log('cgPremium:: L2V:' + loan2Value + ', mort_prod: ' + mort_prod);
	
    if (loan2Value < 0.0 || loan2Value > 0.95)
        return -1;
	
	switch(mort_prod){
		
		case 'STANDARD':		
			if (loan2Value <= 0.65)
				return 0.0060;//0.6%
			else if (loan2Value <= 0.75)
				return 0.0075;
			else if (loan2Value <= 0.80)
				return 0.0125;
			else if (loan2Value <= 0.85)
				return 0.0180;
			else if (loan2Value <= 0.90)
				return 0.0240;
			else if (loan2Value <= 0.95)
				return 0.0360;
			break;
			
		case 'RENTAL':		
			if (loan2Value <= 0.65)
				return 0.0145;
			else if (loan2Value <= 0.75)
				return 0.0200;
			else if (loan2Value <= 0.80)
				return 0.0290;
			break;
			
		case 'LOWDOC':		
			if (loan2Value <= 0.65)
				return 0.0090;
			else if (loan2Value <= 0.75)
				return 0.0115;
			else if (loan2Value <= 0.80)
				return 0.0190;
			else if (loan2Value <= 0.85)
				return 0.0335;
			else if (loan2Value <= 0.90)
				return 0.0545;
			break;
		
		case 'FLEX95':
			return 0.0385;
			break;
	}
}

function cgSurcharge(loan2Value, amortYears) {
	
    if (loan2Value < 0.0 || loan2Value > 1.0 || amortYears < 1)
        return -1;

    if (loan2Value <= 0.80) {
        return 0.0;
    }
    else {
        if (amortYears > 30)
            return 0.004;
        else if (amortYears > 25)
            return 0.002;
        else
            return 0.0;
    }
}
/*
function cmhcPst(cmhcAmt, province) {
    var tax_rates = { 'ON': 0.085, 'QC': 0.08 };

    if (typeof (tax_rates[province]) == 'undefined') {
        return 0;
    }

    return cmhcAmt * tax_rates[province];
}*/