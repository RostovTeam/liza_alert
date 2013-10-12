<div id="map-area" data-editable="0"></div>
<div id="name"></div>
<div id="city"></div>
<div id="age"></div>

<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&callback=initialize"></script>
<script type="text/javascript" src="http://yandex.st/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript" src="../static/js/widget.js"></script>
<script type="text/javascript" src="../static/js/widgetviewmodel.js"></script>
<script type="text/javascript">
	$('#map-area').laWidget({route: '/api/map/<?php echo $id ?>'});
</script>