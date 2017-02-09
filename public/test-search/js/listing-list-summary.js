('pyhbs' in this) && pyhbs.register("listing-list-summary", { phrases: {"no_photo_yet":"No photo yet","add_to_favorites":"Add to Favourites","add_to_likes":"Add to Likes","add_to_dislikes":"Add to Dislikes","comment_on":"Add comments","suggest_to":"Suggest to","unavailable.status.RE":"Rented","unavailable.status.TER":"Terminated","unavailable.status.W/R":"Withdrawn","unavailable.status.SLD":"Sold","unavailable.status.LSD":"Leased","unavailable.status.SUS":"Suspended","saletype.SALE":"For Sale","saletype.sale":"For Sale","saletype.RENT":"For Rent","saletype.rent":"For Rent","price_changed":"Price changed %{priceDifference}%","beds":"Bed||||Beds","baths":"Bath||||Baths","rooms":"Rooms","units":"Unit||||Units","sq_ft":"SqFt","per_sq_ft":"/SqFt","taxes":"Taxes","propertytype.Att/Row/Twnhouse":"Att/Row/Twnhouse","propertytype.Business":"Business","propertytype.Cottage":"Cottage","propertytype.Det w/Com Elements":"Det w/Com Elements","propertytype.Detached":"Detached","propertytype.Duplex":"Duplex","propertytype.Farm":"Farm","propertytype.Fourplex":"Fourplex","propertytype.Link":"Link","propertytype.Mobile/Trailer":"Mobile/Trailer","propertytype.Multiplex":"Multiplex","propertytype.Other":"Other","propertytype.Rural Resid":"Rural Resid","propertytype.Semi-Detached":"Semi-Detached","propertytype.Store w/Apt/Offc":"Store w/Apt/Offc","propertytype.Triplex":"Triplex","propertytype.Vacant Land":"Vacant Land","propertystyle.1 1/2 Storey":"1 1/2 Storey","propertystyle.2 1/2 Storey":"2 1/2 Storey","propertystyle.2-Storey":"2-Storey","propertystyle.3-Storey":"3-Storey","propertystyle.Apartment":"Apartment","propertystyle.studio":"Studio","propertystyle.Bachelor/Studio":"Bachelor/Studio","propertystyle.Backsplit 3":"Backsplit 3","propertystyle.Backsplit 4":"Backsplit 4","propertystyle.Backsplit 5":"Backsplit 5","propertystyle.Backsplt-All":"Backsplt-All","propertystyle.Bungaloft":"Bungaloft","propertystyle.Bungalow":"Bungalow","propertystyle.Bungalow-Raised":"Bungalow-Raised","propertystyle.Frontsplit":"Frontsplit","propertystyle.Loft":"Loft","propertystyle.Multi-level":"Multi-level","propertystyle.Other":"Other","propertystyle.Sidesplit 3":"Sidesplit 3","propertystyle.Sidesplit 4":"Sidesplit 4","propertystyle.Sidesplit 5":"Sidesplit 5","propertystyle.Sidesplt-All":"Sidesplt-All","propertystyle.Stacked Townhse":"Stacked Townhse","lot_sq_ft":"Lot SqFt","status":"Status","acres":"Acres"}, template: {"1":function(depth0,helpers,partials,data) {
  return "	<span style=\"vertical-align:middle;\">\n		<input type=\"checkbox\"/>\n	</span>\n";
  },"3":function(depth0,helpers,partials,data) {
  var helperMissing=helpers.helperMissing, escapeExpression=this.escapeExpression;
  return "		<span class=\"listing-photo\"><span class=\"no-photo-yet\">"
    + escapeExpression(((helpers.t || (depth0 && depth0.t) || helperMissing).call(depth0, "no_photo_yet", {"name":"t","hash":{},"data":data})))
    + "</span></span>\n";
},"5":function(depth0,helpers,partials,data) {
  var stack1, buffer = "		<img class=\"df listing-photo\"  ";
  stack1 = helpers['if'].call(depth0, (depth0 != null ? depth0.$export : depth0), {"name":"if","hash":{},"fn":this.program(6, data),"inverse":this.program(8, data),"data":data});
  if (stack1 != null) { buffer += stack1; }
  return buffer + "/>\n";
},"6":function(depth0,helpers,partials,data) {
  var stack1, helper, functionType="function", helperMissing=helpers.helperMissing, escapeExpression=this.escapeExpression, lambda=this.lambda;
  return "src=\""
    + escapeExpression(((helper = (helper = helpers.httpRootUrl || (depth0 != null ? depth0.httpRootUrl : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"httpRootUrl","hash":{},"data":data}) : helper)))
    + escapeExpression(lambda(((stack1 = ((stack1 = (depth0 != null ? depth0.images : depth0)) != null ? stack1['0'] : stack1)) != null ? stack1.url : stack1), depth0))
    + "/600\"";
},"8":function(depth0,helpers,partials,data) {
  var stack1, lambda=this.lambda, escapeExpression=this.escapeExpression;
  return "data-df-src=\""
    + escapeExpression(lambda(((stack1 = (depth0 != null ? depth0.images : depth0)) != null ? stack1['0'] : stack1), depth0))
    + "/600\"";
},"10":function(depth0,helpers,partials,data) {
  var stack1, helperMissing=helpers.helperMissing, escapeExpression=this.escapeExpression, buffer = "";
  stack1 = helpers['if'].call(depth0, ((stack1 = (depth0 != null ? depth0.images : depth0)) != null ? stack1['1'] : stack1), {"name":"if","hash":{},"fn":this.program(11, data),"inverse":this.noop,"data":data});
  if (stack1 != null) { buffer += stack1; }
  return buffer + "\n		<span class=\"toggles\">\n			<button class=\"btn btn-default btn-toggle-favorite\" data-toggle=\"tooltip\" data-title=\""
    + escapeExpression(((helpers.t || (depth0 && depth0.t) || helperMissing).call(depth0, "add_to_favorites", {"name":"t","hash":{},"data":data})))
    + "\">\n				<span class=\"list-icon list-icon-favorite\"></span>\n			</button>\n			<button class=\"btn btn-default btn-toggle-like\" data-toggle=\"tooltip\" data-title=\""
    + escapeExpression(((helpers.t || (depth0 && depth0.t) || helperMissing).call(depth0, "add_to_likes", {"name":"t","hash":{},"data":data})))
    + "\">\n				<span class=\"list-icon list-icon-like\"></span>\n			</button>\n			<button class=\"btn btn-default btn-toggle-dislike\" data-toggle=\"tooltip\" data-title=\""
    + escapeExpression(((helpers.t || (depth0 && depth0.t) || helperMissing).call(depth0, "add_to_dislikes", {"name":"t","hash":{},"data":data})))
    + "\">\n				<span class=\"list-icon list-icon-dislike\"></span>\n			</button>\n			<button class=\"btn btn-default btn-toggle-comment\" data-toggle=\"tooltip\" data-title=\""
    + escapeExpression(((helpers.t || (depth0 && depth0.t) || helperMissing).call(depth0, "comment_on", {"name":"t","hash":{},"data":data})))
    + "\">\n				<span class=\"list-icon list-icon-comment\"></span>\n			</button>\n			<button class=\"btn btn-default btn-suggest-list\" data-toggle=\"tooltip\" data-title=\""
    + escapeExpression(((helpers.t || (depth0 && depth0.t) || helperMissing).call(depth0, "suggest_to", {"name":"t","hash":{},"data":data})))
    + "\">\n				<span class=\"list-icon list-icon-suggest\"></span>\n			</button>\n			<div class=\"hcmenu quiet\" style=\"top:-4px;\"><a data-toggle=\"dropdown\" class=\"hcmenu-btn\" style=\"height:24px;width:24px;\"><span class=\"fa fa-ellipsis-h\"></span></a></div>\n		</span>\n	</span>\n";
},"11":function(depth0,helpers,partials,data) {
  return "			<a class=\"prev-image quiet\" href=\"#\"><span class=\"glyphicon glyphicon-chevron-left\"></span></a>\n			<a class=\"next-image quiet\" href=\"#\"><span class=\"glyphicon glyphicon-chevron-right\"></span></a>\n";
  },"13":function(depth0,helpers,partials,data) {
  var stack1, helper, helperMissing=helpers.helperMissing, escapeExpression=this.escapeExpression, functionType="function", buffer = "					<label class=\"label\">"
    + escapeExpression(((helpers.v || (depth0 && depth0.v) || helperMissing).call(depth0, (depth0 != null ? depth0.displayStatus : depth0), "unavailable.status", {"name":"v","hash":{},"data":data})))
    + "</label><span style=\"color: gray\">"
    + escapeExpression(((helper = (helper = helpers.priceFormatted || (depth0 != null ? depth0.priceFormatted : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"priceFormatted","hash":{},"data":data}) : helper)))
    + "</span>\n					";
  stack1 = ((helpers.user_is || (depth0 && depth0.user_is) || helperMissing).call(depth0, "agent", (depth0 != null ? depth0.user : depth0), {"name":"user_is","hash":{},"fn":this.program(14, data),"inverse":this.noop,"data":data}));
  if (stack1 != null) { buffer += stack1; }
  return buffer + "\n";
},"14":function(depth0,helpers,partials,data) {
  var helper, functionType="function", helperMissing=helpers.helperMissing, escapeExpression=this.escapeExpression;
  return "<span style=\"color: #444; font-weight: 300;\">"
    + escapeExpression(((helper = (helper = helpers.priceCode || (depth0 != null ? depth0.priceCode : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"priceCode","hash":{},"data":data}) : helper)))
    + "</span>";
},"16":function(depth0,helpers,partials,data) {
  var stack1, helperMissing=helpers.helperMissing, escapeExpression=this.escapeExpression, buffer = "					<label class=\"label\">"
    + escapeExpression(((helpers.v || (depth0 && depth0.v) || helperMissing).call(depth0, (depth0 != null ? depth0.saleOrRent : depth0), "saletype", {"name":"v","hash":{},"data":data})))
    + "</label><span style=\"color:darkblue\">";
  stack1 = helpers['if'].call(depth0, (depth0 != null ? depth0.hasPriceRange : depth0), {"name":"if","hash":{},"fn":this.program(17, data),"inverse":this.program(19, data),"data":data});
  if (stack1 != null) { buffer += stack1; }
  return buffer + "</span>\n";
},"17":function(depth0,helpers,partials,data) {
  var helper, functionType="function", helperMissing=helpers.helperMissing, escapeExpression=this.escapeExpression;
  return escapeExpression(((helper = (helper = helpers.priceShort || (depth0 != null ? depth0.priceShort : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"priceShort","hash":{},"data":data}) : helper)));
  },"19":function(depth0,helpers,partials,data) {
  var helper, functionType="function", helperMissing=helpers.helperMissing, escapeExpression=this.escapeExpression;
  return escapeExpression(((helper = (helper = helpers.priceFormatted || (depth0 != null ? depth0.priceFormatted : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"priceFormatted","hash":{},"data":data}) : helper)));
  },"21":function(depth0,helpers,partials,data) {
  var helperMissing=helpers.helperMissing, escapeExpression=this.escapeExpression;
  return "					<span class=\"pc-incr\" title=\""
    + escapeExpression(((helpers.t || (depth0 && depth0.t) || helperMissing).call(depth0, "price_changed", depth0, {"name":"t","hash":{},"data":data})))
    + "\">&uarr;</span>\n";
},"23":function(depth0,helpers,partials,data) {
  var helperMissing=helpers.helperMissing, escapeExpression=this.escapeExpression;
  return "					<span class=\"pc-decr\" title=\""
    + escapeExpression(((helpers.t || (depth0 && depth0.t) || helperMissing).call(depth0, "price_changed", depth0, {"name":"t","hash":{},"data":data})))
    + "\">&darr;</span>\n";
},"25":function(depth0,helpers,partials,data) {
  var stack1, helper, helperMissing=helpers.helperMissing, functionType="function", escapeExpression=this.escapeExpression, buffer = "\n			<h2>\n";
  stack1 = ((helpers.is || (depth0 && depth0.is) || helperMissing).call(depth0, (depth0 != null ? depth0.saleOrRent : depth0), "SALE", {"name":"is","hash":{},"fn":this.program(26, data),"inverse":this.program(36, data),"data":data}));
  if (stack1 != null) { buffer += stack1; }
  buffer += "			</h2>\n			<h3>\n				<span>#"
    + escapeExpression(((helper = (helper = helpers.listingID || (depth0 != null ? depth0.listingID : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"listingID","hash":{},"data":data}) : helper)))
    + "</span>";
  stack1 = ((helpers.user_is || (depth0 && depth0.user_is) || helperMissing).call(depth0, "agent", {"name":"user_is","hash":{},"fn":this.program(38, data),"inverse":this.noop,"data":data}));
  if (stack1 != null) { buffer += stack1; }
  buffer += "\n			</h3>\n			<hr class=\"clearfix\" style=\"visibility:hidden;margin:0;\" />\n		</div>\n		<div>\n			<h1>"
    + escapeExpression(((helper = (helper = helpers.streetAddress || (depth0 != null ? depth0.streetAddress : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"streetAddress","hash":{},"data":data}) : helper)))
    + "</h1>\n			<h3>\n				";
  stack1 = helpers['if'].call(depth0, (depth0 != null ? depth0.crossStreet : depth0), {"name":"if","hash":{},"fn":this.program(42, data),"inverse":this.noop,"data":data});
  if (stack1 != null) { buffer += stack1; }
  buffer += "\n				"
    + escapeExpression(((helper = (helper = helpers.neighborhood || (depth0 != null ? depth0.neighborhood : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"neighborhood","hash":{},"data":data}) : helper)));
  stack1 = helpers['if'].call(depth0, (depth0 != null ? depth0.neighborhood : depth0), {"name":"if","hash":{},"fn":this.program(44, data),"inverse":this.noop,"data":data});
  if (stack1 != null) { buffer += stack1; }
  buffer += "\n				<span class=\"zip\">"
    + escapeExpression(((helper = (helper = helpers.postalCode || (depth0 != null ? depth0.postalCode : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"postalCode","hash":{},"data":data}) : helper)))
    + "</span>\n			</h3>\n			<h2 style=\"overflow:hidden;\">\n";
  stack1 = ((helpers.is || (depth0 && depth0.is) || helperMissing).call(depth0, (depth0 != null ? depth0.saleOrRent : depth0), "SALE", {"name":"is","hash":{},"fn":this.program(46, data),"inverse":this.program(48, data),"data":data}));
  if (stack1 != null) { buffer += stack1; }
  buffer += "				";
  stack1 = helpers['if'].call(depth0, (depth0 != null ? depth0.buildingName : depth0), {"name":"if","hash":{},"fn":this.program(52, data),"inverse":this.noop,"data":data});
  if (stack1 != null) { buffer += stack1; }
  buffer += "\n			</h2>\n		</div>\n		<span class=\"feature-list\">\n";
  stack1 = helpers['if'].call(depth0, (depth0 != null ? depth0.$export : depth0), {"name":"if","hash":{},"fn":this.program(54, data),"inverse":this.program(57, data),"data":data});
  if (stack1 != null) { buffer += stack1; }
  buffer += "		</span>\n		<table class=\"short-details\" style=\"width:100%; max-width:none;\">\n			<tr>\n				<td>"
    + escapeExpression(((helper = (helper = helpers.bedrooms || (depth0 != null ? depth0.bedrooms : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"bedrooms","hash":{},"data":data}) : helper)));
  stack1 = helpers['if'].call(depth0, (depth0 != null ? depth0.bedroomsPossible : depth0), {"name":"if","hash":{},"fn":this.program(59, data),"inverse":this.noop,"data":data});
  if (stack1 != null) { buffer += stack1; }
  buffer += "<label class=\"label\">"
    + escapeExpression(((helpers.t || (depth0 && depth0.t) || helperMissing).call(depth0, "beds", (depth0 != null ? depth0.bedrooms : depth0), {"name":"t","hash":{},"data":data})))
    + "</label></td>\n				<td>"
    + escapeExpression(((helper = (helper = helpers.bathrooms || (depth0 != null ? depth0.bathrooms : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"bathrooms","hash":{},"data":data}) : helper)))
    + "<label class=\"label\">"
    + escapeExpression(((helpers.t || (depth0 && depth0.t) || helperMissing).call(depth0, "baths", (depth0 != null ? depth0.bathrooms : depth0), {"name":"t","hash":{},"data":data})))
    + "</label></td>\n				<td>"
    + escapeExpression(((helper = (helper = helpers.roomsTotal || (depth0 != null ? depth0.roomsTotal : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"roomsTotal","hash":{},"data":data}) : helper)))
    + " ";
  stack1 = helpers['if'].call(depth0, (depth0 != null ? depth0.roomsPossible : depth0), {"name":"if","hash":{},"fn":this.program(61, data),"inverse":this.noop,"data":data});
  if (stack1 != null) { buffer += stack1; }
  buffer += "<label class=\"label\">"
    + escapeExpression(((helpers.t || (depth0 && depth0.t) || helperMissing).call(depth0, "rooms", (depth0 != null ? depth0.roomsTotal : depth0), {"name":"t","hash":{},"data":data})))
    + "</label></td>\n";
  stack1 = ((helpers.is || (depth0 && depth0.is) || helperMissing).call(depth0, (depth0 != null ? depth0['class'] : depth0), "BUILDING", {"name":"is","hash":{},"fn":this.program(63, data),"inverse":this.noop,"data":data}));
  if (stack1 != null) { buffer += stack1; }
  stack1 = helpers.unless.call(depth0, (depth0 != null ? depth0.hideSqft : depth0), {"name":"unless","hash":{},"fn":this.program(66, data),"inverse":this.noop,"data":data});
  if (stack1 != null) { buffer += stack1; }
  buffer += "				<td>"
    + escapeExpression(((helper = (helper = helpers.daysOnMarket || (depth0 != null ? depth0.daysOnMarket : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"daysOnMarket","hash":{},"data":data}) : helper)))
    + "<label class=\"label\">"
    + escapeExpression(((helpers.t || (depth0 && depth0.t) || helperMissing).call(depth0, "dom", {"name":"t","hash":{},"data":data})))
    + "</label></td>\n";
  stack1 = ((helpers.user_is || (depth0 && depth0.user_is) || helperMissing).call(depth0, "agent", {"name":"user_is","hash":{},"fn":this.program(71, data),"inverse":this.noop,"data":data}));
  if (stack1 != null) { buffer += stack1; }
  return buffer + "			</tr>\n		</table>\n\n\n";
},"26":function(depth0,helpers,partials,data) {
  var stack1, helper, functionType="function", helperMissing=helpers.helperMissing, escapeExpression=this.escapeExpression, buffer = "				";
  stack1 = helpers['if'].call(depth0, (depth0 != null ? depth0.maintCCAmount : depth0), {"name":"if","hash":{},"fn":this.program(27, data),"inverse":this.noop,"data":data});
  if (stack1 != null) { buffer += stack1; }
  buffer += "\n				";
  stack1 = helpers['if'].call(depth0, (depth0 != null ? depth0.taxAmountMonthly : depth0), {"name":"if","hash":{},"fn":this.program(32, data),"inverse":this.noop,"data":data});
  if (stack1 != null) { buffer += stack1; }
  buffer += "\n				";
  stack1 = helpers['if'].call(depth0, (depth0 != null ? depth0.taxYear : depth0), {"name":"if","hash":{},"fn":this.program(34, data),"inverse":this.noop,"data":data});
  if (stack1 != null) { buffer += stack1; }
  return buffer + " "
    + escapeExpression(((helper = (helper = helpers.taxType || (depth0 != null ? depth0.taxType : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"taxType","hash":{},"data":data}) : helper)))
    + "\n";
},"27":function(depth0,helpers,partials,data) {
  var stack1, helperMissing=helpers.helperMissing, escapeExpression=this.escapeExpression, buffer = "<label class=\"label\">";
  stack1 = ((helpers.is || (depth0 && depth0.is) || helperMissing).call(depth0, (depth0 != null ? depth0.buildingOwnershipType : depth0), "Condo", {"name":"is","hash":{},"fn":this.program(28, data),"inverse":this.program(30, data),"data":data}));
  if (stack1 != null) { buffer += stack1; }
  return buffer + "</label>"
    + escapeExpression(((helpers.currency || (depth0 && depth0.currency) || helperMissing).call(depth0, (depth0 != null ? depth0.maintCCAmount : depth0), {"name":"currency","hash":{},"data":data})));
},"28":function(depth0,helpers,partials,data) {
  var helperMissing=helpers.helperMissing, escapeExpression=this.escapeExpression;
  return escapeExpression(((helpers.t || (depth0 && depth0.t) || helperMissing).call(depth0, "Common Charges", {"name":"t","hash":{},"data":data})));
  },"30":function(depth0,helpers,partials,data) {
  var helperMissing=helpers.helperMissing, escapeExpression=this.escapeExpression;
  return escapeExpression(((helpers.t || (depth0 && depth0.t) || helperMissing).call(depth0, "Maintenance", {"name":"t","hash":{},"data":data})));
  },"32":function(depth0,helpers,partials,data) {
  var helperMissing=helpers.helperMissing, escapeExpression=this.escapeExpression;
  return "<label class=\"label\">"
    + escapeExpression(((helpers.t || (depth0 && depth0.t) || helperMissing).call(depth0, "Taxes", {"name":"t","hash":{},"data":data})))
    + "</label>"
    + escapeExpression(((helpers.currency || (depth0 && depth0.currency) || helperMissing).call(depth0, (depth0 != null ? depth0.taxAmountMonthly : depth0), {"name":"currency","hash":{},"data":data})));
},"34":function(depth0,helpers,partials,data) {
  var helper, functionType="function", helperMissing=helpers.helperMissing, escapeExpression=this.escapeExpression;
  return "("
    + escapeExpression(((helper = (helper = helpers.taxYear || (depth0 != null ? depth0.taxYear : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"taxYear","hash":{},"data":data}) : helper)))
    + ")";
},"36":function(depth0,helpers,partials,data) {
  var helperMissing=helpers.helperMissing, escapeExpression=this.escapeExpression;
  return "				<label class=\"label\">"
    + escapeExpression(((helpers.t || (depth0 && depth0.t) || helperMissing).call(depth0, "available", {"name":"t","hash":{},"data":data})))
    + "</label>"
    + escapeExpression(((helpers.time || (depth0 && depth0.time) || helperMissing).call(depth0, (depth0 != null ? depth0.availableDate : depth0), "dt", {"name":"time","hash":{},"data":data})))
    + "\n";
},"38":function(depth0,helpers,partials,data) {
  var stack1;
  stack1 = helpers['if'].call(depth0, (depth0 != null ? depth0.webID : depth0), {"name":"if","hash":{},"fn":this.program(39, data),"inverse":this.noop,"data":data});
  if (stack1 != null) { return stack1; }
  else { return ''; }
  },"39":function(depth0,helpers,partials,data) {
  var stack1, helperMissing=helpers.helperMissing;
  stack1 = ((helpers.is_not || (depth0 && depth0.is_not) || helperMissing).call(depth0, (depth0 != null ? depth0.listingID : depth0), (depth0 != null ? depth0.webID : depth0), {"name":"is_not","hash":{},"fn":this.program(40, data),"inverse":this.noop,"data":data}));
  if (stack1 != null) { return stack1; }
  else { return ''; }
  },"40":function(depth0,helpers,partials,data) {
  var helper, functionType="function", helperMissing=helpers.helperMissing, escapeExpression=this.escapeExpression;
  return " /\n				<span>"
    + escapeExpression(((helper = (helper = helpers.webID || (depth0 != null ? depth0.webID : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"webID","hash":{},"data":data}) : helper)))
    + "</span>";
},"42":function(depth0,helpers,partials,data) {
  var helper, functionType="function", helperMissing=helpers.helperMissing, escapeExpression=this.escapeExpression;
  return escapeExpression(((helper = (helper = helpers.crossStreet || (depth0 != null ? depth0.crossStreet : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"crossStreet","hash":{},"data":data}) : helper)))
    + ",";
},"44":function(depth0,helpers,partials,data) {
  return ",";
  },"46":function(depth0,helpers,partials,data) {
  var stack1, lambda=this.lambda, escapeExpression=this.escapeExpression;
  return "				"
    + escapeExpression(lambda(((stack1 = (depth0 != null ? depth0.building : depth0)) != null ? stack1.ownershipType : stack1), depth0))
    + "\n				"
    + escapeExpression(lambda(((stack1 = (depth0 != null ? depth0.building : depth0)) != null ? stack1.buildingType : stack1), depth0))
    + "\n";
},"48":function(depth0,helpers,partials,data) {
  var stack1, helper, lambda=this.lambda, escapeExpression=this.escapeExpression, functionType="function", helperMissing=helpers.helperMissing, buffer = "				"
    + escapeExpression(lambda(((stack1 = (depth0 != null ? depth0.building : depth0)) != null ? stack1.mgtAgentDescription : stack1), depth0))
    + "\n				";
  stack1 = helpers['if'].call(depth0, ((stack1 = (depth0 != null ? depth0.building : depth0)) != null ? stack1.mgtAgent : stack1), {"name":"if","hash":{},"fn":this.program(49, data),"inverse":this.noop,"data":data});
  if (stack1 != null) { buffer += stack1; }
  return buffer + "\n				"
    + escapeExpression(((helper = (helper = helpers.remarksAccess || (depth0 != null ? depth0.remarksAccess : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"remarksAccess","hash":{},"data":data}) : helper)))
    + "\n";
},"49":function(depth0,helpers,partials,data) {
  var stack1;
  stack1 = helpers['if'].call(depth0, (depth0 != null ? depth0.remarksAccess : depth0), {"name":"if","hash":{},"fn":this.program(50, data),"inverse":this.noop,"data":data});
  if (stack1 != null) { return stack1; }
  else { return ''; }
  },"50":function(depth0,helpers,partials,data) {
  return " - ";
  },"52":function(depth0,helpers,partials,data) {
  var helper, functionType="function", helperMissing=helpers.helperMissing, escapeExpression=this.escapeExpression;
  return "<span class=\"building-name\">@ &ldquo;"
    + escapeExpression(((helper = (helper = helpers.buildingName || (depth0 != null ? depth0.buildingName : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"buildingName","hash":{},"data":data}) : helper)))
    + "&rdquo;</span>";
},"54":function(depth0,helpers,partials,data) {
  var stack1, buffer = "";
  stack1 = helpers.each.call(depth0, (depth0 != null ? depth0.features : depth0), {"name":"each","hash":{},"fn":this.program(55, data),"inverse":this.noop,"data":data});
  if (stack1 != null) { buffer += stack1; }
  return buffer;
},"55":function(depth0,helpers,partials,data) {
  var helperMissing=helpers.helperMissing, escapeExpression=this.escapeExpression;
  return "				<span>"
    + escapeExpression(((helpers.t || (depth0 && depth0.t) || helperMissing).call(depth0, depth0, {"name":"t","hash":{},"data":data})))
    + "</span>\n";
},"57":function(depth0,helpers,partials,data) {
  var stack1, buffer = "";
  stack1 = helpers.each.call(depth0, (depth0 != null ? depth0.featuresAsArray : depth0), {"name":"each","hash":{},"fn":this.program(55, data),"inverse":this.noop,"data":data});
  if (stack1 != null) { buffer += stack1; }
  return buffer;
},"59":function(depth0,helpers,partials,data) {
  var helper, functionType="function", helperMissing=helpers.helperMissing, escapeExpression=this.escapeExpression;
  return "+"
    + escapeExpression(((helper = (helper = helpers.bedroomsPossible || (depth0 != null ? depth0.bedroomsPossible : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"bedroomsPossible","hash":{},"data":data}) : helper)));
},"61":function(depth0,helpers,partials,data) {
  var helper, functionType="function", helperMissing=helpers.helperMissing, escapeExpression=this.escapeExpression;
  return "+ "
    + escapeExpression(((helper = (helper = helpers.roomsPossible || (depth0 != null ? depth0.roomsPossible : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"roomsPossible","hash":{},"data":data}) : helper)));
},"63":function(depth0,helpers,partials,data) {
  var stack1, buffer = "";
  stack1 = helpers['if'].call(depth0, ((stack1 = (depth0 != null ? depth0.building : depth0)) != null ? stack1.numberOfUnitsTotal : stack1), {"name":"if","hash":{},"fn":this.program(64, data),"inverse":this.noop,"data":data});
  if (stack1 != null) { buffer += stack1; }
  return buffer;
},"64":function(depth0,helpers,partials,data) {
  var stack1, lambda=this.lambda, escapeExpression=this.escapeExpression, helperMissing=helpers.helperMissing;
  return "				<td>"
    + escapeExpression(lambda(((stack1 = (depth0 != null ? depth0.building : depth0)) != null ? stack1.numberOfUnitsTotal : stack1), depth0))
    + "<label class=\"label\">"
    + escapeExpression(((helpers.t || (depth0 && depth0.t) || helperMissing).call(depth0, "units", ((stack1 = (depth0 != null ? depth0.building : depth0)) != null ? stack1.numberOfUnitsTotal : stack1), {"name":"t","hash":{},"data":data})))
    + "</label></td>\n";
},"66":function(depth0,helpers,partials,data) {
  var stack1, helperMissing=helpers.helperMissing, escapeExpression=this.escapeExpression, buffer = "				<td>";
  stack1 = ((helpers.is_not || (depth0 && depth0.is_not) || helperMissing).call(depth0, (depth0 != null ? depth0.squareFeet : depth0), "0", {"name":"is_not","hash":{},"fn":this.program(67, data),"inverse":this.noop,"data":data}));
  if (stack1 != null) { buffer += stack1; }
  buffer += "<label class=\"label\">"
    + escapeExpression(((helpers.t || (depth0 && depth0.t) || helperMissing).call(depth0, "sq_ft", {"name":"t","hash":{},"data":data})))
    + "</label></td>\n				<td>";
  stack1 = ((helpers.is_not || (depth0 && depth0.is_not) || helperMissing).call(depth0, (depth0 != null ? depth0.squareFeet : depth0), "0", {"name":"is_not","hash":{},"fn":this.program(69, data),"inverse":this.noop,"data":data}));
  if (stack1 != null) { buffer += stack1; }
  return buffer + "<label class=\"label\">"
    + escapeExpression(((helpers.t || (depth0 && depth0.t) || helperMissing).call(depth0, "per_sq_ft", {"name":"t","hash":{},"data":data})))
    + "</label></td>\n";
},"67":function(depth0,helpers,partials,data) {
  var helper, functionType="function", helperMissing=helpers.helperMissing, escapeExpression=this.escapeExpression;
  return escapeExpression(((helper = (helper = helpers.squareFeet || (depth0 != null ? depth0.squareFeet : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"squareFeet","hash":{},"data":data}) : helper)));
  },"69":function(depth0,helpers,partials,data) {
  var helper, functionType="function", helperMissing=helpers.helperMissing, escapeExpression=this.escapeExpression;
  return escapeExpression(((helper = (helper = helpers.pricePerSquareFoot || (depth0 != null ? depth0.pricePerSquareFoot : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"pricePerSquareFoot","hash":{},"data":data}) : helper)));
  },"71":function(depth0,helpers,partials,data) {
  var stack1, helper, functionType="function", helperMissing=helpers.helperMissing, escapeExpression=this.escapeExpression, buffer = "				<td>"
    + escapeExpression(((helper = (helper = helpers.listingType || (depth0 != null ? depth0.listingType : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"listingType","hash":{},"data":data}) : helper)))
    + "<label class=\"label\">"
    + escapeExpression(((helpers.t || (depth0 && depth0.t) || helperMissing).call(depth0, "Type", {"name":"t","hash":{},"data":data})))
    + "</label></td>\n				<td>"
    + escapeExpression(((helper = (helper = helpers.status || (depth0 != null ? depth0.status : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"status","hash":{},"data":data}) : helper)))
    + "<label class=\"label\">"
    + escapeExpression(((helpers.t || (depth0 && depth0.t) || helperMissing).call(depth0, "Status", {"name":"t","hash":{},"data":data})))
    + "</label></td>\n				";
  stack1 = ((helpers.is || (depth0 && depth0.is) || helperMissing).call(depth0, (depth0 != null ? depth0.saleOrRent : depth0), "SALE", {"name":"is","hash":{},"fn":this.program(72, data),"inverse":this.noop,"data":data}));
  if (stack1 != null) { buffer += stack1; }
  return buffer + "\n";
},"72":function(depth0,helpers,partials,data) {
  var stack1, helperMissing=helpers.helperMissing, escapeExpression=this.escapeExpression, buffer = "<td>";
  stack1 = helpers['if'].call(depth0, (depth0 != null ? depth0.commission : depth0), {"name":"if","hash":{},"fn":this.program(73, data),"inverse":this.noop,"data":data});
  if (stack1 != null) { buffer += stack1; }
  return buffer + "<label class=\"label\">"
    + escapeExpression(((helpers.t || (depth0 && depth0.t) || helperMissing).call(depth0, "Comm", {"name":"t","hash":{},"data":data})))
    + "</label></td>";
},"73":function(depth0,helpers,partials,data) {
  var helper, functionType="function", helperMissing=helpers.helperMissing, escapeExpression=this.escapeExpression;
  return escapeExpression(((helper = (helper = helpers.commission || (depth0 != null ? depth0.commission : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"commission","hash":{},"data":data}) : helper)))
    + escapeExpression(((helper = (helper = helpers.commissionType || (depth0 != null ? depth0.commissionType : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"commissionType","hash":{},"data":data}) : helper)));
},"75":function(depth0,helpers,partials,data) {
  var stack1, helperMissing=helpers.helperMissing, buffer = "";
  stack1 = ((helpers.is || (depth0 && depth0.is) || helperMissing).call(depth0, (depth0 != null ? depth0.gid : depth0), "MLSLI", {"name":"is","hash":{},"fn":this.program(76, data),"inverse":this.program(95, data),"data":data}));
  if (stack1 != null) { buffer += stack1; }
  return buffer;
},"76":function(depth0,helpers,partials,data) {
  var stack1, helper, helperMissing=helpers.helperMissing, functionType="function", escapeExpression=this.escapeExpression, buffer = "\n\n			<h2>\n";
  stack1 = ((helpers.is || (depth0 && depth0.is) || helperMissing).call(depth0, (depth0 != null ? depth0.saleOrRent : depth0), "SALE", {"name":"is","hash":{},"fn":this.program(77, data),"inverse":this.program(83, data),"data":data}));
  if (stack1 != null) { buffer += stack1; }
  buffer += "			</h2>\n			<h3>\n				MLS# "
    + escapeExpression(((helper = (helper = helpers.listingID || (depth0 != null ? depth0.listingID : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"listingID","hash":{},"data":data}) : helper)))
    + "\n			</h3>\n			<hr class=\"clearfix\" style=\"visibility:hidden;margin:0;\" />\n		</div>\n		<div>\n			<h1>";
  stack1 = helpers['if'].call(depth0, (depth0 != null ? depth0.streetAddress : depth0), {"name":"if","hash":{},"fn":this.program(86, data),"inverse":this.noop,"data":data});
  if (stack1 != null) { buffer += stack1; }
  buffer += escapeExpression(((helper = (helper = helpers.city || (depth0 != null ? depth0.city : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"city","hash":{},"data":data}) : helper)))
    + "</h1>\n			<h3>\n				"
    + escapeExpression(((helper = (helper = helpers.neighborhood || (depth0 != null ? depth0.neighborhood : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"neighborhood","hash":{},"data":data}) : helper)));
  stack1 = helpers['if'].call(depth0, (depth0 != null ? depth0.neighborhood : depth0), {"name":"if","hash":{},"fn":this.program(44, data),"inverse":this.noop,"data":data});
  if (stack1 != null) { buffer += stack1; }
  buffer += "\n				<span class=\"line-2\">\n					"
    + escapeExpression(((helper = (helper = helpers.county || (depth0 != null ? depth0.county : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"county","hash":{},"data":data}) : helper)));
  stack1 = helpers['if'].call(depth0, (depth0 != null ? depth0.county : depth0), {"name":"if","hash":{},"fn":this.program(44, data),"inverse":this.noop,"data":data});
  if (stack1 != null) { buffer += stack1; }
  buffer += "\n					"
    + escapeExpression(((helper = (helper = helpers.state || (depth0 != null ? depth0.state : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"state","hash":{},"data":data}) : helper)))
    + "\n				</span>\n				<span class=\"zip\">"
    + escapeExpression(((helper = (helper = helpers.zip || (depth0 != null ? depth0.zip : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"zip","hash":{},"data":data}) : helper)))
    + "</span>\n			</h3>\n			<h2>\n				"
    + escapeExpression(((helpers.v || (depth0 && depth0.v) || helperMissing).call(depth0, (depth0 != null ? depth0.typeName : depth0), "propertytype", {"name":"v","hash":{},"data":data})))
    + "\n				"
    + escapeExpression(((helpers.v || (depth0 && depth0.v) || helperMissing).call(depth0, (depth0 != null ? depth0.style : depth0), "propertystyle", {"name":"v","hash":{},"data":data})))
    + "\n			</h2>\n		</div>\n		<span class=\"feature-list\">\n";
  stack1 = helpers['if'].call(depth0, (depth0 != null ? depth0.$export : depth0), {"name":"if","hash":{},"fn":this.program(54, data),"inverse":this.program(57, data),"data":data});
  if (stack1 != null) { buffer += stack1; }
  buffer += "		</span>\n		<table class=\"short-details\" style=\"width:100%; max-width:none;\">\n			<tr>\n";
  stack1 = ((helpers.is_not || (depth0 && depth0.is_not) || helperMissing).call(depth0, (depth0 != null ? depth0.style : depth0), "Land", {"name":"is_not","hash":{},"fn":this.program(88, data),"inverse":this.noop,"data":data}));
  if (stack1 != null) { buffer += stack1; }
  stack1 = helpers.unless.call(depth0, (depth0 != null ? depth0.hideSqft : depth0), {"name":"unless","hash":{},"fn":this.program(91, data),"inverse":this.noop,"data":data});
  if (stack1 != null) { buffer += stack1; }
  stack1 = ((helpers.user_is || (depth0 && depth0.user_is) || helperMissing).call(depth0, "agent", {"name":"user_is","hash":{},"fn":this.program(93, data),"inverse":this.noop,"data":data}));
  if (stack1 != null) { buffer += stack1; }
  return buffer + "			</tr>\n		</table>\n\n\n";
},"77":function(depth0,helpers,partials,data) {
  var stack1, helper, functionType="function", helperMissing=helpers.helperMissing, escapeExpression=this.escapeExpression, buffer = "				<!--<a href=\"#\">"
    + escapeExpression(((helper = (helper = helpers.est_mortgage_payment || (depth0 != null ? depth0.est_mortgage_payment : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"est_mortgage_payment","hash":{},"data":data}) : helper)))
    + "</a>-->\n				<!--<span>"
    + escapeExpression(((helper = (helper = helpers.est_mortgage_payment || (depth0 != null ? depth0.est_mortgage_payment : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"est_mortgage_payment","hash":{},"data":data}) : helper)))
    + "</span>-->\n";
  stack1 = ((helpers.user_is || (depth0 && depth0.user_is) || helperMissing).call(depth0, "agent", {"name":"user_is","hash":{},"fn":this.program(78, data),"inverse":this.noop,"data":data}));
  if (stack1 != null) { buffer += stack1; }
  buffer += "				<label class=\"label\">"
    + escapeExpression(((helpers.t || (depth0 && depth0.t) || helperMissing).call(depth0, "taxes", {"name":"t","hash":{},"data":data})))
    + "</label>"
    + escapeExpression(((helper = (helper = helpers.taxAmountFormatted || (depth0 != null ? depth0.taxAmountFormatted : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"taxAmountFormatted","hash":{},"data":data}) : helper)))
    + "\n				";
  stack1 = helpers['if'].call(depth0, (depth0 != null ? depth0.taxYear : depth0), {"name":"if","hash":{},"fn":this.program(34, data),"inverse":this.noop,"data":data});
  if (stack1 != null) { buffer += stack1; }
  return buffer + " "
    + escapeExpression(((helper = (helper = helpers.taxType || (depth0 != null ? depth0.taxType : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"taxType","hash":{},"data":data}) : helper)))
    + "\n";
},"78":function(depth0,helpers,partials,data) {
  var stack1, buffer = "				";
  stack1 = helpers['if'].call(depth0, (depth0 != null ? depth0.starExemptTaxAmount : depth0), {"name":"if","hash":{},"fn":this.program(79, data),"inverse":this.noop,"data":data});
  if (stack1 != null) { buffer += stack1; }
  buffer += "\n				";
  stack1 = helpers['if'].call(depth0, (depth0 != null ? depth0.villageTaxAmount : depth0), {"name":"if","hash":{},"fn":this.program(81, data),"inverse":this.noop,"data":data});
  if (stack1 != null) { buffer += stack1; }
  return buffer + "\n";
},"79":function(depth0,helpers,partials,data) {
  var helperMissing=helpers.helperMissing, escapeExpression=this.escapeExpression;
  return "<label class=\"label\">"
    + escapeExpression(((helpers.t || (depth0 && depth0.t) || helperMissing).call(depth0, "Taxes W/STAR", {"name":"t","hash":{},"data":data})))
    + "</label>"
    + escapeExpression(((helpers.currency || (depth0 && depth0.currency) || helperMissing).call(depth0, (depth0 != null ? depth0.starExemptTaxAmount : depth0), {"name":"currency","hash":{},"data":data})));
},"81":function(depth0,helpers,partials,data) {
  var helperMissing=helpers.helperMissing, escapeExpression=this.escapeExpression;
  return "<label class=\"label\">"
    + escapeExpression(((helpers.t || (depth0 && depth0.t) || helperMissing).call(depth0, "Village Taxes", {"name":"t","hash":{},"data":data})))
    + "</label>"
    + escapeExpression(((helpers.currency || (depth0 && depth0.currency) || helperMissing).call(depth0, (depth0 != null ? depth0.villageTaxAmount : depth0), {"name":"currency","hash":{},"data":data})));
},"83":function(depth0,helpers,partials,data) {
  var stack1, helper, functionType="function", helperMissing=helpers.helperMissing, escapeExpression=this.escapeExpression, buffer = "				"
    + escapeExpression(((helper = (helper = helpers.possession || (depth0 != null ? depth0.possession : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"possession","hash":{},"data":data}) : helper)));
  stack1 = helpers['if'].call(depth0, (depth0 != null ? depth0.rentTerm : depth0), {"name":"if","hash":{},"fn":this.program(84, data),"inverse":this.noop,"data":data});
  if (stack1 != null) { buffer += stack1; }
  return buffer + " "
    + escapeExpression(((helper = (helper = helpers.rentTerm || (depth0 != null ? depth0.rentTerm : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"rentTerm","hash":{},"data":data}) : helper)))
    + "\n";
},"84":function(depth0,helpers,partials,data) {
  var stack1;
  stack1 = helpers['if'].call(depth0, (depth0 != null ? depth0.possession : depth0), {"name":"if","hash":{},"fn":this.program(44, data),"inverse":this.noop,"data":data});
  if (stack1 != null) { return stack1; }
  else { return ''; }
  },"86":function(depth0,helpers,partials,data) {
  var helper, functionType="function", helperMissing=helpers.helperMissing, escapeExpression=this.escapeExpression;
  return " "
    + escapeExpression(((helper = (helper = helpers.streetAddress || (depth0 != null ? depth0.streetAddress : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"streetAddress","hash":{},"data":data}) : helper)))
    + ", ";
},"88":function(depth0,helpers,partials,data) {
  var stack1, helper, functionType="function", helperMissing=helpers.helperMissing, escapeExpression=this.escapeExpression, buffer = "				<td>"
    + escapeExpression(((helper = (helper = helpers.bedrooms || (depth0 != null ? depth0.bedrooms : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"bedrooms","hash":{},"data":data}) : helper)));
  stack1 = helpers['if'].call(depth0, (depth0 != null ? depth0.bedroomsPossible : depth0), {"name":"if","hash":{},"fn":this.program(59, data),"inverse":this.noop,"data":data});
  if (stack1 != null) { buffer += stack1; }
  buffer += "<label class=\"label\">"
    + escapeExpression(((helpers.t || (depth0 && depth0.t) || helperMissing).call(depth0, "beds", (depth0 != null ? depth0.bedrooms : depth0), {"name":"t","hash":{},"data":data})))
    + "</label></td>\n				<td>"
    + escapeExpression(((helper = (helper = helpers.bathrooms || (depth0 != null ? depth0.bathrooms : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"bathrooms","hash":{},"data":data}) : helper)))
    + "<label class=\"label\">"
    + escapeExpression(((helpers.t || (depth0 && depth0.t) || helperMissing).call(depth0, "baths", (depth0 != null ? depth0.bathrooms : depth0), {"name":"t","hash":{},"data":data})))
    + "</label></td>\n				<td>"
    + escapeExpression(((helper = (helper = helpers.roomsTotal || (depth0 != null ? depth0.roomsTotal : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"roomsTotal","hash":{},"data":data}) : helper)))
    + "<label class=\"label\">"
    + escapeExpression(((helpers.t || (depth0 && depth0.t) || helperMissing).call(depth0, "rooms", (depth0 != null ? depth0.roomsTotal : depth0), {"name":"t","hash":{},"data":data})))
    + "</label></td>\n";
  stack1 = helpers.unless.call(depth0, (depth0 != null ? depth0.hideSqft : depth0), {"name":"unless","hash":{},"fn":this.program(89, data),"inverse":this.noop,"data":data});
  if (stack1 != null) { buffer += stack1; }
  return buffer;
},"89":function(depth0,helpers,partials,data) {
  var helper, functionType="function", helperMissing=helpers.helperMissing, escapeExpression=this.escapeExpression;
  return "				<td><small>"
    + escapeExpression(((helper = (helper = helpers.squareFeet || (depth0 != null ? depth0.squareFeet : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"squareFeet","hash":{},"data":data}) : helper)))
    + "</small><label class=\"label\">"
    + escapeExpression(((helpers.t || (depth0 && depth0.t) || helperMissing).call(depth0, "sq_ft", {"name":"t","hash":{},"data":data})))
    + "</label></td>\n";
},"91":function(depth0,helpers,partials,data) {
  var helper, functionType="function", helperMissing=helpers.helperMissing, escapeExpression=this.escapeExpression;
  return "				<td><small>"
    + escapeExpression(((helper = (helper = helpers.lotSizeSquareFeetFormatted || (depth0 != null ? depth0.lotSizeSquareFeetFormatted : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"lotSizeSquareFeetFormatted","hash":{},"data":data}) : helper)))
    + "</small><label class=\"label\">"
    + escapeExpression(((helpers.t || (depth0 && depth0.t) || helperMissing).call(depth0, "lot_sq_ft", {"name":"t","hash":{},"data":data})))
    + "</label></td>\n";
},"93":function(depth0,helpers,partials,data) {
  var helper, functionType="function", helperMissing=helpers.helperMissing, escapeExpression=this.escapeExpression;
  return "				<td>"
    + escapeExpression(((helper = (helper = helpers.status || (depth0 != null ? depth0.status : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"status","hash":{},"data":data}) : helper)))
    + "<label class=\"label\">"
    + escapeExpression(((helpers.t || (depth0 && depth0.t) || helperMissing).call(depth0, "status", {"name":"t","hash":{},"data":data})))
    + "</label></td>\n";
},"95":function(depth0,helpers,partials,data) {
  var stack1, helper, helperMissing=helpers.helperMissing, functionType="function", escapeExpression=this.escapeExpression, buffer = "\n\n			<h2>\n";
  stack1 = ((helpers.is || (depth0 && depth0.is) || helperMissing).call(depth0, (depth0 != null ? depth0.saleOrRent : depth0), "SALE", {"name":"is","hash":{},"fn":this.program(96, data),"inverse":this.program(83, data),"data":data}));
  if (stack1 != null) { buffer += stack1; }
  buffer += "			</h2>\n			<h3>\n				"
    + escapeExpression(((helper = (helper = helpers.listingID || (depth0 != null ? depth0.listingID : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"listingID","hash":{},"data":data}) : helper)))
    + "\n			</h3>\n			<hr class=\"clearfix\" style=\"visibility:hidden;margin:0;\" />\n		</div>\n		<div>\n			<h1>";
  stack1 = helpers['if'].call(depth0, (depth0 != null ? depth0.streetAddress : depth0), {"name":"if","hash":{},"fn":this.program(86, data),"inverse":this.noop,"data":data});
  if (stack1 != null) { buffer += stack1; }
  buffer += escapeExpression(((helper = (helper = helpers.city || (depth0 != null ? depth0.city : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"city","hash":{},"data":data}) : helper)))
    + "</h1>\n			<h3>\n				"
    + escapeExpression(((helper = (helper = helpers.neighborhood || (depth0 != null ? depth0.neighborhood : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"neighborhood","hash":{},"data":data}) : helper)));
  stack1 = helpers['if'].call(depth0, (depth0 != null ? depth0.neighborhood : depth0), {"name":"if","hash":{},"fn":this.program(44, data),"inverse":this.noop,"data":data});
  if (stack1 != null) { buffer += stack1; }
  buffer += "\n				"
    + escapeExpression(((helper = (helper = helpers.borough || (depth0 != null ? depth0.borough : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"borough","hash":{},"data":data}) : helper)));
  stack1 = helpers['if'].call(depth0, (depth0 != null ? depth0.borough : depth0), {"name":"if","hash":{},"fn":this.program(44, data),"inverse":this.noop,"data":data});
  if (stack1 != null) { buffer += stack1; }
  buffer += "\n				<span class=\"line-2\">\n					"
    + escapeExpression(((helper = (helper = helpers.county || (depth0 != null ? depth0.county : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"county","hash":{},"data":data}) : helper)));
  stack1 = helpers['if'].call(depth0, (depth0 != null ? depth0.county : depth0), {"name":"if","hash":{},"fn":this.program(44, data),"inverse":this.noop,"data":data});
  if (stack1 != null) { buffer += stack1; }
  buffer += "\n					"
    + escapeExpression(((helper = (helper = helpers.state || (depth0 != null ? depth0.state : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"state","hash":{},"data":data}) : helper)))
    + "\n				</span>\n				<span class=\"zip\">"
    + escapeExpression(((helper = (helper = helpers.zip || (depth0 != null ? depth0.zip : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"zip","hash":{},"data":data}) : helper)))
    + "</span>\n			</h3>\n			<h2>\n				"
    + escapeExpression(((helpers.v || (depth0 && depth0.v) || helperMissing).call(depth0, (depth0 != null ? depth0.typeName : depth0), "propertytype", {"name":"v","hash":{},"data":data})))
    + "\n				"
    + escapeExpression(((helpers.v || (depth0 && depth0.v) || helperMissing).call(depth0, (depth0 != null ? depth0.style : depth0), "propertystyle", {"name":"v","hash":{},"data":data})))
    + "\n			</h2>\n		</div>\n		<span class=\"feature-list\">\n";
  stack1 = helpers['if'].call(depth0, (depth0 != null ? depth0.$export : depth0), {"name":"if","hash":{},"fn":this.program(54, data),"inverse":this.program(57, data),"data":data});
  if (stack1 != null) { buffer += stack1; }
  buffer += "		</span>\n		<table class=\"short-details\" style=\"width:100%; max-width:none;\">\n			<tr>\n				<td>"
    + escapeExpression(((helper = (helper = helpers.bedrooms || (depth0 != null ? depth0.bedrooms : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"bedrooms","hash":{},"data":data}) : helper)));
  stack1 = helpers['if'].call(depth0, (depth0 != null ? depth0.bedroomsPossible : depth0), {"name":"if","hash":{},"fn":this.program(59, data),"inverse":this.noop,"data":data});
  if (stack1 != null) { buffer += stack1; }
  buffer += "<label class=\"label\">"
    + escapeExpression(((helpers.t || (depth0 && depth0.t) || helperMissing).call(depth0, "beds", (depth0 != null ? depth0.bedrooms : depth0), {"name":"t","hash":{},"data":data})))
    + "</label></td>\n				<td>"
    + escapeExpression(((helper = (helper = helpers.bathrooms || (depth0 != null ? depth0.bathrooms : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"bathrooms","hash":{},"data":data}) : helper)))
    + "<label class=\"label\">"
    + escapeExpression(((helpers.t || (depth0 && depth0.t) || helperMissing).call(depth0, "baths", (depth0 != null ? depth0.bathrooms : depth0), {"name":"t","hash":{},"data":data})))
    + "</label></td>\n				<td>"
    + escapeExpression(((helper = (helper = helpers.roomsTotal || (depth0 != null ? depth0.roomsTotal : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"roomsTotal","hash":{},"data":data}) : helper)));
  stack1 = helpers['if'].call(depth0, (depth0 != null ? depth0.roomsPossible : depth0), {"name":"if","hash":{},"fn":this.program(98, data),"inverse":this.noop,"data":data});
  if (stack1 != null) { buffer += stack1; }
  buffer += "<label class=\"label\">"
    + escapeExpression(((helpers.t || (depth0 && depth0.t) || helperMissing).call(depth0, "rooms", (depth0 != null ? depth0.roomsTotal : depth0), {"name":"t","hash":{},"data":data})))
    + "</label></td>\n";
  stack1 = helpers.unless.call(depth0, (depth0 != null ? depth0.hideSqft : depth0), {"name":"unless","hash":{},"fn":this.program(89, data),"inverse":this.noop,"data":data});
  if (stack1 != null) { buffer += stack1; }
  return buffer + "				<td><small>"
    + escapeExpression(((helper = (helper = helpers.acres || (depth0 != null ? depth0.acres : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"acres","hash":{},"data":data}) : helper)))
    + "</small><label class=\"label\">"
    + escapeExpression(((helpers.t || (depth0 && depth0.t) || helperMissing).call(depth0, "acres", {"name":"t","hash":{},"data":data})))
    + "</label></td>\n				<td>"
    + escapeExpression(((helper = (helper = helpers.daysOnMarket || (depth0 != null ? depth0.daysOnMarket : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"daysOnMarket","hash":{},"data":data}) : helper)))
    + "<label class=\"label\">"
    + escapeExpression(((helpers.t || (depth0 && depth0.t) || helperMissing).call(depth0, "dom", {"name":"t","hash":{},"data":data})))
    + "</label></td>\n			</tr>\n		</table>\n\n\n";
},"96":function(depth0,helpers,partials,data) {
  var stack1, helper, functionType="function", helperMissing=helpers.helperMissing, escapeExpression=this.escapeExpression, buffer = "				<!--<a href=\"#\">"
    + escapeExpression(((helper = (helper = helpers.est_mortgage_payment || (depth0 != null ? depth0.est_mortgage_payment : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"est_mortgage_payment","hash":{},"data":data}) : helper)))
    + "</a>-->\n				<!--<span>"
    + escapeExpression(((helper = (helper = helpers.est_mortgage_payment || (depth0 != null ? depth0.est_mortgage_payment : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"est_mortgage_payment","hash":{},"data":data}) : helper)))
    + "</span>-->\n				<label class=\"label\">"
    + escapeExpression(((helpers.t || (depth0 && depth0.t) || helperMissing).call(depth0, "taxes", {"name":"t","hash":{},"data":data})))
    + "</label>"
    + escapeExpression(((helper = (helper = helpers.taxAmountFormatted || (depth0 != null ? depth0.taxAmountFormatted : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"taxAmountFormatted","hash":{},"data":data}) : helper)))
    + "\n				";
  stack1 = helpers['if'].call(depth0, (depth0 != null ? depth0.taxYear : depth0), {"name":"if","hash":{},"fn":this.program(34, data),"inverse":this.noop,"data":data});
  if (stack1 != null) { buffer += stack1; }
  return buffer + " "
    + escapeExpression(((helper = (helper = helpers.taxType || (depth0 != null ? depth0.taxType : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"taxType","hash":{},"data":data}) : helper)))
    + "\n";
},"98":function(depth0,helpers,partials,data) {
  var helper, functionType="function", helperMissing=helpers.helperMissing, escapeExpression=this.escapeExpression;
  return "+"
    + escapeExpression(((helper = (helper = helpers.roomsPossible || (depth0 != null ? depth0.roomsPossible : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"roomsPossible","hash":{},"data":data}) : helper)));
},"compiler":[6,">= 2.0.0-beta.1"],"main":function(depth0,helpers,partials,data) {
  var stack1, helper, functionType="function", helperMissing=helpers.helperMissing, escapeExpression=this.escapeExpression, buffer = "\n\n<div class=\"small-list-icons listing-list-summary a-"
    + escapeExpression(((helper = (helper = helpers.availability || (depth0 != null ? depth0.availability : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"availability","hash":{},"data":data}) : helper)))
    + " s-"
    + escapeExpression(((helper = (helper = helpers.displayStatus || (depth0 != null ? depth0.displayStatus : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"displayStatus","hash":{},"data":data}) : helper)))
    + " "
    + escapeExpression(((helper = (helper = helpers.classes || (depth0 != null ? depth0.classes : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"classes","hash":{},"data":data}) : helper)))
    + "\" data-member-of=\""
    + escapeExpression(((helper = (helper = helpers.classes || (depth0 != null ? depth0.classes : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"classes","hash":{},"data":data}) : helper)))
    + "\" data-id=\""
    + escapeExpression(((helper = (helper = helpers._id || (depth0 != null ? depth0._id : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"_id","hash":{},"data":data}) : helper)))
    + "\" data-entity=\"{&quot;id&quot;: &quot;"
    + escapeExpression(((helper = (helper = helpers._id || (depth0 != null ? depth0._id : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"_id","hash":{},"data":data}) : helper)))
    + "&quot;}\" data-photos=\"{&quot;photos&quot;: "
    + escapeExpression(((helpers.json || (depth0 && depth0.json) || helperMissing).call(depth0, (depth0 != null ? depth0.images : depth0), {"name":"json","hash":{},"data":data})))
    + " }\" style=\"white-space:nowrap;position:relative;\">\n";
  stack1 = helpers.unless.call(depth0, (depth0 != null ? depth0.$export : depth0), {"name":"unless","hash":{},"fn":this.program(1, data),"inverse":this.noop,"data":data});
  if (stack1 != null) { buffer += stack1; }
  buffer += "	<span class=\"photoWrapper\">\n";
  stack1 = helpers.unless.call(depth0, ((stack1 = (depth0 != null ? depth0.images : depth0)) != null ? stack1['0'] : stack1), {"name":"unless","hash":{},"fn":this.program(3, data),"inverse":this.program(5, data),"data":data});
  if (stack1 != null) { buffer += stack1; }
  stack1 = helpers.unless.call(depth0, (depth0 != null ? depth0.$export : depth0), {"name":"unless","hash":{},"fn":this.program(10, data),"inverse":this.noop,"data":data});
  if (stack1 != null) { buffer += stack1; }
  buffer += "	<div class=\"header\" style=\"display:inline-block;vertical-align:top;position:absolute;left:260px;right:18px;\">\n		<div class=\"price\">\n			<h1>\n";
  stack1 = ((helpers.is || (depth0 && depth0.is) || helperMissing).call(depth0, (depth0 != null ? depth0.availability : depth0), "U", {"name":"is","hash":{},"fn":this.program(13, data),"inverse":this.program(16, data),"data":data}));
  if (stack1 != null) { buffer += stack1; }
  stack1 = ((helpers.is || (depth0 && depth0.is) || helperMissing).call(depth0, (depth0 != null ? depth0.priceChange : depth0), 1, {"name":"is","hash":{},"fn":this.program(21, data),"inverse":this.noop,"data":data}));
  if (stack1 != null) { buffer += stack1; }
  stack1 = ((helpers.is || (depth0 && depth0.is) || helperMissing).call(depth0, (depth0 != null ? depth0.priceChange : depth0), -1, {"name":"is","hash":{},"fn":this.program(23, data),"inverse":this.noop,"data":data}));
  if (stack1 != null) { buffer += stack1; }
  buffer += "			</h1>\n\n";
  stack1 = ((helpers.is || (depth0 && depth0.is) || helperMissing).call(depth0, (depth0 != null ? depth0.gid : depth0), "ELLIMAN", {"name":"is","hash":{},"fn":this.program(25, data),"inverse":this.program(75, data),"data":data}));
  if (stack1 != null) { buffer += stack1; }
  return buffer + "\n\n	</div>\n\n</div>\n\n";
},"useData":true} });