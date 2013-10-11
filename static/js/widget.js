
var la = la || {};

(function($){
	la.widgetDefault = {
		route: '/search/:id'
	};
	la.Widget = function(node, options){
		var w = this;
		
		w.$node = $(node);
		w.options = $.extend({}, la.MepDefaults, options);
		w.init();
	};

	la.Widget.prototype = {
		init: function() {
			var w = this,
				data = {};
			
			data = w.get(w.options.route);
		},
		get: function(route) {
			var w = this,
				onDataLoaded = function(json) {
					w.data = JSON.parse(json);
				}, onDataLoadingError = function() {
				};
			$.ajax({
				url: route,
				type: 'GET',
				dataType: 'json'
			}).done(onDataLoaded).error(onDataLoadingError);
		}
	};

	jQuery.fn.laWidget = function(options) {
		jQuery(this).data('lawidget', new la.Widget(this, options));
		return this;
	}
})(jQuery);

