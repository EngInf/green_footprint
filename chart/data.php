<?php
session_start();
$rep_my_custom_sql=$_SESSION['username'];
// Connect to MySQL
$link = mysql_connect( 'localhost', 'root', 'root' );
if ( !$link ) {
  die( 'Could not connect: ' . mysql_error() );
}

// Select the data base
$db = mysql_select_db( 'pegada_energetica', $link );
if ( !$db ) {
  die ( 'Error selecting database \'test\' : ' . mysql_error() );
}

// Fetch the data
$query = "
  SELECT consumo_total,media,cae.descricao as descricao 
  FROM simulacao,empresa,cliente,cae 
  WHERE empresa.cae = cae.id 
  AND cliente.empresa=empresa.id 
  AND simulacao.empresa=empresa.id 
  AND empresa.id=cliente.empresa
  ";
$result = mysql_query( $query );

// All good?
if ( !$result ) {
  // Nope
  $message  = 'Invalid query: ' . mysql_error() . "\n";
  $message .= 'Whole query: ' . $query;
  die( $message );
}

// Print out rows
$prefix = '';
echo "[\n";
while ( $row = mysql_fetch_assoc( $result ) ) {
  echo $prefix . " {\n";
  echo '  "descricao": "' . $row['descricao'] . '",' . "\n";
  echo '  "media": ' . $row['media'] . ',' . "\n";
  echo '  "consumo_total": ' . $row['consumo_total'] . '' . "\n";
  echo " }";
  $prefix = ",\n";
}
echo "\n]";

// Close the connection
mysql_close($link);
?>