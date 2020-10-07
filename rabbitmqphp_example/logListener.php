#!/usr/bin/php
<?php
    require_once('path.inc');
    require_once('get_host_info.inc');
    require_once('rabbitMQLib.inc');
	
    function ErrorHandler($e, $fileName){
        $myfile = fopen( $fileName . '.txt', "a" ) or die ("Unable to open file");
        for ($i = 0; $i < count($e); $i++){
          fwrite( $myfile, $e[$i] );
        }
		return true;
    }
	function requestProcessor($request){
        echo "received request".PHP_EOL;
        echo $request['type'];
		
        var_dump($request);
       
        if(!isset($request['type']))
		{
            return array('message'=>"ERROR: unsupported message type");
        }
        switch($request['type']){
            case "frontend":
                echo "frontend webserver";
                $response_msg = ErrorHandler($request['error_string'], 'frontend');
		echo "Result: " .$response_msg;
		break;
            case "backend": 
                echo "Backend Database" ;
                $response_msg = ErrorHandler($request['error_string'], 'backend');
                echo "Result: " . $response_msg;
                break;
        }
        echo $response_msg;
        return $response_msg;
    }
    $server = new rabbitMQServer('testRabbitMQ.ini', 'testServer');
    $server->process_requests('requestProcessor');
   exit();
   fclose($myfile);
?>
