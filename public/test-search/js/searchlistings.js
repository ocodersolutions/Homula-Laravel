/* global Responsive, $, jQuery, user, Grid, SummaryList */
/* global SelectionsStore, CurrentViewStore, DataSetStore, ACTIONS */
/* global LeafletProvider, GoogleMapProvider, FilterHelpers, listManager */
/* global LocationManager, StreetGridManager, ClearTextButton, DatePicker */
/* global ListManager, closeInfoWindow, validateInfoWindow, LocationAutocomplete */
/* global resetSaveSearchFields */
/* global accounting, pyhbs, bootbox, Grapnel, printFile */
/* global mapContext, listingNumberTerm, formSettings */
/* global collab, _, Store, AppDispatcher, CriteriaStore */

var MapProvider = null;
var isSearchActive = false;
var useInitialScreen = false;
var currentEntityID;
var currentCountRequest;

(function (root, $) {
	root.collab = {
		api: {
			_queue: {},
			_cache: {},

			// For now only support a single queued xhr
			_enqueue: function (id, xhr) {
				var queue = collab.api._queue;
				if (queue[id]) {
					queue[id].abort();
				}
				queue[id] = xhr;
			},

			count: function (criteria, opts) {
				var id = okhash(criteria);

				if (root.collab.api._cache[id]) {
					return root.collab.api._cache[id];
				}

				if (!criteria) {
					return $.Deferred().reject(null);
				}

				// Include latitude and longitude to prevent listings without
				// coordinates from being returned
				criteria += '&$full_count_only=true&latitude=%3E%3D-90&latitude=%3C%3D90&longitude=%3E%3D-90&longitude=%3C%3D90';

				var method = encodeURI(criteria).length > 2048 ? 'post' : 'get';
				var action = '/listings';

				var xhr = $.ajax({
					dataType: 'json',
					type: method,
					url: action,
					data: criteria
				});

				if (opts.cache) {
					xhr.done(function () {
						root.collab.api._cache[id] = xhr;
					});
				}

				xhr.gaType = 'ignore';

				if (opts && opts.id) {
					collab.api._enqueue(opts.id, xhr);
				}

				return xhr;
			},

			buildings: function (criteria, opts) {
				var method = encodeURI(criteria).length > 2048 ? 'post' : 'get';
				var action = '/buildings';

				var xhr = $.ajax({
					dataType: 'json',
					type: method,
					url: action,
					data: criteria
				});

				xhr.gaType = 'ignore';

				if (opts && opts.id) {
					collab.api._enqueue(opts.id, xhr);
				}

				return xhr;
			},

			summaries: function (criteria, opts) {
				var method = encodeURI(criteria).length > 2048 ? 'post' : 'get';
				var action = '/listings';

				if (!criteria) {
					return $.Deferred().reject(null);
				}

				var xhr = $.ajax({
					dataType: 'json',
					type: method,
					url: action,
					data: criteria
				});

				xhr.gaType = 'ignore';

				if (opts && opts.id) {
					collab.api._enqueue(opts.id, xhr);
				}

				return xhr;
			},

			clusters: function (criteria, opts) {
				var method = encodeURI(criteria).length > 2048 ? 'post' : 'get';
				var action = '/listings/clusters';

				if (!criteria) {
					return $.Deferred().reject(null);
				}

				var xhr = $.ajax({
					dataType: 'json',
					type: method,
					url: action,
					data: criteria
				});

				xhr.gaType = 'ignore';
				xhr.queueID = 'clusters';

				return xhr;
			},

			columnsets: function (gid, conditions, opts) {
				var cacheKey = [gid, JSON.stringify(conditions)].join('::').toLowerCase();

				if (collab.api._cache[cacheKey]) {
					return $.Deferred().resolve(collab.api._cache[cacheKey]);
				}

				var xhr = $.ajax({
					dataType: 'json',
					type: 'get',
					url: '/columnsets/' + gid,
					data: { conditions: conditions },
				});

				if (opts && opts.id) {
					collab.api._enqueue(opts.id);
				}

				xhr.gaType = 'ignore';
				xhr.queueID = 'columnsets';

				xhr.then(function (columnSets) {
					if (columnSets) {
						collab.api._cache[cacheKey] = columnSets;
					}
				});

				return xhr;
			}
		}
	};
})(window, jQuery);

// let's not pollute the global anymore than it is
(function () {
	function canUseInitialScreen() {
		return (window.location.hash.split('').filter(function (c) {
			return c == '/';
		}).length < 2);
	}

	useInitialScreen = canUseInitialScreen();
})();

var isSearchInitialized = false;
var isSearching = false;
var CURRENT_HASH;
var CURRENT_CLUSTER_HASH;
var CURRENT_DESERIALIZED_CONDITION;

var GidStore = new Store({
	gid: '',

	get: function () { return this.gid; },
	set: function (gid) {
		// This is sort of ugly but there are times when we set GidStore and we want other
		// actions cleared out, but don't want to trigger a full re-load of the state.
		CURRENT_HASH = CURRENT_CLUSTER_HASH = CURRENT_DESERIALIZED_CONDITION = undefined;
		if (this.gid == gid) {
			return;
		}
		this.gid = gid;
		this._emitChange();
	}
});

var SettingsStore = new Store({
	settings: null,

	get: function () {
		return this.settings || {};
	},

	set: function (settings) {
		this.settings = settings;
		this._emitChange();
	}
});

var SpecialStore = new Store({
	specialValues: {},

	get: function () {
		return this.specialValues || {};
	},

	set: function (values) {
		this.specialValues = values;
		this._emitChange();
	}
});

var ColumnsetStore = new Store({
	_columnset: null,
	_columnOrder: null,
	_hash: null,

	get: function () {
		return this._currentColumnset;
	},

	getColumnOrder: function () {
		return this._columnOrder;
	},

	set: function (columnset, columnOrder) {
		var hash = okhash(JSON.stringify(columnset));

		if (this._hash != hash || JSON.stringify(this._columnOrder) != JSON.stringify(columnOrder)) {
			this._columnOrder = columnOrder;
			this._currentColumnset = columnset;
			this._hash = hash;

			this._emitChange();
		}
	}
});

var ColumnsetAPI = {
	getIdentifier: function (gid, user, criteria) {

	},

	filterDisplayableColumns: function (columns, options) {
		if (!'tableTools' in window) {
			return columns;
		}
		return (columns || []).filter(function (c) {
			return tableTools.canDisplayColumn(c, options);
		});
	},

	getColumnsetContext: function (user, gid, listingNumberTerm) {
		var context = {
			user: user,
			includeHeader: true,
			showDaysOnMarket: (gid !== 'mlsli'),
			listingNumberTerm: listingNumberTerm,
			$displayCheckbox: true,
			$rowRel: 'listing-details',
			$rowStyle: 'cursor: pointer',
			$rowClassKey: 'classes'
		};

		return context;
	},

	saveOrder: function (user, gid, columnset, order, next) {
		var columnSet = ColumnsetStore.get();
		var columns = columnSet.columns;
		gid = GidStore.get();

		var orderDescriptor = null;

		if (order == null || order == []) {
		} else {
			var names = _.compact(_.map(order, function (i) {
				var name = columns[i] ? (columns[i].name || columns[i].displayName) : null;
				return name == '$toggles' ? null : name;
			}));

			orderDescriptor = {
				indexes: order,
				names: names
			};
		}

		var key = JSON.stringify(columnSet.conditions);
		var userKey = [window.user._id, gid, 'columns'].join('.');
		var map = $.jStorage.get(userKey, {});
		map[key] = orderDescriptor;

		$.jStorage.set(userKey, map);

		next && next();
	},

	get: function (user, gid, criteria, next) {
		var isAgent = _.any(user.gids || [], function (gid) { return gid == 'agent'; });
		var conditions = [
			{ name: 'saleOrRent', value: (getConditionValue(criteria, 'saleOrRent') || '').toLowerCase() },
			{ name: 'class', value: (getConditionValue(criteria, 'class') || '').toLowerCase() },
			{ name: 'gid', value: isAgent ? 'agent' : 'client' }
		];

		collab.api.columnsets(gid, conditions).then(function (columnSets) {
			var columnset = _.first(columnSets);

			var key = JSON.stringify(columnset.conditions);
			var saved = ColumnsetAPI._checkLocalStorage(user, gid);

			// Try to load the sort order for this specific columnset, otherwise load the
			// first order descriptor and calculate a new order based from that.
			// Note: even if we have an exact conditions match we still need to
			var preferredOrder = saved[key] || _.values(saved)[0];
			var columnIndexes = null;

			if (preferredOrder) {
				var context = ColumnsetAPI.getColumnsetContext(user, gid, listingNumberTerm);
				columnset.columns = ColumnsetAPI.filterDisplayableColumns(columnset.columns, context);
				var columns = columnset.columns;
				var names = _.compact(_.map(columns, function (c) {
					var name = c.name || c.displayName;
					return name == '$toggles' ? null : name;
				}));

				if (names.length !== preferredOrder.names.length || _.difference(preferredOrder.names, names).length) {
					// TODO: interpolate orders
				} else {
					columnIndexes = preferredOrder.indexes;
				}
			}

			next(columnset, columnIndexes);
		});
	},

	_checkLocalStorage: function (user, gid) {
		var key = [user._id, gid, 'columns'].join('.');
		var userColumns = $.jStorage.get(key, {});
		return userColumns;
	}
};

function getRightMode() {
	return $('[name=right-mode]:checked').parent().text().trim();
}

ACTIONS.setColumnsetOrder = function (user, gid, columnset, indexes) {
	AppDispatcher.dispatch({
		type: 'SET_COLUMNSETORDER',
		data: {
			user: user,
			gid: gid,
			columnset: columnset,
			order: indexes
		}
	});
};

ColumnsetStore.dispatchToken = AppDispatcher.register(function (payload) {
	var action = payload;

	switch (action.type) {
		case 'SET_COLUMNSETORDER':
			ColumnsetAPI.saveOrder(payload.data.user, payload.data.gid, payload.data.columnset, payload.data.order);
			ColumnsetStore.set(payload.data.columnset, payload.data.order);
			break;
	}
});

ColumnsetStore.on('change', function () {
	//updateListingsGrid(DataSetStore.get(), null, SelectionsStore.getAllIDs(), true);
});

$(document).on('reorder.grid', function (e, indexes, gridColumns) {
	ACTIONS.setColumnsetOrder(window.user, GidStore.get(), ColumnsetStore.get(), indexes);
});

GidStore.on('change', function () {
	var gid = GidStore.get();

	var settings = getMapSettings(gid);

	var user = (window.user || {});
	var isAgent = ($.grep(user.gids || [], function (r) {
		return r == 'agent';
	})).length > 0;

	settings.maxClusterZoom = (gid == 'treb') ? 11 : 14;
	settings.additionalFiltersEnabled =
		(gid == 'treb' || gid == 'sd' || gid == 'sf' || gid == 'armls') ? false :
			(gid == 'elliman') ? isAgent : true;

	var $additionalFilters = $('.addl-filters-btn');
	$additionalFilters.toggleClass('hidden', !settings.additionalFiltersEnabled);

	SettingsStore.set(settings);

	CURRENT_HASH = CURRENT_CLUSTER_HASH = CURRENT_DESERIALIZED_CONDITION = undefined;

	// Make sure we start the map with a clean slate
	if (MapProvider && MapProvider.clearMarkers) {
		MapProvider.clearMarkers();
	}
});

DataSetStore.on('change', function () {
	isSearchInitialized = true;

	var dataSet = DataSetStore.get();
	var hash = DataSetStore.getHash();

	dataSet.hash = hash;

	var $listings = $('ul.listings');
	if ($listings.is(':visible')) {
		updateListingList();
	}

	window.tableScrollTop = 0;
	window.listSummaryScrollTop = 0;

	var $listingstable = $('.listtable');
	if ($listingstable.is(':visible')) {
		updateListingsGrid(dataSet);
	}

	var $listingsummary = $('.listsummary');
	if ($listingsummary.is(':visible')) {
		updateListingsSummary(dataSet);
	}

	var id = CurrentViewStore.get();

	if (id) {
		if (dataSet.filter(function (r) { return r._id == id.id; }).length) {
			// no change - current view exists in new data set
		} else {
			// bad
			CurrentViewStore.entityID = null;
			unloadCurrentListing();
		}
	}
});

var BUILDING_XHR;

SpecialStore.on('change', function () {
	var specialCriteria = SpecialStore.get() || {};
	var buildingIDs = specialCriteria.buildingID;

	DataSetStore.set(null, null, 'Buildings');

	if (buildingIDs) {
		buildingIDs = buildingIDs instanceof Array ? buildingIDs : [buildingIDs];

		if (BUILDING_XHR) {
			BUILDING_XHR.abort();
		}

		var qs = buildingIDs.map(function (id) {
			return '_id=LIMO-' + id;
		}).join('&');

		BUILDING_XHR = collab.api.buildings(qs, {}).done(function (buildings) {
			DataSetStore.set(buildings, null, 'Buildings');
		});
	}
});

CriteriaStore.on('change', function () {
	var criteria = CriteriaStore.get();
	var fullCriteria = CriteriaStore.get('no-map');
	var hash = CriteriaStore.getHash();

	clearListAndMarkers();

	var settings = SettingsStore.get();
	var doFullSystemCount = settings.clustering;

	var specialCriteria = parseQueryString(criteria, { buildingID: 1, '%24take': 1 });

	var hideGetAll = specialCriteria['%24take'] == '1000';
	delete specialCriteria['%24take'];

	SpecialStore.set(specialCriteria);

	CURRENT_HASH = hash;

	updateClusters();

	isSearching = true;

	var searchRequest = collab.api.summaries(criteria, { id: 'listings', limit: 1 }).done(function (summaries) {
		if (hash != CURRENT_HASH) {
			return;
		}

		isSearching = false;

		// TODO: we shouldn't be relying on this any longer
		window.currentSearchHash = hash;

		var listings = summaries;

		// #555 - Extend listings with list membership classes
		listings.forEach(function (listing) {
			listing.classes = fastListClasses(listing._id);
		});

		ACTIONS.setSelections([]);
		ACTIONS.setDataSet(listings, hash);

		storeCondition(criteria);
		updateExportCondition(criteria);

		var id = $('#search-id').val();
		var name = $('#search-name').val();
		var nameOriginal = $('#search-name-original').val();

		saveHash('submitSearch', { id: id, name: name, nameOriginal: nameOriginal, condition: criteria, type: window.searchType });
		setTimeout(function () {
			$('input[name="$loc"]').prev().val('');
		}, 12);

		// If we're doing a full system count we already have the results
		if (doFullSystemCount) {
			updateCountDisplay(summaries.length, null, hideGetAll);
			return;
		}

		var fullCount = (listings[0] || []).full_count;

		if (fullCount >= 0 || listings.length != 100) {
			updateCountDisplay(listings.length, fullCount, hideGetAll);
		} else {
			setTimeout(submitFullCount, 100);
		}

	});

	if (doFullSystemCount) {
		var countRequest = collab.api.count(fullCriteria, { id: 'count', limit: 1, cache: settings.clustering });

		$.when(searchRequest, countRequest).done(function (summaries, count) {
			if (CURRENT_HASH !== hash) { return; }
			updateCountDisplay(summaries[0].length, count[0].fullCount, hideGetAll);
		});
	}
});

SelectionsStore.on('change', function () {
	if (window.grid) {
		window.grid.select(SelectionsStore.getAllIDs(), { quiet: true, unsetMissing: true });
	}

	if (window.summaryList) {
		window.summaryList.select(SelectionsStore.getAllIDs(), { quiet: true, unsetMissing: true });
	}
});

SelectionsStore.on('change', updateLinksWithIds);
SelectionsStore.on('change', updateListState);

SelectionsStore.on('change', function () {
	$('.quickdetails-buttons').find('.entity-selected').prop('checked', SelectionsStore.has({ id: $('.quickdetails-buttons').attr('data-id'), entity: 'Listing' }));
});

CurrentViewStore.on('change', function () {
	var id = CurrentViewStore.get();
	if (id) {
		showDetails();
		updateLinksWithId(id);

		if (id.type == 'Building') {
			loadBuilding(id.id, true);
		} else {
			loadListing(id.id, true);
		}
	} else {
		unloadCurrentListing();
	}
});

function showFilters(quiet) {
	if (!Responsive.isHandheld) {
		if ($('.filters').is(':visible') && $('.btn-filters').hasClass('active')) {
			return;
		}
		showMap();
	}

	$('.list').hide();
	$('.searches').hide();
	$('.filters').show();
	$('.btn-filters').button('toggle');

	if (quiet !== true) {
		Responsive.setScene('filters');
		updateHash('filters');
	}
}

function scrollFiltersToTop() {
	$('.filters').scrollTop(0);
}

function showList(quiet) {
	if ($('.listtable').is(':visible')) {
		showMap();
	}

	updateListingList(DataSetStore.get(), DataSetStore.getHash());

	$('.filters').hide();
	$('.searches').hide();
	$('.list').show();
	$('.btn-list').button('toggle');
	$('.listings-count').show();

	if (quiet !== true) {
		Responsive.setScene('list');
		updateHash('list');
		$.force_appear();
	}
}

function showSearches(quiet) {
	//if ($('.listtable').is(':visible')) {
	//	showMap();
	//}

	//updateListingList(DataSetStore.get(), DataSetStore.getHash());

	$('.list').hide();
	$('.filters').hide();
	$('.searches').show();
	$('.btn-searches').button('toggle');
	$('.listings-count').show();

	if (quiet !== true) {
		Responsive.setScene('searches');
		updateHash('searches');
		$.force_appear();
	}
}

function showMap(quiet) {
	if ($('.split-center').is('.contracted-right')) {
		toggleExpandLeft(false);
	}

	hideTable();
	hideSummary();

	$('.details').hide();
	$('.details-buttons, .details-count, .button-group-list').hide();
	$('.split-details, .listtable-buttons').addClass('invisible');
	$('.map-buttons, .map-search-toggle').removeClass('invisible');

	// NOTE: using visibility instead of display because of needing to recall map bounds for searching
	$('.map').css({visibility: 'visible'});
	$('.btn-map').button('toggle');
	$('body').addClass('map-visible');

	if (quiet !== true) {
		Responsive.setScene('map');

		if (Responsive.isHandheld) {

		}

		updateHash('map');
	}

	if (MapProvider) {
		MapProvider.trigger('resize');
	}
}

function isDetails() {
	return $('body').is('.scene-details');
}

window.listSummaryScrollTop = 0;

