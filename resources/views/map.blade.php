<!DOCTYPE html>
<html>

<head>
  <meta charset='utf-8' />
  <title>Exodus - University Project</title>
  <meta name='viewport' content='initial-scale=1,maximum-scale=1,user-scalable=no' />
  <script src='https://api.tiles.mapbox.com/mapbox-gl-js/v1.8.1/mapbox-gl.js'></script>
  <link href='https://api.tiles.mapbox.com/mapbox-gl-js/v1.8.1/mapbox-gl.css' rel='stylesheet' />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <style>
    body {
      margin: 0;
      padding: 0;
    }

    #map {
      position: absolute;
      top: 0;
      bottom: 0;
      width: 100%;
    }

    .quakeInfo {
      position: absolute;
      font-family: sans-serif;
      margin-top: 5px;
      margin-left: 5px;
      padding: 5px;
      width: 30%;
      border: 2px solid black;
      font-size: 14px;
      color: #222;
      background-color: #fff;
      border-radius: 3px;
      opacity:1;
    }

    #menu {
      position: absolute;
      bottom: 8px;
      right: 16px;
      font-size: 18px;
      background: #fff;
      padding: 10px;
      font-family: 'Open Sans', sans-serif;
}
/*
      #fit {
      display: block;
      position: relative;
      margin: 0px auto;
      width: 50%;
      height: 40px;
      padding: 10px;
      border: none;
      border-radius: 3px;
      font-size: 12px;
      text-align: center;
      color: #fff;
      background: #ee8a65;
      }*/
  </style>
</head>

<body>

  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
  <script src="http://cdn.jsdelivr.net/jquery.cookie/1.4.0/jquery.cookie.min.js"></script>

  <div id="map"></div>
<!--
  <br />
<button id="fit">Fit to Kosovo</button>
-->
<div id="menu">
<input id="light-v10" type="radio" name="rtoggle" value="light"/>
<label for="light">light</label>
<input id="dark-v10" type="radio" name="rtoggle" value="dark"/>
<label for="dark">dark</label>
</div>

  <div class='quakeInfo'>
    <div><strong>Magnitude:</strong> <span id='mag'></span></div>
    <div><strong>Location:</strong> <span id='loc'></span></div>
    <div><strong>Date:</strong> <span id='date'></span></div>
  </div>
</div>

  <script>
    mapboxgl.accessToken = 'pk.eyJ1IjoiYmxlb25pMTEiLCJhIjoiY2s4N2l1NGoyMG52YzNmbzh0OTdnYzBqdyJ9.DDxWvIK1MR07q3JYZvLdew';
    var map = new mapboxgl.Map({
      container: 'map', //
      //style: 'mapbox://styles/bleoni11/ck87kphoi11rd1jq5zsl29ejq', // mymap
      style: 'mapbox://styles/mapbox/dark-v10',
      center: [-73.9978, 40.7209],
      //center: [21, 42.550],
      zoom: 2.6 // zoomi
    });

    //full map max
      map.addControl(new mapboxgl.FullscreenControl());

    // disable map rotation using right click + drag
      map.dragRotate.disable();
 
    // disable map rotation using touch rotation gesture
      map.touchZoomRotate.disableRotation();
   
