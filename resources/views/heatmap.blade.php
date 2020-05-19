<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8' />
    <title>Heatmap</title>
    <meta name='viewport' content='initial-scale=1,maximum-scale=1,user-scalable=no' />
    <script src='https://api.tiles.mapbox.com/mapbox-gl-js/v0.44.2/mapbox-gl.js'></script>
    <link href='https://api.tiles.mapbox.com/mapbox-gl-js/v0.44.2/mapbox-gl.css' rel='stylesheet' />
    <style>
        body { margin:0; padding:0; }
        #map { position:absolute; top:0; bottom:0; width:100%; }
    </style>
</head>
<body>

<div id='map'></div>
<script>
mapboxgl.accessToken = 'pk.eyJ1IjoibWFsLXdvb2QiLCJhIjoiY2oyZ2t2em50MDAyMzJ3cnltMDFhb2NzdiJ9.X-D4Wvo5E5QxeP7K_I3O8w';

var map = new mapboxgl.Map({
    container: 'map',
    style: 'mapbox://styles/mapbox/light-v9',
    zoom: 4,
    center: [-87.622088, 41.878781]
});

map.on('load', function(){
  map.addLayer({
    "id": "simple-tiles",
    "type": "raster",
    "source": {
      "type": "raster",
      "tiles": ["https://tile.openweathermap.org/map/temp_new/{z}/{x}/{y}.png?appid=874718354841f0e0250b4b06a05a971e"],
      "tileSize": 256
    },
    "minzoom": 0,
    "maxzoom": 22
  });
});

</script>

</body>
</html>