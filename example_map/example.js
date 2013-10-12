/*jslint vars: true*/
/*global google, document, window*/

var mapCanvas = document.getElementById('map-canvas');
var addMarkerBtn = document.getElementById('add-marker');
var addCircleBtn = document.getElementById('add-circle');
var addPolygonBtn = document.getElementById('add-polygon');
var deleteSelectBtn = document.getElementById('delete-select');

var selectedElement = null;
var infowindow = null;
var editable = false;

var markersArray = {
    green: ['https://maps.gstatic.com/mapfiles/ms2/micons/green.png', '#00ff00'],
    lightblue: ['https://maps.gstatic.com/mapfiles/ms2/micons/lightblue.png', '#79a0c1'],
    blue: ['https://maps.gstatic.com/mapfiles/ms2/micons/blue.png', '#42aaff'],
    yellow: ['https://maps.gstatic.com/mapfiles/ms2/micons/yellow.png', '#ffff00'],
    purple: ['https://maps.gstatic.com/mapfiles/ms2/micons/purple.png', '#8b00ff'],
    pink: ['https://maps.gstatic.com/mapfiles/ms2/micons/pink.png', '#ffc0cb']
    };

function addCustomControl(control, text, callback) {
    'use strict';
    var controlChild = document.createElement('div');
    controlChild.style.float = 'left';
    controlChild.className = 'controlMap';
    controlChild.innerText = text;
    control.appendChild(controlChild);
    google.maps.event.addDomListener(controlChild, 'click', function () {
        callback(this);
    });
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
    var map = new google.maps.Map(mapCanvas, mapOptions);
    editable = Boolean(mapCanvas.getAttribute('data-editable'));
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

    function setSelectElement(element) {
        var i, el;
        for (i in data.markers) {
            el = data.markers[i];
            el.element.setOptions({
                icon: el.defaultValue
            });
        }
        for (i in data.polygons) {
            el = data.polygons[i];
            el.element.setOptions({
                fillColor: el.defaultValue
            });
        }
        for (i in data.circles) {
            el = data.circles[i];
            el.element.setOptions({
                fillColor: el.defaultValue
            });
        }

        // set select element
        if (element.hasOwnProperty('fillColor')) { // polygon or circle
            element.setOptions({
                fillColor: '#ff0000'
            });
        } else { // marker
            element.setOptions({
                icon: element.icon.replace(/\.png$/, '-dot.png')
            });
        }
        selectedElement = element;
    }

    /*set status visible elements*/

    function setStatusElements(elements, type) {
        var i;
        for (i in elements) {
            if (elements.hasOwnProperty(i)) {
                elements[i].element.setVisible(type);
            }
        }
    }

    function infoWindow(event, contentString) {
        if (contentString === '') {
            return false;
        }
        infowindow = new google.maps.InfoWindow();
        infowindow.setContent(contentString);
        infowindow.setPosition(event.latLng);
        infowindow.open(map);
    }

    function switchVisibleLayers(layer, item) {
        var status;
        switch (layer) {
        case 'marker':
            status = data.visible.markers = !data.visible.markers;
            setStatusElements(data.markers, data.visible.markers);
            break;
        case 'polygon':
            status = data.visible.polygons = !data.visible.polygons;
            setStatusElements(data.polygons, data.visible.polygons);
            break;
        case 'circle':
            status = data.visible.circles = !data.visible.circles;
            setStatusElements(data.circles, data.visible.circles);
            break;
        }
        if (status) {
            item.style.color = '#000000';
        } else {
            item.style.color = '#565656';
        }
    }

    function addMarker(bounds, color, info) {
        color = markersArray[color][0];
        bounds = bounds || centerMap;
        info = info || '';
        var marker = new google.maps.Marker({
            position: bounds,
            icon: color,
            map: map,
            draggable: editable
        });
        google.maps.event.addListener(marker, 'click', function (e) {
            setSelectElement(this);
            infoWindow(e, info);
        });
        data.markers.push({
            element: marker,
            defaultValue: color
        });
    }

    function addPolygon(bounds, color, info) {
        color = markersArray[color][1];
        info = info || '';
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
            editable: editable,
            draggable: editable
        });
        polygon.setMap(map);
        data.polygons.push({
            element: polygon,
            defaultValue: color
        });

        google.maps.event.addListener(polygon, 'click', function (e) {
            setSelectElement(this);
            infoWindow(e, info);
        });
    }

    function addCircle(coords, color, radius, info) {
        color = markersArray[color][1];
        info = info || '';
        coords = coords || centerMap;

        var circle = new google.maps.Circle({
            strokeColor: color,
            strokeOpacity: 0.2,
            strokeWeight: 1,
            fillColor: color,
            fillOpacity: 0.2,
            editable: editable,
            draggable: editable,
            center: coords,
            radius: radius
        });
        circle.setMap(map);
        data.circles.push({
            element: circle,
            defaultValue: color
        });

        google.maps.event.addListener(circle, 'click', function (e) {
            setSelectElement(this);
            infoWindow(e, info);
        });
    }

    function deleteSelected() {
        if (selectedElement === null) {
            return false;
        }
        selectedElement.setMap(null);
    }

    addMarkerBtn.onclick = function () {
        var color = $('select[name="color"] option:selected').val();
        addMarker(null, color, '<b>test</b></br>dsfasfsdaf');
    };

    addPolygonBtn.onclick = function () {
        var color = $('select[name="color"] option:selected').val();
        addPolygon(null, color);
    };

    addCircleBtn.onclick = function () {
        var color = $('select[name="color"] option:selected').val();
        addCircle(null, color, 1000);
    };

    deleteSelectBtn.onclick = function () {
        deleteSelected();
    };

    var control = document.createElement('div');
    control.style.margin = '5px';
    addCustomControl(control, 'Скрыть точки', function (item) {
        switchVisibleLayers('marker', item);
    });
    addCustomControl(control, 'Скрыть круги', function (item) {
        switchVisibleLayers('polygon', item);
    });
    addCustomControl(control, 'Скрыть области', function (item) {
        switchVisibleLayers('circle', item);
    });
    map.controls[google.maps.ControlPosition.TOP_RIGHT].push(control);

}

var script = document.createElement('script');
script.type = 'text/javascript';
script.src = 'https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&callback=initialize';
document.body.appendChild(script);