function scrollSummaryToCurrentEntity() {
	var id = (currentEntityID || {}).id;
	scrollToElement(id ? $('.listsummary').find('li[data-id="' + id + '"]') : null, window.listSummaryScrollTop);
}

function showSummary(quiet) {
	var selections = SelectionsStore.getAllIDs();
	var fromListTable = $('.listtable').is(':visible');

	showFilters(true);
	hideTable();

	$('.details').hide();
	$('.map').css({visibility: 'hidden'});
	$('.details-buttons, .details-count').hide();
	$('.map-buttons, .map-search-toggle, .split-details').addClass('invisible');
	$('.listtable-buttons').removeClass('invisible');
	$('.listsummary').show().addClass('show');
	$('.button-group-list').show();
	$('.btn-table').button('toggle');
	$('body').removeClass('map-visible');
	$('.btn-listsummary').button('toggle');

	if (splitRightOpen) {
		toggleExpandRight(false);

		if (!fromListTable) {
			loadQuickDetails();
		}
	}

	if (quiet !== true) {
		Responsive.setScene('summary');
	}

	if (fromListTable && window._expandedListings) {
		var reloadSummary = false;

		(window._expandedListings || []).forEach(function (listing) {
			reloadSummary = reloadSummary || !listing.$expandedForSummary;
		});

		if (reloadSummary) {
			updateListingsSummary(window._expandedListings, selections, true);
		} else {
			_updateListingsSummary(window._expandedListings, selections);
		}
	} else if (isSearchInitialized) {
		updateListingsSummary(DataSetStore.get(), selections);
	}

	$.force_appear();
}

function hideSummary() {
	var listSummary = $('.listsummary');
	if (listSummary.is(':visible')) {
		window.listSummaryScrollTop = $(window).scrollTop();
		listSummary.hide().removeClass('show');
	}
}

function updateListingsSummary(listings, selections, reload) {
	if (listings) {
		window._listingsForGrid = listings;
	}

	if (!$('.listsummary').is(':visible')) { return; }

	if (reload || $('.listsummary').data('hash') != window.currentSearchHash) {
		getListingsSummary(window._listingsForGrid || [], function (listings) {
			listings = sortGridListings(listings);

			var expandedMap = (window._expandedListings || []).reduce(function (a, b) {
				a[b['_id']] = b;
				return a;
			}, {});

			var expandedListings = [];
			listings.forEach(function (listing) {
				if (expandedMap[listing._id]) {
					listing = $.extend({}, expandedMap[listing._id], listing);
				}

				listing.$expandedForSummary = true;

				listing.classes = fastListClasses(listing._id);
				expandedListings.push(listing);
			});

			window._expandedListings = expandedListings;

			_updateListingsSummary(expandedListings, selections);
		});
	} else {
		if (window.summaryList) {
			window.summaryList.select(SelectionsStore.getAllIDs(), { quiet: true, unsetMissing: true });
		}

		//if (isSplitRightOpen()) {
			scrollSummaryToCurrentEntity();
		//}
	}
}

function _updateListingsSummary(listings, selections) {
	var html = ['<ul>'];

	if (listings.length === 0 && isSearchInitialized && !isSearching) {
		html.push('<li><div style="text-align:center;">No listings found</div></li>');
	}

	for (var i = 0, len = listings.length; i < len; ++i) {
		var listing = listings[i];

		html.push(
			'<li data-id="' + listing._id + '" data-rel="listing-details">' +
				renderListingListSummary(listing) +
			'</li>'
		);
	}

	html.push('</ul>');

	$('.listsummary').html(html.join('')).data('hash', window.currentSearchHash);

	var $ul = $('.listsummary').find('ul');
	var summaryList = window.summaryList = new SummaryList($ul, {});

	$ul.on('selected.summarylist', function (e, data) {
		var keys = $.map(data.keys, function (k) { return { type: 'Listing', id: k }; });

		ACTIONS.setSelections(keys);
	});

	summaryList.select(SelectionsStore.getAllIDs(), { quiet: true, unsetMissing: true });
	updateStatistics(listings, $('.listsummary'));
	//if (isSplitRightOpen()) {
		scrollSummaryToCurrentEntity();
	//}
}

window.tableScrollTop = 0;

function scrollToElement($element, scrollTop) {
	var $container = isSplitRightOpen() ? $('.listsummary:visible, .listtable:visible') : $(window);

	if ($element && $element.length) {
		var windowTop = $container.scrollTop();
		var windowHeight = $container.height();
		var windowBottom = windowTop + windowHeight;

		var itemTop = $element.position().top;
		var itemHeight = $element.outerHeight();
		var itemBottom = itemTop + itemHeight;

		if (itemTop < windowTop) {
			$container.scrollTop(itemTop);
		} else if (itemBottom > windowBottom) {
			$element[0].scrollIntoView(false);
		}
	} else if (!isNaN(scrollTop)) {
		$container.scrollTop(scrollTop);
	}
}

function scrollTableToAndSelectCurrentEntity() {
	var id = (currentEntityID || {}).id;
	var $item = null;
	if (id) {
		$item = $('.list-table').find('tr[data-id="' + id + '"]');
		$item.addClass('selected');
	}
	scrollToElement($item, window.tableScrollTop);
}

function showTable(quiet) {
	var selections = SelectionsStore.getAllIDs();
	var fromListSummary = $('.listsummary').is(':visible');

	hideSummary();
	showFilters(true);

	$('.details').hide();
	$('.map').css({visibility: 'hidden'});
	$('.details-buttons, .details-count').hide();
	$('.map-buttons, .map-search-toggle, .split-details').addClass('invisible');
	$('.listtable-buttons').removeClass('invisible');
	$('.listtable').show().addClass('show');
	$('.button-group-list').show();
	$('.btn-table').button('toggle');
	$('body').removeClass('map-visible');

	if (splitRightOpen) {
		toggleExpandRight(false);

		if (!fromListSummary) {
			loadQuickDetails();
		}
	}

	if (quiet !== true) {
		Responsive.setScene('table');
	}

	if (fromListSummary && window._expandedListings) {
		var reloadGrid = false;

		(window._expandedListings || []).forEach(function (listing) {
			reloadGrid = reloadGrid || !listing.$expandedForGrid;
		});

		if (reloadGrid) {
			updateListingsGrid(window._expandedListings, false, selections, true);
		} else {
			_updateListingsGrid(window._expandedListings, {
				columnSet: ColumnsetStore.get(),
				selections: selections,
				columnOrder: ColumnsetStore.getColumnOrder()
			});
		}
	} else if (isSearchInitialized) {
		updateListingsGrid(DataSetStore.get(), null, selections);
	}

	updateLinksWithIds();

	$.force_appear();

	$('.FixedHeader_Cloned').show();
}

function updateLinksWithIds() {
	var ids = SelectionsStore.getAll();

	if (!ids || ids.length == 0) {
		ids = DataSetStore.get().map(function (o) {
			return { entity: o.entity || 'Listing', id: o._id };
		});
	}

	$('.listtable-buttons').data('id', ids).attr('data-id', JSON.stringify(ids));
}

function updateLinksWithId(id) {
	$('.listtable-buttons').data('id', id).attr('data-id', JSON.stringify(id));
}

function updateListState() {
	var state = window._listState || [];
	var ids = SelectionsStore.getAll();

	var hasStateEntries = state.length;
	var hasSelections = ids.length;
	var count = (window._expandedListings || []).length;

	$('.list-expand-btn').toggleClass('disabled', !hasStateEntries);
	$('.list-narrow-btn, .list-exclude-btn').toggleClass('disabled', !hasSelections || hasSelections == count);

}

function updateListingsGrid(listings, isNewSearch, selections, reload) {
	if (isNewSearch) {
		window._listState = [];
		updateListState();
	}

	if (listings) {
		window._listingsForGrid = listings;
	}

	if (!$('.listtable').is(':visible')) {
		return;
	}

	if ((reload || ($('.listtable').data('hash') != window.currentSearchHash || window.currentSearchHash == null) && window._listingsForGrid)) {

		ColumnsetAPI.get(window.user, GidStore.get(), CriteriaStore.get(), function (columnSet, columnOrder) {
			ColumnsetStore.set(columnSet, columnOrder);

			getListingsTable(window._listingsForGrid, columnSet, function (listings) {
				// #555 - Extend listings with list membership classes

				listings = sortGridListings(listings);

				var expandedMap = (window._expandedListings || []).reduce(function (a, b) {
					a[b['_id']] = b;
					return a;
				}, {});

				var expandedListings = [];
				listings.forEach(function (listing) {
					if (expandedMap[listing._id]) {
						listing = $.extend({}, expandedMap[listing._id], listing);
					}

					listing.$expandedForGrid = true;

					listing.classes = fastListClasses(listing._id);
					expandedListings.push(listing);
				});

				window._expandedListings = expandedListings;
				_updateListingsGrid(expandedListings, {
					columnSet: columnSet,
					selections: selections,
					columnOrder: columnOrder
				});
			});
		});
	} else if (window.grid) {
		window.grid.update(true);
		if (selections) {
			window.grid.select(selections, { quiet: true, unsetMissing: true });
		}

		scrollTableToAndSelectCurrentEntity();
	}
}

function sortGridListings(gridListings) {
	var globalListings = DataSetStore.get();
	if (gridListings && gridListings.length && globalListings && globalListings.length) {
		var gridListingsMap = {};
		var newGridListings = [];
		var i;
		var l;

		for (i = 0, l = gridListings.length; i < l; i++) {
			var listing = gridListings[i];
			gridListingsMap[listing._id] = listing;
		}

		for (i = 0, l = globalListings.length; i < l; i++) {
			var key = globalListings[i]._id;
			var gridListingById = gridListingsMap[key];

			// If for some reason the list query doesn't return the same set of
			// listings, use the sparse listing from the search query as a stop-gap
			if (!gridListingById) {
				gridListingById = globalListings[i];
			}

			newGridListings.push(gridListingById);
		}
		return newGridListings;
	} else {
		return gridListings;
	}
}

function syncListingListOrder(orderedIds, listings) {
	var listingMap = {};
	for (var i = 0; i < listings.length; i++) {
		listingMap[listings[i]._id] = listings[i];
	}

	listings = [];
	orderedIds.forEach(function (id) {
		listings.push(listingMap[id]);
	});

	updateListingList(listings);
}

function _updateListingsGrid(listings, options) {
	options = options || {};

	var columnSet = options.columnSet;
	var selections = options.selections;
	var columnOrder = options.columnOrder;

	var html = renderListingsTable(listings, columnSet);
	var $nav = $('.navbar-fixed-top:visible');

	var grid = window.grid;

	if (grid) {
		grid.destroy();
		grid = null;
	}

	var $table = $('.listtable')
		.empty()
		.scrollTop(0)
		.html(html)
		.data('hash', window.currentSearchHash)
		.find('table:first');

	if (!listings || !listings.length) {
		return;
	}

	if (!window._gridOrder) {
		window._gridOrder = $('#orderby').val();
	}

	grid = window.grid = new Grid($table, {
		columns: columnSet,
		affixTo: $nav,
		customSort: true,
		order: window._gridOrder,
		alwaysSortBy: 'price',
		columnOrder: columnOrder,
		zeroRecords: 'No listings found'
	});

	$table.on('selected.grid', function (e, data) {
		var keys = $.map(data.keys, function (k) { return { type: 'Listing', id: k }; });

		ACTIONS.setSelections(keys);
	});

	$table.on('sort.grid', function (e, data) {
		var order = data.order[0];
		var sort = Grid.getSortDetails(order);
		if (data.source !== 'manual') {
			orderby(sort.expression, 'orderby-menu-' + sort.columnNameSafe + '-' + sort.direction, data.order);
		}

		if (grid.sortLocally) {
			syncListingListOrder(grid.getIds(), listings);
		}
	});

	grid.select(SelectionsStore.getAllIDs(), { quiet: true, unsetMissing: true });

	updateStatistics(listings, $('.listtable'));

	//if (isSplitRightOpen()) {
		scrollTableToAndSelectCurrentEntity();
	//}
}

function hideTable() {
	var listTable = $('.listtable');
	if (listTable.is(':visible')) {
		window.tableScrollTop = $(window).scrollTop();
		listTable.hide().removeClass('show');

		$('.FixedHeader_Cloned').hide();
	}
}

function updateStatistics(listings, $container) {
	$container.find('.list-statistics, .list-controls').remove();

	var table = window.tableTools.renderStatisticsTable(listings);
	if (table.length) {
		$container.append(
			'<div class="list-statistics data-section section">' +
				'<span class="section-title">Averages</span>' +
				table +
			'</div>'
		);
	}

	var buttons = [];
	var canViewInStratus = ((window.user || {}).settings || {})['listings.viewInStratus'];

	if (canViewInStratus && listings && listings.length) {
		var listingIDs = listings.map(function(l) { return l.listingID; });

		buttons.push('<a href="/redirect?key=stratus&listingID=' + listingIDs.join(',') + '" target="remoteV3" class="btn btn-success" style="margin-right:10px;">View in Stratus</a>');
	}

	if ($('.listtable').is(':visible')) {
		buttons.push('<a role="button" class="btn-danger btn btn-reset-columnset-order">Reset Columns</a>');
	}

	if (buttons.length) {
		$container.append('<div class="list-controls">' + buttons.join('') + '</div>');
	}
}

function showDetails(quiet) {
	if ($('.split-center').is('.contracted-right')) {
		toggleExpandLeft(false);
	}

	hideTable();
	hideSummary();
	showList(true);
	$('.button-group-list').hide();
	$('.map').css({visibility: 'hidden'});
	$('.map-buttons, .map-search-toggle, .listtable-buttons').addClass('invisible');
	$('.split-details').removeClass('invisible');
	$('.details').removeClass('invisible').show();
	$('.btn-details').button('toggle');
	$('.details-count').show();
	$('body').removeClass('map-visible');

	var currentView = CurrentViewStore.get();
	if (currentView && currentView.id && currentView.type != 'Building') {
		$('.details-buttons').show();
	}

	if (quiet !== true) {
		Responsive.setScene('details');
	}
}

function toggleExpandLeft(expand) {
	expand = (expand != null) ? expand : !$('.split-center').is('.expanded-left');

	if (expand) {
		$('.navbar-fixed-top, .split-left, .split-center').addClass('expanded-left');
		$('.icon-expand-left').hide();
		$('.icon-contract-left').show();
	} else {
		$('.navbar-fixed-top, .split-left, .split-center').removeClass('expanded-left');
		$('.icon-contract-left').hide();
		$('.icon-expand-left').show();

		toggleExpandRight(true);
	}
}

var splitRightOpen = false;
function toggleExpandRight(expand) {
	expand = (expand != null) ? expand : $('.split-center').is('.contracted-right');

	if ((expand && !isSplitRightOpen()) || (!expand && isSplitRightOpen())) { return; }

	if (expand) {
		$('.navbar-fixed-top, .split-right, .split-center').removeClass('contracted-right');
		$('.icon-expand-right').hide();
		$('.icon-contract-right').show();
	} else {
		var scrollTop = $(window).scrollTop();
		$('.navbar-fixed-top, .split-right, .split-center').addClass('contracted-right');
		$('.icon-contract-right').hide();
		$('.icon-expand-right').show();
		$('.listsummary:visible, .listtable:visible').scrollTop(scrollTop);

		toggleExpandLeft(true);
	}
}

function isSplitRightOpen() {
	return $('.split-center').is('.contracted-right');
}

function orderby(val, cls, order, opts) {
	opts = opts || {};
	window._gridOrder = order || val;
	$('#orderby').val(val);
	$('.orderby-menu').children().removeClass('active');
	$('.orderby-menu').children('.' + cls).addClass('active');
	if (!window.grid || !window.grid.sortLocally) {
		var form = $('#filters-form');
		var $selectedListing = $('.listings .selected a[data-id]');
		window.forceCurrentListingById = $selectedListing.attr('data-id');
		if (!opts.quiet) { form.submit(); }
	} else if (window.grid.sortLocally) {
		window.grid.order(window._gridOrder);
	}
}

function updateAdditionalFiltersDescription() {
	var form = $('#filters-form');
	var descriptionContainer = form.find('.additional-filters-description').hide().find('.description');
	if (form.find('#additional-filters-button').length) {
		var conditions = form.find('.additional-filter,[name="$gid"]').serialize();

		conditions += '&%24saleOrRent=' + form.find('[name="saleOrRent"]').val();

		describeFilters(descriptionContainer, conditions, function (description) {
			if ($(description).text().length) {
				form.find('.additional-filters-description').show();
			}
		});
	}
}

function resetAdditionalFilters() {
	var form = $('#filters-form');
	form.find('input.additional-filter[type=hidden]').val('');
	form.find('input.additional-filter:checkbox').removeAttr('checked');
	form.find('.additional-filters-description').hide().find('.description').empty();
}

function salesTabClick() {
	showSales(true);

	$('#filters-form').submit();
}

function showSales(process) {
	$('#saleOrRent-sale').tab('show');
	$('#saleOrRent').val('SALE');

	$.jStorage.set(user._id + '-saleOrRent', 'SALE');

	handleDynamicFields();

	if (process) {
		resetAdditionalFilters();
		handleClassOrSaleOrRentChange($('#filters-form'));
		describeAdditionalFilters();
	}
}

function rentalsTabClick() {
	showRentals(true);

	$('#filters-form').submit();
}

function showRentals(process) {
	$('#saleOrRent-rent').tab('show');
	$('#saleOrRent').val('RENT');

	$.jStorage.set(user._id + '-saleOrRent', 'RENT');

	handleDynamicFields();

	if (process) {
		resetAdditionalFilters();
		handleClassOrSaleOrRentChange($('#filters-form'));
		describeAdditionalFilters();
	}
}

jQuery.fn.deepToggle = function (show) {
	return this.each(function (i, o) {
		var $el = $(o);

		// if this is an option then we have to do a bunch of hackery
		// to support hiding.
		if ($el.is('option')) {
			var $select = $el.parent('select');

			// the parent select may be our hidden select element so
			// prefer the original-select value if one exists
			$select = $select.data('original-select') || $select;

			// ensure we have a cloned, hidden select
			var $hiddenSelect = $select.data('cloned-select');

			if (!$hiddenSelect) {
				$hiddenSelect =  $select.clone();

				// hook up references and add the hidden object to the dom
				$select.data('cloned-select', $hiddenSelect);

				$hiddenSelect
					.data('original-select', $select)
					.empty()
					.removeProp('id')
					.removeProp('name')
					.prop('disabled', true) // exclude from search serialization
					.append('<option />') // prevent hidden options from being set as selected
					.hide()
					.insertBefore($select);
			}

			if (show) {
				$select.append($el);
			} else {
				$hiddenSelect.append($el);
			}
		}

		if (show) {
			$el.show().prop('disabled', false).prop('hidden', false);
		} else {
			$el.hide().prop('disabled', true).prop('hidden', true);
		}

	});
};

