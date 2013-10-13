/*jslint vars: true*/
/*global google, document, window, $*/

var mapCanvas = document.getElementById('map-canvas');
var deleteSelectBtn = document.getElementById('delete-select');
var saveMapBtn = document.getElementById('save-map');
var saveElementBtn = document.getElementById('save-element');

var selectedElement = null;
var editable = false;
var lost_id = $('body').data('lost-id');

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
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    var map = new google.maps.Map(mapCanvas, mapOptions);
    editable = mapCanvas.getAttribute('data-editable') === 'true';

    var geocoder = new google.maps.Geocoder(),
        centerMap;

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

    String.prototype.tr = function () {
        var ret;
        switch (this) {
        case 'balloon':
            ret = 'marker';
            break;
        case 'radius':
            ret = 'circle';
            break;
        case 'area':
            ret = 'polygon';
            break;
        }
        return ret;
    }

    function drawMap() {
        function request(callback) {
            $.ajax({
                url: 'http://146.185.145.71/api/map/' + lost_id,
                type: 'get',
                dataType: 'json',
                success: function (data) {
                    callback(data);
                }
            });
        }

        request(function (data) {
            if (data.error !== 0) {
                console.log(data.error);
            } else {
                geocoder.geocode({
                    'address': data.content.lost.city.name
                }, function (results, status) {
                    if (status === google.maps.GeocoderStatus.OK) {
                        centerMap = results[0].geometry.location;
                        map.setCenter(centerMap);

                        var i;
                        for (i in data.content.ballons) {
                            var d = data.content.ballons[i];
                            var info = {
                                title: d.title,
                                description: d.description
                            };
                            addMarker([d.lat, d.lng], d.color, info);
                        }

                        for (i in data.content.radars) {
                            var d = data.content.radars[i];
                            var info = {
                                title: d.title,
                                description: d.description
                            };
                            addCircle([d.lat, d.lng], d.color, info, d.radius);
                        }

                        /*for (i in data.content.areas) {
                            var d = data.content.areas[i];
                            var info = {
                                title: d.title,
                                description: d.description
                            };
                            addPolygon(d.points, d.color, info);
                        }*/
                    }
                });
            }
        });
    }
    drawMap();

    function setSelectElement(element) {
        if (editable !== true) {
            return false;
        }
        var i, el;
        for (i in data.markers) {
            el = data.markers[i];
            el.element.setOptions({
                icon: markersArray[el.defaultValue][0]
            });
        }
        for (i in data.polygons) {
            el = data.polygons[i];
            el.element.setOptions({
                fillColor: markersArray[el.defaultValue][1]
            });
        }
        for (i in data.circles) {
            el = data.circles[i];
            el.element.setOptions({
                fillColor: markersArray[el.defaultValue][1]
            });
        }

        if (element === null) {
            return false;
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
        $('#save-element').show();
    }

    function resetSelected() {
        $('[name="type"]').val('balloon').removeAttr('disabled');
        $('[name="color"]').val('green');
        $('[name="title"]').val('');
        $('textarea[name="description"]').val('');
        $('[name="element_id"]').val('');

        setSelectElement(null);
        selectedElement = null;
    }

    function saveMap() {
        var balloons = [],
            b = {}, i;

        for (i in data.markers) {
            var balloon = data.markers[i];
            b.title = balloon.info.title;
            b.description = balloon.info.description;
            b.color = balloon.defaultValue;
            b.lost_id = lost_id;
            b.lat = balloon.element.getPosition().lat();
            b.lng = balloon.element.getPosition().lng();
            balloons.push(b);
        }

        var radars = [],
            r = {};

        for (i in data.circles) {
            var radar = data.circles[i];
            r.title = radar.info.title;
            r.description = radar.info.description;
            r.color = radar.defaultValue;
            r.lost_id = lost_id;
            r.lat = radar.element.getCenter().lat();
            r.lng = radar.element.getCenter().lng();
            r.radius = radar.element.getRadius();
            radars.push(r);
        }

        var areas = [],
            a = {};

        for (i in data.polygons) {
            var area = data.polygons[i];
            var objs = data.polygons[i].element.getPath().getArray(),
                j;
            a.color = area.defaultValue;
            a.points = [];
            for (j in objs) {
                a.points.push([objs[j].lng(), objs[j].lng()]);
            }
            a.title = area.info.title;
            a.description = area.info.description;
            a.lost_id = lost_id;
            areas.push(a);
        }

        $.ajax({
            url: 'http://146.185.145.71/api/map/',
            data: {
                Balloon: balloons,
                Radar: radars,
                Area: areas
            },
            type: 'post',
            dataType: 'json',
            success: function (data) {
                console.log(data);
            }
        });
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
        var info = new google.maps.InfoWindow();
        info.setContent(contentString);
        info.setPosition(event.latLng);
        info.open(map);
        return info;
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

    function editElement(element, color, info, id) {
        $('[name="element_id"]').val(id);
        $('[name="type"]').val(element).attr('disabled', true);
        $('[name="color"]').val(color);
        $('[name="title"]').val(info.title);
        $('textarea[name="description"]').val(info.description);
    }

    function saveElement(element) {
        var isNew = false;
        var id = $('[name="element_id"]').val();
        if (selectedElement === null) {
            isNew = true;
        } else {
            id = id | 0;
        }

        var type = $('[name="type"]').val();
        var title = $('[name="title"]').val() || null;
        var description = $('textarea[name="description"]').val() || null;
        var color = $('[name="color"]').val();
        var info = {
            title: title,
            description: description
        };

        if (isNew) {
            switch (type.tr()) {
            case 'marker':
                addMarker(null, color, info);
                break;
            case 'circle':
                addCircle(null, color, info);
                break;
            case 'polygon':
                addPolygon(null, color, info);
                break;
            }
        } else {
            if (type === 'balloon') {
                color = markersArray[color][0];
                element.setOptions({
                    icon: color
                });
            } else {
                color = markersArray[color][1];
                element.setOptions({
                    fillColor: color
                });
            }

            var d = data[type.tr() + 's'][id];
            d.defaultValue = color;
            d.info.title = title;
            d.info.description = description;
        }
        resetSelected();
    }

    function addMarker(bounds, colorName, info) {
        var color = markersArray[colorName][0];
        bounds = bounds || centerMap;
        info = info || '';
        var latLng = new google.maps.LatLng(bounds[0], bounds[1]);
        var marker = new google.maps.Marker({
            position: latLng,
            icon: color,
            map: map,
            draggable: editable
        });

        var id = data.markers.length;
        data.markers.push({
            element: marker,
            info: info,
            defaultValue: colorName
        });
        google.maps.event.addListener(marker, 'click', function (e) {
            setSelectElement(this);
            if (editable === false) {
                infoWindow(e, '<b>' + info.title + '</b><br>' + info.description);
            }
            editElement('balloon', colorName, info, id);
        });
    }

    function addPolygon(bounds, colorName, info) {
        var color = markersArray[colorName][1];
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
            info: info,
            defaultValue: colorName
        });

        google.maps.event.addListener(polygon, 'click', function (e) {
            setSelectElement(this);
            if (editable === false) {
                infoWindow(e, '<b>' + info.title + '</b><br>' + info.description);
            }
        });
    }

    function addCircle(coords, colorName, info, radius) {
        radius = parseFloat(radius) || 1000;
        var color = markersArray[colorName][1];
        info = info || '';
        coords = coords || centerMap;
        var latLng = new google.maps.LatLng(coords[0], coords[1]);
        var circle = new google.maps.Circle({
            strokeColor: color,
            strokeOpacity: 0.2,
            strokeWeight: 1,
            fillColor: color,
            fillOpacity: 0.2,
            editable: editable,
            draggable: editable,
            center: latLng,
            radius: radius
        });
        circle.setMap(map);

        data.circles.push({
            element: circle,
            info: info,
            defaultValue: colorName
        });

        google.maps.event.addListener(circle, 'click', function (e) {
            setSelectElement(this);
            if (editable === false) {
                infoWindow(e, '<b>' + info.title + '</b><br>' + info.description);
            }
        });
    }

    function deleteSelected() {
        if (selectedElement === null) {
            return false;
        }
        selectedElement.setMap(null);
        resetSelected();
    }

    /*addMarkerBtn.onclick = function () {
        var color = $('select[name="color"] option:selected').val();
        var info = {
            title: 'test',
            description: 'text1111'
        };
        addMarker(null, color, info);
    };

    addPolygonBtn.onclick = function () {
        var color = $('select[name="color"] option:selected').val();
        var info = {
            title: 'test',
            description: 'text1111'
        };
        addPolygon(null, color, info);
    };*/

    /*addCircleBtn.onclick = function () {
        var color = $('select[name="color"] option:selected').val();
        var info = {
            title: 'test',
            description: 'text1111'
        };
        addCircle(null, color, 1000, info);
    };*/

    deleteSelectBtn.onclick = function () {
        deleteSelected();
    };

    saveElementBtn.onclick = function () {
        saveElement(selectedElement);
    };

    saveMapBtn.onclick = function () {
        saveMap();
    };

    var control = document.createElement('div');
    control.style.margin = '5px';
    addCustomControl(control, 'Скрыть точки', function (item) {
        switchVisibleLayers('marker', item);
    });
    addCustomControl(control, 'Скрыть круги', function (item) {
        switchVisibleLayers('circle', item);
    });
    addCustomControl(control, 'Скрыть области', function (item) {
        switchVisibleLayers('polygon', item);
    });
    map.controls[google.maps.ControlPosition.TOP_RIGHT].push(control);

}

var script = document.createElement('script');
script.type = 'text/javascript';
script.src = 'https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&callback=initialize';
document.body.appendChild(script);