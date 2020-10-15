#!/usr/bin/php
<?php
    error_reporting(E_ALL);
   
    ini_set('display_errors', 'On');
    ini_set('log_errors', 'On');
   

    require_once('path.inc');
    require_once('get_host_info.inc');
    require_once('rabbitMQLib.inc');
    require_once('testRabbitMQ.ini');

    $myfile = fopen("/home/tashid/git/log/errorLog.txt","r");
    $err_Array = [];
    while(! feof($myfile)){
        array_push($err_Array, fgets($myfile));
    }

    fclose($myfile);

    $request = array();
    $request['type'] = "frontEnd";  
    $request['error_string'] = $err_Array;
    $return_Value =rabbitMQClient($request);
	
    file_put_contents("/home/tashid/git/log/errorLog.txt", "");
    
    function rabbitMQClient($request){
            $client = new rabbitMQClient("errorListener.ini", "testServer");
            if(isset($argv[1])){
                $msg = $argv[1];
            }
            else{
                $msg = "Client";
            }
            $response = $client->send_request($request);
            return $response;
        }
?>