function handleDynamicFields(conditions) {
	var f = $('#filter-forms');
	var props = (f.data('dynamic-fields') || '').split(',');

	props.forEach(function (p) {
		if (p === '') { return; }

		// hide all items by default
		$('[class*=' + p + '-]').deepToggle(false);

		var values = [];

		// if we have a search condition then prefer that value over any
		// that is currently set in the dom
		if (conditions) {
			// todo: this only returns a single value, which won't always be correct
			values = [ getConditionValue(conditions, p) ];
		} else {
			values = f.find('[name=' + p + ']').serializeArray().map(function (v) { return v.value; });
		}

		values.forEach(function (v) {
			// hack for 'Any' support - show all items
			// this will likely need to be changed
			if (v === '') {
				$('[class*=' + p + '-]').deepToggle(true);
			} else {
				$('.' + p + '-' + v).deepToggle(true);
			}
		});
	});
}

var currentLoadRequest;
var loadEntityTimeout;

function loadEntity(url) {
	if (currentLoadRequest) { currentLoadRequest.abort(); currentLoadRequest = null; }
	clearTimeout(loadEntityTimeout);
	loadEntityTimeout = window.setTimeout(function () {
		currentLoadRequest =
			$.ajax({
				url: url,
				data: '',
				success: function (html) {
					var $html = $(html);
					var $listingContainer = $html.is('.container') ? $html : $('.container', $html).first();

					// Set listing content and scroll to top
					$('.details')
						.html($listingContainer)
						.scrollTop(0)
						.trigger('listing:loaded')
						.show();

					// The world needs bad men
					$.force_appear();

					// update our media query to run against the new listing report
					// todo: check if this is leaking memory
					if ('$mediaQuery' in window) {
						window.$mediaQuery.update();
					}
				}
			});
	}, 50);
}

function loadListing(id, scrollIntoView, template) {
	if (!id) { return; }

	unloadCurrentListing();

	selectListing(id, scrollIntoView);

	var index = getWindowListingRowNumberByID(id);
	var dataSet = DataSetStore.get();

	if (!dataSet || !dataSet.length) { return; }

	$('.details-count').html(
		index + ' of <span class="badge overflow">' +
		accounting.formatNumber(dataSet.length) + '</span>'
	);

	if (index == 1) {
		$('.btn-prev').attr('disabled', 'disabled');
	} else {
		$('.btn-prev').removeAttr('disabled');
	}

	if (index == dataSet.length) {
		$('.btn-next').attr('disabled', 'disabled');
	} else {
		$('.btn-next').removeAttr('disabled');
	}

	var lang = $('html').attr('lang') || 'en';
	var listingUrl = '/listings/' + id;

	listingUrl = listingUrl + (listingUrl.indexOf('?') > -1 ? '&' : '?') + '$partial&lang=' + lang;

	var isClient= ($.grep(user.gids || [], function (r) {
		return r == 'client';
	})).length > 0;

	if (isClient) {
		window.template = 'listing-customer-full';
	} else if (typeof template != 'undefined') {
		window.template = template;
	}

	if (window.template && window.template.length) {
		listingUrl += '&template=' + window.template;
	}

	loadEntity(listingUrl);

	$('.details-buttons').show();
	$('.mobile-context-navbar').removeClass('mobile-hidden');

	var $listingButtons = $('.listing-buttons');
	var $parent = $listingButtons.parent();

	// Set the toolbar context to this listing-id
	$parent.attr('data-id', id).data('id', id);
	$listingButtons.attr('data-id', id).data('id', id);

	setListClasses(id, $listingButtons);

	currentEntityID = {
		type: 'Listing',
		id: id
	};

	var value = { id: id };
	if (window.template && window.template.length) {
		value.template = window.template;
	}
	var currentID = CurrentViewStore.get();
	$parent.find('.entity-selected').prop('checked', SelectionsStore.has(currentID));

	saveHash('loadListing', value, window.currentSearchHash);
}

function loadBuilding(id, scrollIntoView) {
	if (!id) { return; }

	unloadCurrentListing();

	selectListing(id, scrollIntoView);

	var lang = $('html').attr('lang') || 'en';
	var buildingUrl = '/buildings/' + id;

	buildingUrl = buildingUrl + (buildingUrl.indexOf('?') > -1 ? '&' : '?') + '$partial&lang='  + lang;

	loadEntity(buildingUrl);

	currentEntityID = {
		type: 'Building',
		id: id
	};

	$('.details-buttons').hide();
	$('.mobile-context-navbar').addClass('mobile-hidden');

	var value = { id: id };
	saveHash('loadBuilding', value, window.currentSearchHash);
}

var currentQuickDetailsLoadRequest;
var loadQuickDetailsEntityTimeout;

function loadQuickDetails(id, entity) {
	if (!isSplitRightOpen()) { return; }

	var dataSet = DataSetStore.get();

	if (!id && (CurrentViewStore.get() || {}).type == 'Listing') {
		id = CurrentViewStore.get().id;
	}

	if (!id && dataSet && dataSet.length) {
		id = dataSet[0]._id;
	}

	$('.list-table').find('tr.selected').removeClass('selected');

	if (!id || !dataSet || !dataSet.length) {
		$('.quickdetails').empty();
		$('.quickdetails-buttons').addClass('invisible');
		return;
	}

	var index = getWindowListingRowNumberByID(id);

	if (index == 1) {
		$('.quickdetails-btn-prev').attr('disabled', 'disabled');
	} else {
		$('.quickdetails-btn-prev').removeAttr('disabled');
	}

	if (index == dataSet.length) {
		$('.quickdetails-btn-next').attr('disabled', 'disabled');
	} else {
		$('.quickdetails-btn-next').removeAttr('disabled');
	}

	var lang = $('html').attr('lang') || 'en';
	var url = '/' + (entity || 'Listing').toLowerCase() + 's/' + id;

	url = url + (url.indexOf('?') > -1 ? '&' : '?') + '$partial&$view=listing-quick-details&lang='  + lang;

	if (currentQuickDetailsLoadRequest) { currentQuickDetailsLoadRequest.abort(); currentQuickDetailsLoadRequest = null; }
	clearTimeout(loadQuickDetailsEntityTimeout);
	loadQuickDetailsEntityTimeout = window.setTimeout(function () {
		currentQuickDetailsLoadRequest =
			$.ajax({
				url: url,
				data: '',
				success: function (html) {
					$('.quickdetails')
						.html(html)
						.scrollTop(0);
				}
			});
	}, 50);

	var $buttons = $('.quickdetails-buttons');

	// Set the toolbar context to this listing-id
	$buttons.attr('data-id', id).data('id', id).removeClass('invisible');

	setListClasses(id, $buttons);

	$buttons.find('.entity-selected').prop('checked', SelectionsStore.has({ id: id, entity: 'Listing' }));

	currentEntityID = {
		type: 'Listing',
		id: id
	};

	if ($('.listsummary').is(':visible')) {
		scrollSummaryToCurrentEntity();
	} else {
		scrollTableToAndSelectCurrentEntity();
	}
}

function getWindowListingRowNumberByID(id) {
	var dataSet = DataSetStore.get();
	if (!dataSet) { return 1; }
	for (var i = 0, len = dataSet.length; i < len; ++i) {
		var listing = dataSet[i];
		if (listing._id == id) { return i + 1; }
	}
	return 1;
}

var _filtersMap = {};
function loadCustomerFilters(id, cb) {
	var currentSearch = serializeFilters(false);
	var orderby = $('#orderby').val() || ((window.user || {}).settings || {})['listingSort'];

	function handler(html) {
		var $form = $('<div>' + html + '</div>');
		var $forms = $form.find('#filter-forms');
		var $currentForms = $('#filter-forms');

		// Clear out any listing ids
		clearListingIDs();

		$currentForms.replaceWith($forms);

		// Since we don't persist criteria when changing customer
		// filters it should be safe to process class/status
		// form field display at this point.
		if (getConditionValue(currentSearch, 'saleOrRent') == 'RENT') {
			showRentals(true);
		} else {
			showSales(true);
		}

		resetOrderby(orderby);

		$('#filter-forms').show();

		onFiltersFormLoad();

		GidStore.set(id);

		$forms.removeClass('uninitialized');

		if (cb) {
			cb();
		}
	}

	if (_filtersMap[id]) {
		handler(_filtersMap[id]);
	} else {
		$.get('/searchlistings/filters/' + id, function (html) {
			_filtersMap[id] = html;
			handler(html);
		});
	}
}

function onFiltersFormLoad() {
	var $form = $('#filters-form');
	window.filterHelpers = new FilterHelpers($form, $('.filters-forms'));
	DatePicker.create($form.find('input[data-datatype=date]'), { minimumDays: getGidSetting($('#gid').val(), 'filtersMinimumDays', mapContext)  });

	$form.find('input[name=class], input[name=availability]').change(function () {
		handleClassOrSaleOrRentChange($form);
		describeAdditionalFilters();
	});
}

function loadSearch(id) {
	$.getJSON('/searches/' + id + '?$select=!results', loadSearchImp);
}

function loadSearchImp(search, isDefault) {
	hideFiltersDescription();

	if (isDefault === true || !Responsive.isHandheld) {
		showFilters();
	} else {
		showMap();
	}
	scrollFiltersToTop();

	deserializeFilters(search.condition, function () {
		updateMapAndSubmit(null, performSearch);
	});

	populateSearchForm(search, { isDefault: isDefault === true });
}

function populateSearchForm(search, options) {
	options = options || {};

	if (options.isDefault) {
		resetSaveSearchFields();
		return;
	}

	$('#search-id').val(search._id);
	$('#search-name').val(search.name);
	$('#search-name-original').val(search.name);
	$('#search-uid').val(search.uid);
	if (search.hidden) {
		$('#search-hidden input').attr('checked', 'checked');
	} else {
		$('#search-hidden input').removeAttr('checked');
	}
	$('#search-uid-original').val(search.uid);
	$('#search-email-interval').val(search.interval);
	$('#search-email-layout').val(search.emailLayout || '');
	$('#save-search-dialog .expire').html('Expires on ' + search.$expire);

	window.searchSubscriptionsHelper.loadSubscriptionsFromSearch(search);
}

var listClassRegex = /es\s|es$|s\s|s$/gi;
function fastListClasses(id) {
	var lists = listManager.getMembership(id);
	return lists.join(' ').replace(listClassRegex, 'ed ');
}

function getListState(id) {
	var lists = listManager.getMembership(id);

	var favorited = lists.indexOf('favorites') !== -1;
	var liked = lists.indexOf('likes') !== -1;
	var disliked = lists.indexOf('dislikes') !== -1;
	var commented = lists.indexOf('comments') !== -1;
	var suggested = lists.indexOf('suggested') !== -1;

	return {
		favorited: favorited,
		liked: liked,
		disliked: disliked,
		commented: commented,
		suggested: suggested
	};
}

function setListClasses(id, $element) {
	var state = getListState(id);

	$element.toggleClass('favorited', state.favorited);
	$element.toggleClass('liked', state.liked);
	$element.toggleClass('disliked', state.disliked);
	$element.toggleClass('commented', state.commented);
	$element.toggleClass('suggested', state.suggested);

	// hide lingering popovers
	$('.toggles button[data-target="#to-dialog"]').popover('hide');
}

function loadCurrentListing(scrollIntoView) {
	var id = (currentEntityID || {}).id;
	var type = (currentEntityID || {}).type || 'Listing';

	if (!id) {
		var listing = (DataSetStore.get() || [])[0];
		id = listing ? listing._id : null;
	}

	ACTIONS.viewEntity({ type: type, id: id });
}

function unloadCurrentListing() {
	currentEntityID = null;
	clearDetails();
}

function selectListing(id, scrollIntoView) {
	$('.list .selected').removeClass('selected');
	$('.listtable .selected').removeClass('selected');

	//var $tr = $('.list-table tr[data-id="' + id + '"]');
	//$tr.addClass('selected');

	var $a = $('.list a[data-id="' + id + '"]');

	if ($a.length === 0) {
		return;
	}

	var $li = $a.parent();
	$li.addClass('selected');
	if (scrollIntoView) {
		var $list = $('.list');
		var listTop = $list.scrollTop();
		var listHeight = $list.height();
		var listBottom = listTop + listHeight;
		var itemTop = $li.position().top;
		var itemHeight = $li.outerHeight();
		var itemBottom = itemTop + itemHeight;

		if (itemTop < listTop) {
			$li[0].scrollIntoView(true);
		} else if (itemBottom > listBottom) {
			$li[0].scrollIntoView(false);
		}
	}
}

function clearDetails() {
	$('.details').empty();
	$('.details-count').empty();
}

function nextListing() {
	var $selected = $('.list .selected');
	var $next = $selected.nextAll().filter(':not(.list-header)').first().find('a.listing-summary');
	var id = $next.attr('data-id');
	var entity = $next.attr('data-entity') || 'Listing';
	ACTIONS.viewEntity({ type: entity, id: id });
}

function prevListing() {
	var $selected = $('.list .selected');
	var $prev = $selected.prevAll().filter(':not(.list-header)').first().find('a.listing-summary');
	var id = $prev.attr('data-id');
	var entity = $prev.attr('data-entity') || 'Listing';
	ACTIONS.viewEntity({ type: entity, id: id });
}

function stepThroughQuickDetails(direction) {
	var currentId = $('.listing-quick-details').attr('data-id');
	var dataSet = DataSetStore.get() || [];
	var nextId = null;
	dataSet.forEach(function (d, i) {
		if (d._id == currentId) {
			var index = (direction == 'prev') ? i - 1 : i + 1;
			if (index > -1 && index < dataSet.length) {
				nextId = dataSet[index]._id;
			}
		}
	});

	if (nextId) {
		loadQuickDetails(nextId);
	}
}

function nextPhoto() {
	$('.details a.rslides_nav.next').click();
}

function prevPhoto() {
	$('.details a.rslides_nav.prev').click();
}

//todo: this is duplicated from list.js
function setPhoto(evt, step) {
	var $listing = $(evt.target).closest('[data-id]');
	var images = ($listing.data('photos') || {}).photos || [];
	var idx = $listing.data('imageIndex') || 0;

	if (!images.length) {
		return;
	}

	idx += step;

	if (idx < 0) { idx = images.length - 1; }
	if (idx >= images.length) { idx = 0; }

	$listing.data('imageIndex', idx);

	var img = $listing.find('.listing-photo');
	if (img.is('img')) {
		img.attr(
			'src',
			images[idx] + '/600'
		);
	} else {
		img.css(
			'background-image',
			'url(' + images[idx] + '/600)'
		);
	}
}

function getGidSetting(gid, setting, context) {
	var val = null;
	if (context[setting]) {
		if (!gid) {
			gid = Object.keys(context[setting])[0];
		}
		val = context[setting][gid.toLowerCase()];
	}
	return val;
}

function mapReady() {
	LocationManager.setMapProvider(MapProvider);
	LocationManager.update($('#gid').val(), { autoPan: false, quiet: true });

	StreetGridManager.setMapProvider(MapProvider);

	updateMapAndSubmit(null, performSearch);
}

function performSearch(isUserEvent) {
	var form = $('#filters-form');
	form.submit();
}

var $debounceSearch = $.debounce(performSearch, 100);

function setGeographyCriteria(state) {
	var sw = state.bounds[0];
	var ne = state.bounds[1];

	$('#minlatitude').val('>=' + sw.lat.toString());
	$('#maxlatitude').val('<=' + ne.lat.toString());
	$('#minlongitude').val('>=' + sw.lng.toString());
	$('#maxlongitude').val('<=' + ne.lng.toString());

	var zoom = state.zoom;
	var center = state.center;

	$('#zoom').val(zoom);
	$('#latitude').val(center.lat.toString());
	$('#longitude').val(center.lng.toString());

	formChanged();
}

function mapMoved(data) {
	var state = data.state;
	setGeographyCriteria(state);

	if (SettingsStore.get().clustering) {
		return;
	}

	//$debounceSearch(data.isUserEvent);
}

function mapZoomed(data) {
	var state = data.state;
	setGeographyCriteria(state);

	$debounceSearch(data.isUserEvent);
}

function getMapSettings(gid) {
	gid = gid || $('#gid').val() || '';

	var startLatitude = 43.7;
	var startLongitude = -79.4;
	var startZoom = 8;
	var geocoding = {};
	var clustering = false;

	if ('mapContext' in window) {
		var defaultLocation = getGidSetting(gid, 'defaultLocation', mapContext);
		geocoding = getGidSetting(gid, 'geocoding', mapContext);

		if (defaultLocation) {
			startLatitude = defaultLocation.latitude;
			startLongitude = defaultLocation.longitude;
			startZoom = defaultLocation.zoom || startZoom;
		}

		clustering = getGidSetting(gid, 'clustering', mapContext) || false;
	}

	return {
		events: {
			ready: mapReady,
			moveEnd: mapMoved,
			zoomEnd: mapZoomed
		},
		defaultLocation: {
			latitude: startLatitude,
			longitude: startLongitude,
			zoom: startZoom
		},
		clustering: clustering,
		geocoding: geocoding
	};
}

function handleHiddenFields(form, condition, ignore) {
	var dynamicFields = [ 'city', 'neighborhoods', 'school', 'listingID', 'webID', 'postalCode', 'schoolDistrict', 'region', 'borough', 'buildingID', 'exclusiveAgentIDs', 'listAgentIDs', 'area', 'district', 'building.mgtAgent', 'building.mgtAgentDescription' ];
	var dynamicFieldAttrs = {
		'exclusiveAgentIDs': 'class="additional-filter agent-only" data-field-name="Exclusive Agent"',
		'listAgentIDs': 'class="additional-filter agent-only" data-field-name="List Agent"',
		'building.mgtAgent': 'class="additional-filter agent-only" data-field-name="Landlord"',
		'building.mgtAgentDescription': 'class="additional-filter agent-only" data-field-name="Landlord"'
	};

	var ignoreMap = {};

	var i;

	// Can probably filter this based on the existence of a non-hidden input element
	for (i = 0; i < dynamicFields.length; i++) {
		if (ignore && $.inArray(dynamicFields[i], ignore) > -1) {
			ignoreMap[dynamicFields[i]] = 1;
			continue;
		}
		form.find('[name="' + dynamicFields[i] + '"]').remove();
	}

	var showFiltersDescription = false;

	for (i = 0; i < dynamicFields.length; i++) {
		if (ignoreMap[dynamicFields[i]]) { continue; }

		var c = (condition.match(new RegExp('(^|&)' + dynamicFields[i] + '=[^&]*(\\b|&)', 'g')) || []).length;

		if (c > 0 && (dynamicFields[i] == 'listingID' || dynamicFields[i] == 'webID')) {
			showFiltersDescription = true;
		}

		for (var j = 0; j < c; ++j) {
			var inputHtml = '<input type="hidden" name="' + dynamicFields[i] + '" ';

			if (dynamicFieldAttrs[dynamicFields[i]]) {
				inputHtml += dynamicFieldAttrs[dynamicFields[i]];
			}

			inputHtml += ' />';
			form.append(inputHtml);
		}
	}

	return showFiltersDescription;
}

