/**
 * JavaScript for PHP Report Maker 11
 * @license (C) 2007-2018 e.World Technology Ltd.
 */
var ewrReportUrlDialog, ewrEmailDialog, ewrExportDialog, ewrPopups = {}, $rowindex$ = null;
var ewrModalLookupDialog;
var ewrDrillCharts = [], ewrExporting = false, ewrExportCharts = [], ewrDrillDownCharts = [];
var EWR_TABLE_CLASSNAME = "ewTable";
var EWR_GRID_CLASSNAME = "ewGrid";
var EWR_TABLE_ROW_CLASSNAME = "ewTableRow";
var EWR_TABLE_ALT_ROW_CLASSNAME = "ewTableAltRow";
var EWR_ITEM_TEMPLATE_CLASSNAME = "ewTemplate";
var EWR_ITEM_TABLE_CLASSNAME = "ewItemTable";
var EWR_TABLE_LAST_ROW_CLASSNAME = "ewTableLastRow";
var EWR_TABLE_LAST_COL_CLASSNAME = "ewTableLastCol";
var EWR_TABLE_BORDER_BOTTOM_CLASSNAME = "ewTableBorderBottom";
var EWR_UNFORMAT_YEAR = 50;
var EWR_LOOKUP_DELAY = 250;
var EWR_POPUP_MINWIDTH = 200;
var EWR_POPUP_MINHEIGHT = 150;
var EWR_POPUP_DEFAULTHEIGHT = 200;
var EWR_EMPTY_VALUE = "##empty##";
var EWR_NULL_VALUE = "##null##";
var EWR_SHOW_EXPORT_DIALOG = true;
var EWR_IS_SCREEN_SM_MIN = window.matchMedia && window.matchMedia("(min-width: 768px)").matches ||
	!window.matchMedia && jQuery(window).width() >= 768; // Should matches $screen-sm-min, window.matchMedia requires IE 10+
var ewr_ClientScriptInclude = jQuery.getScript;
var ewrLightboxSettings = { transition: "none", photo: true, opacity: 0.5 };
var ewrAutoSuggestSettings = { highlight: true, hint: true, minLength: 1, limit: EWR_AUTO_SUGGEST_MAX_ENTRIES,
	trigger: "click", delay: 0, // For loading more results
	templates: { // Custom templates for Typeahead (notFound, pending, header, footer, suggestion)
		footer: '<div class="tt-footer"><a href="#" class="tt-more"></a></div>' // "footer" template
	}
};

// Default events
if (!EWR_RESET_HEIGHT) {
	jQuery(document).on("overflow", function(e, $grid) { // Default "overflow" event (fired if content wider than screen)
		if (EWR_IS_SCREEN_SM_MIN) // Not mobile
			jQuery("body, .wrapper").css("overflow-x", "auto"); // Override AdminLTE
	});
}

// Forms object
var ewrForms = {};

// Init icon tooltip
function ewr_InitIcons() {
	var $ = jQuery;
	$(".ewIcon, .ewTableHeaderPopup .icon-filter").closest("a, button").add(".ewDrillLink, .ewTooltip").tooltip({
		container: "body",
		trigger: (EWR_IS_MOBILE) ? "manual" : "hover",
		placement: "bottom"
	});
}

// Set session timer
function ewr_SetSessionTimer() {
	var $ = jQuery, timeoutTime, timer1, timer2, timer3, counter, $dlg = $("#ewrTimer"),
		useKeepAlive = ((EWR_SESSION_KEEP_ALIVE_INTERVAL > 0 || EWR_IS_LOGGEDIN && EWR_IS_AUTOLOGIN) && EWR_SESSION_URL);
	// Keep alive
	var keepAlive =	function() {
		var url = EWR_SESSION_URL + '?rnd=' + ewr_Random();
		$.get(url, function(token) {
			EWR_TOKEN = token;
			$("input:hidden[name=token]").val(token);
		});
	};
	// Onclick handler of modal
	$dlg.find(".modal-footer .btn-primary").click(function(e) {
		if (timer2)
			timer2.cancel(); // Clear timer2
		$dlg.modal("hide");
		keepAlive();
		if (!useKeepAlive && EWR_SESSION_TIMEOUT > 0)
			setTimer();
	});
	// Reset timer
	var resetTimer = function() {
		counter = EWR_SESSION_TIMEOUT_COUNTDOWN;
		timeoutTime = EWR_SESSION_TIMEOUT - EWR_SESSION_TIMEOUT_COUNTDOWN;
		if (timeoutTime < 0) { // Timeout now
			timeoutTime = 0;
			counter = EWR_SESSION_TIMEOUT;
		}
		if (timer2)
			timer2.cancel(); // Clear timer2
		if (timer1)
			timer1.cancel(); // Clear timer1
	};
	// Timeout
	var timeout = function() {
		if (timer3)
			timer3.cancel(); // Stop keep alive
		timer2 = $.later(1000, null, function() { // Create a timer that runs every second
			if (counter > 0) {
				$dlg.find(".modal-body").html('<p class="text-danger">' + ewLanguage.Phrase("SessionWillExpire").replace("%s", counter) + '</p>');
				$dlg.modal("show");
			} else { // Counter = 0, log out
				$dlg.find(".modal-body").html('<p class="text-danger">' + ewLanguage.Phrase("SessionExpired") + '</p>');
				resetTimer();
				$.later(1000, null, function() {
					$dlg.modal("hide");
					window.location = EWR_TIMEOUT_URL + "?expired=1";
				}); // Redirect after 1 second
			};
			counter--;
		}, null, true); // Periodic
	};
	// Set timer
	var setTimer = function() {
		resetTimer(); // Reset timer first
		timer1 = $.later(timeoutTime * 1000, null, timeout);
	};
	if (useKeepAlive) { // Keep alive
		var keepAliveInterval = (EWR_SESSION_KEEP_ALIVE_INTERVAL > 0) ? EWR_SESSION_KEEP_ALIVE_INTERVAL : EWR_SESSION_TIMEOUT - EWR_SESSION_TIMEOUT_COUNTDOWN;
		if (keepAliveInterval <= 0) keepAliveInterval = 60;
		timer3 = $.later(keepAliveInterval * 1000, null, keepAlive, null, true); // Periodic
	} else {
		if (EWR_SESSION_TIMEOUT > 0) // Set session timeout
			setTimer();
	}
}

// Init export links
function ewr_InitExportLinks(e) {
	var $ = jQuery, el = (e && e.target) ? e.target : document;
	$(el).find(".ewrExportLink[href]:not(.ewEmail):not(.ewPrint):not(.ewXml)").click(function(e) {
		var $dlg, $this = $(this), href = $this.attr("href");
		if (href && !href.startsWith("javascript:"))
			ewr_FileDownload(href);
		e.preventDefault();
	});
}

// Download file
function ewr_FileDownload(href, data) {
	var $ = (window.location != window.parent.location && window.parent.jQuery) ? window.parent.jQuery : jQuery;
	$("body").css("cursor", "wait");
	if (EWR_SHOW_EXPORT_DIALOG) {
		$dlg = $("#ewMsgBox").length ? $("#ewMsgBox") : $("#ewrMsgBox");
		$dlg.find(".modal-body").html("<p>" + ewLanguage.Phrase("Exporting") + "</p>");
		$dlg.find(".modal-footer button").prop("disabled", true);
		$dlg.modal("show");
	}
	var method = (data) ? "POST" : "GET";
	$.fileDownload(href, {
		httpMethod: method,
		data: data || null,
		successCallback: function(url) {
			if (EWR_SHOW_EXPORT_DIALOG)
				$dlg.modal("hide");
			$(document).trigger("export", [{ "type": "done", "url": url }]);
		},
		failCallback: function(response, url) {
			if (EWR_SHOW_EXPORT_DIALOG)
				$dlg.find(".modal-body").html("<div class='text-danger'><h4>" + ewLanguage.Phrase("FailedToExport") + "</h4>" + response + "</div>");
			$(document).trigger("export", [{ "type": "fail", "url": url }]);
		}
	}).always(function() {
		if (EWR_SHOW_EXPORT_DIALOG)
			$dlg.find(".modal-footer button").prop("disabled", false);
		$("body").css("cursor", "default");
		$(document).trigger("export", [{ "type": "always", "url": href }]);
	});
}

// Init page
jQuery(function($) {
	$("div.ewTableHeaderBtn").each(function() {
		var $this = $(this), padding = 0;
		$this.find(".ewTableHeaderSort:has(.caret), .ewTableHeaderPopup").each(function() {
			padding += $(this).width();
		});
		if (padding)
			$this.css(EWR_CSS_FLIP ? "padding-left" : "padding-right", padding + 4);
	});
	ewr_InitIcons();
	ewr_SetSessionTimer();
	ewr_InitExportLinks();
	if ($(".ewTableHeaderPopup").length || $(".ewDrillLink").length || ewrDrillDownCharts.length) // height: 100% will cause popovers not scrolling with content
		$("html").css({ height: "auto" });
	$.extend(ewrLightboxSettings, {
		title: ewLanguage.Phrase("LightboxTitle"),
		current: ewLanguage.Phrase("LightboxCurrent"),
		previous: ewLanguage.Phrase("LightboxPrevious"),
		next: ewLanguage.Phrase("LightboxNext"),
		close: ewLanguage.Phrase("LightboxClose"),
		xhrError: ewLanguage.Phrase("LightboxXhrError"),
		imgError: ewLanguage.Phrase("LightboxImgError")
	});
	$(".ewLightbox").each(function() {
		var $this = $(this);
		if ($this.colorbox)
			$this.colorbox($.extend({rel: $this.data("rel")}, ewrLightboxSettings));
	});
	$("table." + EWR_TABLE_CLASSNAME).each(ewr_SetupTable); // Init tables
	$("table." + EWR_GRID_CLASSNAME).each(ewr_SetupGrid); // Init grids
	$("input[name=pageno]").keypress(function(e) {
		if (e.which == 13) {
			var url = window.location.href, p = url.lastIndexOf(window.location.search);
			window.location = url.substr(0, p) + "?" + this.name + "=" + parseInt(this.value);
			return false;
		}
	});
	$("input[data-calendar]").each(ewr_CreateDateTimePicker); // Init calendars
	if ((typeof EW_USE_JAVASCRIPT_MESSAGE == "undefined" || !EW_USE_JAVASCRIPT_MESSAGE) && EWR_USE_JAVASCRIPT_MESSAGE)
		ewr_ShowMessage(); // Show message
	if (!EWR_IS_SCREEN_SM_MIN) {
		$(".table-responsive [data-toggle='dropdown']").parent().on("shown.bs.dropdown", function() {
			var $this = $(this), $menu = $this.find(".dropdown-menu"), div = $this.closest(".table-responsive")[0];
			if (div.scrollHeight - div.clientHeight) {
				var d = $menu.offset().top + $menu.outerHeight() - $(div).offset().top - div.clientHeight;
				if (d > 0)
					$menu.css(EWR_CSS_FLIP ? "right" : "left", "100%").css("top", parseFloat($menu.css("top")) - d);
			}
		});
	}
	// Fix min-height when .box is collapsed
	$(".box").on("collapsed.boxwidget", function() {
		var $box = $(this), $div = $box.closest("[class^='col-']");
		if ($div.css("min-height"))
			$div.data("min-height", $div.css("min-height"));
		$div.css("min-height", 0);
	});
	// Fix min-height when .box is expanded
	$(".box").on("expanded.boxwidget", function() {
		var $box = $(this), $div = $box.closest("[class^='col-']");
		if ($div.data("min-height"))
			$div.css("min-height", $div.data("min-height")); // Restore min-height
	});
});

// Fix z-index of multiple modals
jQuery(document).on("show.bs.modal", ".modal", function() {
	var $ = jQuery, zIndex = 1050 + (10 * $(".modal:visible").length);
	$(this).css("z-index", zIndex);
	setTimeout(function() {
		$(".modal-backdrop").not(".modal-stack").css("z-index", zIndex - 1).addClass("modal-stack");
	}, 0);
});

// Fix scrolling of multiple modals
jQuery(document).on("hidden.bs.modal", ".modal", function() {
	var $ = jQuery;
	$(".modal:visible").length && $(document.body).addClass("modal-open");
});

// Export charts
function ewr_ExportCharts(el, url, exportid, f) {

	if (ewrExporting)
		return;

	exportid += "_" + (new Date()).getTime();
	url += (url.split("?").length > 1 ? "&" : "?") + "exportid=" + exportid;

	var $ = jQuery, $el = $(el), method = (f) ? "post" : "get";
	if ($el.is(".dropdown-menu a"))
		$el = $el.closest(".btn-group");

	function _export() {
		if (f && !/&(amp;)?custom=1/.test(url)) {
			data = $(f).serialize();
			data += "&token=" + EWR_TOKEN; // Add token
			$.post(url, data, function(result) {
				ewr_ShowMessage(result);
			});
		} else {
			if (/export=(word|excel|pdf|email)&(amp;)?custom=1/.test(url)) {
				if (/export=email/.test(url)) {
					url = url.replace(/export=email&(amp;)?/i, ""); // Remove duplicate export=email (exists in form)
					url += "&" + $(f).serialize();
				}
				$("iframe.ewExport").remove();
				$("<iframe>").attr("src", url).addClass("ewExport").hide().appendTo($("body").css("cursor", "wait"));
				$.later(5000, null, function() { $("body").css("cursor", "default"); });
			} else if (/export=print/.test(url)) {
				ewr_Redirect(url, f, method);
			} else {
				ewr_FileDownload(url, null);
			}
		}
	}

	if (ewrExportCharts.length == 0) // No charts, just submit the form
		return _export();

	var chartcnt = 0; // Reset

	// Export chart
	function chartExport(o) {

		if ($.isObject(o) && o.chart) { // Google Charts

			var id = o.id, cht = o.chart, divid = "div_" + id.substr(6);
			if (cht.getImageURI) { // base64 data
				var data = { "chart_engine": "google", "stream_type": "base64", "stream": cht.getImageURI(), "token": EWR_TOKEN, // Add token
					"parameters": "exportfilename=" + exportid + "_" + id + ".png|exportformat=png|exportaction=download|exportparameters=undefined"
				};
			} else { // SVG data
				var svgString = $("#" + divid).find("svg").parent().html();
				var data = {  "chart_engine": "google", "stream_type": "svg", "stream": svgString, "token": EWR_TOKEN, // Add token
					"parameters": "exportfilename=" + exportid + "_" + id + ".png|exportformat=png|exportaction=download|exportparameters=undefined"
				};
			}
			$.ajax({ "url": EWR_CHART_EXPORT_HANDLER, "data": data, "cache": false, "type": "POST", "success": function() {
				chartcnt++;
				if (chartcnt == ewrExportCharts.length) { // All charts exported
					_export();
					ewrExporting = false;
					$("body").css("cursor", "default");
				} else { // Next chart
					chartExport(ewrExportCharts[chartcnt]);
				}
			}}).fail(function(xhr, status, error) {
				ewrExporting = false;
				$("body").css("cursor", "default");
				ewr_Alert(error + ": " + xhr.responseText); // Show detailed export error message
			});

		} else if ($.isString(o)) {

			var id = o;
			var cht = FusionCharts(id), chartid = "cht_" + id.substr(6), divid = "div_export_" + id.substr(6), $svg = $("#" + divid + " svg");
			cht.getSVGString(function(svgString) {
				var data = { "chart_engine": "fusioncharts", "stream_type": "svg", "stream": svgString, "token": EWR_TOKEN, // Add token
					"meta_bgColor": "#ffffff", "meta_bgAlpha": "1", // Do not change
					"meta_DOMId": id, "meta_width": $svg.attr("width"), "meta_height": $svg.attr("height"),
					"parameters": "exportfilename=" + exportid + "_" + id + ".png|exportformat=png|exportaction=download|exportparameters=undefined"
				};
				$.ajax({ "url": EWR_CHART_EXPORT_HANDLER, "data": data, "cache": false, "type": "POST", "success": function() {
					chartcnt++;
					if (chartcnt == ewrExportCharts.length) { // All charts exported
						_export();
						ewrExporting = false;
						$("body").css("cursor", "default");
					} else { // Next chart
						chartExport(ewrExportCharts[chartcnt]);
					}
				}}).fail(function(xhr, status, error) {
					ewrExporting = false;
					$("body").css("cursor", "default");
					ewr_Alert(error + ": " + xhr.responseText); // Show detailed export error message
				});
			});

		}
	}

	// Export charts
	ewrExporting = true;
	$("body").css("cursor", "wait");
	chartExport(ewrExportCharts[0]); // Export first chart

}

// Create a popup filter
function ewr_CreatePopup(name, db) {
	ewrPopups[name] = db;
}