/*
      //fitBounds to KOSOVO - FIX!
      document.getElementById('fit').addEventListener('click', function() {
        map.fitBounds([
        [42.5833, 20.9030],
        [3.1512, 58.2876]
        ]);
        });
*/
    // Target the relevant span tags in the quakeInfo div
    var magDisplay = document.getElementById('mag');
    var locDisplay = document.getElementById('loc');
    var dateDisplay = document.getElementById('date');

    //by default 30 days prio

    var today = new Date();
    // get the date from a week ago 
    //The setDate() method sets the day of the Date object relative to the beginning of the currently set month.
    var priorDate = new Date().setDate(today.getDate() - 7);
    // ISO8601 timestamp as required by the api
    var priorDateTs = new Date(priorDate);
    //The toISOString() method returns a string in simplified extended ISO format 
    var sevenDaysAgo = priorDateTs.toISOString();

    function getEarthquakes() {
      var source = Math.random().toString()
      var feature = Math.random().toString()
      //GEOJSON DATA LOAD
      // ADDSOURCE INSTANCE
      map.addSource(source, {
        'type': 'geojson',
        'data': 'https://earthquake.usgs.gov/fdsnws/event/1/query?format=geojson&eventtype=earthquake&minmagnitude=1&starttime=' + sevenDaysAgo,
        'generateId': true // This ensures that all features have unique IDs
      });

      // API REFERENCE "A layer defines how data from a specified source will be styled".
      map.addLayer({
        'id': feature,
        'type': 'circle',
        'source': source,
        'paint': {
          'circle-radius': [
            'case',
            ['boolean',
              ['feature-state', 'hover'],
              false
            ],
            [
              'interpolate', ['linear'],
              ['get', 'mag'],
              1, 8,
              1.5, 10,
              2, 12,
              2.5, 14,
              3, 16,
              3.5, 18,
              4.5, 20,
              6.5, 22,
              8.5, 24,
              10.5, 26
            ],
            5
          ],
          'circle-stroke-color': '#ff0000',
          'circle-stroke-width': 1,

          'circle-color': [
            'case',
            ['boolean',
              ['feature-state', 'hover'],
              false
            ],
            [
              'interpolate', ['linear'],
              ['get', 'mag'],
              1, '#fff7ec',
              1.5, '#fee8c8',
              2, '#fdd49e',
              2.5, '#fdbb84',
              3, '#fc8d59',
              3.5, '#ef6548',
              4.5, '#d7301f',
              6.5, '#b30000',
              8.5, '#7f0000',
              10.5, '#000'
            ],
            '#fff'
          ]
        }

    });

    var quakeID = null;

    map.on('mousemove', feature, (e) => {
      map.getCanvas().style.cursor = 'pointer';
      // Set variables equal to the current feature's magnitude, location, and time
      var quakeMagnitude = e.features[0].properties.mag;
      var quakeLocation = e.features[0].properties.place;
      var quakeDate = new Date(e.features[0].properties.time);

      // Check whether features exist
      if (e.features.length > 0) {
        // display the magnitude, location, and time in the sidebar
        magDisplay.textContent = quakeMagnitude;
        locDisplay.textContent = quakeLocation;
        dateDisplay.textContent = quakeDate;

        // If quakeID for the hovered feature is not null,
        // use removeFeatureState to reset to the default behavior
        if (quakeID) {
          map.removeFeatureState({
            source: source,
            id: quakeID
          });
        }
        quakeID = e.features[0].id;

        // When the mouse moves over the earthquakes-viz layer, set the
        // feature state for the feature under the mouse
        map.setFeatureState({
          source: source,
          id: quakeID,
        }, {
          hover: true
        });

      }
    });

    map.on("mouseleave", feature, function() {
      
      if (quakeID) {
        map.setFeatureState({
          source: source,
          id: quakeID
        }, {
          hover: false
        });
      }
      quakeID = null;

      // remove the information from the previously hovered feature from the sidebar
      magDisplay.textContent = '';
      locDisplay.textContent = '';
      dateDisplay.textContent = '';
      // reset the cursor style
      map.getCanvas().style.cursor = '';
    });

      }

    map.on('load', function() {     
      getEarthquakes();
    });


  //TODO - Switch Layer not showing API - fix!
 ////////////////////////////////////////////////////////////
    var layerList = document.getElementById('menu');
    var inputs = layerList.getElementsByTagName('input');
 
      function switchLayer(layer) {
        var layerId = layer.target.id;
        map.setStyle('mapbox://styles/mapbox/' + layerId);
        setTimeout(function() {
          getEarthquakes();
        }, 1000)
      }
      for (var i = 0; i < inputs.length; i++) {
        inputs[i].onclick = switchLayer;
      }
    ////////////////////////////////////////////////////////////

  </script>

</body>

</html>