var geocoder;
var map;
var mapInitialized = false;
var markers = [];
var markerClusterer = null;
var infoWindow;
var hiddenMarker;
var clearShapesControlDiv;
var _additionalFiltersMap = {};
var timeout = 250;

var grid;

// hack: this variable to ignore some events when we don't want to trigger new searches
var IGNORE_CHANGE = false;

var geographyColumnName = 'geometry';

function clearMarkers() {
	MapProvider.clearMarkers();
}

function clearList() {
	$('ul.listings').scrollTop(0).empty();
}

function clearListTable() {
	if (grid) {
		grid.destroy();
		grid = null;
	}
	$('.listtable').scrollTop(0).empty();
}

function clearListSummary() {
	$('.listsummary').scrollTop(0).empty();
}

function clearListAndMarkers() {
	clearList();
	clearListTable();
	clearListSummary();

	var settings = SettingsStore.get();
	if (settings.clustering) {
		return;
	}

	$('.listings-count').html('');
	clearMarkers();
}

function newSearch() {
	CURRENT_HASH = CURRENT_CLUSTER_HASH = CURRENT_DESERIALIZED_CONDITION = undefined;

	window.searchType = '';

	if (window.defaultSearch) {
		loadSearchImp(window.defaultSearch, true);
		return;
	}

	loadCustomerFilters($('#gid').val(), function () {

		IGNORE_CHANGE = true;

		hideFiltersDescription();

		showFilters();
		scrollFiltersToTop();

		var form = $('#filters-form');

		form.children('[name=school],[name=neighborhoods],[name=city],[name=listingID],[name=district],[name=webID],[name=buildingID]').remove();
		form.find('#form-listingids').remove();

		resetAdditionalFilters();

		form.trigger('reset');

		if ($.jStorage.get(user._id + '-saleOrRent') == 'RENT') {
			showRentals();
		}

		$('.listtable').data('hash', null);

		handleClassOrSaleOrRentChange(form);

		form.find('.btn-grup > .btn:has(input)').removeClass('active');
		form.find('.btn-group > .btn:has(input:checked)').addClass('active');

		MapProvider.clearShapes();
		StreetGridManager.reset();

		resetLatLongForm();
		resetSaveSearchFields();

		LocationManager.setMapProvider(MapProvider);
		LocationManager.update($('#gid').val(), { clear: true, quiet: true });

		window.filterHelpers && window.filterHelpers.onAfterDeserialize();

		IGNORE_CHANGE = false;

		var defaultOrderby = ((window.user || {}).settings || {}).listingSort || 'price';
		resetOrderby(defaultOrderby);

		var ms = getMapSettings();
		var start = ms.defaultLocation;
		var latLng = MapProvider.getLatLng(start.latitude, start.longitude);

		MapProvider.panTo(latLng, start.zoom, 'road', function () {
			setGeographyCriteria(MapProvider.getMapState());
		});

		window._gridColumnOrder = null;

		$('.filters-forms')[0].scrollTop = 0;

		$('#loc', form).typeahead('close');
	});
}

function hideAllToolbars() {
	hideTable();
	hideSummary();

	$('.details').hide();
	$('.details-buttons, .details-count, .button-group-list').hide();
	$('.split-details, .listtable-buttons').addClass('invisible');
	$('.map-buttons, .map-search-toggle').removeClass('invisible');
}

$(document).ready(function () {
	var $body = $('body').addClass('search');

	GidStore.set($('#gid').val());

	// Prevent flash of toolbars/content before panels are initialized
	hideAllToolbars();

	if (getScrollBarWidth() > 4) { $body.addClass('scrollbars'); }

	listManager = listManager || new ListManager(true);
	listManager.refresh(function () { });

	$('.list, .listsummary, .listtable').scroll(function () {
		$(window).trigger('scroll');
	});

	if (window.mapProvider.type == 'google') {
		MapProvider = GoogleMapProvider;
	} else if (window.mapProvider.type == 'leaflet') {
		MapProvider = LeafletProvider;
	}

	//issue 4395
	if (MapProvider && !Responsive.isHandheld) {
		$('.map').resize($.debounce(function () {
			if ($('.map').is(':visible')) {
				MapProvider.trigger('resize');
			}
		}, 75));
	}

	function handleListingSummaryClick(e, el, scrollIntoView, view) {
		var id = el.getAttribute('data-id');
		var entity = el.getAttribute('data-entity');

		if (!id) {
			var parent = $(el).parents('[data-id]');
			id = parent.attr('data-id');
			entity = parent.attr('data-entity');
		}

		if (view == 'quickdetails') {
			loadQuickDetails(id);
			return;
		}

		if ($('.map').is(':visible') || $('.listtable').is(':visible') || $('.listsummary').is(':visible')) {
			showDetails();
		}

		if (Responsive.isHandheld) {
			Responsive.setScene('details');
		}

		ACTIONS.viewEntity({ type: entity || 'Listing', id: id });
		//loadListing(id, scrollIntoView);
	}

	$('.filters, .filters-forms').on('scroll', $.debounce(function (e) {
			$('.tooltip').fadeOut();
		}, 250, true)
	);

	$('.listings, .quickdetails').on('click', '[data-rel=listing-details]', function (e) {
		handleListingSummaryClick(e, this, false);
		if (typeof closeInfoWindow != 'undefined') { closeInfoWindow(); }
		e.preventDefault();
		return false;
	});

	$('.listings').on('dblclick', '[data-rel=listing-details]', function (e) {
		toggleExpandLeft();
		e.preventDefault();
		return false;
	});

	$('.map').on('click', '[data-rel=listing-details]', function (e) {
		handleListingSummaryClick(e, this, true);
		e.preventDefault();
		return false;
	});

	$('.listtable, .listsummary').on('click', '[data-rel=listing-details]', function (e) {
		if ($(e.target).parents('.quiet').length || $(e.target).parents('.hover-toolbar').length) {
			e.preventDefault();
			return;
		}

		var $entity = $(e.target).parents('[data-entity]');

		if (Responsive.isHandheldPlatform && window.$toggles.hasOpenToolbar($entity)) {
			window.$toggles.hideToolbar($entity);
			e.preventDefault();
			return;
		}

		handleListingSummaryClick(e, this, true, isSplitRightOpen() ? 'quickdetails' : 'details');
		e.preventDefault();
		return false;
	});

	$('.listtable, .listsummary').on('dblclick', '[data-rel=listing-details]', function (e) {
		// Ignore double clicks occurring on context menu buttons
		if ($(e.target).parents('.hcmenu .btn').length) {
			e.preventDefault();
			return false;
		}

		handleListingSummaryClick(e, this, false);
		e.preventDefault();
		return false;
	});

	$('.listtable, .listsummary').on('click', '.btn-open-details', function (e) {
		window.$toggles.hideToolbar($(e.target).parents('[data-entity]'));
		if (!isSplitRightOpen()) {
			toggleExpandRight(false);
		}
		handleListingSummaryClick(e, this, true, 'quickdetails');
		evt.preventDefault();
		return false;
	});

	$('.list').attr('tabindex', 0).css('outline', 0).on('keydown', function (e) {
		if (e.keyCode == 40) {
			e.preventDefault();
			nextListing();
		} else if (e.keyCode == 38) {
			e.preventDefault();
			prevListing();
		} else if (e.keyCode == 37) {
			prevPhoto();
		} else if (e.keyCode == 39) {
			nextPhoto();
		}
	});

	$('.listtable').attr('tabindex', 0).css('outline', 0).on('keydown', function (e) {
		if (!isSplitRightOpen()) { return; }

		if (e.keyCode == 40) {
			e.preventDefault();
			stepThroughQuickDetails('next');
		} else if (e.keyCode == 38) {
			e.preventDefault();
			stepThroughQuickDetails('prev');
		}
	});

	$('.btn-filters').on('click', showFilters);
	$('.btn-list').on('click', showList);
	$('.btn-searches').on('click', showSearches);
	$('.btn-map').on('click', showMap);
	$('.btn-table').on('click', function (e) {
		if ($('[name="right-submode"]:checked').val() == 'summary') {
			showSummary(e);
		} else {
			showTable(e);
		}
	});
	$('.btn-listtable').on('click', showTable);
	$('.btn-listsummary').on('click', showSummary);

	$('.btn-details').on('click', function (e) {
		loadCurrentListing(true);
		showDetails();
	});

	$('.btn-position').on('click', updateCurrentPosition);
	$('.btn-expand-left').on('click', function () {
		toggleExpandLeft();
	});
	$('.btn-expand-right').on('click', function () {
		splitRightOpen = !isSplitRightOpen();

		toggleExpandRight();

		loadQuickDetails();
	});
	$('.btn-location').on('click', function (ev) {
		updateLocation(ev.target);
		ev.preventDefault();
	});

	$('.btn-sales').on('click', salesTabClick);
	$('.btn-rentals').on('click', rentalsTabClick);

	$(document).on('geocode:request', function (e, val) {
		updateLocation(e.target);
		e.preventDefault();
	});

	$(document).on('click', '.btn-reset-columnset-order', function () {
		ACTIONS.setColumnsetOrder(window.user, GidStore.get(), ColumnsetStore.get(), null);
		updateListingsGrid(DataSetStore.get(), null, SelectionsStore.getAllIDs(), true);
	});

	$('#loc, #locmap').on('focus', function (e) {
		var loc = this;
		setTimeout(function () {
			$(loc).select();
		}, 100);

		//If the height is very small, give more room to the drop down menu
		if ($('body').hasClass('handheld') && $(document).height() < 350) {
			var topNavHeight = $('main .navbar:first').height();
			var currentFilterFormScrolltop = $('.filters-forms').scrollTop();
			var locOffset = $(loc).offset().top;
			var newFilterFormScrolltop = locOffset + currentFilterFormScrolltop - topNavHeight - 2;

			//Will put the filter-forms just under the top navigation
			$('.filters-forms').animate({ scrollTop: newFilterFormScrolltop }, 'slow');
			$('body').addClass('location-search-open');
		}
	});

	$('#loc, #locmap').on('blur', function (e) {
		$('body').removeClass('location-search-open');
	});

	$('#loc, #locmap').on('keypress', function (e) {
		if (e.which == 13 || e.keyCode == 13) {
			updateLocation(e.target);
			e.target.blur();
			e.preventDefault();
		}
	});

	$('#loc, #locmap').on('keyup', toggleGoButton);

	//Imitate a keyup event when user pastes
	$('#loc').on('paste', function () {
		var self = this;
		setTimeout(function () {
			$(self).keyup();
		}, 10);
	});

	toggleGoButton();

	var LocationManager = new LocationAutocomplete('#loc,#locmap', '', {tagsSelector: '.recipient-container', formsSelector: '#filters-form, .map-location-search', formSelector: '#filters-form' });

	// initialize X button for certain search inputs
	new ClearTextButton($('#btn-loc-clear1'), $('#loc'));
	new ClearTextButton($('#btn-loc-clear2'), $('#locmap'));

	LocationManager.on('geo:selected', function (evt, data) {
		if (data.type == 'listingID') {
			var listing = data.object;
			if (listing && listing.latitude && listing.longitude) {
				// Note: Map panning is handled by the shapes manager

				//var latLng = MapProvider.getLatLng(listing.latitude, listing.longitude);
				//MapProvider.panTo(latLng, 18);
			} else {
				// Warn user about unmappable property?
				handleSearchResponse([ listing ]);
			}

			ACTIONS.viewEntity({ type: 'Listing', id: listing._id });

			// Force next search to display details if for some reason we're not already there
			window.initialRightPanel = 'details';

			// Clear all extraneous criteria
			var options = { disableDescription: true };
			deserializeFiltersImpl('listingID=' + listing.listingID + '&saleOrRent=' + listing.saleOrRent, options);

			return;
		}

		formChanged();

	});

	LocationManager.on('geo:removed', function (e, object) {
		MapProvider.updateShapesControls();
		formChanged();
	});

	$(document).on('click', '.cancel-custom-price', function () {
		handleCancelCustomPrice($(this));
	});

	$(document).on('keyup', '.custom-price input', function () {
		var $this = $(this);
		$this.val('$' + $this.val().replace(/[^\d\.]/g, '').replace(/(\d)(?=(\d\d\d)+(?!\d))/g, '$1,'));
	});

	$('#search-email-disabled .initialmessage a').on('click', function () {
		$('#search-email-disabled .initialmessage').hide();
		$('#search-email-disabled .detailedmessage').show();
	});

	$('#search-uid-disabled .initialmessage a').on('click', function () {
		$('#search-uid-disabled .initialmessage').hide();
		$('#search-uid-disabled .detailedmessage').show();
	});

	$('#search-uid').on('change', function () {
		if ($('#search-uid').val() == user._id) {
			$('#save-search-dialog').find('.client-notification-setting').hide();
			$('#search-hidden').hide().find('input').removeAttr('checked');
		} else {
			$('#save-search-dialog').find('.client-notification-setting').show();
			$('#search-hidden').show();
		}
	});

	$('#search-email-interval').on('change', function () {
		$('#search-email-layout-group').toggle($('#search-email-interval').val() != '');
	});

	window.LocationManager = LocationManager;

	$('.btn-more-fields').on('click', function (e) {
		$(this).parent().hide();
	});

	function gidSwitchHandler() {
		window.filterHelpers && window.filterHelpers.onAfterDeserialize();
		MapProvider.clearShapes();
		StreetGridManager.reset();
		resetLatLongForm();
		var gid = $('#gid').val();
		LocationManager.update(gid, { clear: true, quiet: true });
		updateMapAndSubmit(null, performSearch);
	}

	var appForm = $('#app-filters-form');
	appForm.change(function (e) {
		loadCustomerFilters($(e.target).val(), gidSwitchHandler);
	});

	var form = $('#filters-form');

	var formChangeDebounced = $.debounce(handleFilterFormsChange, timeout);

	var formChangeHandler = function () {
		if (IGNORE_CHANGE) { return; }

		formChangeDebounced.apply(this, arguments);
	};

	$(document).on('keyup', ':text', $.debounce(handleFilterFormsChange, 750));
	form.change(formChangeHandler);

	form.submit(function (e) {
		if (IGNORE_CHANGE) {
			return;
		}

		formChanged();
		submitSearch();

		e.preventDefault();
	});

	$(document).on('click', '.delete-grid-filter', function (e) {
		var $el = (e && e.target && $(e.target));
		if ($el) {
			$el.parent().parent().children('select').val('').trigger('change');
		}
	});

	$(document).on('change', '.streetGridFilters select', function (e) {
		var $el = (e && e.target && $(e.target));
		StreetGridManager.validateSelection($el);
		if ($el) {
			$el.parent().children('.delete-grid-filter').detach();
			if ($el.val() !== '') {
				addDeleteIcon($el);
			}
		}

		StreetGridManager.getPolygon(
			[
				$('select[name="streetGridNorth"]', '.streetGridFilters').val() || '',
				$('select[name="streetGridSouth"]', '.streetGridFilters').val() || '',
				$('select[name="streetGridEast"]', '.streetGridFilters').val() || '',
				$('select[name="streetGridWest"]', '.streetGridFilters').val() || ''
			], function () {
				updateGeographyAndSubmitForm();
			});
	});

	var defaultSearchName = 'My Saved Search';
	var defaultSearchNameIndex = 1;

	$('.btn-search-tools, .btn-searches').on('click', function (e) {
		var $menu = $('.search-tools-menu');
		//if ($menu.is(':visible')) { return; }
		var $searchesList = $('.searches-list');
		var $deleteSearchName = $('#delete-search-name');

		var $loadSearchList = $('#load-search-dialog ul');

		$menu.find('.saved-search, .more-searches').remove();
		$searchesList.find('.saved-search').remove();
		$loadSearchList.find('.saved-search').remove();
		$deleteSearchName.empty();

		setTimeout(function () {
			$.getJSON('/searches?$select=_id,name', handleSearches);
		}, 100);

		function handleSearches(searches) {
			if (!searches || searches.length === 0) {
				$menu.append('<li class="dropdown-header saved-search">No saved searches yet</li>');
				$searchesList.append('<li class="saved-search"><span style="display:block; padding:20px; text-align: center;">No saved searches yet</span></li><li class="saved-search" style="padding:10px 10px 10px 20px; position:absolute; bottom:0px; color:#999;"><span>Click here to save your search</span><span class="fa fa-share fa-3x fa-rotate-90 pull-right"></span></li>');
				$deleteSearchName.append('<option disabled="disabled">No saved searches yet</option>');
			} else {
				var search;

				$menu.append(
					'<li class="dropdown-header more-searches hidden-md hidden-lg">' +
					'<a href="#" data-target="#load-search-dialog" data-toggle="modal">Your Searches</a>' +
					'</li>'
				);

				$menu.append('<li class="dropdown-header saved-search hidden-sm hidden-xs">Your Searches</li>');

				for (var i = 0, len = searches.length; i < len; ++i) {
					search = searches[i];

					if (i < 5) {
						$menu.append('<li class="saved-search hidden-sm hidden-xs"><div class="row" style="padding-left:5px;" data-id="' + htmlEncode(search._id) + '">' +
							'<div class="col-xs-10 load-search">' + htmlEncode(search.name) +
							'</div><div class="col-xs-2 del-search" data-toggle="modal" data-target="#delete-search-dialog" style="padding-left:0;"><img src="/images/x.png?00000001" class="delete-search-icon"></div>' +
							'</div></li>');
					}

					$searchesList.append('<li class="saved-search"><a href="#search/' + htmlEncode(search._id) + '" data-id="' + htmlEncode(search._id) + '" data-rel="search">' +
						'<span class="load-search">' + htmlEncode(search.name) + '</span>' +
						'<span class="del-search" data-toggle="modal" data-target="#delete-search-dialog"><img src="/images/x.png?00000001" class="delete-search-icon"></span>' +
						'</a></li>');

					$loadSearchList.append('<li class="saved-search"><div class="row" data-id="' + htmlEncode(search._id) + '">' +
							'<div class="col-xs-10 load-search">' + htmlEncode(search.name) +
							'</div><div class="col-xs-2  del-search" data-toggle="modal" data-target="#delete-search-dialog" style="padding-left:0;"><img src="/images/x.png?00000001" class="delete-search-icon"></div>' +
							'</div></li>');

					$deleteSearchName.append('<option value="' + htmlEncode(search._id) + '">' + htmlEncode(search.name) + '</option>');
				}

				if (searches.length > 5) {
					$menu.append(
						'<li class="more-searches hidden-sm hidden-xs">' +
						'<a href="#" data-target="#load-search-dialog" data-toggle="modal">More...</a>' +
						'</li>'
					);
				}

				var id = $('#search-id').val();
				var searchNames = searches.map(function (search) {
					return search.name;
				});

				if (searchNames.indexOf(defaultSearchName) === -1) {
					defaultSearchNameIndex = 0; // no saved search with defaultSearchName
				} else {
					// find the lowest unused defaultSearchNameIndex
					for (defaultSearchNameIndex = 1; searchNames.indexOf(defaultSearchName + ' ' + defaultSearchNameIndex) !== -1; ++defaultSearchNameIndex);
					if (!id) { // if this is an unsaved search (no id) reset the name
						resetSaveSearchFields();
					}
				}
			}

		}
	});

	$('#save-search-dialog').on('show.bs.modal', function (e) {
		handleSaveSearchForListingCount();

		$('#search-email-interval').trigger('change');
	});

	$('#save-search-dialog').on('shown.bs.modal', function (e) {
		$('#search-name').select();

		describeFilters($('#save-search-dialog .description'));
	});

	$('.btn-save-search').on('click', function (e) {
		var id = $('#search-id').val();
		var name = $('#search-name').val();
		var nameOriginal = $('#search-name-original').val();
		var uid = $('#search-uid').val();
		var uidOriginal = $('#search-uid-original').val();
		var hidden = $('#search-hidden input').is(':checked');
		var description = ''; //toDescription(condition);
		var orderby = $('#orderby').val();
		var layout = $('#search-email-layout').val();

		var condition = serializeFilters(true, uid != user._id);

		if (name != nameOriginal || uid != uidOriginal) { id = null; }

		var search = {
			'type': 'saved',
			'name': name,
			'description': description,
			'collection': 'listings',
			'condition': condition,
			'conditionType': 'form',
			'orderby': ((orderby || '').length) ? orderby : 'price',
			'groupby': null,
			'active': isSearchActive,
			'uid': uid,
			'hidden': hidden,
			'emailLayout': layout
		};

		window.searchSubscriptionsHelper.applySubscriptionsToSearch(search);

		var type = id ? 'put' : 'post';
		var url = id ? '/searches/' + id : '/searches';

		$.ajax({
			contentType: 'application/json',
			dataType: 'json',
			type: type,
			url: url,
			data: JSON.stringify(search),
			success: function (search) {
				if (window.defaultSearch && window.defaultSearch._id == search._id) {
					window.defaultSearch = search;
				}

				populateSearchForm(search);

				$('.btn-searches').click();
			}
		});
	});

	$('.search-tools-menu, .searches-list, #load-search-dialog').on('click', '.saved-search .del-search', function (e) {
		var id = $(this).parent().attr('data-id');
		$('#load-search-dialog').modal('hide');
		$('#delete-search-name option[value=' + id + ']').prop('selected', 'selected');
		e.preventDefault();
	});

	$('.search-tools-menu, .searches-list, #load-search-dialog').on('click', '.saved-search .load-search', function (e) {
		var id = $(this).parent().attr('data-id');
		$('#load-search-dialog').modal('hide');
		loadSearch(id);
		e.preventDefault();
	});

	var resetSaveSearchFields = function () {
		$('#search-id').val('');
		$('#search-name').val(defaultSearchName + (defaultSearchNameIndex ? ' ' + defaultSearchNameIndex : '')); // don't append a zero
		$('#search-name-original').val('');
		$('#search-email-layout').val('');
		$('#search-uid').val(user._id);
		$('#search-hidden input').removeAttr('checked');
		$('#save-search-dialog .expire').html('');

		$('select[name="user.interval"], select[name="client.interval"]').val('instant').attr('disabled', 'disabled');
		$('input[name="user.email"], input[name="client.email"], input[name="user.sms"], input[name="client.sms"]').removeAttr('checked');
	};

	// Export global function
	window.resetSaveSearchFields = resetSaveSearchFields;

	$('.btn-new-search').on('click', function (e) {
		newSearch();
	});

	$('.btn-delete-search').on('click', function (e) {
		var $deleteSearchName = $('#delete-search-name');
		var id = $deleteSearchName.val();

		if (id) {
			$.ajax({
				dataType: 'json',
				type: 'delete',
				url: '/searches/' + id,
				success: function () {
					if (id == $('#search-id').val()) {
						resetSaveSearchFields();
					}
					$('.btn-searches').click();
				}
			});
		}
	});

	$('.listings-count').on('click', 'button', function (e) {
		var $form = $('#filters-form');
		var input = document.createElement('input');
		input.type = 'hidden';
		input.name = '$take';
		input.value = '1000';
		$form.append(input);
		$form.submit();
		input.remove();
	});

	//list summary photos
	$('.btn-prev').on('click', prevListing);

	$('.btn-next').on('click', nextListing);

	$('.quickdetails-btn-prev').on('click', function () {
		stepThroughQuickDetails('prev');
	});

	$('.quickdetails-btn-next').on('click', function () {
		stepThroughQuickDetails('next');
	});

	//map popup photos
	$(document.body).on('click', '.prev-image', function (evt) {
		setPhoto(evt, -1);
		evt.preventDefault();
	});

	$(document.body).on('click', '.next-image', function (evt) {
		setPhoto(evt, 1);
		evt.preventDefault();
	});

	$('#additional-filters-dialog').on('shown.bs.modal', function (e) {
		var id = GidStore.get();
		var additionalFiltersEnabled = SettingsStore.get().additionalFiltersEnabled;

		if (!additionalFiltersEnabled) {
			$('#additional-filters-dialog').modal('hide');
			return;
		}

		if (_additionalFiltersMap[id]) {
			populateAdditonalFilters(_additionalFiltersMap[id]);
		} else {
			$.get('/searchlistings/additionalfilters/' + id, function (html) {
				_additionalFiltersMap[id] = html;
				populateAdditonalFilters(html);
			});
		}
	});

	$('#additional-filters-dialog').on('hidden.bs.modal', function (e) {
		$('#additional-filters-dialog .modal-body').empty();
	});

	$('.btn-search-addfilters').on('click', function (e) {
		var condition = $('#additional-filters-form').serialize();
		condition = pareEmptyConditions(condition);
		deserializeFilters(condition, performSearch);
	});

	onFiltersFormLoad();

	handleStartSearchWith();

	var condition = retrieveCondition();
	deserializeFilters(condition, function () {
		var orderby = $('#orderby').val() || ((window.user || {}).settings || {})['listingSort'];
		resetOrderby(orderby);

		$('#filter-forms').removeClass('uninitialized');

		var settings = SettingsStore.get();
		MapProvider.init(settings, function () {
			window.setTimeout(function () {
				if (getConditionValue(condition, '$updateLocation') === 'true') {
					updateLocation($('#loc'));
				}
			}, 100);
		});
	});

	window.searchSubscriptionsHelper = SearchSubscriptionsHelper($('#save-search-dialog'));
});

