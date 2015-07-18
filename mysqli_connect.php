<?php
DEFINE ('DB_USER', 'Guest');
DEFINE ('DB_PASSWORD', '12345');
DEFINE ('DB_HOST', 'localhost');
DEFINE ('DB_NAME', 'sanrenxia');
$dbc = @mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die ('Could not connect to MySQL: ' . mysqli_connect_error());
mysqli_set_charset($dbc, "utf8");
?>