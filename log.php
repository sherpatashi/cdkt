#!/usr/bin/php
<?php

        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
	

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
?>