function formChanged(quiet) {
	var clustering = SettingsStore.get().clustering;
	var criteria = serializeFilters(null, null, { clustering: clustering });
	ACTIONS.setCriteria(criteria);
}

function handleFilterFormsChange(e) {
	if (IGNORE_CHANGE) {
		return;
	}

	var $el = (e && e.target && $(e.target));

	//streetgrid filters create a polygon, do not update the form on individual change
	if (($el.is('select') && $el.closest('.streetGridFilters').length > 0) || $el.attr('name') == 'streetgrid' ||
		e.keyCode == 37 || e.keyCode == 39) { // Left/Right Arrows
		return;
	}

	var form = document.getElementById('filters-form');
	// Ignore key down / key up events if not coming from form
	if ($.contains(form, $el[0])) {
	} else {
		return;
	}

	preprocessChangeEvent(e);

	handleDynamicFields();

	//issue 290, prevent firing on loc changes
	if (e && e.target && e.target.id == 'loc') { return; }

	formChanged();

	$(form).submit();
}

$(document).ajaxError(function (e, xhr, settings, err) {
	if (xhr.statusText == 'abort' || xhr.readyState === 0) { return; }

	$(document).trigger('error', [ err, xhr.responseText ]);
});

$(document).on('error', function (e, title, description) {
	$('#error-dialog')
		.modal()
		.find('.error-message')
		.text((title || '') + '\n\n' + (description || ''));
});

var currentDescribeFiltersRequest;
var filterDescriptionCache = {};
var filterCacheCount = 0;

function describeFilters(descriptionContainer, condition, callback) {
	condition = condition || serializeFilters(true);
	condition = pareEmptyConditions(condition, { strict: true });

	if (!descriptionContainer) {
		if (!Responsive.isHandheld && !$('.filters').is(':visible')) { showFilters(); }

		$('.filters-forms').hide();

		descriptionContainer = $('.filters-description').show().find('.description');
	}

	descriptionContainer.html('<div style="width:100%;text-align:center;"><i class="fa fa-spinner fa-spin"></i></div>');

	// An empty search is generally "$gid=<value>".  If there's an & then we have
	// filters that require description.
	var hasConditions = condition.indexOf('&') > -1;
	if (!hasConditions) {
		descriptionContainer.html('');
		return;
	}

	var cached = filterDescriptionCache[condition];
	if (cached) {
		descriptionContainer.html(cached);
		if (callback) {
			callback(cached);
		}
		return;
	}

	if (currentDescribeFiltersRequest) {
		currentDescribeFiltersRequest.abort();
		currentDescribeFiltersRequest = null;
	}

	currentDescribeFiltersRequest = $.ajax({
		dataType: 'json',
		contentType: 'application/json',
		type: 'post',
		url: '/searches?description=true',
		data: JSON.stringify({ condition: condition }),
		success: function (d) {
			descriptionContainer.html(d.description);

			filterDescriptionCache[condition] = d.description;
			filterCacheCount++;

			if (filterCacheCount > 100) {
				filterDescriptionCache = {};
				filterCacheCount = 0;
			}

			if (callback) { callback(d.description); }
		}
	});

	currentDescribeFiltersRequest.gaType = 'ignore';
}

function hideFiltersDescription() {
	$('.filters-description').hide();
	$('.filters-forms').show();
}

var currentSearchRequest;

function handleSaveSearchForListingCount(newCountIgnoringViewport) {
	var form = $('#filters-form');
	var geometry = form.find('[name=geometry]').val();
	if (geometry && !newCountIgnoringViewport) {
		getSearchCountIgnoreBrowserViewport(handleSaveSearchForListingCount);
		$('#save-search-dialog .btn-save-search').hide();
		return;
	} else {
		$('#save-search-dialog .btn-save-search').show();
	}

	var fullCount = newCountIgnoringViewport || window.listingFullCount;
	var gid = $('#gid').val() || (user && user.domains && user.domains[0]) || '';
	var settingValue = getGidSetting(gid, 'maxSaveSearchResults', mapContext);

	var maxSearchResultsCount = settingValue || 200;

	var settings = SettingsStore.get();

	if (fullCount > maxSearchResultsCount) {
		$('#search-email-interval-group').hide();
		$('#search-email-disabled').show();
		var msg = newCountIgnoringViewport ?
			'Notification is disabled for this search because your shape contains ' + fullCount + ' results. To enable notification, narrow your filters or change your shape to find fewer than ' + maxSearchResultsCount + ' results.'
			: 'Notification is disabled for this search because it has too many results. To enable notification, narrow your filters ' + ((!settings.clustering) ? 'or zoom in ' : '') + 'to find fewer than ' + maxSearchResultsCount + ' results.';

		$('#search-email-disabled .initialmessage').show();
		$('#search-email-disabled .detailedmessage').text(msg).hide();

		isSearchActive = false;
	} else {
		isSearchActive = true;
		$('#search-email-interval-group').show();
		$('#search-email-disabled').hide();
	}

	var fieldDescriptions = [];

	$('#filters-form').find('input.agent-only:checked:enabled').each(function () {
		if (this.value || $(this).attr('data-field-value')) {
			fieldDescriptions = fieldDescriptionTextToAdd($(this), fieldDescriptions);
		}
	});

	$('#filters-form').find('select.agent-only').each(function () {
		var value = $(this).val();

		if (Array.isArray(value) ? value.length > 1 || (value.length == 1 && value[0]) : value) {
			fieldDescriptions = fieldDescriptionTextToAdd($(this), fieldDescriptions);
		}
	});

	$('#filters-form').find('input.agent-only[type=hidden]:enabled').each(function () {
		if (this.value) {
			fieldDescriptions = fieldDescriptionTextToAdd($(this), fieldDescriptions);
		}
	});

	$('#filters-form').find('input.conditional-agent-only:enabled').each(function () {
		if ((this.value || $(this).attr('data-field-value')) && !$('input[name=' + $(this).attr('name').toLowerCase() + ']:checked').length) {
			fieldDescriptions = fieldDescriptionTextToAdd($(this), fieldDescriptions);
		}
	});

	if (fieldDescriptions.length) {
		$('#search-uid-disabled').show();
		var uidMsg = fieldDescriptions.length > 1 ?
			'Save for Client is disabled for this search because it contains multiple %a% fields. To enable save for client, remove these %a% fields: '
			: 'Save for Client is disabled for this search because it contains %b% field. To enable save for client, remove this %a% field: ';
		if (window.user.$gids.hasOwnProperty('treb')) {
			uidMsg = uidMsg.replace(/%a%/g, 'salesperson-only');
			uidMsg = uidMsg.replace(/%b%/g, 'a salesperson-only');
		} else {
			uidMsg = uidMsg.replace(/%a%/g, 'agent-only');
			uidMsg = uidMsg.replace(/%b%/g, 'an agent-only');
		}
		var canBeSavedForYou = 'This search can only be saved for yourself. ';
		$('#search-uid-disabled .initialmessage').show();
		$('#search-uid-disabled .detailedmessage').text(canBeSavedForYou + uidMsg + fieldDescriptions.join(', ')).hide();
		$('#search-uid').hide().val(user._id);
	} else {
		$('#search-uid-disabled').hide();
		$('#search-uid').show();
	}

	$('#search-uid').trigger('change');
}

function fieldDescriptionTextToAdd(fieldSelected, currentDescriptions) {
	var fieldDescription = fieldSelected.attr('data-field-name') || '';
	var fieldValue = fieldSelected.attr('data-field-value');

	if (fieldValue) {
		currentDescriptions.push(fieldDescription + ' (' + fieldValue + ')');
	} else if (fieldDescription.length && $.inArray(fieldDescription, currentDescriptions) === -1) {
		currentDescriptions.push(fieldDescription);
	}

	return currentDescriptions;
}

function updateExportCondition(condition) {
	$('#export-form').data('condition', condition);
}

function submitSearch() {
	if ($('.filters-description').is(':visible')) {
		describeFilters();
	} else {
		updateAdditionalFiltersDescription();
	}

	//updateClusters();

	return;
}

function updateClusters() {
	var settings = SettingsStore.get();
	if (settings.clustering) {
		getClusters(null, function (clusters) {
			if (!clusters) { return; }
			var zoom = $('#zoom').val();
			if (zoom > settings.maxClusterZoom) {
				clearMarkers();
				return;
			}

			if (clusters.clusters) {
				MapProvider.addClusterMarkers(clusters.clusters);
			} else {
				MapProvider.addMarkers(clusters);
			}
		});
	}
}

function getSearchCountIgnoreBrowserViewport(callback) {
	//set global "saving" variable to true
	if (currentCountRequest) { currentCountRequest.abort(); currentCountRequest = null; }
	var form = $('#filters-form');
	var data = getSerializedDataForCountRequest();
	//Remove all zooms and browser viewports
	data = data.replace(/(&%24zoom=)(\d)+/, '$11');
	data = data.replace(/(&(latitude|longitude)=%[^&]+)/g, '');

	// Always POST if encoded data length is greater than 2048 bytes due to limit in MSIE.
	var method = encodeURI(data).length > 2048 ? 'post' : form.attr('method');
	var action = form.attr('action');

	currentCountRequest = $.ajax({
		dataType: 'json',
		type: method,
		url: action,
		data: data + '&$filter_dislikes=true',
		success: function (res) {
			callback(res.fullCount);
		},
		complete: function () { currentCountRequest = null; }
	});
}

function getSerializedDataForCountRequest(form) {
	form = form || $('#filters-form');
	var input = document.createElement('input');
	input.type = 'hidden';
	input.name = '$full_count_only';
	input.value = 'true';
	form.append(input);
	var data = form.serialize();
	input.remove();
	return data.replace(/[^&]+=\.?(&|$)/g, '').replace(/&$/, '');
}

function submitFullCount(form, callback, thresholdCallback) {
	if (currentCountRequest) {
		if (currentCountRequest._timeoutID) {
			clearTimeout(currentCountRequest._timeoutID);
		}

		currentCountRequest.abort();
		currentCountRequest = null;
	}

	form = form || $('#filters-form');
	var data = getSerializedDataForCountRequest(form);

	var settings = SettingsStore.get();

	if (settings.clustering) {
		// Don't restrict full count to current viewport
		data = data.replace(/(&%24zoom=)(\d)+/, '$11');
		data = data.replace(/(&(latitude|longitude)=%[^&]+)/g, '');
	}

	// Always POST if encoded data length is greater than 2048 bytes due to limit in MSIE.
	var method = encodeURI(data).length > 2048 ? 'post' : form.attr('method');
	var action = form.attr('action');

	currentCountRequest = $.ajax({
		dataType: 'json',
		type: method,
		url: action,
		data: data + '&$filter_dislikes=true',
		success: function (res) {
			clearTimeout(currentCountRequest._timeoutID);

			if (callback) {
				callback(res.fullCount);
			} else {
				var dataSet = DataSetStore.get();
				(dataSet[0] || {}).full_count = res.fullCount;
				updateCountDisplay(dataSet.length, res.fullCount);
			}
		},
		complete: function () { currentCountRequest = null; }
	});

	if (thresholdCallback) {
		currentCountRequest._timeoutID = setTimeout(thresholdCallback, 2000);
	}
}

