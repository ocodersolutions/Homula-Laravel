('pyhbs' in this) && pyhbs.register("listing-summary-card", { phrases: {"no_photo_yet":"No photo yet","add_to_favorites":"Add to Favourites","add_to_likes":"Add to Likes","add_to_dislikes":"Add to Dislikes","comment_on":"Add comments","suggest_to":"Suggest to","beds":"Bed||||Beds","baths":"Bath||||Baths","propertytype.Att/Row/Twnhouse":"Att/Row/Twnhouse","propertytype.Business":"Business","propertytype.Cottage":"Cottage","propertytype.Det w/Com Elements":"Det w/Com Elements","propertytype.Detached":"Detached","propertytype.Duplex":"Duplex","propertytype.Farm":"Farm","propertytype.Fourplex":"Fourplex","propertytype.Link":"Link","propertytype.Mobile/Trailer":"Mobile/Trailer","propertytype.Multiplex":"Multiplex","propertytype.Other":"Other","propertytype.Rural Resid":"Rural Resid","propertytype.Semi-Detached":"Semi-Detached","propertytype.Store w/Apt/Offc":"Store w/Apt/Offc","propertytype.Triplex":"Triplex","propertytype.Vacant Land":"Vacant Land","propertystyle.1 1/2 Storey":"1 1/2 Storey","propertystyle.2 1/2 Storey":"2 1/2 Storey","propertystyle.2-Storey":"2-Storey","propertystyle.3-Storey":"3-Storey","propertystyle.Apartment":"Apartment","propertystyle.studio":"Studio","propertystyle.Bachelor/Studio":"Bachelor/Studio","propertystyle.Backsplit 3":"Backsplit 3","propertystyle.Backsplit 4":"Backsplit 4","propertystyle.Backsplit 5":"Backsplit 5","propertystyle.Backsplt-All":"Backsplt-All","propertystyle.Bungaloft":"Bungaloft","propertystyle.Bungalow":"Bungalow","propertystyle.Bungalow-Raised":"Bungalow-Raised","propertystyle.Frontsplit":"Frontsplit","propertystyle.Loft":"Loft","propertystyle.Multi-level":"Multi-level","propertystyle.Other":"Other","propertystyle.Sidesplit 3":"Sidesplit 3","propertystyle.Sidesplit 4":"Sidesplit 4","propertystyle.Sidesplit 5":"Sidesplit 5","propertystyle.Sidesplt-All":"Sidesplt-All","propertystyle.Stacked Townhse":"Stacked Townhse","price_changed":"Price changed %{priceDifference}%"}, template: {"1":function(depth0,helpers,partials,data) {
  return "ua";
  },"3":function(depth0,helpers,partials,data) {
  return "no-toggles";
  },"5":function(depth0,helpers,partials,data) {
  var helper, functionType="function", helperMissing=helpers.helperMissing, escapeExpression=this.escapeExpression;
  return escapeExpression(((helper = (helper = helpers.urlOverride || (depth0 != null ? depth0.urlOverride : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"urlOverride","hash":{},"data":data}) : helper)));
  },"7":function(depth0,helpers,partials,data) {
  var helper, functionType="function", helperMissing=helpers.helperMissing, escapeExpression=this.escapeExpression;
  return "/listings/"
    + escapeExpression(((helper = (helper = helpers._id || (depth0 != null ? depth0._id : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"_id","hash":{},"data":data}) : helper)));
},"9":function(depth0,helpers,partials,data) {
  var helperMissing=helpers.helperMissing, escapeExpression=this.escapeExpression;
  return "data-photos=\"{&quot;photos&quot;: "
    + escapeExpression(((helpers.json || (depth0 && depth0.json) || helperMissing).call(depth0, (depth0 != null ? depth0.images : depth0), {"name":"json","hash":{},"data":data})))
    + " }\"";
},"11":function(depth0,helpers,partials,data) {
  var stack1, buffer = "		<a href=\"";
  stack1 = helpers['if'].call(depth0, (depth0 != null ? depth0.urlOverride : depth0), {"name":"if","hash":{},"fn":this.program(5, data),"inverse":this.program(7, data),"data":data});
  if (stack1 != null) { buffer += stack1; }
  buffer += "\" ";
  stack1 = helpers.unless.call(depth0, (depth0 != null ? depth0.$useDefaultLinkBehavior : depth0), {"name":"unless","hash":{},"fn":this.program(12, data),"inverse":this.noop,"data":data});
  if (stack1 != null) { buffer += stack1; }
  return buffer + ">\n";
},"12":function(depth0,helpers,partials,data) {
  return "data-rel=\"listing-details\"";
  },"14":function(depth0,helpers,partials,data) {
  return "		<span style=\"cursor:pointer;\" data-toggle=\"modal\" data-target=\"#restricted-listing-dialog\">\n";
  },"16":function(depth0,helpers,partials,data) {
  var helperMissing=helpers.helperMissing, escapeExpression=this.escapeExpression;
  return "			<span class=\"listing-photo\"><span class=\"no-photo-yet\">"
    + escapeExpression(((helpers.t || (depth0 && depth0.t) || helperMissing).call(depth0, "no_photo_yet", {"name":"t","hash":{},"data":data})))
    + "</span></span>\n";
},"18":function(depth0,helpers,partials,data) {
  var stack1, buffer = "								<img ";
  stack1 = helpers.unless.call(depth0, (depth0 != null ? depth0.forceShow : depth0), {"name":"unless","hash":{},"fn":this.program(19, data),"inverse":this.program(21, data),"data":data});
  if (stack1 != null) { buffer += stack1; }
  return buffer + " />";
},"19":function(depth0,helpers,partials,data) {
  var stack1, lambda=this.lambda, escapeExpression=this.escapeExpression;
  return "class=\"df listing-photo\" data-df-src=\""
    + escapeExpression(lambda(((stack1 = (depth0 != null ? depth0.images : depth0)) != null ? stack1['0'] : stack1), depth0))
    + "/600\"";
},"21":function(depth0,helpers,partials,data) {
  var stack1, lambda=this.lambda, escapeExpression=this.escapeExpression;
  return "class=\"listing-photo\" src=\""
    + escapeExpression(lambda(((stack1 = (depth0 != null ? depth0.images : depth0)) != null ? stack1['0'] : stack1), depth0))
    + "/600\"";
},"23":function(depth0,helpers,partials,data) {
  return "</a>";
  },"25":function(depth0,helpers,partials,data) {
  return "</span>";
  },"27":function(depth0,helpers,partials,data) {
  var stack1, buffer = "";
  stack1 = helpers['if'].call(depth0, ((stack1 = (depth0 != null ? depth0.images : depth0)) != null ? stack1['1'] : stack1), {"name":"if","hash":{},"fn":this.program(28, data),"inverse":this.noop,"data":data});
  if (stack1 != null) { buffer += stack1; }
  return buffer;
},"28":function(depth0,helpers,partials,data) {
  return "			<a class=\"prev-image\" href=\"#\"><span class=\"glyphicon glyphicon-chevron-left\"></span></a>\n			<a class=\"next-image\" href=\"#\"><span class=\"glyphicon glyphicon-chevron-right\"></span></a>\n";
  },"30":function(depth0,helpers,partials,data) {
  var helperMissing=helpers.helperMissing, escapeExpression=this.escapeExpression;
  return "\n		<span class=\"toggles\">\n			<button class=\"btn btn-default btn-toggle-favorite\" data-toggle=\"tooltip\" data-title=\""
    + escapeExpression(((helpers.t || (depth0 && depth0.t) || helperMissing).call(depth0, "add_to_favorites", {"name":"t","hash":{},"data":data})))
    + "\">\n				<span class=\"list-icon list-icon-favorite\"></span>\n			</button>\n			<button class=\"btn btn-default btn-toggle-like\" data-toggle=\"tooltip\" data-title=\""
    + escapeExpression(((helpers.t || (depth0 && depth0.t) || helperMissing).call(depth0, "add_to_likes", {"name":"t","hash":{},"data":data})))
    + "\">\n				<span class=\"list-icon list-icon-like\"></span>\n			</button>\n			<button class=\"btn btn-default btn-toggle-dislike\" data-toggle=\"tooltip\" data-title=\""
    + escapeExpression(((helpers.t || (depth0 && depth0.t) || helperMissing).call(depth0, "add_to_dislikes", {"name":"t","hash":{},"data":data})))
    + "\">\n				<span class=\"list-icon list-icon-dislike\"></span>\n			</button>\n			<button class=\"btn btn-default btn-toggle-comment\" data-toggle=\"tooltip\" data-title=\""
    + escapeExpression(((helpers.t || (depth0 && depth0.t) || helperMissing).call(depth0, "comment_on", {"name":"t","hash":{},"data":data})))
    + "\">\n				<span class=\"list-icon list-icon-comment\"></span>\n			</button>\n			<button class=\"btn btn-default btn-suggest-list\" data-toggle=\"tooltip\" data-title=\""
    + escapeExpression(((helpers.t || (depth0 && depth0.t) || helperMissing).call(depth0, "suggest_to", {"name":"t","hash":{},"data":data})))
    + "\">\n				<span class=\"list-icon list-icon-suggest\"></span>\n			</button>\n\n			<div class=\"hcmenu quiet\"><a data-toggle=\"dropdown\" class=\"hcmenu-btn\"><span class=\"fa fa-ellipsis-h\"></span></a></div>\n		</span>\n";
},"32":function(depth0,helpers,partials,data) {
  var stack1, buffer = "	<a href=\"";
  stack1 = helpers['if'].call(depth0, (depth0 != null ? depth0.urlOverride : depth0), {"name":"if","hash":{},"fn":this.program(5, data),"inverse":this.program(7, data),"data":data});
  if (stack1 != null) { buffer += stack1; }
  buffer += "\" ";
  stack1 = helpers.unless.call(depth0, (depth0 != null ? depth0.$useDefaultLinkBehavior : depth0), {"name":"unless","hash":{},"fn":this.program(12, data),"inverse":this.noop,"data":data});
  if (stack1 != null) { buffer += stack1; }
  return buffer + " class=\"listing-details\">\n";
},"34":function(depth0,helpers,partials,data) {
  return "	<span class=\"listing-details\" style=\"cursor:pointer;\" data-toggle=\"modal\" data-target=\"#restricted-listing-dialog\">\n";
  },"36":function(depth0,helpers,partials,data) {
  return ",";
  },"38":function(depth0,helpers,partials,data) {
  var helper, functionType="function", helperMissing=helpers.helperMissing, escapeExpression=this.escapeExpression;
  return "+"
    + escapeExpression(((helper = (helper = helpers.bedroomsPossible || (depth0 != null ? depth0.bedroomsPossible : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"bedroomsPossible","hash":{},"data":data}) : helper)));
},"40":function(depth0,helpers,partials,data) {
  var stack1, helper, functionType="function", helperMissing=helpers.helperMissing, escapeExpression=this.escapeExpression, buffer = "		<span class=\"price\">"
    + escapeExpression(((helper = (helper = helpers.priceFormatted || (depth0 != null ? depth0.priceFormatted : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"priceFormatted","hash":{},"data":data}) : helper)))
    + " ";
  stack1 = ((helpers.user_is || (depth0 && depth0.user_is) || helperMissing).call(depth0, "agent", (depth0 != null ? depth0.user : depth0), {"name":"user_is","hash":{},"fn":this.program(41, data),"inverse":this.noop,"data":data}));
  if (stack1 != null) { buffer += stack1; }
  buffer += "\n";
  stack1 = ((helpers.is || (depth0 && depth0.is) || helperMissing).call(depth0, (depth0 != null ? depth0.priceChange : depth0), 1, {"name":"is","hash":{},"fn":this.program(43, data),"inverse":this.noop,"data":data}));
  if (stack1 != null) { buffer += stack1; }
  stack1 = ((helpers.is || (depth0 && depth0.is) || helperMissing).call(depth0, (depth0 != null ? depth0.priceChange : depth0), -1, {"name":"is","hash":{},"fn":this.program(45, data),"inverse":this.noop,"data":data}));
  if (stack1 != null) { buffer += stack1; }
  return buffer + "		</span>\n";
},"41":function(depth0,helpers,partials,data) {
  var helper, functionType="function", helperMissing=helpers.helperMissing, escapeExpression=this.escapeExpression;
  return " <span style=\"color: #444; font-weight: 300;\">"
    + escapeExpression(((helper = (helper = helpers.priceCode || (depth0 != null ? depth0.priceCode : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"priceCode","hash":{},"data":data}) : helper)))
    + "</span>";
},"43":function(depth0,helpers,partials,data) {
  var helperMissing=helpers.helperMissing, escapeExpression=this.escapeExpression;
  return "				<span class=\"pc-incr\" title=\""
    + escapeExpression(((helpers.t || (depth0 && depth0.t) || helperMissing).call(depth0, "price_changed", depth0, {"name":"t","hash":{},"data":data})))
    + "\">&uarr;</span>\n";
},"45":function(depth0,helpers,partials,data) {
  var helperMissing=helpers.helperMissing, escapeExpression=this.escapeExpression;
  return "				<span class=\"pc-decr\" title=\""
    + escapeExpression(((helpers.t || (depth0 && depth0.t) || helperMissing).call(depth0, "price_changed", depth0, {"name":"t","hash":{},"data":data})))
    + "\">&darr;</span>\n";
},"47":function(depth0,helpers,partials,data) {
  var helper, functionType="function", helperMissing=helpers.helperMissing, escapeExpression=this.escapeExpression;
  return "		<span class=\"status status-"
    + escapeExpression(((helper = (helper = helpers.status || (depth0 != null ? depth0.status : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"status","hash":{},"data":data}) : helper)))
    + "\">"
    + escapeExpression(((helper = (helper = helpers.status || (depth0 != null ? depth0.status : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"status","hash":{},"data":data}) : helper)))
    + "&nbsp;</span>\n";
},"49":function(depth0,helpers,partials,data) {
  var helper, functionType="function", helperMissing=helpers.helperMissing, escapeExpression=this.escapeExpression;
  return "		<span class=\"status status-"
    + escapeExpression(((helper = (helper = helpers.displayStatus || (depth0 != null ? depth0.displayStatus : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"displayStatus","hash":{},"data":data}) : helper)))
    + "\">"
    + escapeExpression(((helper = (helper = helpers.displayStatus || (depth0 != null ? depth0.displayStatus : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"displayStatus","hash":{},"data":data}) : helper)))
    + "&nbsp;</span>\n";
},"51":function(depth0,helpers,partials,data) {
  var helper, functionType="function", helperMissing=helpers.helperMissing, escapeExpression=this.escapeExpression;
  return "<span>"
    + escapeExpression(((helper = (helper = helpers.daysOnMarket || (depth0 != null ? depth0.daysOnMarket : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"daysOnMarket","hash":{},"data":data}) : helper)))
    + " <span class=\"form-label\">DOM</span></span>";
},"53":function(depth0,helpers,partials,data) {
  var stack1, helperMissing=helpers.helperMissing;
  stack1 = ((helpers.user_is || (depth0 && depth0.user_is) || helperMissing).call(depth0, "agent", (depth0 != null ? depth0.user : depth0), {"name":"user_is","hash":{},"fn":this.program(54, data),"inverse":this.noop,"data":data}));
  if (stack1 != null) { return stack1; }
  else { return ''; }
  },"54":function(depth0,helpers,partials,data) {
  var stack1, helperMissing=helpers.helperMissing;
  stack1 = ((helpers.is || (depth0 && depth0.is) || helperMissing).call(depth0, (depth0 != null ? depth0.saleOrRent : depth0), "SALE", {"name":"is","hash":{},"fn":this.program(55, data),"inverse":this.noop,"data":data}));
  if (stack1 != null) { return stack1; }
  else { return ''; }
  },"55":function(depth0,helpers,partials,data) {
  var helper, functionType="function", helperMissing=helpers.helperMissing, escapeExpression=this.escapeExpression;
  return "<span>"
    + escapeExpression(((helper = (helper = helpers.commissionCode || (depth0 != null ? depth0.commissionCode : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"commissionCode","hash":{},"data":data}) : helper)))
    + "</span>";
},"57":function(depth0,helpers,partials,data) {
  return "MLS# ";
  },"59":function(depth0,helpers,partials,data) {
  return "#";
  },"compiler":[6,">= 2.0.0-beta.1"],"main":function(depth0,helpers,partials,data) {
  var stack1, helper, functionType="function", helperMissing=helpers.helperMissing, escapeExpression=this.escapeExpression, buffer = "\n<div class=\"listing-summary-card clearfix "
    + escapeExpression(((helper = (helper = helpers.classes || (depth0 != null ? depth0.classes : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"classes","hash":{},"data":data}) : helper)))
    + " ";
  stack1 = ((helpers.is || (depth0 && depth0.is) || helperMissing).call(depth0, (depth0 != null ? depth0.availability : depth0), "U", {"name":"is","hash":{},"fn":this.program(1, data),"inverse":this.noop,"data":data}));
  if (stack1 != null) { buffer += stack1; }
  buffer += " ";
  stack1 = helpers['if'].call(depth0, ((stack1 = (depth0 != null ? depth0.$settings : depth0)) != null ? stack1.$disableToggles : stack1), {"name":"if","hash":{},"fn":this.program(3, data),"inverse":this.noop,"data":data});
  if (stack1 != null) { buffer += stack1; }
  buffer += "\" data-entity=\"{&quot;id&quot;: &quot;"
    + escapeExpression(((helper = (helper = helpers._id || (depth0 != null ? depth0._id : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"_id","hash":{},"data":data}) : helper)))
    + "&quot;\" data-id=\""
    + escapeExpression(((helper = (helper = helpers._id || (depth0 != null ? depth0._id : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"_id","hash":{},"data":data}) : helper)))
    + "\" data-url=\"";
  stack1 = helpers['if'].call(depth0, (depth0 != null ? depth0.urlOverride : depth0), {"name":"if","hash":{},"fn":this.program(5, data),"inverse":this.program(7, data),"data":data});
  if (stack1 != null) { buffer += stack1; }
  buffer += "\" ";
  stack1 = helpers.unless.call(depth0, ((stack1 = (depth0 != null ? depth0.$settings : depth0)) != null ? stack1.$disableImageNavigation : stack1), {"name":"unless","hash":{},"fn":this.program(9, data),"inverse":this.noop,"data":data});
  if (stack1 != null) { buffer += stack1; }
  buffer += ">\n	<div class=\"photoWrapper\">\n";
  stack1 = helpers.unless.call(depth0, (depth0 != null ? depth0.$isRestricted : depth0), {"name":"unless","hash":{},"fn":this.program(11, data),"inverse":this.program(14, data),"data":data});
  if (stack1 != null) { buffer += stack1; }
  stack1 = helpers.unless.call(depth0, ((stack1 = (depth0 != null ? depth0.images : depth0)) != null ? stack1['0'] : stack1), {"name":"unless","hash":{},"fn":this.program(16, data),"inverse":this.program(18, data),"data":data});
  if (stack1 != null) { buffer += stack1; }
  buffer += "\n		";
  stack1 = helpers.unless.call(depth0, (depth0 != null ? depth0.$isRestricted : depth0), {"name":"unless","hash":{},"fn":this.program(23, data),"inverse":this.program(25, data),"data":data});
  if (stack1 != null) { buffer += stack1; }
  buffer += "\n";
  stack1 = helpers.unless.call(depth0, ((stack1 = (depth0 != null ? depth0.$settings : depth0)) != null ? stack1.$disableImageNavigation : stack1), {"name":"unless","hash":{},"fn":this.program(27, data),"inverse":this.noop,"data":data});
  if (stack1 != null) { buffer += stack1; }
  stack1 = helpers.unless.call(depth0, ((stack1 = (depth0 != null ? depth0.$settings : depth0)) != null ? stack1.$disableToggles : stack1), {"name":"unless","hash":{},"fn":this.program(30, data),"inverse":this.noop,"data":data});
  if (stack1 != null) { buffer += stack1; }
  buffer += "	</div>\n";
  stack1 = helpers.unless.call(depth0, (depth0 != null ? depth0.$isRestricted : depth0), {"name":"unless","hash":{},"fn":this.program(32, data),"inverse":this.program(34, data),"data":data});
  if (stack1 != null) { buffer += stack1; }
  buffer += "		<span><strong><span class=\"addr\">"
    + escapeExpression(((helper = (helper = helpers.streetAddress || (depth0 != null ? depth0.streetAddress : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"streetAddress","hash":{},"data":data}) : helper)));
  stack1 = helpers['if'].call(depth0, (depth0 != null ? depth0.streetAddress : depth0), {"name":"if","hash":{},"fn":this.program(36, data),"inverse":this.noop,"data":data});
  if (stack1 != null) { buffer += stack1; }
  buffer += " </span><span class=\"municipality\">"
    + escapeExpression(((helper = (helper = helpers.city || (depth0 != null ? depth0.city : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"city","hash":{},"data":data}) : helper)))
    + "</span></strong></span>\n		<br/>\n		<span>\n			"
    + escapeExpression(((helper = (helper = helpers.bedrooms || (depth0 != null ? depth0.bedrooms : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"bedrooms","hash":{},"data":data}) : helper)));
  stack1 = helpers['if'].call(depth0, (depth0 != null ? depth0.bedroomsPossible : depth0), {"name":"if","hash":{},"fn":this.program(38, data),"inverse":this.noop,"data":data});
  if (stack1 != null) { buffer += stack1; }
  buffer += " <span class=\"form-label\">"
    + escapeExpression(((helpers.t || (depth0 && depth0.t) || helperMissing).call(depth0, "beds", (depth0 != null ? depth0.bedrooms : depth0), {"name":"t","hash":{},"data":data})))
    + "</span>\n			"
    + escapeExpression(((helper = (helper = helpers.bathrooms || (depth0 != null ? depth0.bathrooms : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"bathrooms","hash":{},"data":data}) : helper)))
    + " <span class=\"form-label\">"
    + escapeExpression(((helpers.t || (depth0 && depth0.t) || helperMissing).call(depth0, "baths", (depth0 != null ? depth0.bathrooms : depth0), {"name":"t","hash":{},"data":data})))
    + "</span>\n			"
    + escapeExpression(((helpers.v || (depth0 && depth0.v) || helperMissing).call(depth0, (depth0 != null ? depth0.typeName : depth0), "propertytype", {"name":"v","hash":{},"data":data})))
    + "\n			"
    + escapeExpression(((helpers.v || (depth0 && depth0.v) || helperMissing).call(depth0, (depth0 != null ? depth0.style : depth0), "propertystyle", {"name":"v","hash":{},"data":data})))
    + "\n		</span>\n		<br/>\n";
  stack1 = helpers.unless.call(depth0, (depth0 != null ? depth0.$isRestricted : depth0), {"name":"unless","hash":{},"fn":this.program(40, data),"inverse":this.noop,"data":data});
  if (stack1 != null) { buffer += stack1; }
  stack1 = ((helpers.user_is || (depth0 && depth0.user_is) || helperMissing).call(depth0, "agent", (depth0 != null ? depth0.user : depth0), {"name":"user_is","hash":{},"fn":this.program(47, data),"inverse":this.program(49, data),"data":data}));
  if (stack1 != null) { buffer += stack1; }
  buffer += "		";
  stack1 = ((helpers.is_not || (depth0 && depth0.is_not) || helperMissing).call(depth0, (depth0 != null ? depth0.gid : depth0), "MLSLI", {"name":"is_not","hash":{},"fn":this.program(51, data),"inverse":this.noop,"data":data}));
  if (stack1 != null) { buffer += stack1; }
  buffer += "\n		";
  stack1 = ((helpers.is || (depth0 && depth0.is) || helperMissing).call(depth0, (depth0 != null ? depth0.gid : depth0), "ELLIMAN", {"name":"is","hash":{},"fn":this.program(53, data),"inverse":this.noop,"data":data}));
  if (stack1 != null) { buffer += stack1; }
  buffer += "\n		<span><small style=\"color:#999;\">";
  stack1 = ((helpers.is || (depth0 && depth0.is) || helperMissing).call(depth0, (depth0 != null ? depth0.gid : depth0), "MLSLI", {"name":"is","hash":{},"fn":this.program(57, data),"inverse":this.program(59, data),"data":data}));
  if (stack1 != null) { buffer += stack1; }
  buffer += escapeExpression(((helper = (helper = helpers.listingID || (depth0 != null ? depth0.listingID : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"listingID","hash":{},"data":data}) : helper)))
    + "</small></span>\n	";
  stack1 = helpers.unless.call(depth0, (depth0 != null ? depth0.$isRestricted : depth0), {"name":"unless","hash":{},"fn":this.program(23, data),"inverse":this.program(25, data),"data":data});
  if (stack1 != null) { buffer += stack1; }
  return buffer + "\n</div>\n";
},"useData":true} });