<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
     <link href="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.0-rc2/css/bootstrap.css" rel="stylesheet" media="screen">

    <!-- Bootstrap CSS -->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet" />
    <title>Weather| Webtut+</title>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places"></script>
     <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <style>
      html, body, #map-canvas {
        height: 100%;
        margin: 0;
        padding: 0;
      }

      .controls {
        margin-top: 16px;
        border: 1px solid transparent;
        border-radius: 2px 0 0 2px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        height: 32px;
        outline: none;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
      }

      #pac-input {
        background-color: #fff;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        /*margin-left: 12px;*/
        padding: 0 11px 0 13px;
        text-overflow: ellipsis;
        width: 200px;
      }

      #pac-input:focus {
        border-color: #4d90fe;
      }

      .pac-container {
        font-family: Roboto;
      }

      #type-selector {
        color: #fff;
        background-color: #4d90fe;
        padding: 5px 11px 0px 11px;
      }

      #type-selector label {
        font-family: Roboto;
        font-size: 13px;
        font-weight: 300;
      }

    </style>
    <script>

var map;
var markers = [];
var lat,lon,appid;
function initialize() {


  map = new google.maps.Map(document.getElementById('map-canvas'), {
    mapTypeId: google.maps.MapTypeId.ROADMAP
  });

  var defaultBounds = new google.maps.LatLngBounds(
      new google.maps.LatLng(-33.8902, 151.1759),
      new google.maps.LatLng(-33.8474, 151.2631));
  map.fitBounds(defaultBounds);

  // Create the search box and link it to the UI element.
  var input = (document.getElementById('pac-input'));
  
  var searchBox = new google.maps.places.SearchBox((input));

  // Listen for the event fired when the user selects an item from the
  // pick list. Retrieve the matching places for that item.
  google.maps.event.addListener(searchBox, 'places_changed', function() {
    var places = searchBox.getPlaces();

    if (places.length == 0) {
      return;
    }
    for (var i = 0, marker; marker = markers[i]; i++) {
      marker.setMap(null);
    }

    // For each place, get the icon, place name, and location.
    markers = [];
    var bounds = new google.maps.LatLngBounds();
    for (var i = 0, place; place = places[i]; i++) {
      var image = {
        url: place.icon,
        size: new google.maps.Size(71, 71),
        origin: new google.maps.Point(0, 0),
        anchor: new google.maps.Point(17, 34),
        scaledSize: new google.maps.Size(25, 25)
      };

      // Create a marker for each place.
      var marker = new google.maps.Marker({
        map: map,
        icon: image,
        title: place.name,
        position: place.geometry.location
      });

    markers.push(marker);
		var x = document.getElementById("demo");
       x.innerHTML = " <br>Location : " + place.geometry.location ;	
       lat = place.geometry.location.lat();
       lon = place.geometry.location.lng();


      bounds.extend(place.geometry.location);
       map.panTo(place.geometry.location);
    
    }

    map.fitBounds(bounds);
    map.setZoom(7);
    showweather();
   
  });

  // Bias the SearchBox results towards places that are within the bounds of the
  // current map's viewport.
  google.maps.event.addListener(map, 'bounds_changed', function() {
    var bounds = map.getBounds();
    searchBox.setBounds(bounds);
  });
}

google.maps.event.addDomListener(window, 'load', initialize);
   </script>
</head>
<body>

<h1 class="text-center">Know weather at your location</h1>
<div  class="col-sm-5" id="map-canvas"></div>

<div  class="col-sm-7" >
<button onclick="getLocation()" class="btn btn-info">Get your Location </button>  <strong> OR</strong>
<span>Enter it manually here</span>
<input id="pac-input" class="control" type="text" placeholder="Enter Location">
<button class="btn btn-warning" onclick="showweather()">Get Weather</button>
<p id="demo"></p>
<p id="weather"></p>
</div>
<script type="text/javascript">
	function showweather()
	{	
		$.ajax({
					url: "http://api.openweathermap.org/data/2.5/weather",
					type: 'GET',
					data: {"lat":lat,
				           "lon":lon,
				           "appid":'abd24802c4da9c011e2b2cbb6ec721ec'},
					success: function (result) {
						var data =  JSON.parse(JSON.stringify(result));
						var y = document.getElementById("weather");
						var str = "<h3><strong>Weather at </strong> "+data["name"]+"</h3><br>";
						str += "<img src='http://openweathermap.org/img/w/"+data["weather"][0]["icon"]+".png'></img>";
						str += "<strong>"+data["weather"][0]["main"]+"</strong>  "+data["weather"][0]["description"]+"<br>";
						str += "<table class='table table-striped'>";
						str += "<tr><td><strong>Temperature   </strong>  </td><td>"+(parseInt(data["main"]["temp"])-273.15)+" Celcius</td></tr>";
						str += "<tr><td><strong>Pressure    </strong>  </td><td>"+data["main"]["pressure"]+" hPa</td></tr>";
						str += "<tr><td><strong>Humidity   </strong> </td><td> "+data["main"]["humidity"]+" %</td></tr>";
						str += "<tr><td><strong>Temp_min   </strong> </td><td> "+(parseInt(data["main"]["temp_min"])-273.15)+" Celcius</td></tr>";
						str += "<tr><td><strong>Temp_max   </strong>  </td><td>"+(parseInt(data["main"]["temp_max"])-273.15)+" Celcius</td></tr>";
						str += "<tr><td><strong>Sea level   </strong> </td><td> "+data["main"]["sea_level"]+" hPa</td></tr>";
						str += "<tr><td><strong>Ground level   </strong>  </td><td>"+data["main"]["grnd_level"]+" hPa<br></td></tr>";
						str += "<tr><td><strong>Wind Speed   </strong> </td><td> "+data["wind"]["speed"]+" hPa</td></tr>";
						str += "<tr><td><strong>Wind Degrees   </strong> </td><td> "+data["wind"]["deg"]+" hPa</td></tr></table>";
			
						y.innerHTML = str;
					}
				});
	}
</script>

<script>
var x = document.getElementById("demo");

function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else { 
        x.innerHTML = "Geolocation is not supported by this browser.";
    }
}

function showPosition(position) {
	x.innerHTML = " <br>Location : (" + position.coords.latitude + " , " +  + position.coords.longitude + " )";		
	lat =  position.coords.latitude;
    lon = position.coords.longitude;

    //show location on map
    var loc = new google.maps.LatLng(position.coords.latitude,position.coords.longitude) ;
    var marker = new google.maps.Marker({
        map: map,
        position: loc
      });

    markers.push(marker);
	var bounds = new google.maps.LatLngBounds();
    bounds.extend(loc);
    map.fitBounds(bounds);
    map.setZoom(7);
    showweather();
} 
</script>

</body>
</html>