var currentClusterRequest;
var CURRENT_CLUSTER_HASH  = undefined;
function getClusters(form, callback, thresholdCallback) {
	var zoom = $('#zoom').val();

	form = form || $('#filters-form');

	var data = CriteriaStore.get('no-map');
	var fullData = CriteriaStore.get();
	var hash = okhash(data + ':' + zoom);

	if (CURRENT_CLUSTER_HASH === hash) {
		return;
	}

	var settings = SettingsStore.get();

	if (zoom > settings.maxClusterZoom) {
		clearMarkers();
		CURRENT_CLUSTER_HASH = undefined;
		return;
	}

	if (!fullData) {
		return;
	}

	if (currentClusterRequest) {
		if (currentClusterRequest._timeoutID) {
			clearTimeout(currentClusterRequest._timeoutID);
		}

		currentClusterRequest.abort();
		currentClusterRequest = null;
	}

	clearMarkers();

	CURRENT_CLUSTER_HASH = hash;

	// Always POST if encoded data length is greater than 2048 bytes due to limit in MSIE.
	var method = encodeURI(fullData).length > 2048 ? 'post' : form.attr('method');
	var action = '/listings/clusters';

	currentClusterRequest = $.ajax({
		dataType: 'json',
		type: method,
		url: action,
		data: fullData + '&$filter_dislikes=true',
		success: function (res) {
			clearTimeout(currentClusterRequest._timeoutID);

			if (callback) {
				callback(res);
			} else {
				var dataSet = DataSetStore.get();
				(dataSet[0] || {}).full_count = res.count;
				updateCountDisplay(dataSet.length, res.count);
			}
		},
		complete: function () { currentClusterRequest = null; }
	});

	currentClusterRequest.gaType = 'ignore';

	if (thresholdCallback) {
		currentClusterRequest._timeoutID = setTimeout(thresholdCallback, 2000);
	}
}

function updateCountDisplay(count, fullCount, hideGetAll) {
	if (!isSearchInitialized) { return; }

	var overflow = fullCount >= 0 && count != fullCount;

	var html =
		'<a onclick="showList();">' +
		'<span class="badge' + (overflow ? ' overflow' : '') + '">' +
		accounting.formatNumber(count) +
		'</span> ';

	window.listingFullCount = fullCount || count;

	handleSaveSearchForListingCount();

	var user = (window.user || {});
	var forceHideGetAll = GidStore.get() == 'treb';

	if (overflow) {
		html +=
			'<span>of</span> <span class="badge">' +
			accounting.formatNumber(fullCount) +
			'</span> <span>Listings</span></a>' +
			((fullCount > 100 && (!forceHideGetAll && hideGetAll !== true)) ?
			'<button class="btn btn-default btn-xs mobile-hidden">' +
			(fullCount > 1000 ? 'Get 1,000' : 'Get All') +
			'</button>' : '');
	} else {
		html += '<span>Listings</span></a>';
	}

	$('.listings-count').html(html);
}

function handleStartSearchWith() {
	if (window.initialRightPanel && useInitialScreen && !Responsive.isHandheld) {
		if (Responsive.getCurrentScene() !== window.initialRightPanel) {
			switch (window.initialRightPanel) {
				case 'table':
					if (Responsive.isHandheld || Responsive.isHandheldPlatform) {
						showList();
					} else {
						showTable();
					}
					break;

				case 'summary':
					if (Responsive.isHandheld || Responsive.isHandheldPlatform) {
						showList();
					} else {
						showSummary();
					}
					break;

				case 'map':
				default:
					showMap();
					break;
			}
		}

		window.initialRightPanel = null;
	}
}

function handleSearchResponse(listings) {
	ACTIONS.setDataSet(listings);
	ACTIONS.setSelections([]);
	ACTIONS.clearCurrentView();

	// #555 - Extend listings with list membership classes
	listings.forEach(function (listing) {
		listing.classes = fastListClasses(listing._id);
	});

	var count = listings.length;
	var fullCount = (listings[0] || []).full_count;
	var listingMap = {};

	if (fullCount >= 0 || count != 100) {
		updateCountDisplay(count, fullCount);
	} else {
		setTimeout(submitFullCount, 100);
	}

	//MapProvider.addMarkers(listings, listingMap);

	var settings = SettingsStore.get();
	if (settings.clustering) {
		getClusters(null, function (clusters) {
			if (!clusters) { return; }
			var zoom = $('#zoom').val();
			if (zoom > settings.maxClusterZoom) {
				clearMarkers();
				return;
			}

			if (clusters.clusters) {
				MapProvider.addClusterMarkers(clusters.clusters);
			} else {
				MapProvider.addMarkers(clusters);
			}
		});
	}

	if (typeof validateInfoWindow != 'undefined') { validateInfoWindow(listingMap); }

	var loadImmediately = $('.list').is(':visible');

	function _handleListLoad() {
		updateListingList(listings);

		var forcedListingId = window.forceCurrentListingById;
		if (forcedListingId) {
			selectListing(forcedListingId);
			window.forceCurrentListingById = null;
		} else {
			// If for some reason we're on the details page and
			// we get new results in then load details for the
			// selected listing, or default the first one
			if ($('.details').is(':visible')) {
				loadCurrentListing(true);
			} else {
				unloadCurrentListing();
			}
		}
	}

	if (loadImmediately) {
		_handleListLoad();
	} else {
		setTimeout(_handleListLoad, 500);
	}

	updateListingsGrid(listings, true);
	updateListingsSummary(listings);
}

function htmlEncode(str) {
	return $('<div />').text(str).html();
}

function _updateListingsList(listings) {
	var $listings = $('ul.listings');
	var html = [];

	var buildings = DataSetStore.get('Buildings');

	if (buildings && buildings.length) {
		html.push('<li class="list-header">Building' + (buildings.length == 1 ? '' : 's') + '</li>');

		buildings.forEach(function (building) {
			html.push('<li>' + renderBuildingThreeLine(building) + '</li>');
		});

		if (listings.length) {
			html.push('<li class="list-header">Listings</li>');
		}
	} else {
		if (listings.length === 0 && isSearchInitialized && !isSearching) {
			html.push('<li><div style="text-align:center;">No listings found</div></li>');
		}
	}

	for (var i = 0, len = listings.length; i < len; ++i) {
		var listing = listings[i];
		var listHtml = renderListingThreeLine(listing);

		html.push('<li>' + listHtml + '</li>');
	}

	// Replace html rather than appending
	$listings.get(0).innerHTML = html.join('');

	if ($listings.is(':visible')) {
		$.force_appear();
	}
}

function updateListingList() {
	var $listings = $('ul.listings');

	var listings = DataSetStore.get();
	var hash = DataSetStore.getHash();

	if (hash && $listings.data('hash') == hash) {

	} else {
		_updateListingsList(listings);
	}

	var currentID = CurrentViewStore.get();
	if (currentID) {
		selectListing(currentID.id, true);
	}

	$listings.data('hash', hash);

	if (window.initialRightPanel == 'details') {
		window.initialRightPanel = null;

		if (listings && listings.length) {
			$('.btn-details').trigger('click');
		}
	} else {
		// Default to first listing if details panel is open
		// and no report is currently loaded
		if (isDetails() && !currentID) {
			loadCurrentListing(true);
		}
	}
}

window.updateListingList = $.debounce(updateListingList, 20);

function formatMoney(num, sym) {
	if (num === null || num === undefined) { return ''; }
	sym = sym || '$';
	if (num % 1 !== 0) {
		return accounting.formatMoney(num, sym, 2);
	} else {
		return accounting.formatMoney(num, sym, 0);
	}
}

function formatMoneyShort(num, sym) {
	if (num === null || num === undefined) { return ''; }
	sym = sym || '$';
	if (num % 1 !== 0) { return accounting.formatMoney(num, sym, 2); }
	if (num < 10000) { return accounting.formatMoney(num, sym, 0); }
	if (num < 1000000) {
		return accounting.formatMoney(num / 1000, sym, num / 1000 % 1 !== 0 ? 1 : 0) + 'K';
	}
	return accounting.formatMoney(num / 1000000, sym, 1) + 'M';
}

function sortMarkers(markers) {
	return markers.sort(function (a, b) {
		return a.listingIndex - b.listingIndex;
	});
}

function renderBuildingThreeLine(building, noDeferredContent) {
	var context = building;
	context.forceShow = noDeferredContent === true;
	return pyhbs.template('building-list-details', context);
}

function renderListingThreeLine(listing, noDeferredContent) {
	var context = listing;
	context.forceShow = noDeferredContent === true;
	context.listingNumberTerm = listingNumberTerm == 'Listing#' ? '#' : listingNumberTerm;
	return pyhbs.template('listing-list-details', context);
}

function renderListingCard(listing) {
	return pyhbs.template('listing-summary-card', listing);
}

function renderListingListSummary(listing) {
	var context = listing;
	context.$isHandheldPlatform = Responsive.isHandheldPlatform;
	return pyhbs.template('listing-list-summary', context);
}

function renderListingsTable(listings, columnSet) {
	var gid = $('#gid').val() || (user && user.domains && user.domains[0]) || '';

	if (!columnSet) {
		columnSet = [
			{ columns: [
				{
					displayName: 'no columnset available',
					name: 'listingID'
				}
			]}
		];
	} else {
		if ((columnSet.columns.filter(function (c) { return c.name == '$toggles'; })).length == 0) {
			columnSet.columns.splice(2, 0, { name: '$toggles' });
		}
	}

	var context = ColumnsetAPI.getColumnsetContext(user, gid, listingNumberTerm);
	columnSet.columns = ColumnsetAPI.filterDisplayableColumns(columnSet.columns, context);
	context.listings = listings;
	context.columnSet = columnSet;

	var renderedTable = pyhbs.template('listing-list-table', context);

	return renderedTable.replace(/td>\s+<td/g, 'td><td');
}

function getListingsSummary(listings, next) {
	if (window._listingsSummaryRequest) {
		window._listingsSummaryRequest.abort();
	}
	var _listings = window._listingIdsForSummary = listings.map(function (l) { return l._id; });
	if (_listings.length > 0) {
		var orderby = $('#orderby').val();
		var data =  '$gid=' + GidStore.get() + '&_id=' + _listings.join('&_id=') + '&$take=' + _listings.length + '&$output=list-summary&$orderby=' + orderby;

		var method = encodeURI(data).length > 2048 ? 'post' : 'get';

		window._listingsSummaryRequest = $.ajax({
			url: '/listings',
			data: data,
			type: method,
			dataType: 'json',
			success: function (listings) {
				next(listings);
			}
		});
	} else {
		next([]);
	}
}

function getListingsTable(listings, columnsets, next) {
	/*var columns = [];
	for (var i = 0, l = columnsets[0].columns.length; i < l; i++) {
		var column = columnsets[0].columns[i];
		if (column.columns){
			for (var j = 0, jl = column.columns.length; j<jl; j++) {
				columns.push(column.columns[j].name);
			}
		}
		else {
			columns.push(column.name);
		}
	}*/

	if (window._listingsTableRequest) {
		window._listingsTableRequest.abort();
	}
	var _listings = window._listingIdsForTable = listings.map(function (l) { return l._id; });
	if (_listings.length > 0) {
		var orderby = $('#orderby').val();
		var data =  '$gid=' + GidStore.get() + '&_id=' + _listings.join('&_id=') + '&$take=' + _listings.length + '&$output=list&$orderby=' + orderby;

		var method = encodeURI(data).length > 2048 ? 'post' : 'get';

		window._listingsTableRequest = $.ajax({
			url: '/listings',
			data: data,
			type: method,
			dataType: 'json',
			success: function (listings) {
				next(listings);
			}
		});
	} else {
		next([]);
	}
}

var hashContexts = {};
var lastHashContext;
var ignoreNextHashChange;
var ignoreNextSaveHash;

function createHash() {
	var hash = '';
	while (hash.length < 24) {
		hash = hash + Math.random().toString(16).substr(2);
	}
	return hash.substr(0, 24);
}

function saveHash(type, value, hash) {
	if (ignoreNextSaveHash) { ignoreNextSaveHash = false; return; }
	if (lastHashContext && lastHashContext.type == type && lastHashContext.value == value) { return; }
	hash = hash || createHash();
	ignoreNextHashChange = true;

	var searchHash = hash;
	var extra = '';

	if (type == 'loadListing') {
		extra = '/listing/' + value.id;
	}

	if (type == 'loadBuilding') {
		extra = '/building/' + value.id;
	}

	if (type == 'submitSearch') {
		window.currentSearchHash = hash;
	}

	window.location.hash = 'search/' + searchHash + extra;

	var hashContext = {
		type: type,
		value: value
	};
	hashContexts[searchHash + extra] = hashContext;
	lastHashContext = hashContext;
}

function updateHash(segment) {
	var searchID = window.currentSearchHash;

	if ('history' in window && 'replaceState' in history) {
		history.replaceState(null, null, '#search/' + searchID + '/' + segment);
	}
}

function loadHash(hash, callback) {
	var hashContext = hashContexts[hash];
	if (!hashContext) {
		if (callback) { callback(true); }
		return;
	}
	switch (hashContext.type) {
		case 'submitSearch':
			if (window.currentSearchHash == hash.split('/')[0]) {
				if (callback) { callback(); }
				return;
			}

			var search = hashContext.value;

			window.searchType = search.type;

			deserializeFilters(search.condition, function () {
				ignoreNextSaveHash = true;
				updateMapAndSubmit();

				$('#search-id').val(search._id || search.id);
				$('#search-name').val(search.name);
				$('#search-name-original').val(search.nameOriginal);

				if (callback) {
					callback();
				} else {
					if (Responsive.isHandheld) {
						showMap(true);
					} else {
						showFilters(true);
					}
				}
			});

			break;
		case 'loadListing':
			var id = hashContext.value.id;
			ignoreNextSaveHash = true;

			ACTIONS.viewEntity({ type: 'Listing', id: id, template: hashContext.value.template });

			break;

		case 'loadBuilding':
			var id = hashContext.value.id;
			ignoreNextSaveHash = true;

			ACTIONS.viewEntity({ type: 'Building', id: id });

			break;
	}
}

var storedSearchKey = 'stored_search';

function storeCondition(condition) {
	$.jStorage.set(user._id + storedSearchKey, condition);
}

function retrieveCondition() {
	var search = window.initialSearch;
	if (search) {
		if (search.err) {
			window.initialRightPanel = null;
			bootbox.dialog({
				message: search.err,
				title: 'Load Search Failed',
				buttons: {
					cancel: {
						label: 'OK',
						className: 'btn-default',
						callback: function () {
						}
					}
				}
			});

			return null;
		} else if (search.condition) {
			return window.initialSearch.condition;
		}
	}

	var condition = $.jStorage.get(user._id + storedSearchKey);

	if (!condition && window.defaultSearch) {
		condition = window.defaultSearch.condition;
		populateSearchForm(window.defaultSearch, { isDefault: true });
	}

	return condition;
}


/************************************/
/*           ROUTES                 */
/************************************/

var router = new Grapnel();

router.on('hashchange', function (event) {});

router.get('search/:searchID', function (data, evt) {
	var searchID = data.params.searchID;
	ensureSearch(searchID, function () {
		var scene = Responsive.getCurrentScene();
		if (scene && scene !== 'details') {
			updateHash(scene);
		}
	});
});

router.get('search/:searchID/map', function (data, evt) {
	var searchID = data.params.searchID;
	ensureSearch(searchID, function () {
		showMap(window.grid && window.grid.sortLocally);
	});
});

router.get('search/:searchID/list', function (data, evt) {
	var searchID = data.params.searchID;
	ensureSearch(searchID, function () {
		showList();
	});
});

router.get('search/:searchID/filters', function (data, evt) {
	var searchID = data.params.searchID;
	ensureSearch(searchID, function () {
		showFilters();
	});
});

router.get('search/:searchID/:entity/:entityID', function (data, evt) {
	var searchID = data.params.searchID;
	var entity = data.params.entity;
	var entityID = data.params.entityID;

	var reserved = ['list', 'map', 'filters', 'details', 'table'];

	// Multiple routes can be triggered so prevent any of the system sub-functions
	// from carrying on any further
	if (jQuery.inArray(entity, reserved) !== -1) {
		return;
	}

	ensureSearch(searchID, function (err) {
		if (err) { return; }
		ACTIONS.viewEntity({ type: entity[0].toUpperCase() + entity.substring(1), id: entityID });
	});
});


function addDeleteIcon($el) {
	$el.parent().prepend('<span class="delete-grid-filter hidden-xs hidden-sm"><img src="/images/x.png?00000001" class="delete-search-icon"></span>');
}

function streetGridIconsToDelete() {
	if ($('select[name="streetGridNorth"]').val() !== '') {
		addDeleteIcon($('select[name="streetGridNorth"]'));
	}
	if ($('select[name="streetGridSouth"]').val() !== '') {
		addDeleteIcon($('select[name="streetGridSouth"]'));
	}
	if ($('select[name="streetGridEast"]').val() !== '') {
		addDeleteIcon($('select[name="streetGridEast"]'));
	}
	if ($('select[name="streetGridWest"]').val() !== '') {
		addDeleteIcon($('select[name="streetGridWest"]'));
	}
}

function ensureSearch(id, callback) {
	loadHash(id, callback);
}

Responsive.registerScenes(
	// List of possible scenes
	['filters', 'list', 'map', 'details', 'table', 'summary'],
	// Current scene
	'map',
	// Selector map (if needed) - by default
	// split-<scene-name> will be used
	{
		'filters': '.split-filters',
		'list': '.split-list',
		'map': '.split-map',
		'details': '.split-details',
		'table': '.split-listtable',
		'summary': '.split-listsummary'
	}
);

