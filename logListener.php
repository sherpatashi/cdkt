#!/usr/bin/php
<?php
  require_once('path.inc');
  require_once('get_host_info.inc');
  require_once('rabbitMQLib.inc');
	
  $server = new rabbitMQServer('logRMQ.ini', 'logServer');
  $server->process_message('messageProcessor');

	function messageProcessor($message){
        echo "received message".PHP_EOL;
        echo $message; 
  }
  //file_put_contents('frontEnd.log', $message);

$logFile = fopen("logs/LogSystem.log", "a");
	fwrite($logFile, $message);
  fclose($logFile);
?>
