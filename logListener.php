#!/usr/bin/php
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

     // creates file and store logs.
function storeLogs($message, $fileName){
	$fp = fopen( $fileName . '.log', "a" );
        fwrite( $fp, $message);
        fclose($fp);
       	return true;
}
//route the request from client.
function requestProcessor($request){
  	echo "Received Request:\n\n";
	var_dump($request);

	if(!isset($request['type'])){
    		return "ERROR: unsupported message type";
	}

switch ($request['type']){
	case "log-error":
      		$msg =  logErrors($request['message'], "logError");
		
    	case "log-login":
		$msg = storeLogs($request['message'], "logLogin");
		
	case "log-register":
		$msg =  logRegister($request['message'], "logRegister");
    	case "log-SQL":
      		$msg =  logSQL($request['message'], "logSQL");
	}
	return $msg;
}
//creating a new server
$server = new rabbitMQServer('logRMQ.ini', 'logServer');
//processes the request sent by client
$server->process_requests('requestProcessor');
   


?>
