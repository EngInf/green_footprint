<?php
	/** @var EmpresaController $this */
	/** @var Empresa $model */
	$this->breadcrumbs = array(
		'Mapa',
	);
	$db_connection = mysqli_connect("localhost" , "root" , "root", "pegada_energetica"  );

?>


<html>
 <head>
 <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
 <title>Mapa</title>
 <style type="text/css">
 body { font: normal 10pt Helvetica, Arial; }
 #map { width: 1125px; height: 600px; border: 0px; padding: 0px; }
 </style>
 <script src="http://maps.google.com/maps/api/js?v=3&sensor=false" type="text/javascript"></script>
 <script type="text/javascript">
 var icon = new google.maps.MarkerImage("http://maps.google.com/mapfiles/ms/micons/blue.png",
 new google.maps.Size(32, 32), new google.maps.Point(0, 0),
 new google.maps.Point(16, 32));
 var center = null;
 var map = null;
 var currentPopup;
 var bounds = new google.maps.LatLngBounds();
 function addMarker(lat, lng, info) {
 var pt = new google.maps.LatLng(lat, lng);
 bounds.extend(pt);
 var marker = new google.maps.Marker({
 position: pt,
 icon: icon,
 map: map
 });
 var popup = new google.maps.InfoWindow({
 content: info,
 maxWidth: 300
 });
 google.maps.event.addListener(marker, "click", function() {
 if (currentPopup != null) {
 currentPopup.close();
 currentPopup = null;
 }
 popup.open(map, marker);
 currentPopup = popup;
 });
 google.maps.event.addListener(popup, "closeclick", function() {
 map.panTo(center);
 currentPopup = null;
 });
 }
 function initMap() {
 map = new google.maps.Map(document.getElementById("map"), {
 center: new google.maps.LatLng(0, 0),
 zoom: 14,
 mapTypeId: google.maps.MapTypeId.ROADMAP,
 mapTypeControl: false,
 mapTypeControlOptions: {
 style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR
 },
 navigationControl: true,
 navigationControlOptions: {
 style: google.maps.NavigationControlStyle.SMALL
 }
 });
 
 <?php
	 $query = "SELECT * FROM empresa";
	 $result = mysqli_query($db_connection, $query);
	 
	 while ($row = mysqli_fetch_array($result))
	 {
		 $descr=$row['nome'];
		 $lat=$row['latitude'];
		 $long=$row['longitude'];
		 echo ("addMarker($lat, $long,'<br>$descr');\n");
	 }
 ?>
 center = bounds.getCenter();
 map.fitBounds(bounds);
 
 }
 </script>
 </head>
 <body onload="initMap()" >
 <div id="map"></div>
 </html>
