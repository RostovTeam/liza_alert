<style>
    html, body {
        height: 100%;
        margin: 0;
        padding: 10px;
    }

    #map-area {
        height: 400px;
        width: 600px;
        border: solid 1px;
    }

    .controlMap {
        background-color: rgb(255, 255, 255);
        padding: 1px 6px;
        background-clip: padding-box;
        border: 1px solid rgba(0, 0, 0, 0.14902);
        -webkit-box-shadow: rgba(0, 0, 0, 0.298039) 0px 1px 4px -1px;
        box-shadow: rgba(0, 0, 0, 0.298039) 0px 1px 4px -1px;
        cursor: pointer;
    }
    .controlMap:hover {
        background-color: rgb(233, 233, 233);
    }
</style>

<div id="map-area" data-editable="true"></div>
<div id="name"></div>
<div id="city"></div>
<div id="age"></div>

<button id="add-marker">addMarker</button>
<button id="add-circle">addCircle</button>
<button id="add-polygon">addPolygon</button>
<button id="delete-select">deleteSelect</button>

<select name="color">
    <option value="green">Зеленый</option>
    <option value="lightblue">Светло-голубой</option>
    <option value="blue">Голубой</option>
    <option value="yellow">Желтый</option>
    <option value="purple">Фиолетовый</option>
    <option value="pink">Розовый</option>
</select>

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
						position: pos,
						map: map,
						title: ballon.title
					});
				});

				// add radar
				data.radars.forEach(function(radar){
					var pos = new google.maps.LatLng(radar.lat, radar.lng);
					var circle = new google.maps.Circle({
						position: pos,
						map: map,
						radius: radar.radius
					});
				})

				$('#name').text(data.lost.name);
				$('#city').text(data.lost.city.name);
				$('#age').text(data.lost.age);
			}
		})
	};

	google.maps.event.addDomListener(window, 'load', initialize);
</script>