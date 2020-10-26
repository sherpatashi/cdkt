#!/usr/bin/php
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

	//Error logging system.
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
	
	// Login logging system.
function LogLogin($log){
  	date_default_timezone_set('America/New_York');
	$time = date("M/d/Y | h:i:sa");
  	$file  = "[$time]  $log \n";

  	$client = new rabbitMQClient("logRMQ.ini","logServer");
	$request = array();
	$request['type'] = "log-login";
  	$request['message'] = $file;
  
	$response = $client->send_request($request);
	#$response = $client->publish($request);
  	return $reponse;
}

	//registration loggin system.
function LogRegister($log){
  	date_default_timezone_set('America/New_York');
	$time = date("M/d/Y | h:i:sa");
  	$file  = "[$time]  $log \n";
  
  	$client = new rabbitMQClient("logRMQ.ini","logServer");
	$request = array();
	$request['type'] = "log-register";
  	$request['message'] = $file;
  
	$response = $client->send_request($request);
	#$response = $client->publish($request);
  	return $reponse; 
}
  
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
