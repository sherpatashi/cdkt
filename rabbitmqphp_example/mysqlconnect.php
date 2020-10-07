#!/usr/bin/php
<?php

$mydb = new mysqli('127.0.0.1','kevin','cdkt','CDKTTechnologies');

if ($mydb->errno != 0)
{
	echo "failed to connect to database: ". $mydb->error . PHP_EOL;
	exit(0);
}

echo "successfully connected to database".PHP_EOL;

$query = "select * from userCredentials;";

$response = $mydb->query($query);
if ($mydb->errno != 0)
{
	echo "failed to execute query:".PHP_EOL;
	echo __FILE__.':'.__LINE__.":error: ".$mydb->error.PHP_EOL;
	exit(0);
}

while ($row = mysqli_fetch_array($response)){
	echo $row['username'];
	echo $row['password'];
}

?>
