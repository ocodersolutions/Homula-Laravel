(function (global, has_require, exports, Polyglot, hbs, moment, accounting) {
    //if in a browser, `global` will be `window`

    if (has_require) {
        Polyglot = Polyglot || require('node-polyglot');
        hbs = hbs || require('express-hbs');
        moment = moment || require('moment');
        accounting = accounting || require('accounting');
    }

    var polyglot = new Polyglot({ locale: global.locale });
    var Handlebars = global.Handlebars || hbs.handlebars;

    var decorators = {
        availability: function (item, options) {
            if (item.availability && item.availability === 'U') {
                return 'ua';
            }

            return '';
        }
    };

    var specialColumns = {
        $remove: {
            header: function (context, write) {
                write('<th class="input" style="padding: 0;"></th>');
            },

            value: function (item, context, write) {
                write('<td class="input" style="padding: 0;"><span class="list-icon list-icon-remove" style="position: relative; top: 2px;"></span></td>');
            }
        },

        $simple_thumbnail: {
            header: function (context, write) {
                write('<th class="text-center" style="width:1%;"><span class="fa fa-lg fa-camera-retro"></span></th>');
            },

            value: function (item, context, write) {
            	 var lineHeight = item.images && item.images.length ? ' line-height:0;' : '';
                write('<td class="text-left" style="width:1%; padding:1px;' + lineHeight + '">');
                if (!item.images || !item.images.length) {
                    write('<span class="listing-photo"><span class="no-photo-yet">');
                    write(context.options.t('no_photo_yet', context.options));
                    write('</span></span>');
                } else {
                    if (!item.forceShow) {
                        write('<span class="df listing-photo" data-df-src="' + item.images[0] + '/150"></span>');
                    } else {
                        write('<span class="listing-photo" style="background-image:url(' + item.images[0] + '/150);"></span>');
                    }
                }
                write('</td>');
            }
        },

        $thumbnail: {
            header: function (context, write) {
                write('<th class="text-center indicator-cell" style="width:59px;" data-original-index="');
                write(context.columnIndex);
                write('"><span class="fa fa-lg fa-camera-retro"></span></th>');
            },
            value: function (item, context, write) {
                write(
                    '<td class="text-left indicator-cell" style="width:1%; padding:1px; line-height:0;">'
                        + '<div style="position:relative;">'
                            + '<span class="indicators-wrapper">'
                                + '<span class="indicators">'
                                    + '<span class="f"></span>'
                                    + '<span class="l"></span>'
                                    + '<span class="d"></span>'
                                    + '<span class="c"></span>'
                                    + '<span class="s"></span>'
                                + '</span>'
                            + '</span>'
                        + '</div>'
                        + '<span class="listing-photo">');

                if (item.images[0]) {
                    write('<img ');
                    if (!item.forceShow) {
                        write('class="df listing-photo-thumbnail" data-df-src="');
                    } else {
                        write('class="listing-photo-thumbnail" src="');
                    }

                    write(item.images[0]);
                    write('/150" />');
                } else {
                    write('<span class="no-photo-yet">');
                    write(context.options.t('no_photo_yet', context.options));
                    write('</span>');
                }

                write('</span></td>');
            }
        },

        $checkbox: {
            header: function (context, write) {
                write('<th class="input"><input type="checkbox" /></th>');
            },

            value: function (item, context, write) {
                write('<td class="input"><input type="checkbox" /></td>');
                if (context.options.$displayRemove) {
                    write('<span class="list-icon list-icon-remove"></span>');
                }

                write('</td>');
            }
        },

        $toggles: {
            header: function (context, write) {
                write('<th></th>');
            },

            value: function (item, context, write) {
                write('<td class="hcmwrapper"><div class="hcmenu quiet"><div class="hover-wrapper"></div><a data-toggle="dropdown" class="hcmenu-btn"><span class="fa fa-ellipsis-h"></span></a></div></td>');
            }
        }
    };

    var alignments = ['text-left', 'text-center', 'text-right'];

    var CsvFormatter = function (options, builder) {
        options.t = options.t || hbs.t || mirror;
        options.v = options.v || hbs.v || mirror;

        var rows = [];
        function writeHeader(headerBuilder) {
            if (rows.length < 1) {
                rows.push([]);
            }

            headerBuilder(function (context) {
                rows[0].push(getDisplayName(context.column, options).toUpperCase());
            });
        }

        function writeRow(item, index, rowBuilder) {
            var row = [];
            rows.push(row);
            rowBuilder(function (context) {
                row.push(getColumnValue(context.column, item, false, options));
            });
        }

        builder({
            writeHeader: writeHeader,
            writeRow: writeRow
        });

        return rows;
    };

    var HtmlFormatter = function (options, builder) {
        var html = [];

        options.t = options.t || hbs.t || mirror;
        options.v = options.v || hbs.v || mirror;

        function writeHeader(headerBuilder) {
            html.push('<thead><tr>');
            if (options.$displayCheckbox) {
                html.push('<th class="input"><input type="checkbox" /></th>');
            }

            headerBuilder(function (context) {
                var special = specialColumns[context.column.name];
                if (special && special.header) {
                    special.header(context, function (text) {
                        html.push(text);
                    });
                } else {
                    html.push('<th class="');
                    var alignment = context.column.alignment;
                    if (alignment !== null && alignment >= 0 && alignment < alignments.length) {
                        html.push(alignments[alignment]);
                    }

                    html.push('" data-original-index="');
                    html.push(context.columnIndex);
                    html.push('">');
                    html.push(getDisplayName(context.column, options));
                    html.push('</th>');
                }
            });

            html.push('</tr></thead>');
        }

        function writeRow(item, index, rowBuilder) {
            html.push('<tr');
            if (item._id) {
                html.push(' data-id="');
                html.push(item._id.toString());
                html.push('" data-entity="{&quot;id&quot;: &quot;');
                html.push(item._id.toString());
                html.push('&quot;}"');
            }

            if (item.$isRestricted) {
				html.push('	data-toggle="modal" data-target="#restricted-listing-dialog"');
			}

            if (item.urlOverride && !item.$isRestricted) {
               html.push(' data-href="');
               html.push(item.urlOverride);
               html.push('"');
            }

            var classes = [],
				resolved;

            if (options.$rowClassKey) {
				// it appears we're tyring to concatenate an array of strings onto classes
				// but the results of resolve might itself be an array or a string
				resolved = resolve(item, options.$rowClassKey) || '';
				if (typeof resolved === 'string') resolved = resolved.split(' ');
                classes.push.apply(classes, resolved);
            } // if

            if (options.$rowDecorators) {
                options.$rowDecorators.split(',').forEach(function (decoratorName) {
                    var decorator = decorators[decoratorName];
                    if (decorator) {
                        classes.push.apply(classes, decorator(item, options).split(' '));
                    }
                });
            }

            if (classes.length) {
                html.push(' class="');
                html.push(classes.filter(function (v) { return v.length }).join(' '));
                html.push('"');
            }

            if (options.$rowRel && !item.$isRestricted) {
                html.push(' data-rel="');
                html.push(options.$rowRel);
                html.push('"');
            }

            if (options.$rowStyle) {
                html.push(' style="');
                html.push(options.$rowStyle);
                html.push('"');
            }

            html.push('>');
            if (options.$displayCheckbox) {
                html.push('<td class="input"><input type="checkbox" /></td>');
            }

            rowBuilder(function (context) {
                var special = specialColumns[context.column.name];
                if (special && special.value) {
                    special.value(item, context, function (text) {
                        html.push(text);
                    });
                } else {
                    html.push('<td class="');
                    var alignment = context.column.alignment;
                    if (alignment !== null && alignment >= 0 && alignment < alignments.length) {
                        html.push(alignments[alignment]);
                    }

                    if (context.column.classNames) {
                        html.push(' ');
                        html.push(context.column.classNames);
                    }

                    html.push('"');
                    if (context.column.containerStyle) {
                        html.push(' style="');
                        html.push(context.column.containerStyle);
                        html.push('"');
                    }

                    html.push(' data-order="');
                    html.push(getColumnSortByValue(context.column, item));
                    html.push('">');
                    html.push(getColumnValue(context.column, item, true, options));
                    html.push('</td>');
                }
            });

            html.push('</tr>');
        }

        html.push('<table class="');
        html.push(options.$defaultTableClasses ? options.$defaultTableClasses : 'table table-hover small outline-icons');
        if (options.$tableClasses) {
            html.push(' ' + options.$tableClasses);
        }

        html.push('"');
        if (options.$tableId) {
            html.push(' data-id="', options.$tableId, '"');
        }

        if (options.$embedColumns) {
            html.push(' data-columns=\'', JSON.stringify(options.columnSet.columns || []), '\'');
        }

        if (options.$embedColumnSet) {
            html.push(' data-columnset=\'', JSON.stringify(options.columnSet || {}), '\'');
        }

        html.push('>');
        builder({
            writeHeader: writeHeader,
            writeRow: writeRow
        });

        html.push('</table>');
        return html.join('');
    };

    var formatters = {
        csv: CsvFormatter,
        html: HtmlFormatter
    };

    function renderTable(items, columnset, options, format) {
        options.columnSet = columnset;
        var formatter = formatters[format];
        function forEachColumn(iterator) {
            var columnOffset = 0;
            columnset.columns.forEach(function (column, columnIndex) {
                if (!canDisplayColumn(column, options)) {
                    columnOffset++;
                    return;
                }

                iterator(column, columnIndex - columnOffset);
            });
        }

		 columnset.columns.forEach(function (column) {
			 if (column.code) {
				column.includeCode = items.some(function(item) {
					return resolve(item, column.code) != null;
				});
			 }
		  });

        return formatter(options, function (table) {
            if (options.includeHeader) {
                table.writeHeader(function (cellWriter) {
                    forEachColumn(function (column, columnIndex) {
                        cellWriter({
                            column: column,
                            columnIndex: columnIndex,
                            options: options
                        });
                    });
                });
            }

            items.forEach(function (item, itemIndex) {
                table.writeRow(item, itemIndex, function (cellWriter) {
                    forEachColumn(function (column, columnIndex) {
                        cellWriter({
                            column: column,
                            data: item,
                            columnIndex: columnIndex,
                            itemIndex: itemIndex,
                            options: options
                        });
                    });
                });
            });
        });
    }

    function getDisplayName(column, options) {
        var name = column.displayName;
        if (name == 'listingNumberTerm') {
            name = options.listingNumberTerm;
        }

        return options.t(name, 0);
    }

    function canDisplayColumn(column, options) {
        if (column.conditional) {
            if (column.name == 'daysOnMarket') {
                if (!options.showDaysOnMarket) {
                    return false;
                }
            }
            else if (column.name == 'commissionCode') {
                var groups = options.user.gids.filter(function (g) {
                    return g == 'elliman' || g == 'agent';
                });

                if (groups.length < 2) {
                    return false;
                }
            } else if (column.name == 'foundts') {
                if (!options.showFoundColumn) {
                    return false;
                }
            } else if (column.name === '$checkbox') {
                if (!options.$displayCheckbox) {
                    return false;
                }
            }
        }

        return true;
    }

    function formatCellValue(format, value, outputHtml) {
        var result;

        if (format === 'checkmark') {
            result = value && (value === true || value === 'true' || value === 'Y') ? 'Y' : '';
            if (outputHtml) {
                result = result === 'Y' ? '<span class="check">&#x2713;</span>' : '';
            }

            return result;
        }
        else if (format === 'checkmarkExists') {
            result = typeof value !== 'undefined' && value !== null ? 'Y' : '';
            if (outputHtml) {
                result = result === 'Y' ? '<span class="check">&#x2713;</span>' : '';
            }

            return result;
        }
        else if (format === 'checkmarkDate') {
            if (!value) { return ''; }
            var dateVal = typeof value == 'string' ? new Date(value) : value;
            if (!global._todayUTC) {
                var today = new Date();
                today.setHours(0, 0, 0, 0);
                today.setMinutes(today.getMinutes() - today.getTimezoneOffset());
                global._todayUTC = today;
            }

            result = dateVal && dateVal.getTime ? (dateVal.getTime() >= global._todayUTC.getTime() ? 'Y' : '') : '';
            if (outputHtml) {
                result = result === 'Y' ? '<span class="check">&#x2713;</span>' : '';
            }

            return result;
        }
        else if (format == 'firstCharacter') {
            if (!value || !value.length) {
                return '';
            }

            result = ((value || '').trim() || 'n').toUpperCase().substr(0, 1);
            if (!global.__count) {
                global.__count = 0;
            }

            return result;
        }
        else if (format.indexOf('date') === 0) {
            if (!value) { return value; }

            var dateFormat = format.substr(4);
            var t = moment(value);
            switch (dateFormat) {
                case 'calendar':
                    return t.calendar();
                case 'from':
                    return t.fromNow();
                case 'unix':
                    return t.unix();
                case 'formal':
                    return t.format('MMM D YYYY h:mm:ss A');
                case 'sql':
                    return t.format('MM/DD/YYYY');
                case 'isodate':
                    return t.format('YYYY-MM-DD');
                case 'iso8601':
                    return t.format();
                case 'lt':
                    return t.format('LT');
                case 'dtlt':
                    return t.format('M/D/YYYY LT');
                case 'h:mm:ss A':
                    return t.format('h:mm:ss A');
                case 'short':
                    return t.format('M/D/YYYY h:mm:ss A');
                default:
                    return t.format('M/D/YYYY');

            }
        } else if (format === 'currency') {
            if (!value && value !== 0) return;
            return accounting.formatMoney(value, '$', 0);
        }

        return value;
    }

    function getColumnSortByValue (column, listing) {
        if (typeof column.sortBy !== 'undefined') {
            return resolve(listing, column.sortBy);
        } else if (column.columns) {
            var values = [];
            return column.columns.map(function (subColumn) {
                return getColumnSortByValue.call(null, subColumn, listing);
            }).join(column.delimiter || ' ');
        }

        return resolve(listing, column.name);
    }

    function getRawColumnValue(column, item) {
        var columnName = column.name;
        if (columnName === 'listPriceShort') {
            columnName = 'listPrice';
        } else if (columnName === 'pricePerSquareFoot') {
            var psqft = parseFloat((resolve(item, columnName) || '').replace(/[^\d\.\-]/g, ''));
            return isNaN(psqft) ? 0 : psqft;
        }

        return resolve(item, columnName);
    }

    function getColumnValue(masterColumn, listing, outputHtml, options) {
        options = options || {};
        var value = [];
        var columns = masterColumn.columns || [masterColumn];

        if (masterColumn.conditional) {
            if (masterColumn.name == 'daysOnMarket' && listing.gid == 'MLSLI') {
                return '';
            }
            if (masterColumn.name == 'commissionCode' && listing.gid != 'ELLIMAN') {
                return '';
            }
            if (masterColumn.name == 'listPriceShort' && listing.$isRestricted) {
                return '';
            }
        }

        var cellValues = [];
        var cellGroups = null;

        columns.forEach(function (column, index) {
            var cellValue = resolve(listing, column.name);
            if (cellValue !== null || column.format || column.group) {

                // subcolumns with "group" specified should be grouped into
                // a single html element
                var group = column.group;
                if (group && cellGroups == null) { cellGroups = {}; }
                if (group && !cellGroups.hasOwnProperty(group)) {
                    cellGroups[group] = column;
                    cellGroups[group].index = index;
                    cellGroups[group].values = [];
                }

                if (column.translate && cellValue !== null) {
                    //use 't' helper
                    if (column.translate.toLowerCase() === 'y') {
                        cellValue = options.t(cellValue, options);
                    }
                    //use 'v' helper
                    else if (column.translate.toLowerCase() !== 'n') {
                        cellValue = options.v(cellValue, column.translate, options);
                    }
                }

                if (column.format) {
                    cellValue = formatCellValue(column.format, cellValue, outputHtml);
                }

                //Make html safe. Notably, commissionCode could have a value of <Std, which would add a ghost element
                if (outputHtml && cellValue && cellValue.replace && !column.format) {
                    cellValue = cellValue.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;');
                }

                if (cellValue !== null && cellValue !== undefined) {
                    if (group) {
                        cellGroups[group].values.push(cellValue);
                        if (cellValues.length < cellGroups[group].index) {
                            cellValues.push();
                        }
                    } else if (outputHtml) {
                        var styles = column.cssStyle || '';
                        cellValues.push('<span class="' + column.name + '"' + (styles.length ? ' style="' + styles + '"' : '') + '>' + cellValue + '</span>');
                    } else {
                        cellValues.push(cellValue);
                    }
                }
            }
        });

        // join grouped sub columns
        if (cellGroups != null) {
            var groupKeys = Object.keys(cellGroups);
            groupKeys.forEach(function(key){
                var _group = cellGroups[key];
                var _index = _group.index;

                cellValues[_index] = !outputHtml ? _group.values.join(_group.delimiter || ' ') : '<div class="' + _group.name + '"' +
                    (_group.cssStyle ? ' style="' + _group.cssStyle + '"' : '') + '>' +
                    _group.values.join(_group.delimiter || ' ') + '</div>';
            });
        }

        //join clustered columns
        value = [cellValues.join(masterColumn.delimiter || ' ')];

        //add history arrow
        if (masterColumn.name === 'listPriceShort' || masterColumn.name === 'priceShort') {
			if (masterColumn.includeCode) {
				value.push('<div style="display:inline-block; width:16px; text-align:left;">');
				var codeValue = resolve(listing, masterColumn.code);
				if (codeValue) {
					value.push('<span style="font-weight: 300; color: #444;">' + codeValue + '</span>');
				}
			 }

            var changeValue = resolve(listing, masterColumn.change);
            if (changeValue) {
                value.push('<span class="pc-' + (changeValue == -1 ? 'decr': 'incr') + '" title="' + options.t('price_changed', listing) + '">' + (changeValue == -1 ? '&darr;': '&uarr;') + '</span>');
            }
            else {
                value.push('<span class="pc-same"></span>');
            }

			  if (masterColumn.includeCode) {
					value.push('</div>');
			  }
        }

        return value.join(' ');
    }

    function mirror(v) { return v; }

    function resolve(obj, path) {
        var paths = path.split('.');
        for (var i = 0; i < paths.length; i++) {
            if (typeof obj[paths[i]] === 'undefined') {
                return null;
            }

            obj = obj[paths[i]];
        }

        return obj;
    }

    function renderStatisticsTable(items) {
      if (!items || items.length == 0) {
         return '';
      }

      function formatMoney0(n) {
         return accounting.formatMoney(n, '$', 0);
      }
      function formatMoney1 (n) {
         var decimals = n < 100 ? 2 : 0;
         return accounting.formatMoney(n, '$', decimals);
      }

      function hasValue(v) {
         return v && v != '0';
      }

      function unformat(v) {
         return typeof(v) == 'string' ? accounting.unformat(v) : v;
      }

      function calculateMedian(values) {
         if (values.length == 1) {
            return values[0];
         }

         values.sort(function sortValues (a, b) {
            return a - b;
         });

         var middle = Math.floor(values.length / 2);

         if (values.length % 2)
            return values[middle];
         else
            return (values[middle - 1] + values[middle]) / 2;
      }

      var stats = {
         price: {
				values: [],
				sum: 0,
				count: 0,
				label: 'Price',
				include: function (l) { return true; },
				formatFn: formatMoney0
			},
         totalMonthlyAmount:  {
				values: [],
				sum: 0,
				count: 0,
				label: 'Monthly',
				include: function (l) { return true; },
				formatFn: formatMoney0
			},
         roomsTotal:  {
				values: [],
				sum: 0,
				count: 0,
				label: 'Rooms',
				include: function (l) { return (l.gid || '').toLowerCase() != 'treb'; },
				formatFn: function(n) { return accounting.formatNumber(n, 1); }
			},
         pricePerRoom: {
				values: [],
				sum: 0,
				count: 0,
				label: '$/Room',
				include: function (l) { return (l.gid || '').toLowerCase() != 'treb'; },
				formatFn: formatMoney0,
				calculateValue: function (l) {
					if (!hasValue(l.price) || !hasValue(l.roomsTotal)) return null; else return unformat(l.price) / unformat(l.roomsTotal);
				}
			},
         squareFeet: {
				values: [],
				sum: 0,
				count: 0,
				label: 'SQFT',
				include: function (l) { return (l.gid || '').toLowerCase() != 'treb'; },
				formatFn: function(n) { return accounting.formatNumber(n, 0); }
			},
         pricePerSquareFoot: {
				values: [],
				sum: 0,
				count: 0,
				label: '$/SQFT',
				include: function (l) { return (l.gid || '').toLowerCase() != 'treb'; },
				formatFn: formatMoney1,
				calculateValue: function (l) {
					if (!hasValue(l.price) || !hasValue(l.squareFeet)) return null; else return unformat(l.price) / unformat(l.squareFeet);
				}
			},
			daysOnMarket: {
				values: [],
				sum: 0,
				count: 0,
				label: 'DOM',
				include: function (l) { return (l.gid || '').toLowerCase() == 'elliman'; },
				formatFn: function(n) { return accounting.formatNumber(n, 0); }
			}
      };

      (items || []).forEach(function(l) {
         for (var p in stats) {
            if (!stats.hasOwnProperty(p) || !stats[p].include(l)) { continue; }

            //catch values of '$0' and unformat
            var value = unformat(l[p]);

            if (!hasValue(value) && stats[p].calculateValue) {
               value = stats[p].calculateValue(l);
            }

            if (!hasValue(value)) { continue; }

            stats[p].sum += value;
            stats[p].values.push(value);
            stats[p].count++;
         }
      });

      var statisticItems = [];

      for (var p in stats) {
         if (!stats.hasOwnProperty(p) || stats[p].count == 0) { continue; }

         var mean = stats[p].sum / stats[p].count;
         var median = calculateMedian(stats[p].values);

         statisticItems.push({
            field: stats[p].label,
            mean: (stats[p].formatFn) ? stats[p].formatFn(mean) : mean,
            median: (stats[p].formatFn) ? stats[p].formatFn(median) : median
         });
      }

      if (!statisticItems.length) { return ''; }

      var columnset = {
         columns: [{
            "name": "field",
            "displayName": "",
            "alignment": 2
         },{
            "name": "mean",
            "displayName": "Mean"
         },{
            "name": "median",
            "displayName": "Median"
         }]
      }

      return renderTable(statisticItems, columnset, { includeHeader: true, $defaultTableClasses: 'table' }, 'html');
    }

    hbs.registerHelper('table', function (items, columnset) {
        var options = arguments[arguments.length - 1];
        var tableOptions = {};
        var addToOptions = function (obj) {
            for (var k in obj) {
                tableOptions[k] = obj[k];
            }
        };

        addToOptions(options.data.root);
        if (options.hash) {
            addToOptions(options.hash);
        }

		  var columnsetCopy = JSON.parse(JSON.stringify(columnset));
		  var filteredColumns = (columnsetCopy.columns || []).filter(function (column) {
			  return canDisplayColumn(column, tableOptions);
		  });
		  columnsetCopy.columns = filteredColumns;

        return new Handlebars.SafeString(renderTable(items, columnsetCopy, tableOptions, 'html'));
    });

     hbs.registerHelper('statisticstable', function (items) {
        return new Handlebars.SafeString(renderStatisticsTable(items));
    });

    exports.renderTable = renderTable;
    exports.getDisplayName = getDisplayName;
    exports.canDisplayColumn = canDisplayColumn;
    exports.formatCellValue = formatCellValue;
    exports.getRawColumnValue = getRawColumnValue;
    exports.getColumnValue = getColumnValue;
    exports.renderStatisticsTable = renderStatisticsTable;
})(this, typeof require !== 'undefined', typeof exports !== 'undefined' ? exports : (this.tableTools = {}), this.Polyglot, this.pyhbs, this.moment, this.accounting);
