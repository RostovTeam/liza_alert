/*jslint vars: true*/
/*global google, document, window*/

var addMarkerBtn = document.getElementById('add-marker');
var addAreaBtn = document.getElementById('add-area');
var deleteMarkerBtn = document.getElementById('delete-marker');
var deleteAreaBtn = document.getElementById('delete-area');
var logArea = document.getElementById('map-log');
var markersArray = ['https://maps.gstatic.com/mapfiles/ms2/micons/green.png',
    'https://maps.gstatic.com/mapfiles/ms2/micons/lightblue.png',
    'https://maps.gstatic.com/mapfiles/ms2/micons/blue.png',
    'https://maps.gstatic.com/mapfiles/ms2/micons/yellow.png',
    'https://maps.gstatic.com/mapfiles/ms2/micons/purple.png',
    'https://maps.gstatic.com/mapfiles/ms2/micons/red.png',
    'https://maps.gstatic.com/mapfiles/ms2/micons/pink.png'];

function addLog(text) {
    'use strict';
    var p = document.createElement('p');
    p.innerHTML = text;
    logArea.appendChild(p);
}

function initialize() {
    'use strict';
    var mapOptions = {
        zoom: 12,
        disableDefaultUI: true,
        mapTypeControl: true,
        zoomControl: true,
        scaleControl: true,
        center: new google.maps.LatLng(47.216653, 39.703646),
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
    var centerMap = map.getCenter();
    var markers = [],
        polygons = [];
    var marker;

    function addMarker(location, type) {
        marker = new google.maps.Marker({
            position: location,
            icon: markersArray[type],
            map: map,
            draggable: true
        });
        addLog('add marker type:' + type);
        markers.push(marker);
    }

    function addArea(location, type) {
        var x = location.lat(),
            y = location.lng();
        var bounds = [
            new google.maps.LatLng(x - 0.01, y),
            new google.maps.LatLng(x - 0.01, y - 0.01),
            new google.maps.LatLng(x, y - 0.01)
        ];

        var polygon = new google.maps.Polygon({
            paths: bounds,
            strokeColor: '#FF0000',
            strokeOpacity: 0.8,
            strokeWeight: 2,
            fillColor: '#FF0000',
            fillOpacity: 0.35,
            editable: true
        });
        polygon.setMap(map);
        addLog('add rectangle type:' + type);
        polygons.push(polygon);
    }

    function deleteSelected() {

    }

    addMarkerBtn.onclick = function () {
        addMarker(centerMap, '');
    };

    addAreaBtn.onclick = function () {
        addArea(centerMap, '');
    };

    deleteMarkerBtn.onclick = function () {

    };

    deleteAreaBtn.onclick = function () {

    };

}

window.onload = function () {
    'use strict';
    var script = document.createElement('script');
    script.type = 'text/javascript';
    script.src = 'https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&callback=initialize';
    document.body.appendChild(script);
};