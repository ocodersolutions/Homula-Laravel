var scripts = document.getElementsByTagName('script');
var index = scripts.length - 1;
var myScript = scripts[index];

if (typeof indexCmhcCalculator == 'undefined')
    indexCmhcCalculator = 1;
else {
    indexCmhcCalculator++;
}
var idPaymentCalculator = "CmhcCalculator" + indexCmhcCalculator;
//document.write("<div id=\"" + idPaymentCalculator + "\" class=\"itp-calculator-body\"/>");
//document.write("</div>");

$(function(){
	$( "#contentLeft #gcCal" ).append("<div id=\"" + idPaymentCalculator + "\" class=\"itp-calculator-body\"/></div>");
});