#!/usr/bin/php
<?php

        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);

//this function log errrors.
function logErrors( $error_level, $error_message, $filename, $line_number )
{
	
$today = date("m/Y/d");
$time =  date("h:i:sa");
$myfile = "logs";

$file = " [" . $today . " | " . $time . "]  " . "Error ". $error_level ." :" . $error_message . " in " . $filename . " at line " . $line_number . "\r\n";

file_put_contents("log/" . $myfile . ".txt", $file, FILE_APPEND );

}
set_error_handler("logErrors");

?>