// Show popup filter
function ewr_ShowPopup(e, args) {

	ewr_StopPropagation(e);
	var $ = jQuery, $el = $(this).tooltip("hide"), popupname = args.name,
		useRange = args.range, rangeFrom = args.from, rangeTo = args.to,
		url = args.url || window.location.href.split("?")[0].split("#")[0];

	var _addOKBtn = function() { // OK button
		var $tip = $el.data("bs.popover").tip(), form = $tip.find("form")[0];
		var $btn = $('<button type="button" class="btn btn-primary btn-sm ewPopupBtn">' + ewLanguage.Phrase("MessageOK") + '</button>')
			.click(function() {
				if (form && !ewr_SelectedEntry(form, popupname)) {
					ewr_Alert(ewLanguage.Phrase("PopupNoValue"));
				} else {
					if (form)
						form.submit();
					$el.popover("hide");
				}
			});
		$tip.find(".modal-footer").append($btn).show();
	}

	var _addCancelBtn = function() { // Cancel button
		var $tip = $el.data("bs.popover").tip(), form = $tip.find("form")[0];
		var $btn = $('<button type="button" class="btn btn-default btn-sm ewPopupBtn">' + ewLanguage.Phrase("Cancel") + '</button>')
			.click(function() {
				$el.popover("hide");
			});
		$tip.find(".modal-footer").append($btn);
	}

	if (!$el.data("bs.popover")) {
		$el.popover({
			html: true,
			placement: "bottom",
			trigger: "manual",
			template: '<div class="popover">' +
				'<div class="popover-content" style="overflow: auto;"></div><div class="modal-footer" style="display: none;"></div></div>',
			content: '<div class="ewrLoading"><div class="ewSpinner"><div></div></div> ' +
				ewLanguage.Phrase("Loading").replace("%s", "") + '</div>',
			container: $("#ewrPopupFilterDialog")
		}).on("shown.bs.popover", function(e) {
			if (ewrPopups[popupname]) { // Load popup if already loaded
				ewr_SetPopupContent.call($el[0], popupname, ewrPopups[popupname], useRange, rangeFrom, rangeTo);
				_addOKBtn();
				_addCancelBtn();
			} else { // Load popup by Ajax if not loaded yet
				$.ajax({
					cache: false,
					dataType: "json",
					data: "popup=" + popupname,
					url: url,
					success: function(db) {
						var args = $el.data("args");
						ewr_CreatePopup(args.popupname, db);
						ewr_SetPopupContent.call($el[0], args.popupname, db, args.useRange, args.rangeFrom, args.rangeTo);
						_addOKBtn();
						_addCancelBtn();
					},
					error: function(o) {
						if (o.responseText) {
							var $tip = $el.data("bs.popover").tip();
							$tip.find(".popover-content").empty().append('<p class="text-error">' + o.responseText + '</p>');
							$tip.find(".modal-footer").empty();
							_addOKBtn();
						}
					}
				});
			}
		});
	}
	$el.data("args", {"popupname": popupname, "useRange": useRange, "rangeFrom": rangeFrom, "rangeTo": rangeTo}).popover("show");

}

// Set popup fitler content
function ewr_SetPopupContent(name, db, useRange, rangeFrom, rangeTo) {
	var $ = jQuery, cnt = 0, $el = $(this);
	$.map(db, function(record) {
		if (record["s"] === false)
			cnt++;
	});
	var selectall = (cnt == 0), showdivider = false, checkedall = selectall ? " checked" : "";
	var $form = $("<form id=\"" + name + "_FilterForm\" class=\"form-horizontal\" method=\"post\">" +
		"<input type=\"hidden\" name=\"token\" value=\"" + EWR_TOKEN + "\">" +
		"<input type=\"hidden\" name=\"popup\" value=\"" + name + "\">" +
		"<div class=\"ewPopupContainer\"></div></form>");
	var $container = $form.find("div");
	if (useRange) {
		$container.append("<div class=\"ewPopupItem\"><table class=\"ewPopupRange\">" +
			"<tr><td>" + ewLanguage.Phrase("PopupFrom") + "</td><td>" +
			"<select class=\"form-control\" name=\"rf_" + name + "\" style=\"width: auto;\" onchange=\"ewr_SelectRange(this, '" + name + "');\">" +
			"</select></td></tr>" +
			"<tr><td>" + ewLanguage.Phrase("PopupTo") + "</td><td>" +
			"<select class=\"form-control\" name=\"rt_" + name + "\" style=\"width: auto;\" onchange=\"ewr_SelectRange(this, '" + name + "');\">" +
			"</select></td></tr></table></div>");
		var $select = $container.find("select").first();
		$select.append("<option value=\"\">" + ewLanguage.Phrase("PopupSelect") + "</option>");
		$.map(db, function(record) {
			var key = record["k"], val = record["v"];
			if (!key.startsWith("@@") && key != EWR_NULL_VALUE && key != EWR_EMPTY_VALUE) {
				var selected = (key == rangeFrom) ? " selected" : "";
				$select.append("<option value=\"" + key + "\"" + selected + ">" + val + "</option>");
			}
		});
		var $select = $container.find("select").last();
		$select.append("<option value=\"\">" + ewLanguage.Phrase("PopupSelect") + "</option>");
		$.map(db, function(record) {
			var key = record["k"], val = record["v"];
			if (!key.startsWith("@@") && key != EWR_NULL_VALUE && key != EWR_EMPTY_VALUE) {
				selected = (key == rangeTo) ? " selected" : "";
				$select.append("<option value=\"" + key + "\"" + selected + ">" + val + "</option>");
			}
		});
		$container.append("<div class=\"ewPopupDivider\"></div>");
	}
	$container.append("<div class=\"ewPopupItem checkbox\"><label><input type=\"checkbox\" name=\"sel_" + name + "[]\" value=\"\" onclick=\"ewr_SelectAll(this);\"" + checkedall + ">" +
		ewLanguage.Phrase("PopupAll") + "</label></div>");
	$.map(db, function(record) {
		var key = record["k"], val = record["v"], checked = record["s"] ? " checked" : "";
		if (key.startsWith("@@")) {
			showdivider = true;
		} else if (showdivider) {
			showdivider = false;
			$container.append("<div class=\"ewPopupDivider\"></div>");
		}
		$container.append("<div class=\"ewPopupItem checkbox\"><label><input type=\"checkbox\" name=\"sel_" + name + "[]\" value=\"" + key + "\" onclick=\"ewr_UpdateSelectAll(this);\"" + checked + ">" + val + "</label></div>");
	});
	var $tip = $el.data("bs.popover").tip();
	$tip.find(".popover-content").empty().append($form);
	$tip.find(".modal-footer").empty();
}

// Check if selected
function ewr_SelectedEntry(f, name) {
	var $ = jQuery, $els = $(f.elements["sel_" + name + "[]"]);
	return ($els.length > 0) ? $els.filter(":not(:first):checked").length > 0 : $els.prop("checked");
}

// Select all
function ewr_SelectAll(el) {
	ewr_ClearRange(el); // Clear any range set
	jQuery(el.form.elements).filter("input:checkbox[name='" + el.name + "']:not(:first)").prop("checked", el.checked);
}

// Update select all
function ewr_UpdateSelectAll(el) {
	ewr_ClearRange(el); // Clear any range set
	var f = el.form;
	if (f) f.elements[el.name][0].checked = jQuery(el.form.elements).filter("input:checkbox[name='" + el.name + "']:not(:first):not(:checked)").length == 0;
}

// Select range
function ewr_SelectRange(el) {
	var from, to, f = el.form, name = el.name.replace(/^r[ft]_/, "");
	if (f.elements["rf_" + name].selectedIndex > -1)
		from = f.elements["rf_" + name].options[f.elements["rf_" + name].selectedIndex].value;
	if (f.elements["rt_" + name].selectedIndex > -1)
		to = f.elements["rt_" + name].options[f.elements["rt_" + name].selectedIndex].value;
	if (!$.isValue(from) || !$.isValue(to) || from === "" || to === "")
		return;
	ewr_SetRange(el, from, to, true);
}

// Clear range
function ewr_ClearRange(el) {
	var f = el.form, name = el.name.replace(/^sel__/, "").replace(/\[\]$/, "");
	var from = f.elements["rf_" + name], to = f.elements["rt_" + name];
	if (from && to && from.selectedIndex > 0 && to.selectedIndex > 0) {
		from.selectedIndex = 0;
		to.selectedIndex = 0;
		ewr_SetRange(el, from.options[from.selectedIndex].value, to.options[to.selectedIndex].value, false);
	}
}

// Set range
function ewr_SetRange(el, from, to, set) {
	var $ = jQuery, f = el.form, name = el.name.replace(/^r[ft]_/, "sel_") + "[]", inRange;
	$(f.elements).filter("input:checkbox[name='" + name + "']").each(function() {
		if (this.value == from)
			inRange = true;
		if (inRange)
			this.checked = set;
		else
			if (set) this.checked = false;
		if (this.value == to)
			inRange = false;
	});
}

// Page Object
function ewr_Page(name) {
	this.Name = name;
	this.PageID = "";

	// Validate function
	this.ValidateRequired = true;
}

// Forms object/function
var ewrForms = function(el) { // Id or element
	if (el) {
		var $ = jQuery, id;
		if ($.isString(el)) { // Id
			id = el;
		} else { // Element
			id = $(ewr_GetForm(el)).attr("id");
		}
		if (id) {
			for (var i in this) {
				if (i === id)
					return this[i];
			}
		}
	}
	return undefined;
}

// Form class
function ewr_Form(id) {
	var $ = jQuery;
	this.ID = id; // Same ID as the form
	this.$Element = null;
	this.Form = null;
	this.InitSearchPanel = false; // Expanded by default

	// Change search operator
	this.SrchOprChanged = function(el) {
		var form = this.GetForm(), $form = $(form), elem = $.isString(el) ? form.elements[el] : el;
		if (!elem)
			return;
		var param = /^so2_/.test(elem.id) ? elem.id.substr(4) : elem.id.substr(3), val = $(elem).val(), isBetween = val == "BETWEEN",
			isNullOpr = val == "IS NULL" || val == "IS NOT NULL";
		if (/^so_/.test(elem.id))
			$form.find("[name^=sv_" + param + "],[name^=cal_sv_" + param + "]").prop("disabled", isNullOpr);
		if (/^so2_/.test(elem.id))
			$form.find("[name^=sv2_" + param + "],[name^=cal_sv2_" + param + "]").prop("disabled", isNullOpr);
		$form.find("span.btw0_" + param).toggle(!isBetween).end().find("span.btw1_" + param).toggle(isBetween)
			.find(":input").prop("disabled", !isBetween);
	}

	// Validate
	this.ValidateRequired = true;
	this.Validate = null;

	// Disable form
	this.DisableForm = function() {
		if (!EWR_DISABLE_BUTTON_ON_SUBMIT)
			return;
		var form = this.GetForm();
		$(form).find(":submit, :reset").prop("disabled", true).addClass("disabled");
	}

	// Enable form
	this.EnableForm = function() {
		if (!EWR_DISABLE_BUTTON_ON_SUBMIT)
			return;
		var form = this.GetForm();
		$(form).find(":submit, :reset").prop("disabled", false).removeClass("disabled");
	}

	// Before submit
	this.PreSubmit = function() {
		var form = this.GetForm(), $form = $(form);
		$form.find("input[name^=s_],input[name^=sx_],input[name^=q_]").prop("disabled", true); // Do not submit these values
		$form.find("input[name$='[]'][data-multiple='1']").each(function() { // Report maker only
			var $this = $(this), id = $this.attr("id"), ar = $this.val().split(",");
			$.each(ar, function(i, v) {
				$this.clone().attr("id", id + i).val(v).appendTo($form);
			});
		}).remove();
	}

	// Submit
	this.Submit = function(action) {
		var form = this.GetForm(), $form = $(form);
		this.DisableForm();
		//this.UpdateTextArea();
		if (!this.Validate || this.Validate()) {
			if (action)
				form.action = action;
			this.PreSubmit();
			form.submit();
		} else {
			this.EnableForm();
		}
		return false;
	}

	// Check empty row
	this.EmptyRow = null;

	// Multi-page
	this.MultiPage = null;

	// Dynamic selection lists
	this.Lists = function(name) {
		return this.Lists[name];
	}

	// Compile templates
	this.CompileTemplates = function() {
		for (var id in this.Lists) {
			var list = this.Lists[id];
			if (list.Template && $.isString(list.Template))
				list.Template = $.templates(list.Template);
		}
	}

	// AutoSuggests
	this.AutoSuggests = {};

	// Get the HTML form object
	this.GetForm = function() {
		if (!this.Form) {
			this.$Element = $("#" + this.ID);
			if (this.$Element.is("form")) { // HTML form
				this.Form = this.$Element[0];
			} else if (this.$Element.is("div")) { // DIV => Grid page
				this.Form = this.$Element.closest("form")[0];
			}
		}
		return this.Form;
	}

	// Get form element as single element
	this.GetElement = function(name) {
		if (!this.$Element)
			this.$Element = $("#" + this.ID);
		return (name) ? ewr_GetElement(name, this.$Element) : this.$Element[0];
	}

	// Get form element(s) as single element or array of radio/checkbox
	this.GetElements = function(name) {
		if (!this.$Element)
			this.$Element = $("#" + this.ID);
		var selector = "[name='" + name + "']";
		selector = "input" + selector + ",select" + selector + ",textarea" + selector + ",button" + selector;
		var $els = this.$Element.find(selector);
		return ($els.length == 0) ? null : ($els.length == 1 && $els.is(":not(:checkbox):not(:radio)")) ? $els[0] : $els.get();
	}

	// Get Auto-Suggest unmatched item (for form submission by pressing Return)
	this.PostAutoSuggest = function() {
		for (var i in this.AutoSuggests) {
			var $input = this.AutoSuggests[i].$input;
			if ($input && $input.is(":focus")) {
				$input.blur();
				break;
			}
		}
	}

	// Update dynamic selection lists
	this.UpdateOpts = function(rowindex) {
		if (rowindex === $rowindex$) // null => return, undefined => update all
			return;
		var lists = [], form = this.GetForm();
		this.CompileTemplates();
		for (var id in this.Lists) {
			var parents = this.Lists[id].ParentFields.slice(); // Clone
			var ajax = this.Lists[id].Ajax;
			if ($.isValue(rowindex)) {
				id = id.replace(/^x_/, "x" + rowindex + "_");
				for (var i = 0, len = parents.length; i < len; i++)
					parents[i] = parents[i].replace(/^x_/, "x" + rowindex + "_");
			}
			if ($.isBoolean(ajax)) { // Ajax
				var pvalues = [];
				for (var i = 0, len = parents.length; i < len; i++)
					pvalues[pvalues.length] = ewr_GetOptValues(parents[i], form); // Save the initial values of the parent lists
				lists[lists.length] = [id, pvalues, ajax, false];
			} else { // Non-Ajax
				ewr_UpdateOpt.call(this, id, parents, null, false);
			}
		}

		// Update the Ajax lists
		for (var i = 0, cnt = lists.length; i < cnt; i++)
			ewr_UpdateOpt.apply(this, lists[i]);
	}

	// Create AutoSuggest
	this.CreateAutoSuggest = function(settings) {
		var self = this, id = settings.id;
		settings.form = this;
		$(function() {
			var options = $.extend({}, ewrAutoSuggestSettings, settings); // Global settings + field specific settings
			var nid = id.replace(/^[xy](\d*|\$rowindex\$)_/, "x_");
			var o = self.AutoSuggests[nid];
			if ($.isObject(o) && !(o instanceof ewr_AutoSuggest))
				options = $.extend(options, o); // Settings + data
			self.AutoSuggests[id] = new ewr_AutoSuggest(options);
		});
	}

	// Show error message
	this.OnError = function(el, msg) {
		return ewr_OnError(this, el, msg);
	}

	// Get form data
	this.GetFormData = function() {
		var form = this.GetForm(), $form = $(form);
		if (ewr_HasFormData(form)) {
			this.PreSubmit();
			return $form.serialize();
		}
		return "";
	}

	// Set up filters
	this.SetupFilters = function(e, filters) {
		var id = this.ID, data = this.FilterList, $sf = $(".ewSaveFilter[data-form=" + id + "]"),
			$df = $(".ewDeleteFilter[data-form=" + id + "]"),
			$delete = $df.parent("li").toggleClass("dropdown-submenu", !!filters.length).toggleClass("disabled", !filters.length),
			$save = $sf.parent("li").toggleClass("disabled", !data),
			$btn = $(e.target);
		$save.off("click.ew").on("click.ew", function(e) { // Save filter
			if ($save.hasClass("disabled"))
				return false;
			ewr_Prompt(ewLanguage.Phrase("EnterFilterName"), function(name) {
				filters[filters.length] = [name, data];
				$.localStorage.set(id + "_filters", filters);
			}, true);
			return false;
		}).prevAll().remove();
		$df.next("ul.dropdown-menu").remove();
		if (filters.length) {
			$menu = $df.closest("ul.dropdown-menu");
			$submenu = $("<ul class='dropdown-menu'></ul>");
			for (var i in filters) {
				if (!$.isArray(filters[i]))
					continue;
				$("<li><a data-index='" + i + "' href='#'>" + filters[i][0] + "</a></li>").on("click", function(e) { // Delete
					var i = $(this).find("a[data-index]").data("index");
					ewr_Prompt(ewLanguage.Phrase("DeleteFilterConfirm").replace("%s", filters[i][0]), function() {
						delete(filters[i]);
						$.localStorage.set(id + "_filters", filters);
					});
					return false;
				}).appendTo($submenu);
				$("<li><a class='ewFilterList' data-index='" + i + "' href='#'>" + filters[i][0] + "</a></li>").insertBefore($save).on("click", function(e) {
					var i = $(this).find("a[data-index]").data("index");
					$("<form>").attr({method: "post", action: location.href.split("?")[0]})
						.append($("<input type='hidden'>").attr({name: "cmd", value: "resetfilter"}), $("<input type='hidden'>").attr({name: "token", value: EWR_TOKEN}), $("<input type='hidden'>").attr({name: "filter", value: JSON.stringify(filters[i][1])}))
						.appendTo("body").submit();
					return false;
				});

			}
			$("<li class='divider'></li>").insertBefore($save);
			$delete.append($submenu);
		}
	}

	// Init form
	this.Init = function() {
		var self = this, form = this.GetForm(), $form = $(form);

		// Filters button
		if (window.localStorage) {
			$(".ewFilterOption." + this.ID + " .ewButtonDropdown").on("show.bs.dropdown", function(e) {
				var filters = $.localStorage.get(self.ID + "_filters") || [];
				var ar = $.grep(filters, function(val) {
					if ($.isArray(val) && val.length == 2)
						return val;
				});
				self.SetupFilters(e, ar);
			});
		} else
			$(".ewFilterOption").hide();

		// Check form
		if (!form)
			return;

		// Compile templates
		this.CompileTemplates();

		// Search panel
		if (this.InitSearchPanel && !ewr_HasFormData(form))
			$("#" + this.ID + "_SearchPanel").removeClass("in");

		// Search panel toggle
		$(".ewSearchToggle[data-form=" + this.ID + "]").on("click.bs.button", function() {
			$("#" + $(this).data("form") + "_SearchPanel").collapse("toggle");
		});

		// Search operators
		$form.find("select[id^=so_]").each(function() {
			var $this = $(this).change();
			if ($this.val() != "BETWEEN")
				$form.find("#so2_" + this.id.substr(2)).change();
		});

		// Dynamic selection lists
		this.UpdateOpts();

		// Bind submit event
		if (this.$Element.is("form")) { // Not Grid page
			$form.submit(function(e) {
				return self.Submit();
			});
		}

		// Store form object as data
		this.$Element.data("form", this);
	}

	// Add to the global forms object
	ewrForms[this.ID] = this;
}

