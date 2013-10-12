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

<div id="map-area" data-editable="0"></div>
<div id="name"></div>
<div id="city"></div>
<div id="age"></div>

<script type="text/javascript" src="http://yandex.st/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript" src="../static/js/widget.js"></script>
<script type="text/javascript" src="../static/js/widgetviewmodel.js"></script>
<script type="text/javascript">
	function initialize() {
		$('#map-area').laWidget({route: '/api/map/<?php echo $id ?>'});
	};

	var script = document.createElement('script');
	script.type = 'text/javascript';
	script.src = 'https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&callback=initialize';
	document.body.appendChild(script);
</script>