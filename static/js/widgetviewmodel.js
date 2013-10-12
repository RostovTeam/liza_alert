
var la = la || {};

(function($){
	la.WidgetViewModelDefaults = {
		name: '#name',
		city: '#city',
		age: '#age',
		phone: '#coordinator-phone'
	};
	la.WidgetViewModel = function(data, options) {
		var wa = this;
		wa.options = $.extend({}, la.WidgetViewModelDefaults, options);
		wa.data = data;

		wa.init();
	};

	la.WidgetViewModel.prototype = {
		init: function() {
			wa = this;
			$(wa.options.name).text(wa.data.name);
			$(wa.options.city).text(wa.data.city);
			$(wa.options.age).text(wa.data.age);
			$(wa.options.phone).text(wa.data.phone);
		}
	};
})(jQuery);