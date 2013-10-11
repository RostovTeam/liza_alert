
<div id="area">
    <div id="map-log"></div>
    <div id="map-canvas"></div>
    <div style="clear: both;"></div>
</div>
<script type="text/javascript" href="/static/js/widget.js"></script>
<script type="text/javascript">
	$('#map-canvas').laWidget({route: '/api/lost/<?php echo $id ?>'});
</script>