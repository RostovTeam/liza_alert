/*jslint vars: true*/
/*global google, document, window*/

var addMarkerBtn = document.getElementById('add-marker');
var addPolygonBtn = document.getElementById('add-polygon');
var deleteMarkerBtn = document.getElementById('delete-marker');
var deletePolygonBtn = document.getElementById('delete-polygon');

var switchVisibleMarkers = document.getElementById('switch-visible-markes');
var switchVisiblePolygons = document.getElementById('switch-visible-polygons');
var switchVisibleCircles = document.getElementById('switch-visible-circles');

var logPolygon = document.getElementById('map-log');
var markersArray = ['https://maps.gstatic.com/mapfiles/ms2/micons/green.png',
    'https://maps.gstatic.com/mapfiles/ms2/micons/lightblue.png',
    'https://maps.gstatic.com/mapfiles/ms2/micons/blue.png',
    'https://maps.gstatic.com/mapfiles/ms2/micons/yellow.png',
    'https://maps.gstatic.com/mapfiles/ms2/micons/purple.png',
    'https://maps.gstatic.com/mapfiles/ms2/micons/red.png',
    'https://maps.gstatic.com/mapfiles/ms2/micons/pink.png'
];

function addLog(text) {
    'use strict';
    var p = document.createElement('p');
    p.innerHTML = text;
    logPolygon.appendChild(p);
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

    var data = {
        visible: {
            markers: 1,
            polygons: 1,
            circles: 1
        },
        markers: [],
        polygons: [],
        circles: []
    };

    function setStatusItems(items, type) {
        var i;
        for (i in items) {
            if (items.hasOwnProperty(i)) {
                items[i].setVisible(type);
            }
        }
    }

    function switchVisibleLayers(layer) {
        switch (layer) {
        case 'marker':
            data.visible.markers = !data.visible.markers;
            setStatusItems(data.markers, data.visible.markers);
            break;
        case 'polygon':
            data.visible.polygons = !data.visible.polygons;
            setStatusItems(data.polygons, data.visible.polygons);
            break;
        case 'circle':
            data.visible.circles = !data.visible.circles;
            setStatusItems(data.circles, !data.visible.circles);
            break;
        }
    }

    function addMarker(bounds, type) {
        bounds = bounds || centerMap;
        var marker = new google.maps.Marker({
            position: bounds,
            icon: markersArray[type],
            map: map,
            draggable: true
        });
        addLog('add marker type:' + type);
        data.markers.push(marker);
    }

    function addPolygon(bounds, color) {
        var x = centerMap.lat(),
            y = centerMap.lng();
        bounds = bounds || [
            [x - 0.01, y],
            [x - 0.01, y - 0.01],
            [x, y - 0.01]
        ];

        var i, coords = [];
        for (i in bounds) {
            if (bounds.hasOwnProperty(i)) {
                coords.push(new google.maps.LatLng(bounds[i][0], bounds[i][1]));
            }
        }

        var polygon = new google.maps.Polygon({
            paths: coords,
            strokeColor: color,
            strokeOpacity: 0.2,
            strokeWeight: 1,
            fillColor: color,
            fillOpacity: 0.2,
            editable: true
        });
        polygon.setMap(map);
        addLog('add rectangle type:' + color);
        data.polygons.push(polygon);
    }

    function deleteSelected() {

    }

    addMarkerBtn.onclick = function () {
        addMarker(null, 0);
    };

    addPolygonBtn.onclick = function () {
        addPolygon(null, '');
    };

    deleteMarkerBtn.onclick = function () {

    };

    deletePolygonBtn.onclick = function () {

    };

    switchVisibleMarkers.onclick = function () {
        switchVisibleLayers('marker');
    };

    switchVisiblePolygons.onclick = function () {
        switchVisibleLayers('polygon');
    };

    switchVisibleCircles.onclick = function () {
        switchVisibleLayers('circle');
    };

}

window.onload = function () {
    'use strict';
    var script = document.createElement('script');
    script.type = 'text/javascript';
    script.src = 'https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&callback=initialize';
    document.body.appendChild(script);
};