// Prompt
function ewr_Prompt(text, cb, input) {
	var $ = jQuery, $dlg = $("#ewrPrompt"), $body = $dlg.find(".modal-body").empty();
	if (input) { // prompt
		$body.append('<div class="form-group">' +
			'<label class="control-label">' + text + '</label>' +
			'<input type="text" class="form-control" style="display: block; width: 100%;"></div>');
		$input = $body.find("input").click(function() {
			$input.parent().removeClass("has-error");
		});
		$dlg.find(".modal-footer .btn-primary").unbind().click(function(e) { // OK
			var val = $.trim($input.val());
			if (val == "") {
				$input.parent().addClass("has-error");
				$input[0].focus();
			} else {
				$dlg.modal("hide");
				if ($.isFunction(cb))
					cb(val);
			}
		});
		$dlg.on("shown.bs.modal", function(e) {
			$input[0].focus();
		});
	} else { // confirm
		$body.append("<div>" + text + "</div>");
		$dlg.find(".modal-footer .btn-primary").unbind().click(function(e) { // OK
			$dlg.modal("hide");
			if ($.isFunction(cb))
				cb();
		});
	}
	$dlg.modal("show");
}

// Find form
function ewr_GetForm(el) {
	var $ = jQuery, $el = $(el), $f = $el.closest(".ewForm");
	if (!$f[0]) // Element not inside form
		$f = $el.closest(".ewGrid").find(".ewForm");
	return $f[0];
}

// Check search form data
function ewr_HasFormData(form) {
	var $ = jQuery, els = $(form).find("[name^=sv_][value!=''][value!='{value}'],[name^=sv2_][value!=''][value!='{value}']").get();
	for (var i = 0, len = els.length; i < len; i++) {
		var el = els[i];
		if (/^(so|so2)_/.test(el.name)) {
			if (/^IS/.test($(el).val()))
				return true;
		} else if (el.type == "checkbox" || el.type == "radio") {
			if (el.checked)
				return true;
		} else if (el.type == "select-one" || el.type == "select-multiple") {
			for (var j = 0, cnt = el.options.length; j < cnt; j++) {
				if (el.options[j].selected && el.options[j].value != "" && el.options[j].value != "##all##")
					return true;
			}
		} else if (el.type == "text" || el.type == "hidden" || el.type == "textarea") {
			return true;
		}
	}
	return false;
}

// Update a dynamic selection list
// - obj {HTMLElement|array[HTMLElement]|string|array[string]} target HTML element(s) or the id of the element(s)
// - parentId {array[string]|array[array]} parent field element names or data
// - async {boolean|null} async(true) or sync(false) or non-Ajax(null)
// - change {boolean} trigger onchange event
function ewr_UpdateOpt(obj, parentId, async, change) {
	var $ = jQuery, self = this, $this = $(this);
	var exit = function() {
		$this.dequeue();
	};
	if (!obj || obj.length == 0)
		return exit();
	var f = (this.Form) ? this.Form : (this.form) ? this.form : null;
	if (this.form && /^x\d+_/.test(this.id)) // Has row index => grid
		f = ewr_GetForm(this); // Detail grid or HTML form
	if (!f)
		return exit();
	var frm = (this.Form) ? this : ewrForms[f.id];
	if (!frm)
		return exit();
	var args = $.makeArray(arguments);
	if (this.form && $.isArray(obj) && $.isString(obj[0])) { // Array of id (onchange/onclick event)
		for (var i = 0, len = obj.length; i < len; i++)
			$this.queue($.proxy(ewr_UpdateOpt, self, obj[i], parentId, async, change));
		var list = frm.Lists[this.id.replace(/^[xy]\d*_/, "x_")];
		return exit();
	}
	if ($.isString(obj))
		obj = ewr_GetElements(obj, f);
	var ar = ewr_GetOptValues(obj);
	var oid = ewr_GetId(obj, false);
	if (!oid)
		return exit();
	var nid = oid.replace(/^([xy])(\d*)_/, "x_");
	var prefix = RegExp.$1;
	var rowindex = RegExp.$2;
	var arp = [];
	if ($.isUndefined(parentId)) { // Parent IDs not specified, use default
		parentId = frm.Lists[nid].ParentFields.slice(); // Clone
		if (rowindex != "") {
			for (var i = 0, len = parentId.length; i < len; i++)
				parentId[i] = parentId[i].replace(/^x_/, "x" + rowindex + "_");
		} else if (prefix == "y") {
//			for (var i = 0, len = parentId.length; i < len; i++) {
//				var yid = parentId[i].replace(/^x_/, "y_");
//				var yobj = ewr_GetElements(yid, f);
//				if (yobj.type || yobj.length > 0) // Has y_* parent
//					parentId[i] = yid; // Changes with y_* parent
//			}
		}
	}
	if ($.isArray(parentId) && parentId.length > 0) {
		if ($.isArray(parentId[0])) { // Array of array => data
			arp = parentId;
		} else if ($.isString(parentId[0])) { // Array of string => Parent IDs
			for (var i = 0, len = parentId.length; i < len; i++)
				arp[arp.length] = ewr_GetOptValues(parentId[i], f);
		}
	}
	if (!ewr_IsAutoSuggest(obj)) // Do not clear Auto-Suggest
		ewr_ClearOpt(obj);
	var addOpt = function(aResults) {
		for (var i = 0, cnt = aResults.length; i < cnt; i++) {
			var args = {data: aResults[i], parents: arp, valid: true, name: ewr_GetId(obj), form: f};
			$(document).trigger("addoption", [args]);
			if (args.valid)
				ewr_NewOpt(obj, aResults[i], f);
		}
		if (!obj.options && obj.length) { // Radio/Checkbox list
			ewr_RenderOpt(obj);
			obj = ewr_GetElements(oid, f); // Update the list
		}
		ewr_SelectOpt(obj, ar);
		if (change !== false)
			$(obj).first().change();
	}
	if ($.isUndefined(async)) // Async not specified, use default
		async = frm.Lists[nid].Ajax;
	if (!$.isBoolean(async) || $.isArray(frm.Lists[nid].Options) && frm.Lists[nid].Options.length > 0) { // Non-Ajax or Options loaded
		var ds = frm.Lists[nid].Options;
		addOpt(ds);
		if (/s(ea)?rch$/.test(f.id) && prefix == "x") { // Search form
			args[0] = oid.replace(/^x_/, "y_");
			ewr_UpdateOpt.apply(this, args); // Update the y_* element
		}
		return exit();
	} else { // Ajax
		var name = ewr_GetId(obj), data = $(f).find("#s_" + name).val();
		if (!data)
			return exit();
		data += "&type=updateopt&name=" + name; // Name of the target element
		if (ewr_IsAutoSuggest(obj) && this.Form || ewr_IsModalLookup(obj)) // Auto-Suggest (init form or auto-fill) / Modal-Lookup
			data += "&v0=" + (ar[0] ? encodeURIComponent(ar[0]) : ewr_Random()); // Filter by the current value
		for (var i = 0, cnt = arp.length; i < cnt; i++) // Filter by parent fields
			data += "&v" + (i+1) + "=" + encodeURIComponent(arp[i].join(EWR_LOOKUP_FILTER_VALUE_SEPARATOR));
		data += "&token=" + EWR_TOKEN; // Add token
		$.ajax(EWR_LOOKUP_FILE_NAME, {
			"type": "POST", "dataType": "json",
			"data": data, "async": async, "cache": false,
			"success": function(result) {
				addOpt(result || []);
			}
		}).always(function() {
			exit();
		});
		if (/s(ea)?rch$/.test(f.id) && prefix == "x") { // Search form
			args[0] = oid.replace(/^x_/, "y_");
			ewr_UpdateOpt.apply(this, args); // Update the y_* element
		}
	}
}

// Clear existing options
function ewr_ClearOpt(obj) {
	var $ = jQuery;
	if (obj.options) { // Selection list
		var lo = 1;
		for (var i = obj.length - 1; i >= lo; i--)
			if (!obj.options[i].value.startsWith("@@")) // Do not clear custom filter
				obj.options[i] = null;
	} else if (obj.length) { // Radio/Checkbox list
		var $ = jQuery, id = ewr_GetId(obj),
			p = ewr_GetElement("dsl_" + id, obj[0].form);
		$(p).data("options", []).find("div").first().empty();
		for (var i = 0; i < obj.length; i++) {
			var el = obj[i];
			var val = el.value;
			if (val.startsWith("@@")) { // Add custom filter to array
				var txt = $(el).data("filter-name");
				if (txt) {
					var opts = $(p).data("options");
					opts[opts.length] = {"val": val, "lbl": txt};
					$(p).data("options", opts);
				}
			}
		}
	} else if (ewr_IsAutoSuggest(obj)) {
		var o = ewr_GetAutoSuggest(obj);
		o._options = [];
		o.input.value = "";
		obj.value = "";
	} else if (ewr_IsModalLookup(obj)) { // Modal-Lookup
		$(obj).data("options", []);
	}
}

// Get the id or name of an element
// - remove {boolean} remove square brackets, default: true
function ewr_GetId(el, remove) {
	var $ = jQuery, id = "";
	if ($.isString(el)) {
		id = el;
	} else {
		id = $(el).attr("name") || $(el).attr("id"); // Use name first (id may have suffix)
	}
	if (remove !== false && /\[\]$/.test(id)) // Ends with []
		id = id.substr(0, id.length-2);
	return id;
}

// Get existing selected values as an array
function ewr_GetOptValues(el, form) {
	var $ = jQuery, obj = ($.isString(el)) ? ewr_GetElements(el, form) : el;
	if (obj.options) { // Selection list
		return $(obj).find("option:selected[value!='']").map(function() {
			return this.value;
		}).get();
	} else if ($.isNumber(obj.length)) { // Radio/Checkbox list, or element not found
		return $(obj).filter(":checked[value!='{value}']").map(function() {
			return this.value;
		}).get();
	} else { // Text/Hidden
		return [obj.value];
	}
}

// Get form element(s) as single element or array of radio/checkbox
function ewr_GetElements(name, root) {
	var $ = jQuery, root = $.isString(root) ? "#" + root : root, selector = "[name='" + name + "']";
	selector = "input" + selector + ",select" + selector + ",textarea" + selector + ",button" + selector;
	var $els = (root) ? $(root).find(selector) : $(selector); // Exclude template element
	if ($els.length == 1 && $els.is(":not(:checkbox):not(:radio)"))
		return $els[0];
	return $els.get();
}

// Create new option
// obj {HTMLElement|array} selection list
// ar {array} data for the new option
// f {ewForm} ewForm object of obj
function ewr_NewOpt(obj, ar, f) {
	var $ = jQuery, frm = ewrForms[f.id], id = ewr_GetId(obj), nid = ewr_GetId(obj, false), text,
		value = ar[0], item = { lf: ar[0], df1: ar[1], df2: ar[2], df3: ar[3], df4: ar[4] };
	if (frm.Lists(nid).Template && !ewr_IsAutoSuggest(obj)) {
		text = frm.Lists(nid).Template.render(item);
	} else {
		text = ewr_DisplayValue(ar, obj) || value;
	}
	var args = {"data": item, "name": id, "form": f.$Element, "value": value, "text": text};
	if (obj.options) { // Selection list
		$.extend(args, {"option": $("<option/>").val(args.value).html(args.text)});
		$(document).trigger("newoption", [args]); // Fire "newoption" event for selection list
		$(obj).append(args.option);
	} else if (obj.length) { // Radio/Checkbox list
		var $p = $(ewr_GetElement("dsl_" + id, f)), opts = $p.data("options"); // Parent element
		if ($p[0] && opts)
			opts[opts.length] = {"val": args.value, "lbl": args.text};
	} else if (ewr_IsAutoSuggest(obj)) { // Auto-Suggest
		var o = ewr_GetAutoSuggest(obj);
		o._options[o._options.length] = {"val": args.value, "lbl": args.text};
	} else if (ewr_IsModalLookup(obj)) { // Modal-Lookup
		var $obj = $(obj), opts = $obj.data("options") || [];
		opts[opts.length] = {"val": args.value, "lbl": args.text};
		$obj.data("options", opts);
	}
	return args.text;
}

// Render the options
function ewr_RenderOpt(obj) {
	var $ = jQuery, id = ewr_GetId(obj), f = ewr_GetForm(obj), $p = $(obj).parent().parent().find("#dsl_" + id); // Parent element
	if (!$p[0] || !$p.data("options"))
		return;
	var $t = $p.parent().find("#tp_" + id);
	if (!$t[0])
		return;
	var cols = (!EWR_IS_MOBILE) ? (parseInt($p.data("repeatcolumn"), 10) || 5) : 1;
	var $tpl = $t.contents(), opts = $p.data("options"), type = $tpl.attr("type");
	var $btn = $p.prevAll(".dropdown-toggle"), $clr = $p.prevAll(".ewDropdownListClear");
	if (opts && opts.length) {
		if (cols > 1 || type == "checkbox" || !$btn[0]) { // Use table
			var $tbl = $('<table class="ewItemTable"></table>');
			if (type == "checkbox")
				$tbl.click(function(e) { e.stopPropagation(); });
			for (var i = 0, cnt = opts.length; i < cnt; i++) {
				if (i % cols == 0)
					$tr = $("<tr></tr>");
				var $el = $tpl.clone(true).val(opts[i].val).click(function(e) {
					if ($btn[0]) {
						var $items = $tbl.find("input[name='" + this.name + "']:checked");
						var vals = $items.map(function() {
							return $(this).parent().text();
						}).get();
						var txt = (vals.length > ($(this).data("maxcount") || 3)) ? ewLanguage.Phrase("CountSelected").replace("%s", vals.length) : vals.join(", ");
						$btn.html(vals.length ? txt : ewLanguage.Phrase("PleaseSelect"));
						$clr.toggle(vals.length > 0);
					}
				});
				var $lbl = $('<label class="' + type + '-inline"></label>').append($el.attr("id", $el.attr("id") + "_" + i), opts[i].lbl);
				var args = {"name": id, "form": f, "value": opts[i].val, "text": opts[i].lbl, "option": $lbl};
				$(document).trigger("newoption", [args]); // Fire "newoption" event for radio/checkbox list
				$("<td></td>").append(args.option).appendTo($tr);
				if (i % cols == cols - 1) {
					$tbl.append($tr);
				} else if (i == cnt - 1) { // Last
					for (var j = (i % cols) + 1; j < cols; j++)
						$tr.append("<td></td>");
					$tbl.append($tr);
				}
			}
			$p.find("div").first().append($tbl);
		} else { // Single column dropdown radio buttons => Use list group
			var $div = $('<div class="list-group"></div>');
			for (var i = 0, cnt = opts.length; i < cnt; i++) {
				var $el = $tpl.clone(true).val(opts[i].val).click(function(e) {
					var $li = $(this).closest(".list-group-item");
					if ($li.hasClass("active"))
						this.checked = false;
					$li.siblings(".list-group-item").removeClass("active");
					$li.toggleClass("active", this.checked);
					$btn.html(this.checked ? $li.text() : ewLanguage.Phrase("PleaseSelect"));
					$clr.toggle(this.checked);
				});
				var $lbl = $('<label class="' + type + '-inline"></label>').append($el.attr("id", $el.attr("id") + "_" + i), opts[i].lbl);
				var $opt = $('<a class="list-group-item" href="#"></a>').append($lbl);
				var args = {"name": id, "form": f, "value": opts[i].val, "text": opts[i].lbl, "option": $opt};
				$(document).trigger("newoption", [args]); // Fire "newoption" event for radio list
				$div.append(args.option);
			}
			$p.find("div").first().append($div);
		}
		var txt = $.trim($btn.html());
		$clr.toggle(!!txt && txt != ewLanguage.Phrase("PleaseSelect")).off().click(function(e) {
			$p.find("[data-field]:radio,[data-field]:checkbox").prop("checked", false).first().triggerHandler("click");
			$p.find(".list-group-item.active").removeClass("active");
			$btn.html(ewLanguage.Phrase("PleaseSelect"));
			$clr.hide();
		});
	}
	$p.data("options", []);
}

