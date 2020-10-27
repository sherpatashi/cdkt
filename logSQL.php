#!/usr/bin/php

error_reporting(E_ALL);
ini_set('display_errors', 'On');
ini_set('display_startup_errors,' 'On');

<?php
function logErrors($error_level, $error_message, $filename, $line_number){
  date_default_timezone_set('America/New_York');
	$time = date("M/d/Y | h:i:sa");
	$file  = "[$time]  $error_level in $filename at line $line_number. \n";

  $client = new rabbitMQClient("logRMQ.ini","logServer");
	$request = array();
	$request['type'] = "log-error";
  $request['message'] = $file;
  
	$response = $client->send_request($request);
	#$response = $client->publish($request);
  return $reponse;
}
set_error_handler("logErrors");

//SQL logging system.
function logSQL($log){
  date_default_timezone_set('America/New_York');
	$time = date("M/d/Y | h:i:sa");
  $file  = "[$time]  $log \n";
  
  $client = new rabbitMQClient("logRMQ.ini","logServer");
	$request = array();
	$request['type'] = "log-SQL";
  $request['message'] = $file;

	$response = $client->send_request($request);
	#$response = $client->publish($request);
  return $reponse; 
}

?>