function serializeFilters(forSave, forClient, opts) {
	if (forClient) {
		$('#filters-form').find('.client-only').prop('disabled', false);
	}

	var form = $('#filters-form').find(':input').filter(':not(.not-searchable)');

	if (forSave) {
		// Exclude max/min longitudes when there is a drawn map shape
		if (form.is('[name=geometry]') || form.is('[name=streetgrid]')) {
			form = form.not('#maxlatitude,#maxlongitude,#minlatitude,#minlongitude');
		}

		form = form.not('#loc');
	}

	if (opts && opts.ignoreBoundingBox) {
		form = form.not('#latitude,#longitude,[name=latitude],[name=longitude],[name="$zoom"]');
	}

	if (window.searchType == 'v3link' || form.is('[name=listingID],[name=webID]')) {
		form = form.filter('[name=listingID],[name=webID],[name="$gid"],[name="$zoom"]');
	}

	if (forClient) {
		form = form.not('.client-strip');
	}

	var conditionSerialized = form.serialize();

	if (forClient) {
		$('#filters-form').find('.client-only').prop('disabled', true);
	}

	var filteredCondition = pareEmptyConditions(conditionSerialized);

	return filteredCondition;
}

function pareEmptyConditions(conditionSerialized, opts) {
	var filteredCondition = conditionSerialized.replace(/[^&]+=\.?(&|$)/g, '').replace(/&$/, '');

	if (!opts || !opts.strict) {
		['class', 'availability'].forEach(function (p) {
			if (filteredCondition.indexOf(p) == -1) {
				filteredCondition += '&' + p + '=';
			}
		});
	}

	return filteredCondition;
}

function getConditionValue(condition, name) {
	var re = new RegExp('[?|&]' + encodeURIComponent(name) + '=(.*?)&');
	var matches = re.exec('&' + condition + '&');
	if (!matches || matches.length < 2) { return null; }
	return decodeURIComponent(matches[1].replace('+', ' '));
}

function parseQueryString(qs, selectMap) {
	var parsed = {};
	var segments = qs.split('&');
	var segment;
	var idx;
	var split;

	for (var i = 0, l = segments.length; i < l; i++) {
		segment = segments[i];
		idx = segment.indexOf('=');
		split = [segment.substring(0, idx), segment.substring(idx + 1, idx + segment.length - idx)];

		if (selectMap && !selectMap[split[0]]) {
			continue;
		}

		if (parsed.hasOwnProperty(split[0])) {
			if (parsed[split[0]] instanceof Array) {
				parsed[split[0]].push(split[1]);
			} else {
				parsed[split[0]] = [parsed[split[0]]].concat(split[1]);
			}
		} else {
			parsed[split[0]] = split[1];
		}
	}

	return parsed;
}

var CURRENT_GID = null;
function deserializeFilters(condition, cb, opts) {
	var gid = getConditionValue(condition, '$gid');
	var zoom = getConditionValue(condition, '$zoom') == null;

	if ((opts && opts.quiet) || (gid == CURRENT_GID && condition === CURRENT_DESERIALIZED_CONDITION)) {
		if (cb) { cb(); }
		return;
	}

	CURRENT_GID = gid;

	if (gid && (user && user.gids && $.inArray(gid, user.gids) > -1)) {
		$('#gid').val(gid);
		loadCustomerFilters(gid, function () {
			deserializeFiltersImpl(condition);
			LocationManager.update(gid, { autoPan: false, quiet: true, zoom: zoom });
			if (cb) { cb(); }
		});
	} else {
		deserializeFiltersImpl(condition);
		LocationManager.update(gid, { autoPan: false, quiet: true, zoom: zoom });
		if (cb) {
			cb();
		}
	}
}

var CURRENT_DESERIALIZED_CONDITION = undefined;

function deserializeFiltersImpl(condition, options) {
	if (condition === CURRENT_DESERIALIZED_CONDITION) {
		return;
	}

	CURRENT_DESERIALIZED_CONDITION = condition;

	options = options || {};

	// If we don't have a search then prepare the form
	// as if it's a sale search.
	if (!condition) {
		if ($.jStorage.get(user._id + '-saleOrRent') == 'RENT') {
			showRentals(true);
		} else {
			showSales(true);
		}
		$('#filter-forms').show();

		ACTIONS.setCriteria(condition);

		window.filterHelpers && window.filterHelpers.onAfterDeserialize();
		return;
	}

	var form = $('#filters-form');

	form.find('input.additional-filter[type=hidden]').val('');

	form.trigger('reset');
	MapProvider.clearShapes();
	StreetGridManager.reset();

	if (form.find('[name=' + StreetGridManager.columnName + ']').length === 0) {
		form.append('<input type="hidden" name="' + StreetGridManager.columnName + '"/>');
	}

	var i;

	for (i = 0; i < 100; ++i) {
		form.append('<input type="hidden" name="' + geographyColumnName + '"/>');
	}

	var saleOrRent = getConditionValue(condition, 'saleOrRent') || $.jStorage.get(user._id + '-saleOrRent') || '';
	var clas = getConditionValue(condition, 'class') || '';
	var availability = getConditionValue(condition, 'availability') || '';

	if (saleOrRent == 'RENT') {
		showRentals();
	} else {
		showSales();
	}

	handleClassOrSaleOrRentChangeImp(form, saleOrRent, clas, availability);

	form.find(':checkbox:enabled').removeAttr('checked');

	$('#filter-forms').show();

	var showFiltersDescription = handleHiddenFields(form, condition);

	if (showFiltersDescription && !options.disableDescription) {
		describeFilters(null, condition);
	}

	handleMinMaxPrices(condition, form);

	// do this up here so that elements are properly hidden prior to deserialization
	handleDynamicFields(condition);

	try {
		form.deserialize(condition);
	} catch (e) {
		console.log(e);
	}

	//resetLatLongForm();
	streetGridIconsToDelete();

	processRangeFields(form);

	window.filterHelpers && window.filterHelpers.onAfterDeserialize();

	form.find('#form-listingids').remove();
	var listingIDs = [];
	form.find('[name=listingID]').each(function () {
		listingIDs.push(this.value);
	});

	// This is handled by the shapes/tags manager now, as listingID is now supported in autocomplete.
	if (false && listingIDs.length) {
		form.find('#filter-tabs').before(['<div id="form-listingids">', listingIDs.join(', '), '<span class="input-clear-btn" onclick="clearListingIDs(this, true);"></span></div>'].join(''));
	}

	form.children('input[name=' + geographyColumnName + ']').each(function () {
		var val = $(this).val();
		if (!val) { $(this).remove(); return; }

		var points = val.substr(12, val.length - 14).split(', ');
		var latLngs = [];

		for (var i = 0, len = points.length; i < len; ++i) {
			var point = points[i].split(' ');
			latLngs.push(MapProvider.getLatLng(point[1], point[0]));
		}
		MapProvider.addShape(latLngs);
	});

	var streetGridVal = $('input[name=' + StreetGridManager.columnName + ']', form).val();
	StreetGridManager.addWKTShape(streetGridVal);

	describeAdditionalFilters();

	// Force re-evaluation of go button and x display
	$('#loc,#locmap').trigger('keyup');

	form.find('.btn-group > .btn:has(input)').removeClass('active');
	form.find('.btn-group > .btn:has(input:checked)').addClass('active');

	var orderby = form.find('#orderby').val();
	resetOrderby(orderby);

	// Trigger a form change to account for any form values that may have
	// been changed as a result of processing the passed-in condition
	formChanged();
}

function resetOrderby(orderVal) {
	$('.orderby-menu').children().removeClass('active');
	var clsMap = {
		'address': 'orderby-menu-address-asc',
		'price': 'orderby-menu-price-asc',
		'price desc': 'orderby-menu-price-desc',
		'bedrooms desc, price': 'orderby-menu-beds-desc',
		'bathrooms desc, price': 'orderby-menu-baths-desc',
		'daysOnMarket, price': 'orderby-menu-dom-asc',
		'squareFeet desc': 'orderby-menu-sqft-desc',
		'status, price': 'orderby-menu-status-asc'
	};

	//convert orderby for searches previously saved with listPrice
	if (orderVal && orderVal.indexOf('listPrice') > -1) {
		orderVal = orderVal.replace('listPrice', 'price');
	}

	$('#orderby').val(orderVal);
	$('.orderby-menu').children('.' + clsMap[orderVal || 'price']).addClass('active');
	window._gridOrder = orderVal || 'price asc';
}

function describeAdditionalFilters() {
	var form = $('#filters-form');

	var descriptionContainer = form.find('.additional-filters-description').hide().find('.description');
	if (form.find('#additional-filters-button').length) {
		describeFilters(descriptionContainer, form.find('.additional-filter,[name="$gid"]').serialize(), function (description) {
			if ($(description).text().length) { form.find('.additional-filters-description').show(); }
		});
	}
}

function clearListingIDs(button, clearSearchType) {
	if (clearSearchType === true) { window.searchType = ''; }
	var form = $('#filters-form');
	form.children('[name=listingID], [name=webID]').remove();
	$(button).parent().remove();
	form.change();
}

function resetLatLongForm() {
	var mapSettings = getMapSettings();
	var start = mapSettings.defaultLocation;

	$('#zoom').val(start.zoom);
	$('#latitude').val(start.latitude);
	$('#longitude').val(start.longitude);
}

function updateMapAndSubmit(gid, callback) {
	var mapSettings = getMapSettings(gid);
	var start = mapSettings.defaultLocation;

	var latitude = $('#latitude').val() || start.latitude;
	var longitude = $('#longitude').val() || start.longitude;

	//Change center if there is a gid
	var center = MapProvider.getLatLng(latitude, longitude);
	var zoom = ($('#zoom').val() || start.zoom) * 1;

	var currentCenter = MapProvider.map.getCenter();
	var currentZoom = MapProvider.map.getZoom();

	// Check if the map needs to be panned and/or zoomed and set map
	// options if so, which will automatically submit the search.
	// Otherwise just set the map type and submit the search here.
	if (!center.equals(currentCenter) || zoom != currentZoom) {
		MapProvider.panTo(center, zoom, null, callback);
	} else {
		//#783, update bounds as viewport might be different
		var bounds = MapProvider.map.getBounds();
		var sw = bounds.getSouthWest();
		var ne = bounds.getNorthEast();

		$('#minlatitude').val('>=' + sw.lat.toString());
		$('#maxlatitude').val('<=' + ne.lat.toString());
		$('#minlongitude').val('>=' + sw.lng.toString());
		$('#maxlongitude').val('<=' + ne.lng.toString());

		updateGeographyAndSubmitForm();

	}
}

var regexMap = {};
function getListingIDRegex() {
	var gid = $('#gid').val() || '';

	if (regexMap.hasOwnProperty(gid)) {
		return regexMap[gid];
	}

	var settings = getGidSetting(gid, 'listingIDPattern', mapContext);
	var re = new RegExp(settings, 'gi');
	regexMap[gid] = re;

	return re;
}

function updateLocation(el) {
	var location;

	if (el.tagName == 'INPUT') {
		location = $(el).val();
	} else if (el.tagName == 'BUTTON') {
		location = $(el).closest('.form-group').find('input[name="$loc"]').val();
	} else {
		location = $('#loc').val();
	}

	var form = $('#filters-form');

	form.children('[name=listingID], [name=webID]').remove();

	var listingIDRegex = getListingIDRegex();

	// Look for MLS numbers.
	var matches = location.match(listingIDRegex);

	if (matches) {
		// Remove duplicates.
		matches = matches.filter(function (v, i, t) { return t.indexOf(v) === i; });

		$('#loc').val(matches.join(', '));

		if (!isTouchscreen) {
			$('#loc').select();
		}
		if (matches.length == 1) {
			centerOnListing(matches[0]);
		} else {
			centerOnListings(matches);
		}
	} else {
		MapProvider.centerOnLocation(location);
	}
}

function centerOnListing(id) {
	var form = $('#filters-form');
	var data = 'listingID=' + id.toUpperCase() + '&webID=' + id.toUpperCase();
	var action = form.attr('action');

	currentSearchRequest = $.ajax({
		dataType: 'json',
		type: 'get',
		url: action,
		data: data,
		success: function (listings) {
			if (!listings || listings.length === 0) {
				var listingTerm = window.listingNumberTerm || 'MLS#';
				alert('Could not find ' + listingTerm + ' ' + id);
				return;
			}

			var listing = listings[0];
			var latLng = MapProvider.getLatLng(listing.latitude, listing.longitude);
			MapProvider.panTo(latLng, 18);

		}
	});

	currentSearchRequest.gaType = 'ignore';
}

function centerOnListings(ids) {
	var form = $('#filters-form');

	for (var i = 0; i < ids.length; ++i) {
		var id = ids[i].toUpperCase();

		var listingID = document.createElement('input');
		listingID.type = 'hidden';
		listingID.name = 'listingID';
		listingID.value = id;

		form.append(listingID);
	}

	form.submit();
}

function updateCurrentPosition() {
	if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(function (position) {

			var mapSettings = getMapSettings();

			var latLng = MapProvider.getLatLng(
				position.coords.latitude || mapSettings.latitude,
				position.coords.longitude || mapSettings.longitude
			);

			MapProvider.panTo(latLng, 16);
		});
	}
}

var updateGeographyTimeout;
function updateGeographyAndSubmitForm() {

	var state = MapProvider.getMapState();

	setGeographyCriteria(state);

	//clearListAndMarkers();
	var form = $('#filters-form');

	form.children('input[name=' + geographyColumnName + ']').remove();

	for (var i = 0; i < MapProvider.shapes.length; ++i) {
		var shape = MapProvider.shapes[i];

		var wkt = MapProvider.getShapeAsWkt(shape);

		var geography = document.createElement('input');
		geography.type = 'hidden';
		geography.name = geographyColumnName;
		geography.value = '?#' + wkt;

		form.append(geography);
	}

	if ('StreetGridManager' in window) {
		StreetGridManager.appendStreetGridPolygon(form);
	}

	if (updateGeographyTimeout) {
		clearTimeout(updateGeographyTimeout);
	}

	updateGeographyTimeout = window.setTimeout(function () {
		formChanged();
	}, 100);
}

function numberToRadius(number) {
	return number * Math.PI / 180;
}

function numberToDegree(number) {
	return number * 180 / Math.PI;
}

var getMsveDirection = function (x, y) {
	if (x == 1) {
		if (y == 1) {
			return '3';
		} else if (y === 0) {
			return '1';
		}
	} else if (x === 0) {
		if (y == 1) {
			return '2';
		} else if (y === 0) {
			return '0';
		}
	}
	return '';
};

var getMsveString = function (x, y, z) {
	var rx;
	var ry;
	var s = '';
	for (var i = 17; i > z; i--) {
		rx = x % 2;
		x = Math.floor(x / 2);
		ry = y % 2;
		y = Math.floor(y / 2);
		s = getMsveDirection(rx, ry) + s;
	}
	return s;
};

var getMsveServer = function (x, y, z) {
	var rx;
	var ry;
	var s = '';
	for (var i = 17; i > z; i--) {
		rx = x % 2;
		x = Math.floor(x / 2);
		ry = y % 2;
		y = Math.floor(y / 2);
		s = getMsveDirection(rx, ry);
	}
	return s;
};

var isTouchscreen = navigator.userAgent.match(/Android|BlackBerry|iPhone|iPad|iPod|Opera Mini|IEMobile/i);

function toggleGoButton() {
	var v1 = $('#loc').val();
	var v2 = $('#locmap').val();

	if ((v1 || v2 || '').length) {
		$('.btn-location').removeAttr('disabled');
	} else {
		$('.btn-location').attr('disabled', 'disabled');
	}
}

function getScrollBarWidth() {
	var inner = document.createElement('p');
	inner.style.width = '100%';
	inner.style.height = '200px';

	var outer = document.createElement('div');
	outer.style.position = 'absolute';
	outer.style.top = '0px';
	outer.style.left = '0px';
	outer.style.visibility = 'hidden';
	outer.style.width = '200px';
	outer.style.height = '150px';
	outer.style.overflow = 'hidden';
	outer.appendChild(inner);

	document.body.appendChild(outer);
	var w1 = inner.offsetWidth;
	outer.style.overflow = 'scroll';
	var w2 = inner.offsetWidth;
	if (w1 == w2) w2 = outer.clientWidth;

	document.body.removeChild(outer);

	return (w1 - w2);
}

function populateAdditonalFilters(html) {
	window.onAfterDeserializeAdditonalFilters = function () {};

	var $modalBody = $('#additional-filters-dialog .modal-body');
	$modalBody.scrollTop(0);
	$modalBody.css('max-height', ($(window).height() - 120) + 'px').html(html);
	var condition = serializeFilters(false);
	var $form = $('#additional-filters-form');

	$form.find(':checked').removeAttr('checked');

	var filterHelpers = new FilterHelpers($form, $modalBody);

	var i;

	for (i = 0; i < 100; ++i) {
		$form.append('<input type="hidden" name="' + geographyColumnName + '"/>');
	}

	handleHiddenFields($form, condition, [ 'exclusiveAgentIDs', 'listAgentIDs', 'building.mgtAgent', 'building.mgtAgentDescription' ]);

	var saleOrRent = getConditionValue(condition, 'saleOrRent') || '';
	var clas = getConditionValue(condition, 'class') || '';
	var availability = getConditionValue(condition, 'availability') || '';

	toggleAdditionalFilterTabs(saleOrRent.toLowerCase());
	handleClassOrSaleOrRentChangeImp($form, saleOrRent, clas, availability);

	$form.find('.btn-sales').on('click', function () {
		toggleAdditionalFilterTabs('sale');
		$form.trigger('change');
	});
	$form.find('.btn-rentals').on('click', function () {
		toggleAdditionalFilterTabs('rent');
		$form.trigger('change');
	});

	$form.deserialize(condition);

	var mgtAgentCriteria = parseQueryString(condition, { 'building.mgtAgent': 1 });
	if (mgtAgentCriteria['building.mgtAgent']) {
		var mgtAgents = mgtAgentCriteria['building.mgtAgent'];
		(mgtAgents instanceof Array ? mgtAgents : [mgtAgents]).forEach(function (ma) {
			$form.find('select[name="building.mgtAgentDescription"] option[data-id="' + ma.replace('%3F%5D','') + '"]').attr('selected', 'selected');
		});
	}

	DatePicker.create($form.find('input[data-datatype=date]'), { minimumDays: getGidSetting($('#gid').val(), 'filtersMinimumDays', mapContext) });

	$form.find('input[data-datatype=number]').mask('0#');
	$.applyDataMask();

	handleMinMaxPrices(condition, $form);

	processRangeFields($form);

	filterHelpers.onAfterDeserialize();
	window.onAfterDeserializeAdditonalFilters();

	$form.children('input[name=' + geographyColumnName + ']').each(function () {
		var val = $(this).val();
		if (!val) { $(this).remove(); }
	});

	$form.find('.btn-group > .btn:has(input)').removeClass('active');
	$form.find('.btn-group > .btn:has(input:checked)').addClass('active');

	var $count = $('#additional-filters-dialog .count');
	$count.text(accounting.formatNumber(window.listingFullCount));

	if ($.fn.placeholder) {
		$form.find('input[placeholder]').placeholder();
	}

	$form.find(':text').on('keyup', $.debounce(handleAdditionalFiltersChange, 750));
	$form.change($.debounce(handleAdditionalFiltersChange, timeout));

	$form.find('input[name=saleOrRent], input[name=class]').change(function () {
		handleClassOrSaleOrRentChange($form);
	});
}

