<div id="map-canvas"></div>
<div id="name"></div>
<div id="city"></div>
<div id="age"></div>

<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
<script type="text/javascript" src="http://yandex.st/jquery/1.10.2/jquery.min.js"></script>
<script>
	function initialize() {
		$.ajax({
			url: '/api/map/<?php echo $id ?>',
			//url: 'http://webant.ru/json.php?test1=1',
			type: 'GET',
			dataType: 'json',
			success: function(json) {
				//var data = json;
				var data = json.content;
				var mapOptions = {
					zoom: 12,
					//center: new google.maps.LatLng(-25.363882, 131.044922),
					mapTypeId: google.maps.MapTypeId.ROADMAP
				};

				var map = new google.maps.Map(document.getElementById('map-canvas'),
				mapOptions);

				var	geocoder = new google.maps.Geocoder();
				geocoder.geocode({address: data.lost.city.name}, function(results, status) {
					if (status == google.maps.GeocoderStatus.OK) {
						map.setCenter(results[0].geometry.location);
					}
				});

				// add markers
				data.ballons.forEach(function(ballon){
					var pos = new google.maps.LatLng(ballon.lat, ballon.lng);
					var marker = new google.maps.Marker({
						position: pos,e
						map: map,
						title: ballon.title
					});
				});

				// 
				$('#name').text(data.lost.name);
				$('#city').text(data.lost.city.name);
				$('#age').text(data.lost.age);
			}
		})
	};

	google.maps.event.addDomListener(window, 'load', initialize);
</script>