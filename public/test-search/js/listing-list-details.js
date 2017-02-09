('pyhbs' in this) && pyhbs.register("listing-list-details", { phrases: {"no_photo_yet":"No photo yet","beds":"Bed||||Beds","baths":"Bath||||Baths","propertytype.Att/Row/Twnhouse":"Att/Row/Twnhouse","propertytype.Business":"Business","propertytype.Cottage":"Cottage","propertytype.Det w/Com Elements":"Det w/Com Elements","propertytype.Detached":"Detached","propertytype.Duplex":"Duplex","propertytype.Farm":"Farm","propertytype.Fourplex":"Fourplex","propertytype.Link":"Link","propertytype.Mobile/Trailer":"Mobile/Trailer","propertytype.Multiplex":"Multiplex","propertytype.Other":"Other","propertytype.Rural Resid":"Rural Resid","propertytype.Semi-Detached":"Semi-Detached","propertytype.Store w/Apt/Offc":"Store w/Apt/Offc","propertytype.Triplex":"Triplex","propertytype.Vacant Land":"Vacant Land","propertystyle.1 1/2 Storey":"1 1/2 Storey","propertystyle.2 1/2 Storey":"2 1/2 Storey","propertystyle.2-Storey":"2-Storey","propertystyle.3-Storey":"3-Storey","propertystyle.Apartment":"Apartment","propertystyle.studio":"Studio","propertystyle.Bachelor/Studio":"Bachelor/Studio","propertystyle.Backsplit 3":"Backsplit 3","propertystyle.Backsplit 4":"Backsplit 4","propertystyle.Backsplit 5":"Backsplit 5","propertystyle.Backsplt-All":"Backsplt-All","propertystyle.Bungaloft":"Bungaloft","propertystyle.Bungalow":"Bungalow","propertystyle.Bungalow-Raised":"Bungalow-Raised","propertystyle.Frontsplit":"Frontsplit","propertystyle.Loft":"Loft","propertystyle.Multi-level":"Multi-level","propertystyle.Other":"Other","propertystyle.Sidesplit 3":"Sidesplit 3","propertystyle.Sidesplit 4":"Sidesplit 4","propertystyle.Sidesplit 5":"Sidesplit 5","propertystyle.Sidesplt-All":"Sidesplt-All","propertystyle.Stacked Townhse":"Stacked Townhse","price_changed":"Price changed %{priceDifference}%","shortstatus.Unavailable":"U"}, template: {"1":function(depth0,helpers,partials,data) {
  var stack1;
  stack1 = helpers['if'].call(depth0, (depth0 != null ? depth0.tagName : depth0), {"name":"if","hash":{},"fn":this.program(2, data),"inverse":this.program(4, data),"data":data});
  if (stack1 != null) { return stack1; }
  else { return ''; }
  },"2":function(depth0,helpers,partials,data) {
  var helper, functionType="function", helperMissing=helpers.helperMissing, escapeExpression=this.escapeExpression;
  return escapeExpression(((helper = (helper = helpers.tagName || (depth0 != null ? depth0.tagName : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"tagName","hash":{},"data":data}) : helper)));
  },"4":function(depth0,helpers,partials,data) {
  return "a";
  },"6":function(depth0,helpers,partials,data) {
  return "span style=\"cursor:pointer;\" ";
  },"8":function(depth0,helpers,partials,data) {
  return "ua";
  },"10":function(depth0,helpers,partials,data) {
  var stack1, buffer = " href=\"";
  stack1 = helpers['if'].call(depth0, (depth0 != null ? depth0.urlOverride : depth0), {"name":"if","hash":{},"fn":this.program(11, data),"inverse":this.program(13, data),"data":data});
  if (stack1 != null) { buffer += stack1; }
  buffer += "\" target=\"";
  stack1 = helpers['if'].call(depth0, (depth0 != null ? depth0.urlTarget : depth0), {"name":"if","hash":{},"fn":this.program(15, data),"inverse":this.program(17, data),"data":data});
  if (stack1 != null) { buffer += stack1; }
  return buffer + "\"\ndata-rel=\"listing-details\" ";
},"11":function(depth0,helpers,partials,data) {
  var helper, functionType="function", helperMissing=helpers.helperMissing, escapeExpression=this.escapeExpression;
  return escapeExpression(((helper = (helper = helpers.urlOverride || (depth0 != null ? depth0.urlOverride : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"urlOverride","hash":{},"data":data}) : helper)));
  },"13":function(depth0,helpers,partials,data) {
  var helper, functionType="function", helperMissing=helpers.helperMissing, escapeExpression=this.escapeExpression;
  return "/listings/"
    + escapeExpression(((helper = (helper = helpers._id || (depth0 != null ? depth0._id : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"_id","hash":{},"data":data}) : helper)));
},"15":function(depth0,helpers,partials,data) {
  var helper, functionType="function", helperMissing=helpers.helperMissing, escapeExpression=this.escapeExpression;
  return escapeExpression(((helper = (helper = helpers.urlTarget || (depth0 != null ? depth0.urlTarget : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"urlTarget","hash":{},"data":data}) : helper)));
  },"17":function(depth0,helpers,partials,data) {
  return "_top";
  },"19":function(depth0,helpers,partials,data) {
  return " data-toggle=\"modal\" data-target=\"#restricted-listing-dialog\" ";
  },"21":function(depth0,helpers,partials,data) {
  return "	<table style=\"table-layout:fixed;width:100%;\">\n		<tr>\n			<td width=\"75\" style=\"width:75px;\">\n";
  },"23":function(depth0,helpers,partials,data) {
  var stack1, buffer = "				<span class=\"listing-photo\">\n";
  stack1 = helpers.unless.call(depth0, ((stack1 = (depth0 != null ? depth0.images : depth0)) != null ? stack1['0'] : stack1), {"name":"unless","hash":{},"fn":this.program(24, data),"inverse":this.program(26, data),"data":data});
  if (stack1 != null) { buffer += stack1; }
  return buffer + "				</span>\n";
},"24":function(depth0,helpers,partials,data) {
  var helperMissing=helpers.helperMissing, escapeExpression=this.escapeExpression;
  return "						<span class=\"no-photo-yet\">"
    + escapeExpression(((helpers.t || (depth0 && depth0.t) || helperMissing).call(depth0, "no_photo_yet", {"name":"t","hash":{},"data":data})))
    + "</span>\n";
},"26":function(depth0,helpers,partials,data) {
  var stack1, buffer = "						<img ";
  stack1 = helpers.unless.call(depth0, (depth0 != null ? depth0.forceShow : depth0), {"name":"unless","hash":{},"fn":this.program(27, data),"inverse":this.program(29, data),"data":data});
  if (stack1 != null) { buffer += stack1; }
  return buffer + " />\n";
},"27":function(depth0,helpers,partials,data) {
  var stack1, lambda=this.lambda, escapeExpression=this.escapeExpression;
  return "class=\"df listing-photo-thumbnail\" data-df-src=\""
    + escapeExpression(lambda(((stack1 = (depth0 != null ? depth0.images : depth0)) != null ? stack1['0'] : stack1), depth0))
    + "/150\"";
},"29":function(depth0,helpers,partials,data) {
  var stack1, lambda=this.lambda, escapeExpression=this.escapeExpression;
  return "class=\"listing-photo-thumbnail\" src=\""
    + escapeExpression(lambda(((stack1 = (depth0 != null ? depth0.images : depth0)) != null ? stack1['0'] : stack1), depth0))
    + "/150\"";
},"31":function(depth0,helpers,partials,data) {
  return "			</td>\n			<td>\n";
  },"33":function(depth0,helpers,partials,data) {
  return "";
},"35":function(depth0,helpers,partials,data) {
  var stack1, helper, functionType="function", helperMissing=helpers.helperMissing, escapeExpression=this.escapeExpression, buffer = "						"
    + escapeExpression(((helper = (helper = helpers.bedrooms || (depth0 != null ? depth0.bedrooms : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"bedrooms","hash":{},"data":data}) : helper)));
  stack1 = helpers['if'].call(depth0, (depth0 != null ? depth0.bedroomsPossible : depth0), {"name":"if","hash":{},"fn":this.program(36, data),"inverse":this.noop,"data":data});
  if (stack1 != null) { buffer += stack1; }
  return buffer + " <span class=\"form-label\">"
    + escapeExpression(((helpers.t || (depth0 && depth0.t) || helperMissing).call(depth0, "beds", (depth0 != null ? depth0.bedrooms : depth0), {"name":"t","hash":{},"data":data})))
    + "</span>\n						"
    + escapeExpression(((helper = (helper = helpers.bathrooms || (depth0 != null ? depth0.bathrooms : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"bathrooms","hash":{},"data":data}) : helper)))
    + " <span class=\"form-label\">"
    + escapeExpression(((helpers.t || (depth0 && depth0.t) || helperMissing).call(depth0, "baths", (depth0 != null ? depth0.bathrooms : depth0), {"name":"t","hash":{},"data":data})))
    + "</span>\n";
},"36":function(depth0,helpers,partials,data) {
  var helper, functionType="function", helperMissing=helpers.helperMissing, escapeExpression=this.escapeExpression;
  return "+"
    + escapeExpression(((helper = (helper = helpers.bedroomsPossible || (depth0 != null ? depth0.bedroomsPossible : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"bedroomsPossible","hash":{},"data":data}) : helper)));
},"38":function(depth0,helpers,partials,data) {
  var helperMissing=helpers.helperMissing, escapeExpression=this.escapeExpression;
  return escapeExpression(((helpers.v || (depth0 && depth0.v) || helperMissing).call(depth0, (depth0 != null ? depth0.typeName : depth0), "propertytype", {"name":"v","hash":{},"data":data})));
  },"40":function(depth0,helpers,partials,data) {
  var stack1, helper, functionType="function", helperMissing=helpers.helperMissing, escapeExpression=this.escapeExpression, buffer = "									<span class=\"price\">"
    + escapeExpression(((helper = (helper = helpers.priceShort || (depth0 != null ? depth0.priceShort : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"priceShort","hash":{},"data":data}) : helper)));
  stack1 = ((helpers.user_is || (depth0 && depth0.user_is) || helperMissing).call(depth0, "agent", (depth0 != null ? depth0.user : depth0), {"name":"user_is","hash":{},"fn":this.program(41, data),"inverse":this.noop,"data":data}));
  if (stack1 != null) { buffer += stack1; }
  buffer += "\n";
  stack1 = ((helpers.is || (depth0 && depth0.is) || helperMissing).call(depth0, (depth0 != null ? depth0.priceChange : depth0), 1, {"name":"is","hash":{},"fn":this.program(43, data),"inverse":this.noop,"data":data}));
  if (stack1 != null) { buffer += stack1; }
  stack1 = ((helpers.is || (depth0 && depth0.is) || helperMissing).call(depth0, (depth0 != null ? depth0.priceChange : depth0), -1, {"name":"is","hash":{},"fn":this.program(45, data),"inverse":this.noop,"data":data}));
  if (stack1 != null) { buffer += stack1; }
  return buffer + "									</span>\n";
},"41":function(depth0,helpers,partials,data) {
  var helper, functionType="function", helperMissing=helpers.helperMissing, escapeExpression=this.escapeExpression;
  return " <span style=\"color: #444; font-weight: 300;\">"
    + escapeExpression(((helper = (helper = helpers.priceCode || (depth0 != null ? depth0.priceCode : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"priceCode","hash":{},"data":data}) : helper)))
    + "</span>";
},"43":function(depth0,helpers,partials,data) {
  var helperMissing=helpers.helperMissing, escapeExpression=this.escapeExpression;
  return "											<span class=\"pc-incr\" title=\""
    + escapeExpression(((helpers.t || (depth0 && depth0.t) || helperMissing).call(depth0, "price_changed", depth0, {"name":"t","hash":{},"data":data})))
    + "\">&uarr;</span>\n";
},"45":function(depth0,helpers,partials,data) {
  var helperMissing=helpers.helperMissing, escapeExpression=this.escapeExpression;
  return "											<span class=\"pc-decr\" title=\""
    + escapeExpression(((helpers.t || (depth0 && depth0.t) || helperMissing).call(depth0, "price_changed", depth0, {"name":"t","hash":{},"data":data})))
    + "\">&darr;</span>\n";
},"47":function(depth0,helpers,partials,data) {
  var helper, functionType="function", helperMissing=helpers.helperMissing, escapeExpression=this.escapeExpression;
  return "<span>"
    + escapeExpression(((helper = (helper = helpers.daysOnMarket || (depth0 != null ? depth0.daysOnMarket : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"daysOnMarket","hash":{},"data":data}) : helper)))
    + " <span class=\"form-label\">DOM</span></span>";
},"49":function(depth0,helpers,partials,data) {
  var stack1, helperMissing=helpers.helperMissing;
  stack1 = ((helpers.user_is || (depth0 && depth0.user_is) || helperMissing).call(depth0, "agent", (depth0 != null ? depth0.user : depth0), {"name":"user_is","hash":{},"fn":this.program(50, data),"inverse":this.noop,"data":data}));
  if (stack1 != null) { return stack1; }
  else { return ''; }
  },"50":function(depth0,helpers,partials,data) {
  var stack1, helperMissing=helpers.helperMissing;
  stack1 = ((helpers.is || (depth0 && depth0.is) || helperMissing).call(depth0, (depth0 != null ? depth0.saleOrRent : depth0), "SALE", {"name":"is","hash":{},"fn":this.program(51, data),"inverse":this.noop,"data":data}));
  if (stack1 != null) { return stack1; }
  else { return ''; }
  },"51":function(depth0,helpers,partials,data) {
  var helper, functionType="function", helperMissing=helpers.helperMissing, escapeExpression=this.escapeExpression;
  return "<span>"
    + escapeExpression(((helper = (helper = helpers.commissionCode || (depth0 != null ? depth0.commissionCode : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"commissionCode","hash":{},"data":data}) : helper)))
    + "</span>";
},"53":function(depth0,helpers,partials,data) {
  return "MLS# ";
  },"55":function(depth0,helpers,partials,data) {
  return "#";
  },"57":function(depth0,helpers,partials,data) {
  return "			</td>\n		</tr>\n	</table>\n";
  },"59":function(depth0,helpers,partials,data) {
  var stack1, buffer = "</";
  stack1 = helpers['if'].call(depth0, (depth0 != null ? depth0.tagName : depth0), {"name":"if","hash":{},"fn":this.program(2, data),"inverse":this.program(4, data),"data":data});
  if (stack1 != null) { buffer += stack1; }
  return buffer + ">";
},"61":function(depth0,helpers,partials,data) {
  return "</span>";
  },"63":function(depth0,helpers,partials,data) {
  var stack1, helperMissing=helpers.helperMissing, buffer = "";
  stack1 = helpers['if'].call(depth0, ((stack1 = (depth0 != null ? depth0.$root : depth0)) != null ? stack1.isYourLists : stack1), {"name":"if","hash":{},"fn":this.program(64, data),"inverse":this.noop,"data":data});
  if (stack1 != null) { buffer += stack1; }
  stack1 = ((helpers.is || (depth0 && depth0.is) || helperMissing).call(depth0, ((stack1 = (depth0 != null ? depth0.$root : depth0)) != null ? stack1.$view : stack1), "mobile", {"name":"is","hash":{},"fn":this.program(64, data),"inverse":this.noop,"data":data}));
  if (stack1 != null) { buffer += stack1; }
  return buffer;
},"64":function(depth0,helpers,partials,data) {
  return "		<a data-toggle=\"dropdown\" class=\"hcmenu-btn\"><span class=\"fa fa-ellipsis-h\"></span></a>\n";
  },"compiler":[6,">= 2.0.0-beta.1"],"main":function(depth0,helpers,partials,data) {
  var stack1, helper, functionType="function", helperMissing=helpers.helperMissing, escapeExpression=this.escapeExpression, buffer = "<";
  stack1 = helpers.unless.call(depth0, (depth0 != null ? depth0.$isRestricted : depth0), {"name":"unless","hash":{},"fn":this.program(1, data),"inverse":this.program(6, data),"data":data});
  if (stack1 != null) { buffer += stack1; }
  buffer += " class=\"listing-summary "
    + escapeExpression(((helper = (helper = helpers.classes || (depth0 != null ? depth0.classes : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"classes","hash":{},"data":data}) : helper)))
    + " ";
  stack1 = ((helpers.is || (depth0 && depth0.is) || helperMissing).call(depth0, (depth0 != null ? depth0.availability : depth0), "U", {"name":"is","hash":{},"fn":this.program(8, data),"inverse":this.noop,"data":data}));
  if (stack1 != null) { buffer += stack1; }
  buffer += "\" ";
  stack1 = helpers.unless.call(depth0, (depth0 != null ? depth0.$isRestricted : depth0), {"name":"unless","hash":{},"fn":this.program(10, data),"inverse":this.program(19, data),"data":data});
  if (stack1 != null) { buffer += stack1; }
  buffer += " data-id=\""
    + escapeExpression(((helper = (helper = helpers._id || (depth0 != null ? depth0._id : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"_id","hash":{},"data":data}) : helper)))
    + "\">\n	<span class=\"indicators-wrapper\">\n		<span class=\"indicators\">\n			<span class=\"f\"></span>\n			<span class=\"l\"></span>\n			<span class=\"d\"></span>\n			<span class=\"c\"></span>\n			<span class=\"s\"></span>\n		</span>\n	</span>\n";
  stack1 = helpers['if'].call(depth0, ((stack1 = (depth0 != null ? depth0.$root : depth0)) != null ? stack1.isEmail : stack1), {"name":"if","hash":{},"fn":this.program(21, data),"inverse":this.noop,"data":data});
  if (stack1 != null) { buffer += stack1; }
  stack1 = helpers.unless.call(depth0, ((stack1 = (depth0 != null ? depth0.$root : depth0)) != null ? stack1.disableListingPhotos : stack1), {"name":"unless","hash":{},"fn":this.program(23, data),"inverse":this.noop,"data":data});
  if (stack1 != null) { buffer += stack1; }
  stack1 = helpers['if'].call(depth0, ((stack1 = (depth0 != null ? depth0.$root : depth0)) != null ? stack1.isEmail : stack1), {"name":"if","hash":{},"fn":this.program(31, data),"inverse":this.noop,"data":data});
  if (stack1 != null) { buffer += stack1; }
  buffer += "				<span class=\"listing-details\">\n					<span><strong>"
    + escapeExpression(((helper = (helper = helpers.streetAddress || (depth0 != null ? depth0.streetAddress : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"streetAddress","hash":{},"data":data}) : helper)))
    + ", "
    + escapeExpression(((helper = (helper = helpers.city || (depth0 != null ? depth0.city : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"city","hash":{},"data":data}) : helper)))
    + "</strong></span>\n					<br/>\n					<span class=\"full-line\">\n";
  stack1 = ((helpers.is || (depth0 && depth0.is) || helperMissing).call(depth0, (depth0 != null ? depth0.style : depth0), "Land", {"name":"is","hash":{},"fn":this.program(33, data),"inverse":this.program(35, data),"data":data}));
  if (stack1 != null) { buffer += stack1; }
  buffer += "						";
  stack1 = helpers['if'].call(depth0, (depth0 != null ? depth0.typeName : depth0), {"name":"if","hash":{},"fn":this.program(38, data),"inverse":this.noop,"data":data});
  if (stack1 != null) { buffer += stack1; }
  buffer += "\n						"
    + escapeExpression(((helpers.v || (depth0 && depth0.v) || helperMissing).call(depth0, (depth0 != null ? depth0.style : depth0), "propertystyle", {"name":"v","hash":{},"data":data})))
    + "\n					</span>\n					<br/>\n";
  stack1 = helpers.unless.call(depth0, (depth0 != null ? depth0.$isRestricted : depth0), {"name":"unless","hash":{},"fn":this.program(40, data),"inverse":this.noop,"data":data});
  if (stack1 != null) { buffer += stack1; }
  buffer += "								<span class=\"status status-"
    + escapeExpression(((helper = (helper = helpers.displayStatus || (depth0 != null ? depth0.displayStatus : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"displayStatus","hash":{},"data":data}) : helper)))
    + "\">"
    + escapeExpression(((helpers.v || (depth0 && depth0.v) || helperMissing).call(depth0, (depth0 != null ? depth0.displayStatus : depth0), "shortstatus", {"name":"v","hash":{},"data":data})))
    + "</span>\n								";
  stack1 = ((helpers.is_not || (depth0 && depth0.is_not) || helperMissing).call(depth0, (depth0 != null ? depth0.gid : depth0), "MLSLI", {"name":"is_not","hash":{},"fn":this.program(47, data),"inverse":this.noop,"data":data}));
  if (stack1 != null) { buffer += stack1; }
  buffer += "\n								";
  stack1 = ((helpers.is || (depth0 && depth0.is) || helperMissing).call(depth0, (depth0 != null ? depth0.gid : depth0), "ELLIMAN", {"name":"is","hash":{},"fn":this.program(49, data),"inverse":this.noop,"data":data}));
  if (stack1 != null) { buffer += stack1; }
  buffer += "\n								<span><small style=\"color:#999;\">";
  stack1 = ((helpers.is || (depth0 && depth0.is) || helperMissing).call(depth0, (depth0 != null ? depth0.gid : depth0), "MLSLI", {"name":"is","hash":{},"fn":this.program(53, data),"inverse":this.program(55, data),"data":data}));
  if (stack1 != null) { buffer += stack1; }
  buffer += escapeExpression(((helper = (helper = helpers.listingID || (depth0 != null ? depth0.listingID : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"listingID","hash":{},"data":data}) : helper)))
    + "</small></span>\n				</span>\n";
  stack1 = helpers['if'].call(depth0, ((stack1 = (depth0 != null ? depth0.$root : depth0)) != null ? stack1.isEmail : stack1), {"name":"if","hash":{},"fn":this.program(57, data),"inverse":this.noop,"data":data});
  if (stack1 != null) { buffer += stack1; }
  stack1 = helpers.unless.call(depth0, (depth0 != null ? depth0.$isRestricted : depth0), {"name":"unless","hash":{},"fn":this.program(59, data),"inverse":this.program(61, data),"data":data});
  if (stack1 != null) { buffer += stack1; }
  buffer += "\n\n";
  stack1 = helpers.unless.call(depth0, ((stack1 = (depth0 != null ? depth0.$root : depth0)) != null ? stack1.isEmail : stack1), {"name":"unless","hash":{},"fn":this.program(63, data),"inverse":this.noop,"data":data});
  if (stack1 != null) { buffer += stack1; }
  return buffer;
},"useData":true} });