function handleAdditionalFiltersChange(e) {
	preprocessChangeEvent(e);

	submitFullCount($('#additional-filters-form'), function (count) {
		$('#additional-filters-dialog .default-spinner').hide();
		$('#additional-filters-dialog .result-info').show();
		$('#additional-filters-dialog .count').text(accounting.formatNumber(count));
	}, function () {
		$('#additional-filters-dialog .result-info').hide();
		$('#additional-filters-dialog .default-spinner').show();
	});
}

function toggleAdditionalFilterTabs(activeTab) {
	$('#additional-filters-form #saleOrRent-' + activeTab).tab('show');
	$('#additional-filters-form #saleOrRent').val(activeTab.toUpperCase());

	handleClassOrSaleOrRentChange($('#additional-filters-form'));
}

function handleClassOrSaleOrRentChange($form) {
	var saleOrRent = $form.find('input[name=saleOrRent]:checked,input[name=saleOrRent][type=hidden]').val();
	var clas = $form.find('input[name=class]:checked').val();
	var availability = $form.find('input[name=availability]:checked').val();

	handleClassOrSaleOrRentChangeImp($form, saleOrRent, clas, availability);
}

function handleClassOrSaleOrRentChangeImp($form, saleOrRent, clas, availability) {
	var srValues = ['SALE', 'RENT'];
	var classValues = ['UNIT', 'BUILDING', 'FREE', 'CONDO', ''];
	var availabilityValues = ['A', 'U', ''];

	var showSelectors = [];

	availabilityValues.forEach(function (a) {
		var aLower = a.toLowerCase();
		var selector = '.availability-' + aLower;

		if (availability == a) {
			showSelectors.push(selector);
		} else {
			$form.find(selector).hide().find(':input').prop('disabled', true);
		}
	});

	classValues.forEach(function (c) {
		var cLower = c.toLowerCase();
		var selector = '.class-' + cLower;

		if (clas == c) {
			showSelectors.push(selector);
		} else {
			$form.find(selector).hide().find(':input').prop('disabled', true);
		}
	});

	srValues.forEach(function (sr) {
		var srLower = sr.toLowerCase();

		var selector = '.saleOrRent-' + srLower;
		if (saleOrRent == sr) {
			showSelectors.push(selector);
		} else {
			$form.find(selector).hide().find(':input').prop('disabled', true);
		}

		classValues.forEach(function (c) {
			var cLower = c.toLowerCase();
			var selector = '.saleOrRent-' + srLower + '-class-' + cLower;

			if (saleOrRent == sr && clas == c) {
				showSelectors.push(selector);
			} else {
				$form.find(selector).hide().find(':input').prop('disabled', true);
			}
		});

		availabilityValues.forEach(function (a) {
			var aLower = a.toLowerCase();
			var selector = '.saleOrRent-' + srLower + '-availability-' + aLower;

			if (saleOrRent == sr && availability == a) {
				showSelectors.push(selector);
			} else {
				$form.find(selector).hide().find(':input').prop('disabled', true);
			}
		});
	});

	if (showSelectors.length) {
		$form.find(showSelectors.join(', ')).show().find(':input').prop('disabled', false);
	}

	$form.find('select[multiple=multiple]').each(function () {
		var multiselect = $(this).data('multiselect');
		if (!multiselect) { return; }
		multiselect[$(this).is(':enabled') ? 'enable' : 'disable']();
	});
}

function handleMinMaxPrices(condition, $form) {
	var minPrice = getConditionValue(condition, '_min_price') || '';
	var maxPrice = getConditionValue(condition, '_max_price') || '';
	if (minPrice.length) {
		minPrice = minPrice.replace(/(\d)(?=(\d\d\d)+(?!\d))/g, '$1,');
		var $input = $form.find('input[name=_min_price]:enabled');
		$input.val(minPrice).parent().show().next().hide();
		handleMinPrice($input);
	}
	if (maxPrice.length) {
		maxPrice = maxPrice.replace(/(\d)(?=(\d\d\d)+(?!\d))/g, '$1,');
		var $input = $form.find('input[name=_max_price]:enabled');
		$input.val(maxPrice).parent().show().next().hide();
		handleMaxPrice($input);
	}
}

function handleCancelCustomPrice($el) {
	$el.prev().val('').parent().hide();
	var dropDownList = $el.parent().next();
	dropDownList.prop('selectedIndex', 0).show().find('option:first').val('');

	$el.trigger('change');
}

function handleMinPrice($el) {
	var dropDownList = $el.parent().next();
	dropDownList.prop('selectedIndex', 0);
	if ($el.val().length > 1) {
		var val = $el.val().replace(/[^\d\.]/g, '');
		dropDownList.find('option:first').val('>=' + val);
	} else {
		dropDownList.find('option:first').val('');
	}
}

function handleMaxPrice($el) {
	var dropDownList = $el.parent().next();
	dropDownList.prop('selectedIndex', 0);
	if ($el.val().length > 1) {
		var val = $el.val().replace(/[^\d\.]/g, '');
		dropDownList.find('option:first').val('<=' + val);
	} else {
		dropDownList.find('option:first').val('');
	}
}

function preprocessChangeEvent(e) {
	var $el = (e && e.target && $(e.target));

	if ($el && $el.is('[data-searchtype=range]')) {
		var $form = $el.closest('form');
		setMinMaxValues($form, $el);
	}

	if ($el && $el.is('select[name=price]') && $el.val() === 'Custom') {
		var $customPriceInput = $el.hide().val('').prev().show().find('input');
		if (!Responsive.Platforms.iOS) {
			$customPriceInput.focus();
		}
	}

	if ($el && $el.is('input[name=_min_price]')) {
		return handleMinPrice($el);
	}

	if ($el && $el.is('input[name=_max_price]')) {
		return handleMaxPrice($el);
	}

	if ($el && $el.is('[data-datatype=number]')) {
		var value = $el.val().replace(/[^\d\.]/g, '');
		$el.val(value);
	}
}

function processRangeFields($form) {
	var $ranges = $form.find('input[data-searchtype=range]');
	var map = {};

	$ranges.each(function (i, range) {
		var n = range.name;
		var property = (n || '').split('_', 2)[1];

		if (map[property]) { return; }

		map[property] = 1;

		$form.find('input[name="' + property + '"]').each(function (i, input) {
			var value = input.value || '';

			if (value.length) {
				var ops = {
					'>=': 1,
					'<=': 1
				};

				var op = ops[0];
				if (value.length >= 2 && ops[value.substr(0, 2)]) {
					op = value.substr(0, 2);
					value = value.substr(2);
				}

				$form.find('input[name="' +  ((op == '<=') ? 'max_' : 'min_')  + property + '"]').val(value);
			}
		});
	});
}

function setMinMaxValues($form, $input) {
	if (!$input.length) { return; }

	var property = $input[0].name.split('_', 2)[1];

	var min = $form.find('input[name="min_' + property + '"]').val();
	var max = $form.find('input[name="max_' + property + '"]').val();

	var values = [];
	if ((min || '').length) { values.push('>=' + min); }
	if ((max || '').length) { values.push('<=' + max); }

	$form.find('input[name="' + property + '"]').each(function (i, input) {
		input.value = values[i] || '';
	});
}


function _updateListings(listings) {
	var originalListings = DataSetStore.get();

	var count = listings.length;
	var fullCount = (originalListings[0] || []).full_count;

	if (fullCount >= 0 || count != 100) {
		updateCountDisplay(count, fullCount);
	}

	ACTIONS.setDataSet(listings);

	if ($('.list').is(':visible')) {
		updateListingList(listings);
	} else {
		setTimeout(function () {
			updateListingList(listings);
		}, 500);
	}

	MapProvider.clearMarkers();
	MapProvider.addMarkers(listings);

	listings.full_count = fullCount;

	loadQuickDetails();
}

var _listState = [];

function expandList() {
	var state = _listState.pop();
	var selections = SelectionsStore.getAll() || [];

	if (state) {
		window._expandedListings = state.expanded;

		ACTIONS.setDataSet(state.basic);
		ACTIONS.setSelections(selections.concat(state.selections || []));

		_updateListings(state.basic);
		if ($('.listsummary').is(':visible')) {
			if (state.reloadListSummary) {
				updateListingsSummary(state.expanded, selections.concat(state.selections || []), true);
			} else {
				_updateListingsSummary(state.expanded, selections.concat(state.selections || []));
			}
		} else {
			if (state.reloadGrid) {
				updateListingsGrid(state.expanded, false, selections.concat(state.selections || []), true);
			} else {
				_updateListingsGrid(state.expanded, {
					columnSet: ColumnsetStore.get(),
					selections: selections.concat(state.selections || []),
					columnOrder: ColumnsetStore.getColumnOrder()
				});
			}
		}
	}
}

function narrowList() {
	if (!$('.list-narrow-btn').hasClass('disabled')) {
		_filterList(true);
	}
}

function removeListRows() {
	_filterList(false);
}

function _filterList(invert, clearSelections) {
	var selections = SelectionsStore.getAll();
	var selectionIds = SelectionsStore.getAllIDs();

	var expandedListings = (window._expandedListings || []).slice(0);
	var basicListings = (DataSetStore.get() || []).slice(0);

	if (!grid) {
		return ColumnsetAPI.get(window.user, GidStore.get(), CriteriaStore.get(), function (columnSet, columnOrder) {
			var options = {
				columnSet: columnSet,
				columnOrder: columnOrder
			};
			_updateListingsGrid(_expandedListings, options);
			_filterList(invert, clearSelections);
		});
	}

	grid.sortLocally = true;

	var filteredExpanded = [];
	var filteredBasic = [];

	var map = {};

	if (clearSelections) {
		grid.clearSelections();
	}

	var reloadGrid = false;
	var reloadListSummary = false;

	$.each(expandedListings, function (i, o) {
		reloadGrid = reloadGrid || !o.$expandedForGrid;
		reloadListSummary = reloadListSummary || !o.$expandedForSummary;

		var idx = $.inArray(o._id, selectionIds);
		if (invert && idx === -1 || !invert && idx > -1) {
			$('.listtable tr[data-id="' + o._id + '"]').remove();
			$('.listsummary li[data-id="' + o._id + '"]').remove();
			return;
		}
		map[o._id] = 1;
		filteredExpanded.push(o);
	});

	_listState.push({ basic: basicListings, expanded: expandedListings, selections: selections, reloadGrid: reloadGrid, reloadListSummary: reloadListSummary });

	$.each(basicListings, function (i, o) {
		if (map[o._id]) {
			filteredBasic.push(o);
		}
	});

	window._expandedListings = filteredExpanded;

	_updateListings(filteredBasic);

	updateStatistics(filteredExpanded, $('.listsummary').is(':visible') ? $('.listsummary') : $('.listtable'));

	// force grid state to refresh
	grid.update(true);
	updateListState();
}

function sendListTable(sms) {
	// Get all keys if none selected
	var selectedKeys = SelectionsStore.getAllIDs();
	var dataSet = DataSetStore.get();
	var currentKey = (CurrentViewStore.get() || {}).id;

	var allKeys = null;
	if (selectedKeys.length != dataSet.length) {
		allKeys = jQuery.map(dataSet, function (e) {return e._id; });
	}

	if (selectedKeys.length === 0 && !currentKey && !allKeys) { return; }

	// If we're coming from the details page and the only selection is the
	// current listing then hide the selected keys and only set currentKey.
	if (isDetails()) {
		if (selectedKeys.length == 1 && selectedKeys.indexOf(currentKey) > -1) {
			selectedKeys = [];
		}
	} else {
		currentKey = null;
	}

	if (allKeys && allKeys.length == 1 && currentKey) {
		allKeys = null;
	}

	var selectedIds = selectedKeys.join(',');

	var allIds = (allKeys ? '&allKeys=' + allKeys.join(',') : '');
	var dataQuerystring =  allIds + (selectedIds ? ('&selectedKeys=' + selectedKeys) : '')  + (currentKey ? ('&currentKey=' + currentKey) : '');
	var querystring = '?type=listing' + (sms ? '&sms' : '');
	var $form = null;
	var url;

	if (dataQuerystring.length > 2000) {
		url = '/messages/send-large' + querystring;
		$form = $(
			'<form action="' + url + '" method="post" target="sendMessagePopup">' +
				'<input type="hidden" name="allKeys" value="' + htmlEncode(allKeys.join(',')) + '" />' +
				(selectedIds ? '<input type="hidden" name="selectedKeys" value="' + htmlEncode(selectedKeys.join(',')) + '" />' : '') +
				(currentKey ? '<input type="hidden" name="currentKey" value="' + htmlEncode(currentKey) + '" />' : '') +
			'</form>'
		);

		url = '';
	} else {
		url = '/messages/send' + querystring;
		url += dataQuerystring;
	}

	var maxHeight = $(window).height();
	var popupHeight = Math.min(sms ? 600 : 900, maxHeight);

	window.open(url, 'sendMessagePopup', 'toolbar=no, status=no, menubar=no, scrollbars=no, resizable=no, location=no, directories=no, width=800, height=' + popupHeight);

	if ($form) {
		window.setTimeout(function () { $form.submit(); }, 250);
	}

	return false;
}

function exportCsv(e) {
	var form = $('#export-form');
	var keys = SelectionsStore.getAllIDs();

	if (!keys || !keys.length) {
		keys = (DataSetStore.get() || []).map(function (v) { return v._id; });
	}

	var html = ['<input type="hidden" name="$export" value="" /><input type="hidden" name="$output" value="list" />'];
	var search = form.data('condition');
	$.each(search.split('&'), function (i, kv) {
		if (!kv.length) {
			return;
		}

		kv = kv.split('=');
		html.push('<input type="hidden" name="');
		html.push(decodeURIComponent(kv[0]));
		html.push('" value="');
		html.push(decodeURIComponent((kv[1] || '').replace(/\+/g, ' ')));
		html.push('" />');
	});

	$.each(keys, function (i, id) {
		html.push('<input type="hidden" name="_id" value="');
		html.push(id);
		html.push('" />');
	});

	form.html(html.join(''));
	form.submit();
	e.preventDefault();
	return false;
}


function exportPdf(isPrint) {

	// Get all keys if none selected
	var current = isDetails() ? (CurrentViewStore.get() || {}).id : null;
	var selected = SelectionsStore.getAllIDs();

	var all = $.map(DataSetStore.get() || [], function (o, i)  { return o._id; });

	if (selected.length === 0 && all.length === 1) {
		current = all[0];
	}

	if (selected.length == 1 && selected[0] == current) {
		selected = null;
	}

	var $gids = window.user.$gids;
	var gid = $('#gid').val() || '';
	formSettings = formSettings || {};

	var context = {
		gid: gid,
		currentKey: current,
		selectedKeys: selected,
		allKeys: all,
		formDefinitions: (formSettings[gid] || {}).definitions || {},
		modalTitle: isPrint ? 'Print' : 'PDF Export',
		primaryButtonText: isPrint ? 'Print' : 'Export',
		allowHideHistory: !($gids.hasOwnProperty('treb') || $gids.hasOwnProperty('armls'))
	};

	$('#print-listings-dialog').remove();
	$('#export-listings-progress-dialog').remove();

	var html = pyhbs.template('print-listings-dialog', context);

	$(html)
		.data('mode', isPrint ? 'print' : 'export')
		.modal();

	return false;
}

$(document).on('click', '#print-listings-dialog .btn-primary', function () {
	var $modal = $(this).parents('#print-listings-dialog');
	var $form = $modal.find('form');

	var mode = $modal.data('mode');
	var action = $form.attr('action');
	var data = $form.serialize();

	var ids = $form.find('[name=ids][checked]').attr('value');

	data += '&printMode=' + mode;

	$.post(action, data, function (task, b) {
		if (b !== 'success') {
			return;
		}

		task.modalTitle = $('.modal-title', '#print-listings-dialog').text();

		$('#export-listings-progress-dialog').remove();

		var html = pyhbs.template('export-progress-dialog', task);
		$(html)
			.modal()
			.data('mode', mode)
			.data('length', ids.split(',').length);

		window.setTimeout(pollTask, 1500);
	});
});

function pollTask() {
	var renewTimeout = true;
	var $dialog = $('#export-listings-progress-dialog:visible');
	var currentId = $dialog.data('id');
	var mode = $dialog.data('mode');

	if ($dialog.length === 0 || !currentId) {
		return;
	}

	var jqXHR = $.get('/tasks/exports/poll/' + currentId, function (task) {
		var $dialog = $('#export-listings-progress-dialog');

		if (task.status === 'completed') {
			renewTimeout = false;

			if (task._id == currentId) {
				task.modalTitle = $('.modal-title', $dialog).text();
				task.result.url = task.result.url + '/Exported-Listings.pdf';
				$dialog.modal('hide');

				if (mode == 'print') {
					printFile(this, task.result.url + '?host=' + (task.worker || {}).host);
				} else {
					var html = pyhbs.template('export-progress-dialog', task);
					$(html).modal();
				}
			}
		} else if (task.status === 'accepted') {
			var $bar = $dialog.find('.progress-bar');
			var len = $dialog.data('length');
			var duration = Math.max(len * 550, 8000);
			var transition = 'width ' + duration + 'ms ease';

			$bar.css({
				'-webkit-transition': transition,
				'transition': transition,
				'width': '98%'
			});
		}
	}).always(function () {
		if (renewTimeout) {
			window.setTimeout(pollTask, 1500);
		}
	});

	jqXHR.gaType = 'ignore';
}

function toggleEntitySelection(el) {
	var isToggled = el.checked;
	var currentID = { id: $(el).closest('[data-id]').attr('data-id'), entity: 'Listing' };

	if (isToggled) {
		ACTIONS.addSelection(currentID);
	} else {
		ACTIONS.removeSelection(currentID);
	}
}

function okhash(x) {
	if (!x || !x.length) return 0;
	for (var i = 0, h = 0; i < x.length; i++) {
		h = ((h << 5) - h) + x.charCodeAt(i) | 0;
	}
	return h;
}