// Get display value separator
function ewr_ValueSeparator(index, obj) {
	var $ = jQuery, sep = $(obj).data("value-separator");
	return ($.isArray(sep)) ? sep[index - 1] : (sep || ", ");
}

// Get display value
function ewr_DisplayValue(ar, obj) {
	var $ = jQuery, text = ar[1];
	for (var i = 2; i <= 4; i++) {
		if (ar[i] && ar[i] != "") {
			var sep = ewr_ValueSeparator(i - 1, obj);
			if ($.isUndefined(sep))
				break;
			if (text != "")
				text += sep;
			text += ar[i];
		}
	}
	return text;
}

// Select combobox option
function ewr_SelectOpt(obj, value_array) {
	if (!obj || !value_array || value_array.length == 0)
		return;
	var $ = jQuery, $obj = $(obj);
	if (obj.options) { // Selection list
		$obj.val(value_array);
		if (obj.type == "select-one" && obj.selectedIndex == -1)
			obj.selectedIndex = 0; // Make sure an option is selected (IE)
	} else if (obj.length) { // Radio/Checkbox list
		if (obj.length == 1 && obj[0].type == "checkbox" && obj[0].value != "{value}") { // Assume boolean field // P802
			obj[0].checked = (ewr_ConvertToBool(obj[0].value) === ewr_ConvertToBool(value_array[0]));
		} else {
			$obj.val(value_array).closest(".ewDropdownList").find(".ewDropdownListClear").show();
			$obj.each(function() {
				$(this).closest(".list-group-item").toggleClass("active", this.checked);
			});
		}
	} else if (ewr_IsAutoSuggest(obj) && value_array.length == 1) {
		var o = ewr_GetAutoSuggest(obj);
		for (var i = 0, len = o._options.length; i < len; i++) {
			if (o._options[i].val == value_array[0]) {
				obj.value = o._options[i].val;
				o.input.value = o._options[i].lbl;
				break;
			}
		}
	} else if (ewr_IsModalLookup(obj)) {
		var $obj = $(obj), val = "", txt = "", opts = $obj.data("options") || [];
		for (var j = 0, cnt = value_array.length; j < cnt; j++) {
			for (var i = 0, len = opts.length; i < len; i++) {
				if (value_array[j] == opts[i].val) {
					val += (val !== "" ? EWR_LOOKUP_FILTER_VALUE_SEPARATOR : "") + opts[i].val;
					txt += (txt !== "" ? ", " : "") + opts[i].lbl;
					break;
				}
			}
		}
		$obj.val(val);
		$obj.parent().find(".ewLookupText").html(txt !== "" ? txt : ewLanguage.Phrase("PleaseSelect"));
	} else if (obj.type) {
		obj.value = value_array.join(",");
	}

	// Auto-select if only one option
	function isAutoSelect(el) {
		if (!$(el).data("autoselect")) // Is data-autoselect="false"
			return false;
		var form = ewr_GetForm(el);
		if (form) {
			if (/s(ea)?rch$/.test(form.id)) // Search forms
				return false;
			var nid = el.id.replace(/^([xy])(\d*)_/, "x_");
			if (nid in ewrForms[form.id].Lists && ewrForms[form.id].Lists[nid].ParentFields.length == 0) // No parent fields
				return false;
			return true;
		}
		return false;
	}
	if (obj.options) { // Selection List
		if (obj.type == "select-one" && obj.options.length == 2 && !obj.options[1].selected && isAutoSelect(obj)) {
			obj.options[1].selected = true;
		} else if (obj.type == "select-multiple" && obj.options.length == 1 && !obj.options[0].selected && isAutoSelect(obj)) {
			obj.options[0].selected = true;
		}
	} else if (obj.length) { // Radio/Checkbox list
		if (obj.length == 2 && isAutoSelect(obj[1]))
			obj[1].checked = true;
	} else if (ewr_IsAutoSuggest(obj)) {
		var o = ewr_GetAutoSuggest(obj);
		if (o._options.length == 1 && isAutoSelect(obj)) {
			obj.value = o._options[0].val;
			o.input.value = o._options[0].lbl;
		}
	}
}

// Auto-Suggest
function ewr_AutoSuggest(settings) {
	var $input, $element, self = this, $ = jQuery, elValue = settings.id, frm = settings.form, forceSelection = settings.forceSelect;
	var nid = elValue.replace(/^[xy](\d*|\$rowindex\$)_/, "x_");
	var rowindex = RegExp.$1;
	var oEmpty = {typeahead:{}}; // Empty Auto-Suggest object
	if (rowindex == "$rowindex$")
		return oEmpty;
	var form = frm.GetElement(); // HTML form or DIV
	var elInput = frm.GetElement("sx_" + elValue);
	if (!elInput)
		return oEmpty;
	var elContainer = frm.GetElement("sc_" + elValue);
	var elParent = frm.Lists[nid].ParentFields.slice(); // Clone

	for (var i = 0, len = elParent.length; i < len; i++) {
		var ar = elParent[i].split(" ");
		if (ar.length == 1) // Parent field in the same table, add row index
		elParent[i] = elParent[i].replace(/^x_/, "x" + rowindex + "_");
	}

	// Properties
	this.data = settings.data;
	this.minWidth = settings.minWidth;
	this.maxHeight = settings.maxHeight;
	this.highlight = settings.highlight;
	this.hint = settings.hint;
	this.minLength = settings.minLength;
	this.limit = settings.limit;
	this.templates = $.extend({}, settings.templates); // Clone
	this.trigger = settings.trigger; // For loading more results
	this.delay = settings.delay; // For loading more results
	this.display = settings.display || "value";
	this.input = elInput;
	this.element = frm.GetElement(elValue);
	this.$input = $input = $(this.input)
	this.$element = $element = $(this.element);
	this._options = [];
	this._recordCount = 0;
	
	// Save initial option
	if ($input.val() && $element.val())
		this._options.push({val: $element.val(), lbl: $input.val()});

	// Format display value in textbox
	this.formatResult = function(ar) {
		return ewr_DisplayValue(ar, this.element) || ar[0];
	};

	// Set the selected item to the actual field
	this.setValue = function(v) {
		v = v || $input.val();
		var ar = $input.data("results") ? $.map($input.data("results"), function(item, i) {
			if (item["value"] == v) // Value exists
				return i; // Return the index
		}) : [];
		if (ar.length == 0) { // Not found in results
			if (this._options && this._options.length && this._options[this._options.length - 1].lbl == v) // Option added by Add Option dialog or initial option
				return;
			if (forceSelection && v) { // Force selection and query not empty => error
				$input.typeahead("val", "").attr("placeholder", ewLanguage.Phrase("ValueNotExist"))
					.parent().append('<span class="glyphicon glyphicon-warning-sign form-control-feedback"></span>')
					.addClass("has-error has-feedback");
				$element.val("").change();
				return;
			}
		} else { // Found in results
			if (!/s(ea)?rch$/.test(form.id) || forceSelection) { // Force selection or not search form
				var i = ar[0]; // Get the index
				if (i > -1)
					v = $input.data("results")[i][0]; // Replace the display value by Link Field value
			}
		}
		if (v !== $element.val())
			$element.val(v).change(); // Set value to the actual field
	};

	// Generate request
	this.generateRequest = function() {
		var data = this.data;
		if (elParent.length > 0) {
			for (var i = 0, len = elParent.length; i < len; i++) {
				var arp = ewr_GetOptValues(elParent[i], form);
				data += "&v" + (i+1) + "=" + encodeURIComponent(arp.join(","));
			}
		}
		return "name=" + this.element.name + "&" + data;
	};

	// Prepare to send request
	this.prepare = function(query, start) {
		var settings = {};
		settings.data = this.generateRequest();
		settings.type = "POST";
		settings.dataType = "json";
		settings.url = EWR_LOOKUP_FILE_NAME + "?q=" + encodeURIComponent(query);
		settings.url += "&n=" + this.limit;
		if ($.isNumber(start))
			settings.url += "&start=" + start;
		settings.url += "&rnd=" + ewr_Random();
		return settings;
	};

	// Transform suggestion
	this.transform = function(data) {
		var results;
		if (data && data.Result == "OK") {
			self._recordCount = data.TotalRecordCount;
			results = data.Records;
		}
		$input.data("results", results || []);
		var ar = $.map($input.data("results"), function(item) {
			var val = item["value"] = self.formatResult(item); // Format the item and save as property
			return { lf: item[0], df1: item[1], df2: item[2], df3: item[3], df4: item[4], value: val }; // Return as object
		});
		return ar;
	};

	// Get suggestions by Ajax
	this.source = function(query, syncResults, asyncResults) {
		self._recordCount = 0; // Reset
		var settings = self.prepare(query);
		$.ajax(settings).done(function(data) {
			asyncResults(self.transform(data));
		});
	};

	// Get current suggestion count
	this.count = function() {
		return self.typeahead.menu.$node.find(".tt-suggestion.tt-selectable").length;
	};

	// Get more suggestions by Ajax
	this.more = function() {
		$("body").css("cursor", "wait");
		var ta = self.typeahead, query = ta.menu.query, dataset = ta.menu.datasets[0];
		var start = self.count();
		var settings = self.prepare(query, start);
		$.ajax(settings).done(function(data) {
			data = self.transform(data);
			dataset._append(query, data);
			ta.menu.$node.find(".tt-dataset").scrollTop(dataset.$lastSuggestion.outerHeight() * start);
		}).always(function() {
			$("body").css("cursor", "default");
		});
	};

	// Add events
	$input.on("typeahead:select", function(e, d) {
		self.setValue(d.value);
	}).blur(function(e) {
		var ta = $input.data("tt-typeahead");
		if (ta && ta.isOpen() && !ta.menu.empty()) {
			var $item = ta.menu.getActiveSelectable();
			if ($item) { // A suggestion is highlighted
				var i = $item.index();
				var val = $input.data("results")[i][1];
				$input.typeahead("val", val);
			}
		}
		self.setValue();
	}).focus(function(e) {
		$input.attr("placeholder", $input.data("placeholder"))
			.closest(".has-error.has-feedback").removeClass("has-error has-feedback")
			.find(".form-control-feedback").remove();
	});

	// Option template ("suggestion" template)
	var tpl;
	if (frm.Lists[nid].Template) {
		tpl = frm.Lists[nid].Template;
	} else {
		tpl = self.templates["suggestion"];
	}
	if (tpl && $.isString(tpl))
		tpl = $.templates(tpl);
	if (tpl)
		self.templates["suggestion"] = $.proxy(tpl.render, tpl);

	// Save
	$element.data("autosuggest", this);

	// Create Typeahead
	$(function() {
		// Typeahead options and dataset
		var options = {
			highlight: self.highlight,
			minLength: self.minLength,
			hint: self.hint,
			trigger: self.trigger,
			delay: self.delay
		};
		var dataset = {
			name: frm.ID + "-" + elValue,
			source: self.source,
			templates: self.templates,
			display: self.display,
			limit: self.limit,
			async: true
		};
		var args = [options, dataset];
		// Trigger "typeahead" event
		$element.trigger("typeahead", [args]);
		self.limit = dataset.limit;
		// Create Typeahead
		$input.typeahead.apply($input, args);
		$input.on("typeahead:rendered", function() {
			var $node = self.typeahead.menu.$node;
			var $more = $node.find(".tt-more").html(ewLanguage.Phrase("More"));
			if (arguments.length > 1 && // Arguments: event, suggestion, suggestion, ...
				self._recordCount > self.count()) {
				var timer;
				$more.one(options.trigger, function(e) {
					if (timer)
						timer.cancel();
					$.later(options.delay, null, function() {
						self.more();
					});
					e.preventDefault();
					e.stopPropagation();
				});
			} else {
				$more.hide();
			}
		});
		$input.off("blur.tt");
		self.typeahead = $input.data("tt-typeahead");
		var $menu = self.typeahead.menu.$node.css("z-index", 9001);
		if (self.minWidth)
			$menu.css("min-width", self.minWidth);
		var $dataset = $menu.find(".tt-dataset");
		var maxHeight = self.maxHeight ||
			(parseInt($dataset.css("line-height"), 10) + 6) * (dataset.limit + 1); // Match .tt-suggestion padding
		$dataset.css({"max-height": maxHeight, "overflow-y": "auto"});
	});
}

// Get first element (not necessarily form element)
function ewr_GetElement(name, root) {
	var $ = jQuery, root = $.isString(root) ? "#" + root : root,
		selector = "#" + name.replace(/([\$\[\]])/g, "\\$1") + ",[name='" + name + "']";
	return (root) ? $(root).find(selector)[0] : $(selector).first()[0];
}

// Check if same text
function ewr_SameText(o1, o2) {
	return (String(o1).toLowerCase() == String(o2).toLowerCase());
}

// Check if same string
function ewr_SameStr(o1, o2) {
	return (String(o1) == String(o2));
}

// Check if an element is in array (deprecated)
function ewr_InArray(el, ar) {
	return ar.indexOf(el);
}

// Get a value from querystring
function ewr_Get(key, query) {
	query = query || window.location.search;
	var re = /(?:\?|&)([^&=]+)=?([^&]*)/g;
	var decodeRE = /\+/g;
	var decode = function(str) {
		return decodeURIComponent(str.replace(decodeRE, " "));
	};
	var params = {}, e;
	while (e = re.exec(query)) {
		var k = decode(e[1]), v = decode(e[2]);
		if (k.substring(k.length - 2) === "[]")
			k = k.substring(0, k.length - 2);
		(params[k] || (params[k] = [])).push(v);
	}
	return params[key];
}

// Set language
function ewr_SetLanguage(el) {
	var $ = jQuery, $el = $(el), val = $el.val() || $el.data("language");
	if (!val)
		return;
	var url = window.location.href;
	if (window.location.search) {
		var query = window.location.search;
		var param = {};
		query.replace(/(?:\?|&)([^&=]*)=?([^&]*)/g, function ($0, $1, $2) {
			if ($1)
				param[$1] = $2;
		});
		param["language"] = encodeURIComponent(val);
		var q = "?";
		for (var i in param)
			q += i + "=" + param[i] + "&";
		q = q.substr(0, q.length-1);
		var p = url.lastIndexOf(window.location.search);
		url = url.substr(0, p) + q;
	} else {
		if (window.location.hash) // Add hash to end
			url = url.split("#")[0] + "?language=" + encodeURIComponent(val) + "#" + url.split("#")[1];
		else
			url += "?language=" + encodeURIComponent(val);
	}
	window.location = url;
}

// Get Ctrl key for multiple column sort
function ewr_Sort(e, url, type) {
	if (type == 2 && e && e.ctrlKey)
		url += "&ctrl=1";
	location = url;
	return true;
}

// Check if modal lookup
function ewr_IsModalLookup(el) {
	var $ = jQuery, $el = $(el);
	return (el && $el.is(":hidden") && $el.data("lookup"));
}

// Check if hidden textbox (Auto-Suggest)
function ewr_IsAutoSuggest(el) {
	var $ = jQuery, $el = $(el);
	return ($el[0] && $el.is(":hidden") && $el.data("autosuggest"));
}

// Get AutoSuggest instance
function ewr_GetAutoSuggest(el) {
	return ewrForms(el).AutoSuggests[el.id];
}

// Alert
// type {string} "muted|primary|success|info|warning|danger"
function ewr_Alert(msg, cb, type) {
	var $ = jQuery;
	if (EWR_IS_MOBILE) {
		alert(msg);
		if (cb)
			$.later(100, null, cb); // Focus later to make sure editors are created
	} else {
		var $dlg = $("#ewrMsgBox");
		$dlg.find(".modal-body").html('<p class="text-' + (type || 'danger') + '">' + msg + '</p>');
		$dlg.find(".modal-footer button").prop("disabled", false); // Make sure that the footer button is enabled
		$dlg.modal("show");
		if (cb)
			$dlg.off("hidden.bs.modal").on("hidden.bs.modal", cb);
	}
}

// Show error message
function ewr_OnError(frm, el, msg) {
	if (el.jquery) { // el is jQuery object
		var typ = el.attr("type");
		el = (typ == "checkbox" || typ == "radio") ? el.get() : el[0];
	}
	ewr_Alert(msg, function() {
		ewr_SetFocus(el);
	});
	return false;
}

// Set focus
function ewr_SetFocus(obj) {
	if (!obj)
		return;
	var $ = jQuery, $obj = $(obj);
	if (!obj.options && obj.length) { // Radio/Checkbox list
		obj = $obj.filter("[value!='{value}']")[0];
	} else if (ewr_IsAutoSuggest(obj)) { // Auto-Suggest
		obj = ewr_GetAutoSuggest(obj).input;
	}
	var $cg = $obj.closest(".form-group").addClass("has-error");
	if (ewr_IsModalLookup(obj))
		$cg.find(":button").on("click", function() {
			$cg.removeClass("has-error");
		});
	else
		$(obj).focus().select().one("click keypress", function() {
			$cg.removeClass("has-error");
		});
}

// Check if object has value
function ewr_HasValue(obj) {
	return ewr_GetOptValues(obj).join("") != "";
}

