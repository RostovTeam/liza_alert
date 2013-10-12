
var la = la || {};

(function($){
	la.WidgetViewModelDefaults = {
		name: '#name',
		city: '#city',
		age: '#age'
	};
	la.WidgetViewModel = function(data, options) {
		var wa = this;
		wa.options = $.extend({}, la.WidgetViewModelDefaults, options);
		wa.data = data;
		wa.map = undefined;
		wa.init();
	};

	la.WidgetViewModel.prototype = {
		init: function() {
			wa = this,
				lost = wa.data.content.lost;
			$(wa.options.name).text(lost.name);
			$(wa.options.city).text(lost.city.name);
			$(wa.options.age).text(lost.age);

			we.initMap(lost);
		},
		initMap: function(lost) {
			var wa = this,
				mapOptions = {
					zoom: 12,
					disableDefaultUI: true,
					mapTypeControl: true,
					zoomControl: true,
					scaleControl: true,
					mapTypeId: google.maps.MapTypeId.ROADMAP
				},
				map = new google.maps.Map(mapCanvas, mapOptions),
				geocoder = new google.maps.Geocoder(),
				address = lost.city.name,
				editable = Boolean(mapCanvas.getAttribute('data-editable'));

				geocoder.geocode( { 'address': address}, function(results, status) {
					if (status == google.maps.GeocoderStatus.OK) {
						map.setCenter(results[0].geometry.location);
					}
				});
		}
	};
})(jQuery);