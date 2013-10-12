
var la = la || {};

(function($){
	la.widgetDefault = {
		route: '/search/:id',
		test: 0,
		testResponce: JSON.stringify({
			name: 'Test Name',
			age: '34',
			city: 'Moscow',
			phone: '+7781234912'
		})
	};
	la.Widget = function(node, options){
		var w = this;
		
		w.$node = $(node);
		w.options = $.extend({}, la.widgetDefault, options);
		w.init();
	};

	la.Widget.prototype = {
		init: function() {
			var w = this,
				data,
				widget;
			
			w.$node.bind('refresh.la', function(){
				w.updateView();
			});
			
			data = w.get(w.options.route);
		},
		get: function(route) {
			var w = this,
				onDataLoaded = function(json) {
					w.data = JSON.parse(json.content);
					w.$node.trigger('refresh.la');
				}, onDataLoadingError = function() {
				};
			if (w.options.test) {
				onDataLoaded.call(w, w.options.testResponce);
			} else {
				$.ajax({
					url: route,
					type: 'GET',
					dataType: 'json'
				}).done(onDataLoaded).error(onDataLoadingError);
			}
		},
		updateView: function() {
			var w = this;
			w.widget = new la.WidgetViewModel(w.data);
		}
	};

	jQuery.fn.laWidget = function(options) {
		this.each(function(){
			jQuery(this).data('lawidget', new la.Widget(this, options));
		});
		return this;
	}
})(jQuery);