// Encode html
function ewr_HtmlEncode(text) {
	var str = text;
	str = str.replace(/&/g, '&amp');
	str = str.replace(/\"/g, '&quot;');
	str = str.replace(/</g, '&lt;');
	str = str.replace(/>/g, '&gt;');
	return str;
}

// Extended basic search clear form
function ewr_ClearForm(form){
	var $ = jQuery;
	$(form).find("[id^=sv_],[id^=sv2_]").each(function() {
		if (this.type == "checkbox" || this.type == "radio") {
			this.checked = false;
		} else if (this.type == "select-one") {
			this.selectedIndex = 0;
		} else if (this.type == "select-multiple") {
			$(this).find("option").prop("selected", false);
		} else if (this.type == "text" || this.type == "textarea") {
			this.value = "";
			if (ewr_IsAutoSuggest(this))
				ewr_GetAutoSuggest(this).input.value = "";
		}
	});
}

// Stop propagation
function ewr_StopPropagation(e) {
	if (e.stopPropagation) {
		e.stopPropagation();
	} else {
		e.cancelBubble = true;
	}
}

// Setup table
function ewr_SetupTable(index, tbl, force) {
	var $ = jQuery, $tbl = $(tbl), $rows = $(tbl.rows);
	if (!tbl || !tbl.rows || !force && $tbl.data("isset") || tbl.tBodies.length == 0)
		return;
	var n = $rows.filter("[data-rowindex=1]").length || $rows.filter("[data-rowindex=0]").length || 1; // Alternate color every n rows
	var rows = $rows.filter(":not(." + EWR_ITEM_TEMPLATE_CLASSNAME + "):not(:hidden)").each(function() {
		$(this.cells).removeClass(EWR_TABLE_LAST_ROW_CLASSNAME).last().addClass(EWR_TABLE_LAST_COL_CLASSNAME); // Cell of last column
	}).get();
	var div = $tbl.parentsUntil(".ewGrid", ".table-responsive")[0];
	if (rows.length) {
		for (var i = 1; i <= n; i++) {
			var r = rows[rows.length - i]; // Last rows
			$(r.cells).each(function() {
				if (this.rowSpan == i) // Cell of last row
					$(this).addClass(EWR_TABLE_LAST_ROW_CLASSNAME)
						.toggleClass(EWR_TABLE_BORDER_BOTTOM_CLASSNAME, !!div && div.offsetHeight > tbl.offsetHeight);
			});
		}
	}
	ewr_SetupGrid(index, $tbl.closest("." + EWR_GRID_CLASSNAME)[0], force);
	$tbl.data("isset", true);
}

// Setup grid
function ewr_SetupGrid(index, grid, force) {
	var $ = jQuery, $grid = $(grid);
	if (!grid || !force && $grid.data("isset"))
		return;
	$grid.find(".ewGridUpperPanel, .ewGridLowerPanel").each(function() {
		var $this = $(this);
		if (!$this.text().trim()) $this.hide();
	});
	var	rowcnt = $grid.find("table." + EWR_TABLE_CLASSNAME + " > tbody:first > tr").length;
	if (rowcnt == 0 && !$grid.find(".ewGridUpperPanel, .ewGridLowerPanel")[0])
		$grid.hide();
	if (!$grid.find(".ewGridUpperPanel:visible")[0])
		$grid.css({"border-top-left-radius": 0, "border-top-right-radius": 0});
	if (!$grid.find(".ewGridLowerPanel:visible")[0])
		$grid.css({"border-bottom-left-radius": 0, "border-bottom-right-radius": 0});
	if ($grid.width() > $(".content").width())
		$(document).trigger("overflow", [$grid]); // Trigger "overflow" event
	$grid.data("isset", true);
}

// Generate report URL
function ewr_ModalGenerateUrlShow(e) {
	var $ = jQuery, $dlg = ewrReportUrlDialog || $("#ewrReportUrlDialog"), $sf = $(".ewExtFilterForm");
	if (!$dlg)
		return;
	// Get local filters
	var getLocalFilters = function() {
		filters = [];
		if ($sf) {
			var id = $sf.attr("id");
			var localFilters = $.localStorage.get(id + "_filters") || [];
			var ar = $.grep(localFilters, function(val) {
				if ($.isArray(val) && val.length == 2)
					return val;
			});
			if (ar.length) {
				for (var i in ar) {
					if (!$.isArray(ar[i]))
						continue;
					filters[filters.length] = ar[i];
				}
			}
		}
		return filters;
	}
	var $f = $dlg.find(".modal-body form");
	$f.find("#ewrReportType").off("change.ew").on("change.ew", function() {
		$f.find(".ewReportEmail").toggleClass("hidden", $(this).val() != "email"); // Show/hide email related options
	}).triggerHandler("change");
	$f.find("#ewrUrl").val(""); // Clear output URL
	// Add filters
	var filters = getLocalFilters();
	for (var i = 0, len = filters.length; i < len; i++)
		$f.find("#ewrFilterName").find(".ewFilter").remove()
			.end().append($("<option>", { class: "ewFilter", value:filters[i][0], text:filters[i][0] }));
	var frm = $f.data("form");
	if (!frm) {
		frm = new ewr_Form($f.attr("id"));
		frm.Validate = function() {
			var elm, fobj = this.GetForm();
			elm = fobj.elements["sender"];
			if (elm && !ewr_HasValue(elm))
				return this.OnError(elm, ewLanguage.Phrase("EnterSenderEmail"));
			if (elm && !ewr_CheckEmailList(elm.value, 1))
				return this.OnError(elm, ewLanguage.Phrase("EnterProperSenderEmail"));
			elm = fobj.elements["recipient"];
			if (elm && !ewr_HasValue(elm))
				return this.OnError(elm, ewLanguage.Phrase("EnterRecipientEmail"));
			if (elm && !ewr_CheckEmailList(elm.value, EWR_MAX_EMAIL_RECIPIENT))
				return this.OnError(elm, ewLanguage.Phrase("EnterProperRecipientEmail"));
			elm = fobj.elements["cc"];
			if (elm && !ewr_CheckEmailList(elm.value, EWR_MAX_EMAIL_RECIPIENT))
				return this.OnError(elm, ewLanguage.Phrase("EnterProperCcEmail"));
			elm = fobj.elements["bcc"];
			if (elm && !ewr_CheckEmailList(elm.value, EWR_MAX_EMAIL_RECIPIENT))
				return this.OnError(elm, ewLanguage.Phrase("EnterProperBccEmail"));
			elm = fobj.elements["subject"];
			if (elm && !ewr_HasValue(elm))
				return this.OnError(elm, ewLanguage.Phrase("EnterSubject"));
			return true;
		};
		frm.Submit = function() {
			var fobj = this.GetForm(), $fobj = $(fobj);
			var reportType = ewr_GetOptValues("reporttype", fobj);
			var filterName = ewr_GetOptValues("filtername", fobj);
			if (reportType == "email" && !this.Validate())
				return false;
			var data = $fobj.serialize();
			if (filterName != "") {
				if (filterName == "@@current") {
					var sfobj = $sf.attr("id") ? ewrForms[$sf.attr("id")] : null;
					if (sfobj && sfobj.FilterList) // Add current filter
						data += "&filter=" + JSON.stringify(sfobj.FilterList);
				} else {
					for (var i = 0, len = filters.length; i < len; i++) {
						if (filters[i][0] == filterName) // Add filter criteria
							data += "&filter=" + JSON.stringify(filters[i][1]);
					}
				}
			}
			$.post(fobj.action, data, function(data) {
				var result, url;
				if (data) {
					try {
						result = $.parseJSON(data);
					} catch(e) {}
				}
				if ($.isObject(result) && result.url) {
					url = result.url;
				} else {
					url = ewr_StripScript(data).match(/<body[\s\S]*>[\s\S]*<\/body>/i);
				}
				$fobj.find("#ewrUrl").val(url);
			});
			return false;
		};
		$f.data("form", frm);
	}
	var $el = $(e.currentTarget);
	$dlg.modal("hide").find(".modal-title").html($el.data("original-title") || $el.attr("title"));
	$dlg.find(".modal-footer .btn-primary").unbind().click(function(e) {
		e.preventDefault();
		frm.Submit();
	});
	var $copy = $dlg.find(".modal-footer .ewCopyToClipboard");
	if (!$copy.data("clipboard"))
		$copy.data("clipboard", new Clipboard($copy[0]));
	ewrReportUrlDialog = $dlg.modal("show");
}

// Show dialog for email sending
// Argument object members:
// - lnk {string} email link id
// - hdr {string} dialog header
// - url {string} URL of the email script
// - exportid - export id
// - el - element
function ewr_EmailDialogShow(oArg) {
	var $ = jQuery, $dlg = ewrEmailDialog || $("#ewrEmailDialog");
	if (!$dlg)
		return;
	var $f = $dlg.find(".modal-body form").data("args", oArg);
	var frm = $f.data("form");
	if (!frm) {
		frm = new ewr_Form($f.attr("id"));
		frm.Validate = function() {
			var elm, fobj = this.GetForm();
			elm = fobj.elements["sender"];
			if (elm && !ewr_HasValue(elm))
				return this.OnError(elm, ewLanguage.Phrase("EnterSenderEmail"));
			if (elm && !ewr_CheckEmailList(elm.value, 1))
				return this.OnError(elm, ewLanguage.Phrase("EnterProperSenderEmail"));
			elm = fobj.elements["recipient"];
			if (elm && !ewr_HasValue(elm))
				return this.OnError(elm, ewLanguage.Phrase("EnterRecipientEmail"));
			if (elm && !ewr_CheckEmailList(elm.value, EWR_MAX_EMAIL_RECIPIENT))
				return this.OnError(elm, ewLanguage.Phrase("EnterProperRecipientEmail"));
			elm = fobj.elements["cc"];
			if (elm && !ewr_CheckEmailList(elm.value, EWR_MAX_EMAIL_RECIPIENT))
				return this.OnError(elm, ewLanguage.Phrase("EnterProperCcEmail"));
			elm = fobj.elements["bcc"];
			if (elm && !ewr_CheckEmailList(elm.value, EWR_MAX_EMAIL_RECIPIENT))
				return this.OnError(elm, ewLanguage.Phrase("EnterProperBccEmail"));
			elm = fobj.elements["subject"];
			if (elm && !ewr_HasValue(elm))
				return this.OnError(elm, ewLanguage.Phrase("EnterSubject"));
			return true;
		};
		frm.Submit = function() {
			var fobj = this.GetForm(), $fobj = $(fobj), args = $fobj.data("args");
			var exporttype = ewr_GetOptValues("contenttype", fobj);
			if (args.url && args.exportid && exporttype == "html") {
				if (!this.Validate())
					return false;
				$dlg.modal("hide");
				ewr_ExportCharts(args.el, args.url, args.exportid, fobj);
			} else {
				var data = $fobj.serialize();
				data += "&token=" + EWR_TOKEN; // Add token
				$.post(fobj.action, data, function(result) {
					ewr_ShowMessage(result);
				});
				$dlg.modal("hide");
			}
			return false;
		};
		$f.data("form", frm);
	}
	$dlg.modal("hide").find(".modal-title").html(oArg.hdr);
	$dlg.find(".modal-footer .btn-primary").unbind().click(function(e) {
		e.preventDefault();
		if (frm.Submit())
			$dlg.modal("hide");
	});
	ewrEmailDialog = $dlg.modal("show");
}

// Hide Modal dialog
function ewr_ModalDialogHide(e) {
	var $ = jQuery, $dlg = $(this);
	ewr_RemoveScript("ModalDialog");
	var frm = $dlg.removeData("args").find(".modal-body form").data("form");
	if (frm)
		frm.DestroyEditor();
	$body = $dlg.find(".modal-body").html("");
	if ($body.ewjtable && $body.ewjtable("instance"))
		$body.ewjtable("destroy");
	$dlg.find(".modal-footer .btn-primary").unbind();
	$dlg.find(".modal-dialog").removeClass(function(index, className) {
		var m = className.match(/table\-\w+/);
		return (m) ? m[0] : "";
	});
	$dlg.data("showing", false);
}

// Show Modal Lookup
function ewr_ModalLookupShow(args) {
	var $ = jQuery, el = args.el, f = ewr_GetForm(args.lnk);
	if (!f || !el)
		return;

	var $dlg = ewrModalLookupDialog || $("#ewrModalLookupDialog").on("hidden.bs.modal", ewr_ModalDialogHide);
	if ($dlg.data("showing"))
		return;
	$dlg.data("showing", true);
	var id = ewr_GetId(el, true), $f = $(f), $input = $f.find("[id='" + el + "']"), // id may contains "[]"
		$body = $dlg.find(".modal-body");
	$input.parent().find(".ewLookupText").focus();

	// Format data
	var _format = function(data) {
		if (data.Result == "OK" && $.isArray(data.Records)) {
			$.each(data.Records, function(index, ar) {
				var item = { "lf": ar[0], "df1": ar[1], "df2": ar[2], "df3": ar[3], "df4": ar[4] };
				if (list.Template) {
					item["df"] = list.Template.render(item);
				} else {
					item["df"] = ewr_DisplayValue(ar, $input);
				}
				data.Records[index] = item;
			});
		}
	}

	// Set AutoSuggest
	var setAutoSuggest = function(value, text) {
		if (!ewr_IsAutoSuggest($input))
			return;
		var o = ewr_GetAutoSuggest($input[0]);
		o._options[o._options.length] = {"val": value, "lbl": text};
		o.input.value = text;
	}

	// Add option
	var addOpt = function(ar) {
		// Check if selected records are in the current page
		var vals = [], htms = "", txts = "", useText = !args.m && args.srch;
		$body.ewjtable("selectedRows").each(function() {
			var record = $(this).data("record");
			var ar = $.map(record, function(el) { return el });
			vals.push(record.lf);
			htms += (htms !== "" ? ", " : "") + record.df;
			txts += (txts !== "" ? ", " : "") + ewr_DisplayValue(ar, $input);
		});
		if (ar.sort().join() === vals.sort().join()) { // All selected records are from the current page
			$(args.lnk).prev(".ewLookupList").find(".ewLookupText").html(htms != "" ? htms : ewLanguage.Phrase("PleaseSelect"));
			setAutoSuggest(vals.join(), txts);
			$input.val(useText ? htms : vals.join()).change();
		} else { // Get selected records from server
			var dataToPost = data + "&" + $.param({ "keys": ar });
			$.ajax(EWR_MODAL_LOOKUP_FILE_NAME, {
				type: "POST",
				dataType: "json",
				data: dataToPost
			}).done(_format).then(function(data) {
				if (data.Result == "OK" && $.isArray(data.Records)) {
					var vals = [], htms = "", txts = "", results = data.Records;
					for (var i = 0, cnt = results.length; i < cnt; i++) {
						var result = results[i];
						var ar = $.map(result, function(el) { return el });
						vals.push(result.lf);
						htms += (htms !== "" ? ", " : "") + result.df; // Separator
						txts += (txts !== "" ? ", " : "") + ewr_DisplayValue(ar, $input);
					}
					$(args.lnk).prev(".ewLookupList").find(".ewLookupText").html(htms != "" ? htms : ewLanguage.Phrase("PleaseSelect"));
					setAutoSuggest(vals.join(), txts);
					$input.val(useText ? htms : vals.join()).change();
				}
			});
		}
	}

	// Submit
	var _submit = function() {
		addOpt(arLinkValue);
		$dlg.modal("hide");
		return false;
	}

	// Hide
	$dlg.modal("hide");
	$dlg.data("args", args);
	var _timer, $search;

	// Success
	var success = function(data) {
		if (data.Result == "OK") {
			$dlg.find(".modal-title").html($(args.lnk).attr("title") || $(args.lnk).data("original-title"));
			$dlg.find(".modal-footer").html('<button type="button" id="btnSelect" class="btn btn-primary ewButton">' + ewLanguage.Phrase("SelectBtn") + '</button>' +
				'<button type="button" class="btn btn-default ewButton" data-dismiss=\"modal">' + ewLanguage.Phrase("CancelBtn") + '</button>');
			$search = $('<input type="text" name="sv" class="form-control" placeholder="' + ewLanguage.Phrase("Search") + '">')
				.prependTo($body).on("keyup", function(e) {
					if (_timer)
						_timer.cancel();
					_timer = $.later(EWR_LOOKUP_DELAY, null, function() {
						$body.ewjtable("load", { "sv": $search.val() });
					});
				});
			$dlg.find(".modal-footer #btnSelect").click(_submit); // Select
			ewrModalLookupDialog = $dlg.modal("show");
		} else {
			ewr_Alert(data.Message);
		}
	};

	var list = ewrForms[f.id].Lists(el.replace(/^[xy]\d*_/, "x_"));
	var linkValue = $input.val(); // Link values
	var arLinkValue = (linkValue !== "") ? linkValue.split(",") : [];
	var data = $f.find("#s_" + id).val();
	data += "&lt=" + encodeURIComponent(list.LinkTable); // Link table
	data += "&lf=" + encodeURIComponent(list.LinkField.substring(2)); // Link field
	for (var i = 0, cnt = list.DisplayFields.length; i < cnt; i++) // Display fields
		data += "&ldf" + (i+1) + "=" + encodeURIComponent(list.DisplayFields[i].substring(2));

	// Add parent field values
	var oid = ewr_GetId(el, false);
	var prefix = "", rowindex = "", m = oid.match(/^([xy])(\d*)_/);
	if (m) {
		prefix = m[1];
		rowindex = m[2];
	}
	var nid = oid.replace(/^([xy])(\d*)_/, "x_");
	var parentId = list.ParentFields.slice(); // Clone
	if (rowindex != "") {
		for (var i = 0, len = parentId.length; i < len; i++) {
			var ar = parentId[i].split(" ");
			if (ar.length == 1) // Parent field in the same table, add row index
				parentId[i] = parentId[i].replace(/^x_/, "x" + rowindex + "_");
		}
	}
	var arp = [];
	for (var i = 0, len = parentId.length; i < len; i++)
		arp[arp.length] = ewr_GetOptValues(parentId[i], f);
	for (var i = 0, cnt = arp.length; i < cnt; i++) // Filter by parent fields
		data += "&v" + (i+1) + "=" + encodeURIComponent(arp[i].join(EWR_LOOKUP_FILTER_VALUE_SEPARATOR));

	$("body").css("cursor", "wait");

	$body.ewjtable({
		paging: true,
		pageSize: args.n,
		pageSizes: [],
		pageSizeChangeArea: false,
		paging: true,
		pageList: "minimal",
		selecting: true,
		selectingCheckboxes: true,
		multiselect: !!args.m,
		actions: {
			"listAction": function(postData, jtParams) {
				var dataToPost = data + "&start=" + jtParams.start + "&recperpage=" + jtParams.recperpage;
				if ($.isObject(postData)) // Search
					dataToPost += "&" + $.param(postData);
				return $.Deferred(function($dfd) {
					$.ajax(EWR_MODAL_LOOKUP_FILE_NAME, {
						type: "POST",
						dataType: "json",
						data: dataToPost,
						success: function(data) { $dfd.resolve(data); },
						error: function() { $dfd.reject(); }
					});
				}).done(_format).always(function() {
					$("body").css("cursor", "default");
				});
			}
		},
		messages: {
			serverCommunicationError: ewLanguage.Phrase("ServerCommunicationError"),
			loadingMessage: ewLanguage.Phrase("Loading"),
			noDataAvailable: ewLanguage.Phrase("NoRecord"),
			close: ewLanguage.Phrase("CloseBtn"),
			pagingInfo: ewLanguage.Phrase("Record") + " {0}-{1} " + ewLanguage.Phrase("Of") + " {2}",
			pageSizeChangeLabel: ewLanguage.Phrase("RecordsPerPage"),
			gotoPageLabel: ewLanguage.Phrase("Page")
		},
		fields: {
			"lf": { key: true, list: false},
			"df": {}
		},
		recordsLoaded: function(e, data) {
			var selectedRows = $(e.target).find(".ewjtable-data-row").filter(function() {
				return arLinkValue.includes(String($(this).data("record-key")));
			});
			$(e.target).ewjtable("selectRows", selectedRows);
		},
		selectionChanged: function(e, data) {
			var $rows = data.rows;
			if ($rows) {
				if (!args.m)
					arLinkValue = [];
				$rows.each(function() {
					var $row = $(this);
					var key = String($row.data("record-key"));
					var index = arLinkValue.indexOf(key);
					var selected = $row.hasClass("ewjtable-row-selected");
					if (selected && index == -1)
						arLinkValue.push(key);
					else if (!selected && index > -1)
						arLinkValue.splice(index, 1);
				});
			}
		}
	}).ewjtable("load", null, success);
}

// Ajax query
// Prerequisite: Output encrypted SQL by Client Script or Startup Script, e.g.
// var sql = "<?php echo ewr_Encrypt("SELECT xxx FROM xxx WHERE xxx = '{query_value}'") ?>";
// where "{query_value}" will be replaced by runtime value.
// s {string} Encrypted SQL
// data {string|object} string to replace "{query_value}" in SQL, or object (e.g. {"q": xxx, "q1": xxx, "q2": yyy}) to replace additional values "{query_value_n}" in SQL
// callback {function} callback function for async request (see http://api.jquery.com/jQuery.post/), empty for sync request
// Note: Return value is string or array of string.
function ewr_Ajax(sql, data, callback) {
	if (!sql)
		return undefined;
	var $ = jQuery, obj = $.extend({ s: sql }, ($.isObject(data)) ? data : { q: data });
	var _convert = function(aResults) {
		if ($.isArray(aResults) && aResults.length == 1) { // Single row
			aResults = aResults[0];
			if ($.isArray(aResults) && aResults.length == 1) // Single column
				return aResults[0]; // Return a value
			else
				return aResults; // Return a row
		}
		return aResults;
	};
	if ($.isFunction(callback)) { // Async
		$.post(EWR_LOOKUP_FILE_NAME, obj, function(result) {
			callback(_convert(result));
		}, "json");
	} else { // Sync
		var result = $.ajax({ url: EWR_LOOKUP_FILE_NAME, async: false, type: "POST", data: obj }).responseText;
		var aResults = $.parseJSON(result);
		return _convert(aResults);
	}
}

// Show drill down
function ewr_ShowDrillDown(e, obj, url, id, hdr) {
	if (e && e.ctrlKey) {
		ewr_Redirect(url.replace("?d=1&", "?d=2&")); // Change d parameter to 2
		return false;
	}
	var $ = jQuery, pos = ($.isString(obj)) ? "top" : "bottom", //  isString(obj) => chart
		$obj = ($.isString(obj)) ? $("#" + obj) : $(obj);
	$obj.tooltip("hide");
	var args = {"obj": $obj[0], "id": id, "url": url, "hdr": hdr};
	$(document).trigger("drilldown", [args]);
	var ar = args.url.split("?");
	args.file = (ar[0]) ? ar[0] : "";
	args.data = (ar[1]) ? ar[1] : "";
	args.data += (args.data != "" ? "&" : "") + "token=" + EWR_TOKEN; // Add token
	if (!$obj.data("bs.popover")) {
		$obj.popover({
			html: true,
			placement: pos,
			trigger: "manual",
			template: '<div class="popover"><h3 class="popover-title" style="cursor: move;"></h3>' +
				'<div class="popover-content"></div></div>',
			content: '<div class="ewrLoading"><div class="ewSpinner"><div></div></div> ' +
				ewLanguage.Phrase("Loading").replace("%s", "") + '</div>',
			container: $("#ewrDrillDownPanel")
		}).on("show.bs.popover", function(e) {
			$obj.attr("data-original-title", "");
		}).on("shown.bs.popover", function(e) {
			if (!$obj.data("args"))
				return;
			$.ajax({
				cache: false,
				dataType: "html",
				type: "POST",
				data: $obj.data("args").data,
				url: $obj.data("args").file,
				success: function(data) {
					var $tip = $obj.data("bs.popover").tip().on("mousedown", function(e) {
						var $this = $(this).addClass("drag");
						var height = $this.outerHeight();
						var width = $this.outerWidth();
						var ypos = $this.offset().top + height - e.pageY;
						var xpos = $this.offset().left + width - e.pageX;
						$(document.body).on("mousemove", function(e) {
							var itop = e.pageY + ypos - height;
							var ileft = e.pageX + xpos - width;
							if ($this.hasClass("drag"))
								$this.offset({top: itop, left: ileft});
						}).on("mouseup", function(e){
							$this.removeClass("drag");
						});
					});
					if (args.hdr)
						$tip.find(".popover-title").empty().show()
							.append('<button type="button" class="close" aria-hidden="true">&times;</button>' + args.hdr)
							.find(".close").click(function() { $obj.popover("hide"); });
					var reb = /<body[^>]*>([\s\S]*?)<\/body\s*>/i;
					if (data.match(reb)) // Use HTML in document body only
						data = RegExp.$1;
					var html = ewr_StripScript(data);
					var $bd = $tip.find(".popover-content").html(html);
					if (EWR_IS_MOBILE) { // If mobile, insert the container table only
						var container = $bd.find("#ewContainer")[0];
						if (container)
							$bd.empty().append(container);
					}
					$bd.find(".ewTable").each(ewr_SetupTable);
					ewr_ExecScript(data, id);
				},
				error: function(o) {
					if (o.responseText) {
						var $tip = $el.data("bs.popover").tip();
						$tip.find(".popover-content").empty().append('<p class="text-error">' + o.responseText + '</p>');
					}
				}
			});
		}).on("hidden.bs.popover", function(e) {
			for (var i = 0; i < ewrDrillCharts.length; i++) { // Dispose charts
				var cht = FusionCharts(ewrDrillCharts[i]);
				cht.dispose();
			}
			ewrDrillCharts = [];
			ewr_RemoveScript(id);
		});
	}
	$obj.data("args", args).popover("show");
}

// Execute JavaScript in HTML loaded by Ajax
function ewr_ExecScript(html, id) {
	var ar, i = 0, re = /<script([^>]*)>([\s\S]*?)<\/script\s*>/ig;
	while ((ar = re.exec(html)) != null) {
		var text = RegExp.$2;
		if (text != "" && !/ewr_Get(Css|Script)/i.test(text) &&
			/(\s+type\s*=\s*['"]*(text|application)\/(java|ecma)script['"]*)|^((?!\s+type\s*=).)*$/i.test(RegExp.$1))
			ewr_AddScript(text, "scr_" + id + "_" + i++);
	}
}

// Strip JavaScript in HTML loaded by Ajax
function ewr_StripScript(html) {
	var ar, re = /<script([^>]*)>([\s\S]*?)<\/script\s*>/ig;
	var str = html;
	while ((ar = re.exec(html)) != null) {
		var text = RegExp.lastMatch;
		if (/(\s+type\s*=\s*['"]*(text|application)\/(java|ecma)script['"]*)|^((?!\s+type\s*=).)*$/i.test(RegExp.$1))
			str = str.replace(text, "");
	}
	return str;
}

// Add SCRIPT tag
function ewr_AddScript(text, id) {
	var scr = document.createElement("SCRIPT");
	if (id)
		scr.id = id;
	scr.type = "text/javascript";
	scr.text = text;
	return document.body.appendChild(scr);
}

// Remove JavaScript added by Ajax
function ewr_RemoveScript(id) {
	if (id)
		jQuery("script[id^='scr_" + id + "_']").remove();
}

// Language class
function ewr_Language(obj) {
	this.obj = obj;
	this.Phrase = function(id) {
		return this.obj[id.toLowerCase()];
	};
}

// Apply client side template to a DIV
function ewr_ApplyTemplate(divId, tmplId, classId, exportType, data) {
	var $ = jQuery, $tmpl = $("#" + tmplId);
	if (!$.views || !$tmpl[0])
		return;
	// Add script tags
	$('span[data-class^=tp],div[data-class^=tp]').html(function() {
		var $this = $(this);
		return '<scr' + 'ipt type="text/html" class="' + classId + '" id="' + $this.data('class') + '">' + $this.html() + '</scr' + 'ipt>';
	});
	if (!$tmpl.attr("type")) // Not script
		$tmpl.attr("type", "text/html");
	var args = {data: data || {}, id: divId, template: tmplId, enabled: true};
	$(document).trigger("rendertemplate", [args]);
	if (args.enabled)
		$("#" + divId).html($tmpl.render(args.data));
	// Export custom
	if (exportType && exportType != "print") {
		$(function() {
			var $meta = $("meta[http-equiv='Content-Type']");
			var html = "<html><head>";
			if ($meta[0])
				html += "<meta http-equiv='Content-Type' content='" + $meta.attr("content") + "'>";
			if (exportType == "pdf") {
				html += "<link rel='stylesheet' type='text/css' href='" + EWR_PDF_STYLESHEET_FILENAME + "'>";
			} else {
				html += "<style>" + $.ajax({async: false, type: "GET", url: EWR_PROJECT_STYLESHEET_FILENAME}).responseText + "</style>";
			}
			html += "</" + "head><body>";
			$("span.ewChartTop").each(function(){ html += $(this).html(); });
			html += $("#" + divId).find('div[id^="ct_"]').html();
			$("span.ewChartBottom").each(function(){ html += $(this).html(); });
			html += "</body></html>";
			var url = window.location.href.split('?')[0];
			var data = {"customexport": exportType, "data": html, "filename": classId};
			if (exportType == "email") {
				var str = window.location.search.replace(/^\?/, "") + "&" + $.param(data);
				str += "&token=" + EWR_TOKEN; // Add token
				$.post(url, str, function(data) {
					ewr_ShowMessage(data);
				});
			} else {
				ewr_FileDownload(url, data);
			}
			if (window.location != window.parent.location && window.parent.jQuery) // In iframe
				window.parent.jQuery("body").css("cursor", "default");
		})
	}
}

// Render client side template and return the rendered HTML
function ewr_RenderTemplate(tmpl, data) {
	var $ = jQuery, $tmpl = (tmpl && tmpl.render) ? tmpl : $(tmpl);
	if (!$tmpl.render)
		return;
	var args = {$template: $tmpl, data: data};
	$(document).trigger("rendertemplate", [args])
	var html = $tmpl.render(args.data), method = args.$template.data("method"), target = args.$template.data("target");
	if (html && method && target) // Render by specified method to target
		$(html)[method](target);
	else if (html && !method && target) // No method, render as inner HTML of target
		$(target).html(html);
	else if (html && !method && !target) // No method and target, render locally
		$tmpl.parent().append(html);
	return html;
}

// Render all client side templates
function ewr_RenderJsTemplates(e) {
	var $ = jQuery, ids = {}, el = (e && e.target) ? e.target : document;
	$(el).find(".ewJsTemplate").each(function(index) {
		var $this = $(this), name = $this.data("name"), data = $this.data("data");
		if (data && $.isString(data))
			data = ewrVar[data] || window[data]; // Get data from ewrVar or global
		if (name) {
			if (!$.render[name]) { // Render the first template of any named template only
				$.templates(name, $this.text());
				ewr_RenderTemplate($this, data);
			}
		} else { 
			ewr_RenderTemplate($this, data);
		}
	});
}

// Show template
function ewr_ShowTemplates(classname) {
	var $ = jQuery;
	$("script" + ((classname) ? "." + classname : "") + "[type='text/html']").each(function() {
		$scr = $(this);
		if (/^\s*(<(td|th)[\s\S]*>[\s\S]*<\/\2>)\s*$/i.test($scr.html())) { // Table cells
			$scr.next().before(RegExp.$1);
		} else {
			$(this).after($("<span></span>").addClass($scr.attr("class")).html($scr.html()));
		}
		$scr.closest(".ewTable, .ewViewTable, .ewGrid").removeClass("hidden").show();
	});
}

// Show message dialog
function ewr_ShowMessage(msg) {
	if (window.location != window.parent.location && parent.ewr_ShowMessage) // In iframe
		return parent.ewr_ShowMessage(msg);
	var $ = jQuery, $div = $("div.ewMessageDialog:first");
	var html = msg || ($div.length ? (EWR_IS_MOBILE ? $div.text() : $div.html()) : "");
	if ($.trim(html) == "")
		return;
	if (EWR_IS_MOBILE) {
		alert(html);
	} else {
		var $dlg = $("#ewrMsgBox");
		$dlg.find(".modal-body").html(html);
		$dlg.modal("show");
	}
}

// Random number
function ewr_Random() {
	return Math.floor(Math.random() * 100001) + 100000;
}

// Toggle search operator
function ewr_ToggleSrchOpr(id, value) {
	var el = this.form.elements[id];
	if (!el)
		return;
	el.value = (el.value != value) ? value : "=";
}

// Toggle group
function ewr_ToggleGroup(el) {
	var $ = jQuery, $el = $(el), $tr = $el.closest("tr"), selector = "tr", level;
	for (var i = 1; i <= 6; i++) {
		var idx = (i == 1) ? "" : "-" + i;
		var data = $tr.data("group" + idx);
		if ($.isValue(data)) {
			level = i;
			if (data != "")
				selector += "[data-group" + idx + "='" + String(data).replace(/'/g, "\\'") + "']";
		}
	}
	if ($el.hasClass("icon-collapse")) { // Hide
		$(selector).slice(1).addClass("ewRptGrpHide" + level);
		$el.toggleClass("icon-expand icon-collapse");
	} else {
		$(selector).slice(1).removeClass("ewRptGrpHide" + level);
		$el.toggleClass("icon-expand icon-collapse");
	}
}

// Validators

// Check US Date format (mm/dd/yyyy)
function ewr_CheckUSDate(object_value) {
	return ewr_CheckDateEx(object_value, "us", EWR_DATE_SEPARATOR);
}

// Check US Date format (mm/dd/yy)
function ewr_CheckShortUSDate(object_value) {
	return ewr_CheckDateEx(object_value, "usshort", EWR_DATE_SEPARATOR);
}

// Check Date format (yyyy/mm/dd)
function ewr_CheckDate(object_value) {
	return ewr_CheckDateEx(object_value, "std", EWR_DATE_SEPARATOR);
}

// Check Date format (yy/mm/dd)
function ewr_CheckShortDate(object_value) {
	return ewr_CheckDateEx(object_value, "stdshort", EWR_DATE_SEPARATOR);
}

// Check Euro Date format (dd/mm/yyyy)
function ewr_CheckEuroDate(object_value) {
	return ewr_CheckDateEx(object_value, "euro", EWR_DATE_SEPARATOR);
}

// Check Euro Date format (dd/mm/yy)
function ewr_CheckShortEuroDate(object_value) {
	return ewr_CheckDateEx(object_value, "euroshort", EWR_DATE_SEPARATOR);
}

// Check default date format
function ewr_CheckDateDef(object_value) {
	if (EWR_DATE_FORMAT.match(/^yyyy/))
		return ewr_CheckDate(object_value);
	else if (EWR_DATE_FORMAT.match(/^yy/))
		return ewr_CheckShortDate(object_value);
	else if (EWR_DATE_FORMAT.match(/^m/) && EWR_DATE_FORMAT.match(/yyyy$/))
		return ewr_CheckUSDate(object_value);
	else if (EWR_DATE_FORMAT.match(/^m/) && EWR_DATE_FORMAT.match(/yy$/))
		return ewr_CheckShortUSDate(object_value);
	else if (EWR_DATE_FORMAT.match(/^d/) && EWR_DATE_FORMAT.match(/yyyy$/))
		return ewr_CheckEuroDate(object_value);
	else if (EWR_DATE_FORMAT.match(/^d/) && EWR_DATE_FORMAT.match(/yy$/))
		return ewr_CheckShortEuroDate(object_value);
	return false;
}

// Check date format
//  Format: std/stdshort/us/usshort/euro/euroshort
function ewr_CheckDateEx(value, format, sep) {
	if (value == null || value.length == "" || value.startsWith("@@"))
		return true;
	while (value.indexOf("  ") > -1)
		value = value.replace(/  /g, " ");
	value = value.replace(/^\s*|\s*$/g, "");
	var arDT = value.split(" ");
	if (arDT.length > 0) {
		var re, sYear, sMonth, sDay;
		re = /^([0-9]{4})-([0][1-9]|[1][0-2])-([0][1-9]|[1|2][0-9]|[3][0|1])$/;
		if (ar = re.exec(arDT[0])) {
			sYear = ar[1];
			sMonth = ar[2];
			sDay = ar[3];
		} else {
			var wrksep = "\\" + sep;
			switch (format) {
				case "std":
					re = new RegExp("^(\\d{4})" + wrksep + "([0]?[1-9]|[1][0-2])" + wrksep + "([0]?[1-9]|[1|2]\\d|[3][0|1])$");
					break;
				case "stdshort":
					re = new RegExp("^(\\d{2})" + wrksep + "([0]?[1-9]|[1][0-2])" + wrksep + "([0]?[1-9]|[1|2]\\d|[3][0|1])$");
					break;
				case "us":
					re = new RegExp("^([0]?[1-9]|[1][0-2])" + wrksep + "([0]?[1-9]|[1|2]\\d|[3][0|1])" + wrksep + "(\\d{4})$");
					break;
				case "usshort":
					re = new RegExp("^([0]?[1-9]|[1][0-2])" + wrksep + "([0]?[1-9]|[1|2]\\d|[3][0|1])" + wrksep + "(\\d{2})$");
					break;
				case "euro":
					re = new RegExp("^([0]?[1-9]|[1|2]\\d|[3][0|1])" + wrksep + "([0]?[1-9]|[1][0-2])" + wrksep + "(\\d{4})$");
					break;
				case "euroshort":
					re = new RegExp("^([0]?[1-9]|[1|2]\\d|[3][0|1])" + wrksep + "([0]?[1-9]|[1][0-2])" + wrksep + "(\\d{2})$");
					break;
			}
			if (!re.test(arDT[0]))
				return false;
			var arD = arDT[0].split(sep);
			switch (format) {
				case "std":
				case "stdshort":
					sYear = ewr_UnformatYear(arD[0]);
					sMonth = arD[1];
					sDay = arD[2];
					break;
				case "us":
				case "usshort":
					sYear = ewr_UnformatYear(arD[2]);
					sMonth = arD[0];
					sDay = arD[1];
					break;
				case "euro":
				case "euroshort":
					sYear = ewr_UnformatYear(arD[2]);
					sMonth = arD[1];
					sDay = arD[0];
					break;
			}
		}
		if (!ewr_CheckDay(sYear, sMonth, sDay))
			return false;
	}
	if (arDT.length > 1 && !ewr_CheckTime(arDT[1]))
		return false;
	return true;
}

// Unformat 2 digit year to 4 digit year
function ewr_UnformatYear(yr) {
	if (yr.length == 2)
		return (yr > EWR_UNFORMAT_YEAR) ? "19" + yr : "20" + yr;
	return yr;
}

// Check day
function ewr_CheckDay(checkYear, checkMonth, checkDay) {
	checkYear = parseInt(checkYear, 10);
	checkMonth = parseInt(checkMonth, 10);
	checkDay = parseInt(checkDay, 10);
	var maxDay = [4, 6, 9, 11].includes(checkMonth) ? 30 : 31;
	if (checkMonth == 2)
		maxDay = (checkYear % 4 > 0 || checkYear % 100 == 0 && checkYear % 400 > 0) ? 28 : 29;
	return ewr_CheckRange(checkDay, 1, maxDay);
}

// Check integer
function ewr_CheckInteger(object_value) {
	if (!object_value || object_value.length == 0)
		return true;
	if (object_value.indexOf(EWR_DECIMAL_POINT) > -1)
		return false;
	return ewr_CheckNumber(object_value);
}

// Check number
function ewr_CheckNumber(object_value) {
	object_value = String(object_value);
	if (!object_value || object_value.length == 0)
		return true;
	object_value = object_value.replace(/^\s*|\s*$/g, "");
	var re = new RegExp("^[+-]?(\\d{1,3}(" + ((EWR_THOUSANDS_SEP) ? "\\" + EWR_THOUSANDS_SEP + "?" : "") + "\\d{3})*(\\" +
		EWR_DECIMAL_POINT + "\\d+)?|\\" + EWR_DECIMAL_POINT + "\\d+)$");
	return re.test(object_value);
}

// Convert to float
function ewr_StrToFloat(object_value) {
	object_value = String(object_value);
	if (EWR_THOUSANDS_SEP != "") {
		var re = new RegExp("\\" + EWR_THOUSANDS_SEP, "g");
		object_value = object_value.replace(re, "");
	}
	if (EWR_DECIMAL_POINT != "")
		object_value = object_value.replace(EWR_DECIMAL_POINT, ".");
	return parseFloat(object_value);
}

// Convert string (yyyy-mm-dd hh:mm:ss) to date object
function ewr_StrToDate(object_value) {
	var re = /^(\d{4})-([0][1-9]|[1][0-2])-([0][1-9]|[1|2]\d|[3][0|1]) (?:(0\d|1\d|2[0-3]):([0-5]\d):([0-5]\d))?$/;
	var ar = object_value.replace(re, "$1 $2 $3 $4 $5 $6").split(" ");
	return new Date(ar[0], ar[1]-1, ar[2], ar[3], ar[4], ar[5]);
}

// Check range
function ewr_CheckRange(object_value, min_value, max_value) {
	if (!object_value || object_value.length == 0)
		return true;
	var $ = jQuery;
	if ($.isNumber(min_value) || $.isNumber(max_value)) { // Number
		if (ewr_CheckNumber(object_value))
			object_value = ewr_StrToFloat(object_value);
	}
	if (!$.isNull(min_value) && object_value < min_value)
		return false;
	if (!$.isNull(max_value) && object_value > max_value)
		return false;
	return true;
}

// Check time
function ewr_CheckTime(object_value) {
	if (!object_value || object_value.length == 0)
		return true;
	object_value = object_value.replace(/^\s*|\s*$/g, "");
	var re = /^(0\d|1\d|2[0-3]):[0-5]\d:[0-5]\d$/;
	return re.test(object_value);
}

// Check phone
function ewr_CheckPhone(object_value) {
	if (!object_value || object_value.length == 0)
		return true;
	object_value = object_value.replace(/^\s*|\s*$/g, "");
	var re = /^\(\d{3}\) ?\d{3}( |-)?\d{4}|^\d{3}( |-)?\d{3}( |-)?\d{4}$/;
	return re.test(object_value);
}

// Check zip
function ewr_CheckZip(object_value) {
	if (!object_value || object_value.length == 0)
		return true;
	object_value = object_value.replace(/^\s*|\s*$/g, "");
	var re = /^\d{5}$|^\d{5}-\d{4}$/;
	return re.test(object_value);
}

// Check credit card
function ewr_CheckCreditCard(object_value) {
	if (!object_value || object_value.length == 0)
		return true;
	var creditcard_string = object_value.replace(/\D/g, "");
	if (creditcard_string.length == 0)
		return false;
	var doubledigit = creditcard_string.length % 2 == 1 ? false : true;
	var tempdigit, checkdigit = 0;
	for (var i = 0, len = creditcard_string.length; i < len; i++) {
		tempdigit = parseInt(creditcard_string.charAt(i));
		if (doubledigit) {
			tempdigit *= 2;
			checkdigit += (tempdigit % 10);
			if (tempdigit / 10 >= 1.0)
				checkdigit++;
			doubledigit = false;
		}	else {
			checkdigit += tempdigit;
			doubledigit = true;
		}
	}
	return (checkdigit % 10 == 0);
}

// Check social security number
function ewr_CheckSSC(object_value) {
	if (!object_value || object_value.length == 0)
		return true;
	object_value = object_value.replace(/^\s*|\s*$/g, "");
	var re = /^(?!000)([0-6]\d{2}|7([0-6]\d|7[012]))([ -]?)(?!00)\d\d\3(?!0000)\d{4}$/;
	return re.test(object_value);
}

// Check emails
function ewr_CheckEmailList(object_value, email_cnt) {
	if (!object_value || object_value.length == 0)
		return true;
	var arEmails = object_value.replace(/,/g, ";").split(";");
	for (var i = 0, len = arEmails.length; i < len; i++) {
		if (email_cnt > 0 && len > email_cnt)
			return false;
		if (!ewr_CheckEmail(arEmails[i]))
			return false;
	}
	return true;
}

// Check email
function ewr_CheckEmail(object_value) {
	if (!object_value || object_value.length == 0)
		return true;
	object_value = object_value.replace(/^\s*|\s*$/g, "");
	var re = /^[\w.%+-]+@[\w.-]+\.[A-Z]{2,18}$/i;
	return re.test(object_value);
}

// Check GUID {xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx}
function ewr_CheckGUID(object_value) {
	if (!object_value || object_value.length == 0)
		return true;
	object_value = object_value.replace(/^\s*|\s*$/g, "");
	var re = /^\{\w{8}-\w{4}-\w{4}-\w{4}-\w{12}\}$/;
	var re2 = /^\w{8}-\w{4}-\w{4}-\w{4}-\w{12}$/;
	return re.test(object_value) || re2.test(object_value);
}

// Check by regular expression
function ewr_CheckByRegEx(object_value, pattern) {
	if (!object_value || object_value.length == 0)
		return true;
	return (object_value.match(pattern)) ? true : false;
}

// Redirect by HTTP GET or POST
function ewr_Redirect(url, f, method) {
	if (!method || method.toLowerCase() == "post") { // Default
		var $ = jQuery, param = {}, $form = (f) ? $(f) : $("<form></form>").appendTo("body");
		$form.attr({ action: url.split("?")[0], method: "post" });
		url += (url.split("?").length > 1 ? "&" : "?") + "token=" + EWR_TOKEN;
		url.replace(/(?:\?|&)([^&=]*)=?([^&]*)/g, function ($0, $1, $2) {
			if ($1)
				$('<input type="hidden">').attr({ name: $1, value: $2 }).appendTo($form);
		});
		$form.submit();
	} else {
		window.location = url;
	}
}

// Create Date/Time Picker
function ewr_CreateDateTimePicker(index, el) {
	var $ = jQuery, $el = $(el), format = "", options = $el.data("options") || [];
	var _getDateTimeFormatId = function(id, withtime) {
		if (id == 5 || id == 9)
			return withtime ? 9 : 5;
		else if (id == 6 || id == 10)
			return withtime ? 10 : 6;
		else if (id == 7 || id == 11)
			return withtime ? 11 : 7;
		else if (id == 12 || id == 15)
			return withtime ? 15 : 12;
		else if (id == 13 || id == 16)
			return withtime ? 16 : 13;
		else if (id == 14 || id == 17)
			return withtime ? 17 : 14;
		return id;
	}
	var formatid = $el.data("formatid") || options.format || 0;
	if (formatid == 0)
		formatid = EWR_DATE_FORMAT_ID;
	else if (formatid == 1)
		formatid = _getDateTimeFormatId(EWR_DATE_FORMAT_ID, true);
	else if (formatid == 2)
		formatid = _getDateTimeFormatId(EWR_DATE_FORMAT_ID, false);
	switch (formatid) {
		case 5: format = "YYYY/MM/DD"; break;
		case 6: format = "MM/DD/YYYY"; break;
		case 7: format = "DD/MM/YYYY"; break;
		case 9: format = "YYYY/MM/DD HH:mm:ss"; break;
		case 10: format = "MM/DD/YYYY HH:mm:ss"; break;
		case 11: format = "DD/MM/YYYY HH:mm:ss"; break;
		case 12: format = "YY/MM/DD"; break;
		case 13: format = "MM/DD/YY"; break;
		case 14: format = "DD/MM/YY"; break;
		case 15: format = "YY/MM/DD HH:mm:ss"; break;
		case 16: format = "MM/DD/YY HH:mm:ss"; break;
		case 17: format = "DD/MM/YY HH:mm:ss"; break;
	}
	format = format.replace(/\//g, EWR_DATE_SEPARATOR).replace(/:/g, EWR_TIME_SEPARATOR);
	options.format = format;
	if (!options.locale) // locale
		options.locale = EWR_LANGUAGE_ID.toLowerCase();
	var inputGroup = $.isBoolean(options.inputGroup) ? options.inputGroup : true;
	delete(options.inputGroup);
	var args = {"el": el, "enabled": true, "inputGroup": inputGroup, "options": options};
	$(function() {
		$(document).trigger("datetimepicker", [args]);
		if (!args.enabled)
			return;
		if (args.inputGroup !== false) {
			var $btn = $('<button type="button"><span class="glyphicon glyphicon-calendar"></span></button>')
				.addClass("btn btn-default btn-sm datepickerbutton").css({ "font-size": $el.css("font-size"), "height": $el.outerHeight() })
				.click(function() { $(this).closest(".has-error").removeClass("has-error"); });
			$el.wrap('<div class="input-group date"></div>').after($('<span class="input-group-btn"></span>').append($btn));
			$el = $el.parent();
		}
		if (args.options.locale && moment.locale() != args.options.locale) {
			$.getScript(EWR_RELATIVE_PATH + "moment/locale/" + args.options.locale + ".js", function() {
				moment.localeData().postformat = function(string){ return string }; // overwrite the postformat() in <locale.js>
				$el.datetimepicker(args.options);
			});
		} else {
			$el.datetimepicker(args.options);
		}
	});
}

// jQuery.sub
if (!jQuery.sub) {
	jQuery.sub = function() {
		function jQuerySub( selector, context ) {
			return new jQuerySub.fn.init( selector, context );
		}
		jQuery.extend( true, jQuerySub, this );
		jQuerySub.superclass = this;
		jQuerySub.fn = jQuerySub.prototype = this();
		jQuerySub.fn.constructor = jQuerySub;
		jQuerySub.sub = this.sub;
		jQuerySub.fn.init = function init( selector, context ) {
			var instance = jQuery.fn.init.call( this, selector, context, rootjQuerySub );
			return instance instanceof jQuerySub ?
				instance :
				jQuerySub( instance );
		};
		jQuerySub.fn.init.prototype = jQuerySub.fn;
		var rootjQuerySub = jQuerySub(document);
		return jQuerySub;
	};
}

// jQuery "fields" plugin
// $(<input>).fields("<fieldvar>") returns jQuery object of the specified field element(s)
// $(<input>).fields() returns object of jQuery objects of all fields
(function() {
	var plugin = jQuery.sub();
	plugin.fn.extend({
		// Get jQuery object of the row (<div id='r_<n>' class='ewRow'>)
		row: function() {
			var $row = this.closest(".ewRow");
			return $row;
		},
		// Show/Hide field
		visible: function(v) {
			var $el = this.closest(".ewCell"); // Find the cell <div ... class='ewCell'>...</div>
			if (typeof(v) != "undefined") {
				$el.toggle(v);
				return this;
			} else {
				return $el.is(":visible");
			}
		},
		// Get/Set field "readonly" attribute
		// Note: This attribute is ignored if the value of the type attribute is hidden, range, color, checkbox, radio, file, or a button type
		readonly: function(v) {
			if (typeof(v) != "undefined") {
				this.prop("readOnly", v);
				return this;
			} else {
				return this.prop("readOnly");
			}
		},
		// Get/Set field "disabled" attribute
		// Note: A disabled control's value isn't submitted with the form
		disabled: function(v) {
			if (typeof(v) != "undefined") {
				this.prop("disabled", v);
				return this;
			} else {
				return this.prop("disabled");
			}
		},
		// Get/Set field value(s)
		// Note: Return array if select-multiple
		value: function(v) {
			var type = this.attr("type");
			if (typeof(v) != "undefined") {
				if (!jQuery.isArray(v))
					v = [v];
				var type = this.attr("type");
				var el = (type == "radio" || type == "checkbox") ? this.get() : this[0];
				ewr_SelectOpt(el, v);
				return this;
			} else {
				if (type == "checkbox") {
					return ewr_GetOptValues(this.get());
				} else if (type == "radio") {
					return ewr_GetOptValues(this.get()).join();
				} else {
					return this.val();
				}
			}
		},
		// Get field value as number
		toNumber: function() {
			return ewr_ParseNumber(this.value());
		},
		// Get field value as moment object
		toDate: function() {
			return ewr_ParseDate(this.value(), this.data("format"));
		},
		// Get field value as native Date object
		toJsDate: function() {
			return ewr_ParseDate(this.value(), this.data("format")).toDate();
		}
	});
	jQuery.fn.fields = function(fldvar) { // Note: fldvar has NO "x_" prefix
		var $ = jQuery, rec = {}, id = this.attr("id"), obj = this[0], f, tbl;
		if (/^(sv|sv2)_/.test(id)) { // "this" is input element
			f = ewr_GetForm(obj); // ewr_Form
			tbl = this.data("table"); // table var
		} else if (obj && obj.Form) { // "this" is ewr_Form
			f = obj.$Element; // ewr_Form
			tbl = obj.ID.replace(new RegExp("^f|" + obj.PageID + "$", "g"), ""); // table var
		}
		var selector = "[data-table=" + tbl + "][data-field" + ((fldvar) ? "=x_" + fldvar : "") + "]";
		if (f && selector) {
			$(f).find(selector).each(function() {
				var key = this.getAttribute("data-field").substr(2), name = this.getAttribute("name");
				key = (/^sv2_/.test(name)) ? "y_" + key : key; // Use "y_fldvar" as key for 2nd search input
				rec[key] = (rec[key]) ? rec[key].add(this) : plugin(this); // Create jQuery object for each field
			});
		}
		return (fldvar) ? rec[fldvar] : rec;
	};
})();

// Convert data to type Number
// config {Object} (Optional) Optional configuration values:
// - decimalSeparator {String} Decimal separator
// - thousandsSeparator {String} Thousands separator
function ewr_ParseNumber(data, config) {
	var $ = jQuery;
	if ($.isString(data)) {
		config = config || {"thousandsSeparator": EWR_THOUSANDS_SEP, "decimalSeparator": EWR_DECIMAL_POINT};
		var regexBits = [], regex, separator = config.thousandsSeparator, decimal = config.decimalSeparator;
		if (separator)
			regexBits.push(separator.replace(/[\-$\^*()+\[\]{}|\\,.?\s]/g, "\\$&") + "(?=\\d)");
		regex = new RegExp("(?:" + regexBits.join("|") + ")", "g");
		if (decimal === ".")
			decimal = null;
		data = data.replace(regex, "");
		data = (decimal) ? data.replace(decimal, ".") : data;
	}
	if ($.isString(data) && $.trim(data) !== "")
		data = +data;
	if (!$.isNumber || !isFinite(data)) // Catch NaN and Infinity
		data = null;
	return data;
}

// Format a Number to string for display
// config {Object} (Optional) Optional configuration values:
// - decimalPlaces {Number} Number of decimal places to round. Must be a number 0 to 20.
// - decimalSeparator {String} Decimal separator
// - thousandsSeparator {String} Thousands separator
// Note: null, undefined, NaN and "" returns as ""
function ewr_FormatNumber(data, config) {
	var $ = jQuery;
	if ($.isNumber(data)) {
		config = config || {"thousandsSeparator": EWR_THOUSANDS_SEP, "decimalSeparator": EWR_DECIMAL_POINT};
		var isNeg = (data < 0), output = data + "", decPlaces = config.decimalPlaces,
			decSep = config.decimalSeparator || ".", thouSep = config.thousandsSeparator,
			decIndex, newOutput, count, i;
		if ($.isNumber(decPlaces) && (decPlaces >= 0) && (decPlaces <= 20)) // Decimal precision
			output = data.toFixed(decPlaces);
		if (decSep !== ".") // Decimal separator
			output = output.replace(".", decSep);
		if (thouSep) { // Add the thousands separator
			decIndex = output.lastIndexOf(decSep); // Find the dot or where it would be
			decIndex = (decIndex > -1) ? decIndex : output.length;
			newOutput = output.substring(decIndex); // Start with the dot and everything to the right
			for (count = 0, i = decIndex; i > 0; i--) { // Working left, every third time add a separator, every time add a digit
				if (count%3 === 0 && i !== decIndex && (!isNeg || i > 1))
					newOutput = thouSep + newOutput;
				newOutput = output.charAt(i-1) + newOutput;
				count++;
			}
			output = newOutput;
		}
		return output;
	} else { // Not a Number, return as string
		return ($.isValue(data) && data.toString) ? data.toString() : "";
	}
}

// Convert data to Moment object (see http://momentjs.com/docs/)
// format {Number} Date format matching server side ewr_FormatDateTime()
function ewr_ParseDate(data, format) {
	var $ = jQuery, args = $.makeArray(arguments);
	if ($.isNumber(format) && format >=0 && format <= 17) {
		var f, def = EWR_DATE_FORMAT.toUpperCase(), sep = EWR_DATE_SEPARATOR, timesep = EWR_TIME_SEPARATOR;
		switch (format) {
			case 0: case 2: case 8: f = def + " HH" + timesep + "mm" + timesep + "ss"; break; // EWR_DATE_FORMAT + " %H:%M:%S"
			case 1: f = "dddd, MMMM DD, YYYY"; break; // "%A, %B %d, %Y"
			case 3: f = "hh:mm:ss A"; break; // "%I:%M:%S %p"
			case 4: f = "HH:mm:ss"; break; // "%H:%M:%S"
			case 5: f = "YYYY" + sep + "MM" + sep + "DD"; break; // "%Y" + sep + "%m" + sep + "%d"
			case 6: f = "MM" + sep + "DD" + sep + "YYYY"; break; // "%m" + sep + "%d" + sep + "%Y"
			case 7: f = "DD" + sep + "MM" + sep + "YYYY"; break; // "%d" + sep + "%m" + sep + "%Y"
			case 9: f = "YYYY" + sep + "MM" + sep + "DD HH" + timesep + "mm" + timesep + "ss"; break; // "%Y" + sep + "%m" + sep + "%d %H:%M:%S"
			case 10: f = "MM" + sep + "DD" + sep + "YYYY HH" + timesep + "mm" + timesep + "ss"; break; // "%m" + sep + "%d" + sep + "%Y %H:%M:%S"
			case 11: f = "DD" + sep + "MM" + sep + "YYYY HH" + timesep + "mm" + timesep + "ss"; break; // "%d" + sep + "%m" + sep + "%Y %H:%M:%S"
			case 12: f = "YY" + sep + "MM" + sep + "DD"; break; // "%y" + sep + "%m" + sep + "%d"
			case 13: f = "MM" + sep + "DD" + sep + "YY"; break; // "%m" + sep + "%d" + sep + "%y"
			case 14: f = "DD" + sep + "MM" + sep + "YY"; break; // "%d" + sep + "%m" + sep + "%y"
			case 15: f = "YY" + sep + "MM" + sep + "DD HH" + timesep + "mm" + timesep + "ss"; break; // "%y" + sep + "%m" + sep + "%d %H:%M:%S"
			case 16: f = "MM" + sep + "DD" + sep + "YY HH" + timesep + "mm" + timesep + "ss"; break; // "%m" + sep + "%d" + sep + "%y %H:%M:%S"
			case 17: f = "DD" + sep + "MM" + sep + "YY HH" + timesep + "mm" + timesep + "ss"; break; // "%d" + sep + "%m" + sep + "%y %H:%M:%S"
		}
		args[1] = [f, "YYYY-MM-DD HH" + timesep + "mm" + timesep + "ss"];
	}
	return moment.apply(this, args);
}

// Format date time
// format {String} Date format (see http://momentjs.com/docs/#/displaying/format/)
function ewr_FormatDate(data, format) {
	return moment(data).format(format || EWR_DATE_FORMAT.toUpperCase());
}

// String.includes
if (!String.prototype.includes) {
	String.prototype.includes = function(search, start) {
		'use strict';
		if (typeof start !== 'number') {
			start = 0;
		}
		
		if (start + search.length > this.length) {
			return false;
		} else {
			return this.indexOf(search, start) !== -1;
		}
	};
}

if (!String.prototype.startsWith) {
	String.prototype.startsWith = function(searchString, position) {
		return this.substr(position || 0, searchString.length) === searchString;
	};
}

if (!String.prototype.endsWith) {
	String.prototype.endsWith = function(searchStr, Position) {
		// This works much better than >= because
		// it compensates for NaN:
		if (!(Position < this.length))
			Position = this.length;
		else
			Position |= 0; // round position
		return this.substr(Position - searchStr.length, searchStr.length) === searchStr;
	};
}

// Array.includes
if (!Array.prototype.includes) {
	Object.defineProperty(Array.prototype, 'includes', {
		value: function(searchElement, fromIndex) {

		// 1. Let O be ? ToObject(this value).
		if (this == null) {
			throw new TypeError('"this" is null or not defined');
		}

		var o = Object(this);

		// 2. Let len be ? ToLength(? Get(O, "length")).
		var len = o.length >>> 0;

		// 3. If len is 0, return false.
		if (len === 0) {
			return false;
		}

		// 4. Let n be ? ToInteger(fromIndex).
		//    (If fromIndex is undefined, this step produces the value 0.)
		var n = fromIndex | 0;

		// 5. If n ??0, then
		//  a. Let k be n.
		// 6. Else n < 0,
		//  a. Let k be len + n.
		//  b. If k < 0, let k be 0.
		var k = Math.max(n >= 0 ? n : len - Math.abs(n), 0);

		function sameValueZero(x, y) {
			return x === y || (typeof x === 'number' && typeof y === 'number' && isNaN(x) && isNaN(y));
		}

		// 7. Repeat, while k < len
		while (k < len) {
			// a. Let elementK be the result of ? Get(O, ! ToString(k)).
			// b. If SameValueZero(searchElement, elementK) is true, return true.
			// c. Increase k by 1. 
			if (sameValueZero(o[k], searchElement)) {
			return true;
			}
			k++;
		}

		// 8. Return false
		return false;
		}
	});
}

// Array indexOf
if (!Array.prototype.indexOf) {
	Array.prototype.indexOf = function(searchElement, fromIndex) {

		var k;

		// 1. Let o be the result of calling ToObject passing
		//    the this value as the argument.
		if (this == null) {
			throw new TypeError('"this" is null or not defined');
		}

		var o = Object(this);

		// 2. Let lenValue be the result of calling the Get
		//    internal method of o with the argument "length".
		// 3. Let len be ToUint32(lenValue).
		var len = o.length >>> 0;

		// 4. If len is 0, return -1.
		if (len === 0) {
			return -1;
		}

		// 5. If argument fromIndex was passed let n be
		//    ToInteger(fromIndex); else let n be 0.
		var n = fromIndex | 0;

		// 6. If n >= len, return -1.
		if (n >= len) {
			return -1;
		}

		// 7. If n >= 0, then Let k be n.
		// 8. Else, n<0, Let k be len - abs(n).
		//    If k is less than 0, then let k be 0.
		k = Math.max(n >= 0 ? n : len - Math.abs(n), 0);

		// 9. Repeat, while k < len
		while (k < len) {
		// a. Let Pk be ToString(k).
		//   This is implicit for LHS operands of the in operator
		// b. Let kPresent be the result of calling the
		//    HasProperty internal method of o with argument Pk.
		//   This step can be combined with c
		// c. If kPresent is true, then
		//    i.  Let elementK be the result of calling the Get
		//        internal method of o with the argument ToString(k).
		//   ii.  Let same be the result of applying the
		//        Strict Equality Comparison Algorithm to
		//        searchElement and elementK.
		//  iii.  If same is true, return k.
		if (k in o && o[k] === searchElement) {
			return k;
		}
		k++;
		}
		return -1;
	};
}

jQuery.extend({
	isBoolean: function(o) {
		return typeof o === 'boolean';
	},
	isNull: function(o) {
		return o === null;
	},
	isNumber: function(o) {
		return typeof o === 'number' && isFinite(o);
	},
	isObject: function(o) {
		return (o && (typeof o === 'object' || this.isFunction(o))) || false;
	},
	isString: function(o) {
		return typeof o === 'string';
	},
	isUndefined: function(o) {
		return typeof o === 'undefined';
	},
	isValue: function(o) {
		return (this.isObject(o) || this.isString(o) || this.isNumber(o) || this.isBoolean(o));
	},
	isDate: function(o) {
		return this.type(o) === 'date' && o.toString() !== 'Invalid Date' && !isNaN(o);
	},
	later: function(when, o, fn, data, periodic) {
		when = when || 0;
		o = o || {};
		var m = fn, d = data, f, r;
		if (this.isString(fn))
			m = o[fn];
		if (!m)
			return;
		if (!this.isUndefined(data) && !this.isArray(d))
			d = [data];
		f = function() {
			m.apply(o, d || []);
		};
		r = (periodic) ? setInterval(f, when) : setTimeout(f, when);
		return {
			interval: periodic,
			cancel: function() {
				if (this.interval) {
					clearInterval(r);
				} else {
					clearTimeout(r);
				}
			}
		};
	}

});

// Dropdown based on Bootstrap
+function ($) {
	'use strict';

	// DROPDOWN CLASS DEFINITION
	// =========================

	var backdrop = '.dropdown-backdrop'
	var toggle   = '.ewDropdown' //***
	var Dropdown = function (element) {
		$(element).on('click.bs.dropdown', this.toggle)
	}

	Dropdown.VERSION = '3.3.7'

	function getParent($this) {
		var selector = $this.attr('data-target')

		if (!selector) {
			selector = $this.attr('href')
			selector = selector && /#[A-Za-z]/.test(selector) && selector.replace(/.*(?=#[^\s]*$)/, '') // strip for ie7
		}

		var $parent = selector && $(selector)

		return $parent && $parent.length ? $parent : $this.parent()
	}

	function clearMenus(e) {
		if (e && e.which === 3) return
		$(backdrop).remove()
		$(toggle, $(e.currentTarget).is(toggle) ? $(e.currentTarget).parent() : document).each(function () { //***
			var $this         = $(this)
			var $parent       = getParent($this)
			var relatedTarget = { relatedTarget: this }

			if (!$parent.hasClass('open')) return

			if (e && e.type == 'click' && /input|textarea/i.test(e.target.tagName) && $.contains($parent[0], e.target)) return

			$parent.trigger(e = $.Event('hide.bs.dropdown', relatedTarget))

			if (e.isDefaultPrevented()) return

			$this.attr('aria-expanded', 'false')
			$parent.removeClass('open').trigger($.Event('hidden.bs.dropdown', relatedTarget))
		})
	}

	Dropdown.prototype.toggle = function (e) {
		var $this = $(this)

		if ($this.is('.disabled, :disabled')) return

		var $parent  = getParent($this)
		var isActive = $parent.hasClass('open')

		//***
		var nodeName = e.target.nodeName
		
		clearMenus(e)

		if (!isActive) {
			if ('ontouchstart' in document.documentElement && !$parent.closest('.navbar-nav').length) {
				// if mobile we use a backdrop because click events don't delegate
				$(document.createElement('div'))
				.addClass('dropdown-backdrop')
				.insertAfter($(this))
				.on('click', clearMenus)
			}

			var relatedTarget = { relatedTarget: this }
			$parent.trigger(e = $.Event('show.bs.dropdown', relatedTarget))

			if (e.isDefaultPrevented()) return

			$this
				.trigger('focus')
				.attr('aria-expanded', 'true')

			$parent
				.toggleClass('open')
				.trigger($.Event('shown.bs.dropdown', relatedTarget))
		}

		//***
		var href = $this.attr('href')
		if (href && href != '#' && window.matchMedia) { // Requires IE10+
			if (EWR_IS_SCREEN_SM_MIN) {
				return true
			} else { // Mobile mode
				return nodeName == 'SPAN'
			}
		}

		return false
	}

	Dropdown.prototype.keydown = function (e) {
		if (!/(38|40|27|32)/.test(e.which) || /input|textarea/i.test(e.target.tagName)) return

		var $this = $(this)

		e.preventDefault()
		e.stopPropagation()

		if ($this.is('.disabled, :disabled')) return

		var $parent  = getParent($this)
		var isActive = $parent.hasClass('open')

		if (!isActive && e.which != 27 || isActive && e.which == 27) {
			if (e.which == 27) $parent.find(toggle).trigger('focus')
				return $this.trigger('click')
		}

		var desc = ' li:not(.disabled):visible a'
		var $items = $parent.find('.dropdown-menu' + desc)

		if (!$items.length) return

		var index = $items.index(e.target)

		if (e.which == 38 && index > 0)                 index--         // up
		if (e.which == 40 && index < $items.length - 1) index++         // down
		if (!~index)                                    index = 0

		$items.eq(index).trigger('focus')
	}


	// DROPDOWN PLUGIN DEFINITION
	// ==========================

	function Plugin(option) {
		return this.each(function () {
			var $this = $(this)
			var data  = $this.data('bs.dropdown')

			if (!data) $this.data('bs.dropdown', (data = new Dropdown(this)))
			if (typeof option == 'string') data[option].call($this)
		})
	}

	var old = $.fn.dropdown

	$.fn.dropdown             = Plugin
	$.fn.dropdown.Constructor = Dropdown


	// DROPDOWN NO CONFLICT
	// ====================

	$.fn.dropdown.noConflict = function () {
		$.fn.dropdown = old
		return this
	}


	// APPLY TO STANDARD DROPDOWN ELEMENTS
	// ===================================

	$(document)
		.on('click.bs.dropdown.data-api', clearMenus)
		.on('click.bs.dropdown.data-api', '.dropdown form', function (e) { e.stopPropagation() })
		.on('click.bs.dropdown.data-api', toggle, Dropdown.prototype.toggle)
		.on('keydown.bs.dropdown.data-api', toggle, Dropdown.prototype.keydown)
		.on('keydown.bs.dropdown.data-api', '.dropdown-menu', Dropdown.prototype.keydown)

}(jQuery);
