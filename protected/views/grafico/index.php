<?php
session_start();
$db_connection = mysqli_connect("localhost" , "root" , "root", "pegada_energetica"  );
$user = Yii::app()->user->getId();
$my_custom_sql = "SELECT username FROM users WHERE id=$user";
$result_my_custom_sql = mysqli_query($db_connection, $my_custom_sql);		
$rep_my_custom_sql="";
if ($row_my_custom_sql = mysqli_fetch_array($result_my_custom_sql))
{
	$_SESSION['username'] = $row_my_custom_sql ['username'];
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <title>amCharts tutorial: Loading external data</title>
</head>
<body>

  <!-- prerequisites -->
  <link rel="stylesheet" href="http://www.amcharts.com/lib/style.css" type="text/css">
  <script src="http://www.amcharts.com/lib/3/amcharts.js" type="text/javascript"></script>
  <script src="http://www.amcharts.com/lib/3/serial.js" type="text/javascript"></script>

  <!-- cutom functions -->
  <script>
AmCharts.loadJSON = function(url) {
  // create the request
  if (window.XMLHttpRequest) {
    // IE7+, Firefox, Chrome, Opera, Safari
    var request = new XMLHttpRequest();
  } else {
    // code for IE6, IE5
    var request = new ActiveXObject('Microsoft.XMLHTTP');
  }

  // load it
  // the last "false" parameter ensures that our code will wait before the
  // data is loaded
  request.open('GET', url, false);
  request.send();

  // parse adn return the output
  return eval(request.responseText);
};
  </script>

  <!-- chart container -->
  <div id="chartdiv" style="width: 600px; height: 300px;"></div>

  <script>
  var chartData = AmCharts.loadJSON('./chart/data.php');
  
  var chart = AmCharts.makeChart("chartdiv", {
  "type": "serial",
  "addClassNames": true,
  "theme": "light",
  "autoMargins": false,
  "marginLeft": 75,
  "marginRight": 8,
  "marginTop": 10,
  "marginBottom": 26,
  "balloon": {
    "adjustBorderColor": false,
    "horizontalPadding": 10,
    "verticalPadding": 8,
    "color": "#ffffff"
  },

  "dataProvider": chartData,
  "valueAxes": [{
    "axisAlpha": 0,
    "position": "left"
  }],
  "startDuration": 1,
  "graphs": [{
    "alphaField": "alpha",
    "balloonText": "<span style='font-size:12px;'>[[title]] in [[category]]:<br><span style='font-size:20px;'>[[value]]</span> [[additional]]</span>",
    "fillAlphas": 1,
    "title": "Media do Consumo Total",
    "type": "column",
    "valueField": "consumo",
    "dashLengthField": "dashLengthColumn"
  }, {
    "id": "graph2",
    "balloonText": "<span style='font-size:12px;'>[[title]] in [[category]]:<br><span style='font-size:20px;'>[[value]]</span> [[additional]]</span>",
    "bullet": "round",
    "lineThickness": 3,
    "bulletSize": 7,
    "bulletBorderAlpha": 1,
    "bulletColor": "#FFFFFF",
    "useLineColorForBulletBorder": true,
    "bulletBorderThickness": 3,
    "fillAlphas": 0,
    "lineAlpha": 1,
    "title": "Media por tipo de empresa",
    "valueField": "media"
  }],
  "categoryField": "nome",
  "categoryAxis": {
    "gridPosition": "start",
    "axisAlpha": 0,
    "tickLength": 0
  },
  "export": {
    "enabled": true
  }
});
  </script>
  
  

</body>
</html>

