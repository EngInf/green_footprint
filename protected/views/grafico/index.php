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

  <!-- the chart code -->
  <script>
var chart;

// create chart
AmCharts.ready(function() {

  // load the data
  var chartData = AmCharts.loadJSON('./chart/data.php');

  // SERIAL CHART
  chart = new AmCharts.AmSerialChart();
  chart.pathToImages = "http://www.amcharts.com/lib/images/";
  chart.dataProvider = chartData;
  chart.categoryField = "descricao";

  // GRAPHS

  var graph1 = new AmCharts.AmGraph();
  graph1.valueField = "media";
  graph1.bullet = "round";
  graph1.bulletBorderColor = "#FFFFFF";
  graph1.bulletBorderThickness = 2;
  graph1.lineThickness = 2;
  graph1.lineAlpha = 0.5;
  chart.addGraph(graph1);
  
  var graph2 = new AmCharts.AmGraph();
  graph2.valueField = "consumo_total";
  graph2.bullet = "round";
  graph2.bulletBorderColor = "#FFFFFF";
  graph2.bulletBorderThickness = 2;
  graph2.lineThickness = 2;
  graph2.lineAlpha = 0.5;
  chart.addGraph(graph2);

  // CATEGORY AXIS
  chart.categoryAxis.parseDates = false;

  // WRITE
  chart.write("chartdiv");
});

  </script>

</body>
</html>

