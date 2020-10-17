#!/usr/bin/php
<?php

        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
	
//this function log errrors.
function logErrors( $error_number, $error_string, $filename, $line_number )
{
	echo $error_number . "<br>";
	echo $error_string . "<br>"; 
	echo $filename . "<br>";
	echo $line_number . "<br>";
	echo $today . "<br>";
	echo $time . "<br>";

	
$today = date("m-Y-d");
$time =  date("h:i:sa");
$myfile = "logs";
$file = " [" . $today . " | " . $time . "]  " . $error_number ." :" . $error_string . " in " . $filename . " at line " . $line_number . "\n";

file_put_contents("log/" . $myfile . ".txt", $file, FILE_APPEND);

}
set_error_handler("logErrors");


//this function check the responds.
function if_responds($message)
{
$message = strtolower($message);
  if (preg_match('/successfully/',$message) | preg_match('/failed/',$message))
  {
   	 return True;
  }
  	return false;
}
// this line send log to server
if (if_responds($message)
{
	$client = new rabbitMQClient("errorListener.ini","testServer");
    	$client->publish($message);	
}

error_log($message.PHP_EOL,3,"home/tashid/changeRabbit/log/logs.txt");
?>

